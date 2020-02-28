<?php
date_default_timezone_set("Asia/Chongqing");
                
class commonFun
{
    private $ip;
    private $crypt_key;


    public function __construct()
    {
        $this->ip="unknown";
        $this->crypt_key="daljedecrypt_keyiomjkls";
    }

    /**
     * 返回当前客户端ip
     * @param
     * @return  $ip
     * 失败返回 unknown
     *
     */
    public function getIP()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            $ip = getenv("REMOTE_ADDR");
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = "unknown";
        }
        $this->ip=$ip;
        return $ip;
    }
    /**
     * 返回时间差
     * @param
     * @return  大于0，表示 t1更晚，差返回过去了多少秒数
     *
     *
     */
    public function checkTime($t1, $t0='')
    {
        if ($t0=='') {
            $t0=date("Y-m-d H:i:s");
        }
        // strtotime — 将任何英文文本的日期时间描述解析为 Unix 时间戳
        return strtotime($t1)-strtotime($t0);
    }
    /**
     * 返回凯撒加密
     * @param text 明文
     * @param key 偏移量，默认16
     * @return  _text 密文
     *
     */
    public function caesar($text, $key=16)
    {
        $temp="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstvuwxyz0123456789";
        $temp="pDARYrx243OsZB5bUiPgSKXvEQ1cj0IodJVlFfyh79NzGMtuk8amnwWHTCeqL6";
        $max=strlen($temp);
        $l=strlen($text);
        $_text='';
        for ($i=0;$i<$l;$i++) {
            $index=strpos($temp, $text[$i]);
            $_key=$index+$key;
            $_key=($_key>=$max)?($_key-$max):$_key;
            $_text.=substr($temp, $_key, 1);
        }
        return  $_text;
    }
     /**
     * 返回以n位字符串
     * @param text 
     * @param n 默认6，需要返回几位，前面以temp补齐
     * @param temp 默认0，
     * @return  _text 
     *
     */
    public function add0str($text, $n=6 ,$temp='0')
    {
        $text=$text.'';
        $temp=$temp.'';
        $l=$n-strlen($text);
        if($l<=0){
            return $text;
        }else{
            for ($i=0;$i<$l;$i++) {
                $text=$temp.$text;
            }
        }
        return  $text;
    }

    public function encrypt($data, $key=false)
    {
        $this->crypt_key=$key||$this->crypt_key;

        $key = md5($this->crypt_key);
        $x	 = 0;
        $len = strlen($data);
        $l	 = strlen($key);
        $char='';
        $str='';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l) 
            {
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return base64_encode($str);
    }
    public function decrypt($data, $key=false)
    {
        $this->crypt_key=$key||$this->crypt_key;
        
        $key = md5($this->crypt_key);

        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char='';
        $str='';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l) 
            {
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
            {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }
            else
            {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }

    /**
     * @description Make HTTP-GET call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPGet($url, array $params) {
        $query = http_build_query($params); 
        $ch    = curl_init($url.'?'.$query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    /**
     * @description Make HTTP-POST call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPPost($url, array $params) {
        $query = http_build_query($params);
        $ch    = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    /**
     * @description Make HTTP-PUT call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPPut($url, array $params) {
        $query = http_build_query($params);
        $ch    = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    /**
     * @category Make HTTP-DELETE call
     * @param    $url
     * @param    array $params
     * @return   HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPDelete($url, array $params) {
        $query = http_build_query($params);
        $ch    = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    public function __destruct()
    {
    }
}
