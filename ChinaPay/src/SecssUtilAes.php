<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/11
 * Time: 2:05 上午
 */

namespace ChinaPay;


class SecssUtilAes
{
    private $rsa;
    private $split_char = "|";

    public function __construct($path)
    {
        require_once './SecssUtilRsa.php';
        $this->rsa = new SecssUtil();
        $securityPropFile = $path;
        $initRes = $this->rsa->init($securityPropFile);
        if (!$initRes) {
            echo "初始化失败！请检查证书文件路径！";
            return;
        }
    }

    public function encodeEnvelope($bytes, $isZip = true)
    {
        if ($bytes == null) {
            return false;
        }
        $data = $this->toStr($bytes);
        if ($isZip) {
            $data = $this->deflater($data);
        }
        $aesKey = $this->genAESKey(97, 122);
        $encryptAesData = $this->encrypt_aes($aesKey, $data);
        $this->rsa->encryptData(base64_encode($aesKey));
        if ("00" !== $this->rsa->getErrCode()) {
            echo "有卡交易域加密过程发生错误，错误信息为-->" . $this->rsa->getErrMsg();
            return;
        }
        $encryptKey = $this->rsa->getEncValue();
        $encryData = $encryptKey . $this->split_char . $encryptAesData;
        return $encryData;
    }

    public function decodeEnvelope($decodeEnvelope, $isZip = true)
    {
        if ($decodeEnvelope == null) {
            return false;
        }
        $tmp_arr = explode("|", $decodeEnvelope);
        $keyRsa = $tmp_arr[0];
        $this->rsa->decryptData($keyRsa);
        if ("00" !== $this->rsa->getErrCode()) {
            echo "有卡交易域解密过程发生错误，错误信息为-->" . $this->rsa->getErrMsg();
            return;
        }
        $key = $this->rsa->getDecValue();
        $key = base64_decode($key);
        $contentAes = $tmp_arr[1];
        $content = $this->decrypt($key, $contentAes);
        if ($isZip) {
            $content = $this->inflater($content);
        }
        $content = $this->getBytes($content);
        return $content;
    }

    private function deflater($string)
    {
        $compressed = gzcompress($string);
        return $compressed;
    }

    private function inflater($string)
    {
        $data = gzuncompress($string);
        return $data;
    }

    public function toStr($bytes)
    {
        $str = "";
        foreach ($bytes as $ch) {
            $str .= chr($ch);
        }
        return $str;
    }

    public function getBytes($string)
    {
        $bytes = array();
        for ($i = 0; $i < strlen($string); $i++) {
            $bytes[] = ord($string[$i]);
        }
        return $bytes;
    }

    private function genAESKey($min = 97, $max = 122)
    {
        $str = '';
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $ks = mcrypt_enc_get_key_size($td);
        for ($i = 1; $i <= $ks; $i++) {
            $str .= chr(mt_rand($min, $max));
        }
        return $str;
    }

    private function encrypt_aes($key, $input)
    {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = $this->pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    private function decrypt($key, $sStr)
    {
        $decrypted = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $key,
            base64_decode($sStr),
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s - 1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }

    private static function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}
