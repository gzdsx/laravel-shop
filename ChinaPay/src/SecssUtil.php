<?php

namespace ChinaPay;

define('CP_SIGN_FILE', "sign.file");
define('CP_SIGN_FILE_PASSWORD', "sign.file.password");
define('CP_SIGN_CERT_TYPE', "sign.cert.type");
define('CP_SIGN_INVALID_FIELDS', "sign.invalid.fields");
define('CP_VERIFY_FILE', "verify.file");
define('CP_SIGNATURE_FIELD', "signature.field");
define('CP_SUCCESS', "00");
define("CP_LOAD_CONFIG_ERROR", "01");
define("CP_SIGN_CERT_ERROR", "02");
define("CP_SIGN_CERT_PWD_ERROR", "03");
define("CP_SIGN_CERT_TYPE_ERROR", "04");
define("CP_INIT_SIGN_CERT_ERROR", "05");
define("CP_VERIFY_CERT_ERROR", "06");
define("CP_INIT_VERIFY_CERT_ERROR", "07");
define("CP_GET_PRI_KEY_ERROR", "08");
define("CP_GET_CERT_ID_ERROR", "09");
define("CP_GET_SIGN_STRING_ERROR", "10");
define("CP_SIGN_GOES_WRONG", "11");
define("CP_VERIFY_GOES_WRONG", "12");
define("CP_VERIFY_FAILED", "13");
define("CP_SIGN_FIELD_NULL", "14");
define("CP_SIGN_VALUE_NULL", "15");
define("CP_UNKNOWN_WRONG", "16");
define("CP_ENCPIN_GOES_WRONG", "17");
define("CP_ENCDATA_GOES_WRONG", "18");
define("CP_DECDATA_GOES_WRONG", "19");
define("CP_DEFAULTINIT_GOES_WRONG", "20");
define("CP_SPECIFYINIT_GOES_WRONG", "21");
define("CP_RELOADSC_GOES_WRONG", "22");
define("CP_NO_INIT", "23");
define("CP_CONFIG_WRONG", "24");
define("CP_INIT_CONFIG_WRONG", "25");
define("CP_KEY_VALUE_CONNECT", "=");
define("CP_MESSAGE_CONNECT", "&");
define("CP_SIGN_ALGNAME", "SHA512WithRSA");
define("CP_ENC_ALG_PREFIX", "RSA");
define("CP_CHARSET_COMM", "UTF-8");
define("CP_PKCS12", "PKCS12");
define("CP_OPENSSL_ALGO_SHA1", 1);
define("CP_OPENSSL_ALGO_SHA224", 6);
define("CP_OPENSSL_ALGO_SHA256", 7);
define("CP_OPENSSL_ALGO_SHA384", 8);
define("CP_OPENSSL_ALGO_SHA512", 9);

class SecssUtil
{
    private static $VERSION = 1.0;
    private static $errMap = array(
        CP_SUCCESS => "操作成功",
        CP_LOAD_CONFIG_ERROR => "加载security.properties配置文件出错，请检查文件路径！",
        CP_SIGN_CERT_ERROR => "签名文件路径配置错误！",
        CP_SIGN_CERT_PWD_ERROR => "签名文件访问密码配置错误！",
        CP_SIGN_CERT_TYPE_ERROR => "签名文件密钥容器类型配置错误，需为PKCS12！",
        CP_INIT_SIGN_CERT_ERROR => "初始化签名文件出错！",
        CP_VERIFY_CERT_ERROR => "验签证书路径配置错误！",
        CP_INIT_VERIFY_CERT_ERROR => "初始化验签证书出错！",
        CP_GET_PRI_KEY_ERROR => "获取签名私钥出错！",
        CP_GET_CERT_ID_ERROR => "获取签名证书ID出错！",
        CP_GET_SIGN_STRING_ERROR => "获取签名字符串出错！",
        CP_SIGN_GOES_WRONG => "签名过程发生错误！",
        CP_VERIFY_GOES_WRONG => "验签过程发生错误！",
        CP_VERIFY_FAILED => "验签失败！",
        CP_SIGN_FIELD_NULL => "配置文件中签名字段名称为空！",
        CP_SIGN_VALUE_NULL => "报文中签名为空！",
        CP_UNKNOWN_WRONG => "未知错误",
        CP_ENCPIN_GOES_WRONG => "Pin加密过程发生错误！",
        CP_ENCDATA_GOES_WRONG => "数据加密过程发生错误！",
        CP_DECDATA_GOES_WRONG => "数据解密过程发生错误！",
        CP_DEFAULTINIT_GOES_WRONG => "从默认配置文件初始化安全控件发生错误！",
        CP_SPECIFYINIT_GOES_WRONG => "从指定属性集初始化安全控件发生错误！",
        CP_RELOADSC_GOES_WRONG => "重新加载签名证书发生错误！",
        CP_NO_INIT => "未初化安全控件",
        CP_CONFIG_WRONG => "控件初始化信息未正确配置，请检查！",
        CP_INIT_CONFIG_WRONG => "初始化配置信息发生错误！"
    );
    private static $encryptFieldMap = array(
        "CardTransData"
    );
    private $CPPublicKey;
    private $MerPrivateKey;
    private $sign;
    private $encPin;
    private $encValue;
    private $decValue;
    private $privatePFXCertId;
    private $publicCERCertId;
    private $errCode;
    private $errMsg;
    private $signFile;
    private $signFilePassword;
    private $signCertType;
    private $signInvalidFields;
    private $verifyFile;
    private $signatureField;
    private $initFalg = false;
    private $shaMethod = CP_OPENSSL_ALGO_SHA512;
    private $cpPubBits;
    private $merPriBits;

