@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('post/catlog')}}">
                <span class="btn btn-primary">分类管理</span>
            </a>
            <a href="{{admin_url('post')}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>发布文章</h2>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off" id="Form">
            {{csrf_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tr>
                    <td width="80">文章标题</td>
                    <td><input type="text" class="form-control" placeholder="在这里输入标题" name="post[title]"
                               value="{{$post->title}}" id="title" style="width: 760px;" required></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tr>
                    <td width="80">目录分类</td>
                    <td width="380">
                        <select name="post[catid]" class="custom-select w300" title="">
                            {!! $catlogOptions !!}
                        </select>
                    </td>
                    <td width="80">文章来源</td>
                    <td width="320"><input type="text" title="" class="form-control w300" name="post[from]"
                                           value="{{$post->from}}"></td>
                    <td rowspan="5" style="text-align: center">
                        <input type="hidden" id="postImage" name="post[image]" value="{{$post->image ?? ''}}">
                        <div class="post-image-box" title="点击更换图片">
                            <div class="bg-cover" id="postImagePreview"
                                 style="width: 140px; height: 140px; display: inline-block; background-image: url({{image_url($post->image)}})"></div>
                            <p style="text-align: center; padding-top: 5px;">文章配图</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>文章别名</td>
                    <td><input type="text" title="" class="form-control w300" name="post[alias]" value="{{$post->alias}}"></td>
                    <td>来源地址</td>
                    <td><input type="text" title="" class="form-control w300" name="post[fromurl]" value="{{$post->fromurl}}"></td>
                </tr>
                <tr>
                    <td>评论设置</td>
                    <td><label><input type="checkbox" name="post[allowcomment]" value="1"{{$post->allowcomment ? ' checked="checked"' : ''}}> 允许评论</label></td>
                    <td>文章标签</td>
                    <td><input type="text" title="" class="form-control w300" name="post[tags]" value="{{$post->tags}}"></td>
                </tr>
                <tr>
                    <td>文章作者</td>
                    <td><input type="text" title="" class="form-control w300" name="post[author]" value="{{$post->author}}"></td>
                    <td>文章形式</td>
                    <td>
                        <label onclick="switchContent('article')"><input type="radio" name="post[type]" value="article"{{$post->type=='article' ? ' checked="checked"' : ''}}> 文章</label>
                        <label onclick="switchContent('image')"><input type="radio" name="post[type]" value="image"{{$post->type=='image' ? ' checked="checked"' : ''}}> 相册</label>
                        <label onclick="switchContent('video')"><input type="radio" name="post[type]" value="video"{{$post->type=='video' ? ' checked="checked"' : ''}}> 视频</label>
                    </td>
                </tr>
                <tr>
                    <td>阅读价格</td>
                    <td><input type="text" title="" class="form-control w300" name="post[price]" value="{{$post->price}}"></td>
                    <td>发布时间</td>
                    <td><input type="text" title="" class="form-control w300" name="post[created_at]" value="{{$post->created_at}}"></td>
                </tr>
            </table>
            <table width="100%" class="formtable">
                <tr>
                    <td width="80">内容摘要</td>
                    <td><textarea title="" class="form-control" name="post[summary]" style="height: 100px;">{{$post->summary}}</textarea></td>
                </tr>
            </table>
            <!--文章内容部分-->
            <div class="swithContent" id="content-article" style="display: none;">
                <table width="100%" class="dsxui-formtable">
                    <tr>
                        <td width="80">文章内容</td>
                        <td>
                            <div style="box-sizing:border-box">
                                @include('common.editor', ['name' => 'content[content]', 'content'=>$post->content['content'], 'params'=>[]])
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <!--文章内容部分-->
            <div class="swithContent" id="content-image" style="display: none;">
                <table width="100%" class="dsxui-formtable">
                    <tr>
                        <td width="80">图片列表</td>
                        <td>
                            <div id="postImages">
                                @foreach($post->images as $img)
                                    <table class="dsxui-formtable" width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="90">
                                                <input type="hidden" name="images[{{$img['id']}}][thumb]" value="{{$img['thumb']}}">
                                                <input type="hidden" name="images[{{$img['id']}}][image]" value="{{$img['image']}}">
                                                <div class="bg-cover" style="background-image: url({{$img['thumb']}}); width: 80px; height: 80px; display: block;"></div>
                                            </td>
                                            <td width="500">
                                                <textarea name="images[{{$img['id']}}][description]" class="form-control w500 h80" title="" placeholder="图片介绍">{{$img['description']}}</textarea>
                                            </td>
                                            <td class="cell-tips"><a class="font-24" onclick="removeItem(this)">&times;</a></td>
                                        </tr>
                                    </table>
                                @endforeach
                            </div>
                            <p>
                                <a id="addNewImg" class="btn btn-link">
                                    <span class="iconfont icon-roundadd" style="vertical-align: -2px;"></span>
                                    <span>添加图片</span>
                                </a>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="swithContent" id="content-video" style="display: none;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                    <tr>
                        <td width="80">视频地址</td>
                        <td>
                            <input title="" type="text" class="form-control w-100" name="media[media_link]" value="{{$post->media['media_link'] ?? ''}}">
                            <p>请输入QQ视频，优酷网、酷6网、56网的视频播放页链接</p>
                        </td>
                    </tr>
                </table>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tr>
                    <td width="80"></td>
                    <td><input type="submit" class="btn btn-primary w100" value="发布"></td>
                </tr>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $("#content-{{$post->type}}").show();

        function switchContent(type) {
            $(".swithContent").hide();
            $("#content-" + type).show();
        }

        function removeItem(o) {
            DSXUI.showConfirm('确认要删除此图片吗?', function () {
                $(o).parent().parent().parent().parent().remove();
            });
        }

        $("#postImagePreview").click(function (e) {
            Widget.showImagePicker(function (data) {
                console.log(data);
                $("#postImage").val(data.image);
                $("#postImagePreview").css('background-image', 'url(' + data.image + ')');
            });
        });

        ;$(function () {
            var k = 0;
            $("#addNewImg").on('click', function () {
                Widget.showImagePicker(function (data) {
                    $("#postImages").append('<table class="dsxui-formtable" width="100%" cellspacing="0" cellpadding="0">\n' +
                        '                                            <tr>\n' +
                        '                                                <td width="90">\n' +
                        '<input type="hidden" name="images[' + k + '][thumb]" value="' + data.thumb + '">' +
                        '<input type="hidden" name="images[' + k + '][image]" value="' + data.image + '">' +
                        '                                                    <div class="bg-cover" style="background-image: url(' + data.thumb + '); width: 80px; height: 80px; display: block;"></div>\n' +
                        '                                                </td>\n' +
                        '                                                <td width="500">\n' +
                        '                                                    <textarea name="images[' + k + '][description]" class="form-control w500 h80" title="" placeholder="图片介绍"></textarea>\n' +
                        '                                                </td>\n' +
                        '                                                <td class="cell-tips"><a class="font-24" onclick="removeItem(this)">&times;</a></td>\n' +
                        '                                            </tr>\n' +
                        '                                        </table>');
                });
                k--;
            });
            $("#postImages").sortable();

            $("#Form").on('submit', function (e) {
                var title = $.trim($("#title").val());
                if (!title) {
                    DSXUI.showToast("{{trans('post.post title required')}}");
                    return false;
                }
            });
        });
    </script>
@stop
