<?php
date_default_timezone_set("Asia/Chongqing");
$appid ="wx157cce0cd769d568";
$secret ="d5de06c842a5919537f1ae96ab65fc3a";	
if (is_array($_GET)&&count($_GET)>0) {
    if (isset($_GET["code"])) {
        if (strlen($_GET["code"])>0) {
            $js_code=$_GET["code"];
			
			$url__="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$js_code."&grant_type=authorization_code";
			
			$wxopenid_json=file_get_contents($url__);
			
			echo $wxopenid_json;
			
			//$wxopenid_json=json_decode($wxopenid_json);
        }
    }
	
}

		require_once 'class.user.php';
        $user=new user();
		$checkToken = $user->checkToken('13588213453','b4111eea43c368eea0893c90e9679865');
		
var_dump($re);
echo "<br>";
       require_once 'class.activecode.php';
        $DBactivecode=new activecode();
		echo $DBactivecode->insert();
		
		echo '<br>';echo '<br>';
		
		
		$str='1234567';
		
	function randName(){
		$key="create_active_code is yaoyao";
		$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$randStr = str_shuffle($str);//打乱字符串
		$rands= substr($randStr,0,12);//substr(string,start,length);返回字符串的一部分
		return md5 (date("Y-m-d H:i:s").$rands.$key);
	}
	echo randName();echo '<br>';
	echo randName();echo '<br>';
	echo randName();echo '<br>';
	echo randName();echo '<br>';
				
				echo date('Y-m-d H:i:s');'<br>';
				echo date('Y-m-d H:i:s', strtotime("+1 year"));//过期时间
				
              // require_once 'class.common.php';  // $commonFun=new commonFun();

               // $wxopenid_json=$commonFun->getHtml($url__);
				
				
				
				
				
				
				
				//object(stdClass)#2 (2) { ["errcode"]=> int(40029) ["errmsg"]=> string(48) "invalid code, hints: [ req_id: YHHBP0yFe-8xmQ4 ]" } 
				//object(stdClass)#2 (2) { ["session_key"]=> string(24) "LbMCY1i2YQgmczfop1dpNA==" ["openid"]=> string(28) "o6Pa45ez4qt561UF8YWKAB5sy2-4" } 
				
				
?>