    public function getVerstion()
    {
        return self::$VERSION;
    }

    /**
     * @param $securityPropFile
     * @return bool
     */
    public function init($securityPropFile)
    {
        try {
            $key_file = parse_ini_file($securityPropFile);
            if (!$key_file) {
                $this->errCode = CP_LOAD_CONFIG_ERROR;
                $this->writeLog("in SecssUitl->init 加载security.properties配置文件出错，请检查文件路径！");
                return false;
            }
            if (array_key_exists(CP_SIGN_FILE, $key_file)) {
                $this->signFile = $key_file[CP_SIGN_FILE];
                if (empty($this->signFile)) {
                    $this->errCode = CP_SIGN_CERT_ERROR;
                    $this->writeLog("in SecssUitl->init security.properties文件中sign.file为空 ");
                    return false;
                }
                if (!file_exists($this->signFile)) {
                    $this->errCode = CP_SIGN_CERT_ERROR;
                    $this->writeLog("in SecssUitl->init security.properties文件中sign.file=[" . $this->verifyFile . "],文件不存在");
                    return false;
                }
            } else {
                $this->errCode = CP_SIGN_CERT_ERROR;
                $this->writeLog("in SecssUitl->init security.properties文件中sign.file参数不存在 ");
                return false;
            }
            if (array_key_exists(CP_SIGN_FILE_PASSWORD, $key_file)) {
                $this->signFilePassword = $key_file[CP_SIGN_FILE_PASSWORD];
            } else {
                $this->signFilePassword = "";
            }
            if (array_key_exists(CP_SIGN_CERT_TYPE, $key_file)) {
                $this->signCertType = $key_file[CP_SIGN_CERT_TYPE];
                if (empty($this->signCertType)) {
                    $this->errCode = CP_SIGN_CERT_TYPE_ERROR;
                    $this->writeLog("in SecssUitl->init security.properties文件中sign.cert.type格式为空 ");
                    return false;
                } else
                    if (CP_PKCS12 != $this->signCertType) {
                        $this->errCode = CP_SIGN_CERT_TYPE_ERROR;
                        $this->writeLog("in SecssUitl->init security.properties文件中sign.cert.type格式错误 ");
                        return false;
                    }
            } else {
                $this->errCode = CP_SIGN_CERT_TYPE_ERROR;
                $this->writeLog("in SecssUitl->init security.properties文件中sign.cert.type字段不存在");
                return false;
            }
            if (array_key_exists(CP_SIGN_INVALID_FIELDS, $key_file)) {
                $this->signInvalidFields = $key_file[CP_SIGN_INVALID_FIELDS];
            }
            if (array_key_exists(CP_VERIFY_FILE, $key_file)) {
                $this->verifyFile = $key_file[CP_VERIFY_FILE];
                if (empty($this->verifyFile)) {
                    $this->errCode = CP_VERIFY_CERT_ERROR;
                    $this->writeLog("in SecssUitl->init security.properties文件中verify.file字段为空");
                    return false;
                }
                if (!file_exists($this->verifyFile)) {
                    $this->errCode = CP_VERIFY_CERT_ERROR;
                    $this->writeLog("in SecssUitl->init security.properties文件中verify.file=[" . $this->verifyFile . "],文件不存在");
                    return false;
                }
            } else {
                $this->errCode = CP_VERIFY_CERT_ERROR;
                $this->writeLog("in SecssUitl->init security.properties文件中verify.file字段不存在");
                return false;
            }
            if (array_key_exists(CP_SIGNATURE_FIELD, $key_file)) {
                $this->signatureField = $key_file[CP_SIGNATURE_FIELD];
            }
            $merPkcs12 = file_get_contents($this->signFile);
            if (empty($merPkcs12)) {
                $this->errCode = CP_GET_PRI_KEY_ERROR;
                $this->writeLog("in SecssUitl->init 读取pfx证书文件失败.pfxFile=[" . $this->signFile . "]");
                return false;
            }
            $pkcs12 = openssl_pkcs12_read($merPkcs12, $this->MerPrivateKey, $this->signFilePassword);
            if (!$pkcs12) {
                $this->errCode = CP_GET_PRI_KEY_ERROR;
                $this->writeLog("in SecssUitl->init 解析pfx证书内容错误.pfxFile=[" . $this->signFile . "]");
                return false;
            }

            $x509data = $this->MerPrivateKey['cert'];
            if (!openssl_x509_read($x509data)) {
                $this->errCode = CP_GET_PRI_KEY_ERROR;
                $this->writeLog("in SecssUitl->init 读取pfx证书公钥错误.pfxFile=[" . $this->signFile . "]");
                return false;
            }
            $certdata = openssl_x509_parse($x509data);
            if (empty($certdata)) {
                $this->errCode = CP_GET_PRI_KEY_ERROR;
                $this->writeLog("in SecssUitl->init 解析pfx证书公钥成功，但解析证书错误.pfxFile=[" . $this->signFile . "]");
                return false;
            }
            $this->privatePFXCertId = $certdata['serialNumber'];
            $this->writeLog("in SecssUitl->init 解析pfx证书公钥成功，证书编号=[" . $this->privatePFXCertId . "]");
            $this->CPPublicKey = file_get_contents($this->verifyFile);
            if (empty($this->CPPublicKey)) {
                $this->errCode = CP_INIT_VERIFY_CERT_ERROR;
                $this->writeLog("in SecssUitl->init 读取CP公钥证书文件失败.cerFile=[" . $this->verifyFile . "]");
                return false;
            }
            $pk = openssl_pkey_get_public($this->CPPublicKey);
            $a = openssl_pkey_get_details($pk);
            $this->cpPubBits = $a['bits'];
            $certdata = openssl_x509_parse($this->CPPublicKey, false);
            if (empty($certdata)) {
                $this->errCode = CP_INIT_VERIFY_CERT_ERROR;
                $this->writeLog("in SecssUitl->init 解析CP证书公钥成功，但解析证书错误.cerFile=[" . $this->verifyFile . "]");
                return false;
            }
            $this->publicCERCertId = $certdata['serialNumber'];
            $this->writeLog("in SecssUitl->init 解析CP证书公钥成功，证书编号=[" . $this->publicCERCertId . "]");
            $this->initFalg = true;
            return true;
        } catch (\Exception $e) {
            $this->errCode = CP_UNKNOWN_WRONG;
            $this->writeLog("in SecssUitl->init 初始化CP签名控件出错,message=" . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $paramArray
     * @return bool
     */
    public function sign($paramArray)
    {
        try {
            $this->sign = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->sign 未调用init方法，无法进行签名");
                return false;
            }
            ksort($paramArray);
            $signRawData = $this->getSignStr($paramArray);
            if (empty($signRawData)) {
                $this->errCode = CP_GET_SIGN_STRING_ERROR;
                $this->writeLog("in SecssUitl->sign 获取待签名字符串失败");
                return false;
            }
            $charSet = mb_detect_encoding($signRawData, array(
                "UTF-8",
                "GB2312",
                "GBK"
            ));
            $tempSignRawData = mb_convert_encoding($signRawData, "UTF-8", $charSet);
            $this->writeLog("in SecssUitl->sign 待签名数据=[" . $tempSignRawData . "]");
            //echo $tempSignRawData.'<br><br>';
            $sign_falg = openssl_sign($tempSignRawData, $signature, $this->MerPrivateKey['pkey'], $this->shaMethod);
            if (!$sign_falg) {
                $this->errCode = CP_SIGN_GOES_WRONG;
                $this->writeLog("in SecssUitl->sign 签名失败,openssl签名失败,openssl return=[" . $sign_falg . "]");
                return false;
            }
            $base64Result = base64_encode($signature);
            $this->sign = $base64Result;
            $this->errCode = CP_SUCCESS;
            return true;
        } catch (\Exception $e) {
            $this->errCode = CP_SIGN_GOES_WRONG;
            $this->writeLog("in SecssUitl->sign 签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $paramArray
     * @param $cpOpensslAlgo
     * @return bool
     */
    public function signByAlgo($paramArray, $cpOpensslAlgo)
    {
        try {
            $this->shaMethod = $cpOpensslAlgo;
            return $this->sign($paramArray);
        } catch (\Exception $e) {
            $this->errCode = CP_SIGN_GOES_WRONG;
            $this->writeLog("in SecssUitl->signByAlgo 签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $paramArray
     * @return bool
     */
    public function verify($paramArray)
    {
        try {
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->verify 未调用init方法，无法进行验签");
                return false;
            }
            $orgSignMsg = $paramArray["Signature"];
            if (empty($orgSignMsg)) {
                $this->writeLog("in SecssUitl->verify paramArray数组中签名字段为空。");
                $this->errCode = CP_SIGN_VALUE_NULL;
                return false;
            }
            unset($paramArray["Signature"]);
            ksort($paramArray);
            $verifySignData = $this->getSignStr($paramArray);
            $charSet = mb_detect_encoding($verifySignData, array(
                "UTF-8",
                "GB2312",
                "GBK"
            ));
            $tempVerifySignData = mb_convert_encoding($verifySignData, "UTF-8", $charSet);
            $this->writeLog("in SecssUitl->verify  待验证签名数据 =[" . $tempVerifySignData . "]");
            //echo $tempVerifySignData.'<br><br>';
            $result = openssl_verify($tempVerifySignData, base64_decode($orgSignMsg), $this->CPPublicKey, $this->shaMethod);
            if ($result == 1) {
                $this->errCode = CP_SUCCESS;
            } else
                if ($result == 0) {
                    $this->errCode = CP_VERIFY_FAILED;
                } else {
                    $this->errCode = CP_VERIFY_GOES_WRONG;
                }
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_VERIFY_GOES_WRONG;
            $this->writeLog("in SecssUitl->verify  验证签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function verifyByAlgo($paramArray, $cpOpensslAlgo)
    {
        try {
            $this->shaMethod = $cpOpensslAlgo;
            return $this->verify($paramArray);
        } catch (\Exception $e) {
            $this->errCode = CP_VERIFY_GOES_WRONG;
            $this->writeLog("in SecssUitl->verifyByAlgo  验证签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function getSignCertId()
    {
        return $this->privatePFXCertId;
    }

    public function encryptPin($pin, $card)
    {
        try {
            $this->encPin = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->encryptPin 未调用init方法，无法进行加密");
                return false;
            }
            $pinBlock = $this->pin2PinBlockWithCardNO($pin, $card);
            if (empty($pinBlock)) {
                $this->errCode = CP_ENCPIN_GOES_WRONG;
                $this->writeLog("in SecssUitl->encryptPin PIN加密异常,计算得到的PinBlock为空");
                return false;
            }
            $pk = openssl_pkey_get_public($this->CPPublicKey);
            $a = openssl_pkey_get_details($pk);
            $n = $a["rsa"]["n"];
            $e = $a["rsa"]["e"];
            $intN = $this->bin2int($n);
            $intE = $this->bin2int($e);
            $crypted = bcpowmod($this->bin2int($pinBlock), $intE, $intN);
            if (!$crypted) {
                $this->errCode = CP_ENCPIN_GOES_WRONG;
                $this->writeLog("in SecssUitl->encryptPin pin加密失败,errCode=[" . $this->errCode . "]");
                return false;
            }
            $rb = $this->bcdechex($crypted);
            $rb = $this->padstr($rb);
            $crypted = hex2bin($rb);
            $this->errCode = CP_SUCCESS;
            $this->encPin = base64_encode($crypted);
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_ENCPIN_GOES_WRONG;
            $this->writeLog("in SecssUitl->encryptPin PIN加密异常,message=" . $e->getMessage());
            return false;
        }
    }

    private function pin2PinBlockWithCardNO($aPin, $aCardNO)
    {
        $tPinByte = $this->pin2PinBlock($aPin);
        if (empty($tPinByte)) {
            return null;
        }
        if (strlen($aCardNO) == 11) {
            $aCardNO = "00" . $aCardNO;
        } else
            if (strlen($aCardNO) == 12) {
                $aCardNO = "0" . $aCardNO;
            }
        $tPanByte = $this->formatPan($aCardNO);
        if (empty($tPanByte)) {
            return null;
        }
        $tByte = array();
        for ($i = 0; $i < 8; $i++) {
            $tByte[$i] = $tPinByte[$i] ^ $tPanByte[$i];
        }
        $result = "";
        foreach ($tByte as $key => $value) {
            $result .= chr($value);
        }
        return $result;
    }

    private function formatPan($aPan)
    {
        $tPanLen = strlen($aPan);
        $tByte = array();
        $temp = $tPanLen - 13;
        try {
            $tByte[0] = 0;
            $tByte[1] = 0;
            for ($i = 2; $i < 8; $i++) {
                $a = "\x" . substr($aPan, $temp, 2);
                $tByte[$i] = hexdec($a);
                $temp += 2;
            }
        } catch (\Exception $e) {
            return null;
        }
        return $tByte;
    }

    private function pin2PinBlock($aPin)
    {
        $tTemp = 1;
        $tPinLen = strlen($aPin);
        $tByte = array();
        try {
            $tByte[0] = $tPinLen;
            $i = 0;
            if ($tPinLen % 2 == 0) {
                for ($i = 0; $i < $tPinLen;) {
                    $a = hexdec("\x" . substr($aPin, $i, 2));
                    $tByte[$tTemp] = $a;
                    if (($i == $tPinLen - 2) && ($tTemp < 7)) {
                        for ($x = $tTemp + 1; $x < 8; $x++) {
                            $tByte[$x] = -1;
                        }
                    }
                    $tTemp++;
                    $i += 2;
                }
            } else {
                for ($i = 0; $i < $tPinLen - 1;) {
                    $a = hexdec("\x" . substr($aPin, $i, $i + 2));
                    $tByte[$tTemp] = $a;
                    if ($i == $tPinLen - 3) {
                        $b = hexdec("\x" . substr($aPin, $tPinLen - 1) . "F");
                        $tByte[($tTemp + 1)] = $b;
                        if ($tTemp + 1 < 7) {
                            for ($x = $tTemp + 2; $x < 8; $x++) {
                                $tByte[$x] = -1;
                            }
                        }
                    }
                    $tTemp++;
                    $i += 2;
                }
            }
        } catch (\Exception $e) {
            return null;
        }
        return $tByte;
    }

    public function encryptData_ForClose($data)
    {
        try {
            $this->encValue = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->encryptData 未调用init方法，无法进行加密");
                return false;
            }
            $charSet = mb_detect_encoding($data, array(
                "UTF-8",
                "GB2312",
                "GBK"
            ));
            $tmpData = mb_convert_encoding($data, "UTF-8", $charSet);
            $pk = openssl_pkey_get_public($this->CPPublicKey);
            $a = openssl_pkey_get_details($pk);
            $n = $a["rsa"]["n"];
            $e = $a["rsa"]["e"];
            $intN = $this->bin2int($n);
            $intE = $this->bin2int($e);
            $crypted = bcpowmod($this->bin2int($tmpData), $intE, $intN);
            if (!$crypted) {
                $this->errCode = CP_ENCDATA_GOES_WRONG;
                $this->writeLog("in SecssUitl->encryptData 数据加密失败,errCode=[" . $this->errCode . "]");
                return false;
            }
            $rb = $this->bcdechex($crypted);
            $rb = $this->padstr($rb);
            $crypted = hex2bin($rb);
            $this->errCode = CP_SUCCESS;
            $this->encValue = base64_encode($crypted);
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_ENCDATA_GOES_WRONG;
            $this->writeLog("in SecssUitl->encryptData 数据加密异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function decryptData_ForClose($data)
    {
        try {
            $this->decValue = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->decryptData 未调用init方法，无法进行加密");
                return false;
            }
            $pkeyResource = openssl_pkey_get_private($this->MerPrivateKey['pkey']);
            if (openssl_private_decrypt(base64_decode($data), $tmpDecValue, $pkeyResource, OPENSSL_NO_PADDING)) {
                $this->errCode = CP_SUCCESS;
            } else {
                $this->errCode = CP_DECDATA_GOES_WRONG;
            }
            $this->decValue = $this->remove_padding($tmpDecValue);
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_DECDATA_GOES_WRONG;
            $this->writeLog("in SecssUitl->decryptData 数据解密异常,message=" . $e->getMessage());
            return false;
        }
    }

    private function getSignStr($paramArray)
    {
        $result = "";
        $invalidFieldsArray = explode(',', $this->signInvalidFields);
        foreach ($paramArray as $key => $value) {
            if (in_array($key, $invalidFieldsArray)) {
                continue;
            }
            $result = $result . $key . CP_KEY_VALUE_CONNECT . $value . CP_MESSAGE_CONNECT;
        }
        if (CP_MESSAGE_CONNECT === substr($result, -1, 1)) {
            $result = substr($result, 0, strlen($result) - 1);
        }
        return $result;
    }

    public function getSign()
    {
        return $this->sign;
    }

    public function getEncPin()
    {
        return $this->encPin;
    }

    public function getEncValue()
    {
        return $this->encValue;
    }

    public function getDecValue()
    {
        return $this->decValue;
    }

    public function getPrivatePFXCertId()
    {
        return $this->privatePFXCertId;
    }

    public function getPublicCERCertId()
    {
        return $this->publicCERCertId;
    }

    public function getErrCode()
    {
        return $this->errCode;
    }

    public function getErrMsg()
    {
        if (empty($this->errCode)) {
            $this->errMsg = self::$errMap[CP_UNKNOWN_WRONG];
        } else {
            $this->errMsg = self::$errMap[$this->errCode];
        }
        if (empty($this->errMsg)) {
            $this->errMsg = self::$errMap[CP_UNKNOWN_WRONG];
        }
        return $this->errMsg;
    }

    private function writeLog($log)
    {
        error_log($log . "\n", 0);
    }

    private function bin2int($bindata)
    {
        $hexdata = bin2hex($bindata);
        return $this->bchexdec($hexdata);
    }

    private function bchexdec($hexdata)
    {
        $ret = '0';
        $len = strlen($hexdata);
        for ($i = 0; $i < $len; $i++) {
            $hex = substr($hexdata, $i, 1);
            $dec = hexdec($hex);
            $exp = $len - $i - 1;
            $pow = bcpow('16', $exp);
            $tmp = bcmul($dec, $pow);
            $ret = bcadd($ret, $tmp);
        }
        return $ret;
    }

    private function padstr($src, $len = 256, $chr = '0', $d = 'L')
    {
        $ret = trim($src);
        $padlen = $len - strlen($ret);
        if ($padlen > 0) {
            $pad = str_repeat($chr, $padlen);
            if (strtoupper($d) == 'L') {
                $ret = $pad . $ret;
            } else {
                $ret = $ret . $pad;
            }
        }
        return $ret;
    }

    private function bcdechex($decdata)
    {
        $s = $decdata;
        $ret = '';
        while ($s != '0') {
            $m = bcmod($s, '16');
            $s = bcdiv($s, '16');
            $hex = dechex($m);
            $ret = $hex . $ret;
        }
        return $ret;
    }

    private function number_to_binary($number, $blocksize)
    {
        $base = "256";
        $result = "";
        $div = $number;
        while ($div > 0) {
            $mod = bcmod($div, $base);
            $div = bcdiv($div, $base);
            $result = chr($mod) . $result;
        }
        return str_pad($result, $blocksize, "\x00", STR_PAD_LEFT);
    }

    private function binary_to_number($data)
    {
        $base = "256";
        $radix = "1";
        $result = "0";
        for ($i = strlen($data) - 1; $i >= 0; $i--) {
            $digit = ord($data{$i});
            $part_res = bcmul($digit, $radix);
            $result = bcadd($result, $part_res);
            $radix = bcmul($radix, $base);
        }
        return $result;
    }

    private function remove_padding($data)
    {
        $offset = strrpos($data, "\x00", 1);
        return substr($data, $offset + 1);
    }

    private function signFromStr($signStr)
    {
        try {
            $this->sign = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->signFromStr 未调用init方法，无法进行签名");
                return false;
            }
            if (empty($signStr)) {
                $this->errCode = CP_GET_SIGN_STRING_ERROR;
                $this->writeLog("in SecssUitl->signFromStr 获取待签名字符串失败");
                return false;
            }
            $sign_falg = openssl_sign($signStr, $signature, $this->MerPrivateKey['pkey'], $this->shaMethod);
            if (!$sign_falg) {
                $this->errCode = CP_SIGN_GOES_WRONG;
                return false;
            }
            $base64Result = base64_encode($signature);
            $this->sign = $base64Result;
            $this->errCode = CP_SUCCESS;
            return true;
        } catch (\Exception $e) {
            $this->errCode = CP_SIGN_GOES_WRONG;
            $this->writeLog("in SecssUitl->signFromStr 签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    private function verifyFromStr($paramArray)
    {
        try {
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->verifyFromStr 未调用init方法，无法进行验签");
                return false;
            }
            $orgSignMsg = $paramArray["Signature"];
            if (empty($orgSignMsg)) {
                $this->writeLog("in SecssUitl->verifyFromStr paramArray数组中签名字段为空。");
                $this->errCode = CP_SIGN_VALUE_NULL;
                return false;
            }
            unset($paramArray["Signature"]);
            $verifySignData = $paramArray["plainData"];
            $result = openssl_verify($verifySignData, base64_decode($orgSignMsg), $this->CPPublicKey, $this->shaMethod);
            if ($result == 1) {
                $this->errCode = CP_SUCCESS;
            } else {
                if ($result == 0) {
                    $this->errCode = CP_VERIFY_FAILED;
                } else {
                    $this->errCode = CP_VERIFY_GOES_WRONG;
                }
            }
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_VERIFY_GOES_WRONG;
            $this->writeLog("in SecssUitl->verifyFromStr 验证签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function signFile($filePath)
    {
        try {
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->signFile 未调用init方法，无法进行签名");
                return false;
            }
            $tempFilePath = mb_convert_encoding($filePath, "GBK", "auto");
            $this->signFileByAlgo($tempFilePath, CP_OPENSSL_ALGO_SHA512);
            return true;
        } catch (\Exception $e) {
            $this->errCode = CP_SIGN_GOES_WRONG;
            $this->writeLog("in SecssUitl->signFile 文件签名异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function signFileByAlgo($tempFilePath, $cpOpensslAlgo)
    {
        try {
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->signFileByAlgo 未调用init方法，无法进行签名");
                return false;
            }
            $filePath = mb_convert_encoding($tempFilePath, "GBK", "auto");
            if (!is_file($filePath)) {
                $this->errCode = CP_SIGN_GOES_WRONG;
                $this->writeLog("in SecssUitl->signFileByAlgo 文件不存在，无法进行签名.file=[" . $filePath . "]");
                return false;
            }
            $hashAlgo = "sha512";
            if (CP_OPENSSL_ALGO_SHA1 == $cpOpensslAlgo) {
                $hashAlgo = "sha1";
            } else
                if (CP_OPENSSL_ALGO_SHA224 == $cpOpensslAlgo) {
                    $hashAlgo = "sha224";
                } else
                    if (CP_OPENSSL_ALGO_SHA256 == $cpOpensslAlgo) {
                        $hashAlgo = "sha256";
                    } else
                        if (CP_OPENSSL_ALGO_SHA384 == $cpOpensslAlgo) {
                            $hashAlgo = "sha384";
                        } else
                            if (CP_OPENSSL_ALGO_SHA512 == $cpOpensslAlgo) {
                                $hashAlgo = "sha512";
                            }
            $ctx = hash_init($hashAlgo);
            $handle = fopen($filePath, "r");
            $max = filesize($filePath);
            $chunk = 4096;
            if ($max <= $chunk) {
                $endIndex = 0;
            } else {
                $endIndex = ($max % $chunk === 0 ? $max / $chunk : $max / $chunk + 1);
            }
            $endReadLength = $max % $chunk;
            $readData = "";
            $ctx = hash_init($hashAlgo);
            for ($i = 0; $i <= $endIndex; $i++) {
                if ($i == $endIndex) {
                    if ($endReadLength > 0) {
                        $readData = fread($handle, $endReadLength);
                    } else {
                        $readData = fread($handle, $chunk);
                    }
                } else {
                    $readData = fread($handle, $chunk);
                }
                $readData = str_replace(array(
                    "\r\n",
                    "\r",
                    "\n"
                ), "", $readData);
                hash_update($ctx, $readData);
            }
            fclose($handle);
            clearstatcache();
            $hashResult = hash_final($ctx);
            if ($this->signFromStr(hex2bin($hashResult))) {
                $data = "\r\n" . $this->getSign();
                if (file_put_contents($filePath, $data, FILE_APPEND) !== false) {
                    clearstatcache();
                    return true;
                } else {
                    $this->errCode = CP_SIGN_GOES_WRONG;
                    $this->writeLog("in SecssUitl->signFileByAlgo 写入签名数据至文件失败.file=[" . $filePath . "]");
                    clearstatcache();
                    return false;
                }
            } else {
                $this->errCode = CP_SIGN_GOES_WRONG;
                $this->writeLog("in SecssUitl->signFileByAlgo 文件签名失败.file=[" . $filePath . "]");
                clearstatcache();
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_SIGN_GOES_WRONG;
            $this->writeLog("in SecssUitl->signFileByAlgo 文件签名异常,message=" . $e->getMessage());
            clearstatcache();
            return false;
        }
    }

    public function verifyFile($filePath)
    {
        try {
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->verifyFile 未调用init方法，无法进行签名");
                return false;
            }
            return $this->verifyFileByAlgo($filePath, CP_OPENSSL_ALGO_SHA512);
        } catch (\Exception $e) {
            $this->errCode = CP_SIGN_GOES_WRONG;
            $this->writeLog("in SecssUitl->verifyFile 文件验签异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function verifyFileByAlgo($tempFilePath, $cpOpensslAlgo)
    {
        try {
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->verifyFileByAlgo 未调用init方法，无法进行签名");
                return false;
            }
            $filePath = mb_convert_encoding($tempFilePath, "GBK", "auto");
            if (!is_file($filePath)) {
                $this->errCode = CP_VERIFY_GOES_WRONG;
                $this->writeLog("in SecssUitl->verifyFileByAlgo 文件不存在，无法进行验签.file=[" . $filePath . "]");
                return false;
            }
            $hashAlgo = "sha512";
            if (CP_OPENSSL_ALGO_SHA1 == $cpOpensslAlgo) {
                $hashAlgo = "sha1";
            } else
                if (CP_OPENSSL_ALGO_SHA224 == $cpOpensslAlgo) {
                    $hashAlgo = "sha224";
                } else
                    if (CP_OPENSSL_ALGO_SHA256 == $cpOpensslAlgo) {
                        $hashAlgo = "sha256";
                    } else
                        if (CP_OPENSSL_ALGO_SHA384 == $cpOpensslAlgo) {
                            $hashAlgo = "sha384";
                        } else
                            if (CP_OPENSSL_ALGO_SHA512 == $cpOpensslAlgo) {
                                $hashAlgo = "sha512";
                            }
            $max = filesize($filePath);
            $handle = fopen($filePath, "r");
            $index = -1;
            fseek($handle, $index, SEEK_END);
            $orgSignature = "";
            while (($c = fread($handle, 1)) !== false) {
                if ($c == "\n" || $c == "\r")
                    break;
                $orgSignature = $c . $orgSignature;
                $index = $index - 1;
                fseek($handle, $index, SEEK_END);
            }
            fclose($handle);
            $handle = fopen($filePath, "a+");
            ftruncate($handle, $max - strlen($orgSignature));
            fclose($handle);
            clearstatcache();
            $max = filesize($filePath);
            $handle = fopen($filePath, "r");
            $chunk = 4096;
            if ($max <= $chunk) {
                $endIndex = 0;
            } else {
                $endIndex = ($max % $chunk === 0 ? $max / $chunk : $max / $chunk + 1);
            }
            $endReadLength = $max % $chunk;
            $readData = "";
            $ctx = hash_init($hashAlgo);
            for ($i = 0; $i <= $endIndex; $i++) {
                if ($i === $endIndex) {
                    if ($endReadLength > 0) {
                        $readData = fread($handle, $endReadLength);
                    } else {
                        $readData = fread($handle, $chunk);
                    }
                } else {
                    $readData = fread($handle, $chunk);
                }
                $readData = str_replace(array(
                    "\r\n",
                    "\r",
                    "\n"
                ), "", $readData);
                hash_update($ctx, $readData);
            }
            fclose($handle);
            clearstatcache();
            $hashResult = hash_final($ctx);
            $paramArray = array(
                "plainData" => hex2bin($hashResult),
                "Signature" => $orgSignature
            );
            $verifyResult = $this->verifyFromStr($paramArray);
            if (file_put_contents($filePath, $orgSignature, FILE_APPEND) !== false) {
                clearstatcache();
                return $verifyResult;
            } else {
                $this->errCode = CP_VERIFY_FAILED;;
                $this->writeLog("in SecssUitl->signFileByAlgo 写入原签名数据至文件失败.file=[" . $filePath . "]");
                clearstatcache();
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_VERIFY_GOES_WRONG;
            $this->writeLog("in SecssUitl->verifyFileByAlgo 文件签名验证异常,message=" . $e->getMessage());
            clearstatcache();
            return false;
        }
    }

    public function encryptData($data)
    {
        try {
            $this->encValue = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->encryptData 未调用init方法，无法进行加密");
                return false;
            }
            $charSet = mb_detect_encoding($data, array(
                "UTF-8",
                "GB2312",
                "GBK"
            ));
            $tmpData = mb_convert_encoding($data, "UTF-8", $charSet);
            $pk = openssl_pkey_get_public($this->CPPublicKey);
            $crypted = '';
            $is_error = 0;
            if (is_numeric($this->cpPubBits) && $this->cpPubBits === 1024) {
                $split_length = 127;
                $pad_length = 128;
            } elseif (is_numeric($this->cpPubBits) && $this->cpPubBits === 2048) {
                $split_length = 255;
                $pad_length = 256;
            }
            foreach (str_split($tmpData, $split_length) as $chunk) {
                if (openssl_public_encrypt(str_pad($chunk, $pad_length, "\x00", STR_PAD_LEFT), $encryptData, $pk, OPENSSL_NO_PADDING)) {
                    $crypted .= $encryptData;
                } else {
                    $is_error = 1;
                }
            }
            if (!$is_error) {
                $this->errCode = CP_SUCCESS;
                $this->encValue = base64_encode($crypted);
            }
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_ENCDATA_GOES_WRONG;
            $this->writeLog("in SecssUitl->encryptData 数据加密异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function decryptData($data)
    {
        try {
            $this->decValue = null;
            if (!$this->initFalg) {
                $this->errCode = CP_NO_INIT;
                $this->writeLog("in SecssUitl->decryptData 未调用init方法，无法进行加密");
                return false;
            }
            $pkeyResource = openssl_pkey_get_private($this->MerPrivateKey['pkey']);
            $priInfo = openssl_pkey_get_details($pkeyResource);
            $this->merPriBits = $priInfo['bits'];
            $crypto = '';
            $is_error = 0;
            $bytes = array();
            if (is_numeric($this->merPriBits) && $this->merPriBits === 1024) {
                $split_length = 128;
            } elseif (is_numeric($this->merPriBits) && $this->merPriBits === 2048) {
                $split_length = 256;
            }
            foreach (str_split(base64_decode($data), $split_length) as $chunk) {
                if (openssl_private_decrypt($chunk, $tmpDecValue, $pkeyResource, OPENSSL_NO_PADDING)) {
                    $bytes[] = $this->getBytes($tmpDecValue);
                } else {
                    $is_error = 1;
                }
            }
            $crypto = $this->toStr($bytes);
            if (!$is_error) {
                $this->errCode = CP_SUCCESS;
            } else {
                $this->errCode = CP_DECDATA_GOES_WRONG;
            }
            $this->decValue = $crypto;
            if ($this->errCode === CP_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->errCode = CP_DECDATA_GOES_WRONG;
            $this->writeLog("in SecssUitl->decryptData 数据解密异常,message=" . $e->getMessage());
            return false;
        }
    }

    public function getBytes($string)
    {
        $flag = false;
        $bytes = array();
        for ($i = 0; $i < strlen($string); $i++) {
            if (ord($string[$i]) === 0 && !$flag) {
                continue;
            } else {
                $bytes[] = ord($string[$i]);
                $flag = true;
            }
        }
        return $bytes;
    }

    public function toStr($bytes)
    {
        $str = '';
        foreach ($bytes as $key => $ch) {
            foreach ($ch as $k => $v) {
                $str .= chr($v);
            }
        }
        return $str;
    }
}
