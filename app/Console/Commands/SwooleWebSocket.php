<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SwooleWebSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:websocket {port}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swoole websocket';

    protected $redis;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->redis = Redis::connection()->client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //创建server
        $server = new \Swoole\WebSocket\Server("0.0.0.0", $this->argument('port'));
//        $server = new \Swoole\WebSocket\Server("0.0.0.0", 30002, SWOOLE_PROCESS, SWOOLE_SOCK_TCP | SWOOLE_SSL);
//        $server->set([
//            'ssl_cert_file' => base_path('cert/3925396_shop.gzdsx.cn.pem'),
//            'ssl_key_file' => base_path('cert/3925396_shop.gzdsx.cn.key'),
//        ]);

        //连接成功回调
        $server->on('open', function (\Swoole\WebSocket\Server $server, \Swoole\Http\Request $request) {
            $this->info('客户端' . $request->fd . '链接成功');
            //dump($request);
            $pathinfo = pathinfo($request->server['path_info']);
            parse_str($pathinfo['filename'], $query);
            if (isset($query['tid'])) {
                $this->redis->sAdd('rooms', $query['tid']);
                $this->redis->sAdd('room_' . $query['tid'], $request->fd);
            }
        });

        //收到消息回调
        $server->on('message', function (\Swoole\WebSocket\Server $server, \Swoole\WebSocket\Frame $frame) {
            //dump($frame);

            $content = json_decode($frame->data);
            dump($content);
            if (is_object($content)) {
                $content->created_at = now()->format('m-d H:i:s');
                //推送给所有链接
                //foreach ($server->connections as $fd) {
                //    $server->push($fd, json_encode($content));
                //}
                if ($content->tid) {
                    foreach ($this->redis->sMembers('room_' . $content->tid) as $fd) {
                        if ($server->exist($fd)) {
                            $server->push($fd, json_encode($content));
                        } else {
                            $this->redis->sRem('room_' . $content->tid, $fd);
                        }
                    }
                }
            }
        });

        //关闭链接回调
        $server->on('close', function (\Swoole\WebSocket\Server $server, $fd) {
            $this->info('客户端' . $fd . '断开链接');
            //unset($this->connections[$fd]);
            foreach ($this->redis->sMembers('rooms') as $tid) {
                $this->redis->sRem('room_' . $tid, $fd);
            }
        });

        //Redis::remove('rooms');
        $server->start();
        return true;
    }
}
