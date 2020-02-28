<?php
error_reporting(E_ALL || ~E_NOTICE);
	//header("Content-Type:text/html;charset=utf-8");//获取需要上传的文件目录

$myFile="file";//
$myFile="uploadfile_ant";
$img=$_FILES[$myFile];
$oldNameWithTmp=$_FILES[$myFile]["name"];
$tmp=end(explode('.',$oldNameWithTmp));
$time=date("Y-m-d H:i:s");

$img_md_5=md5_file($_FILES[$myFile]["tmp_name"]);

$name=$img_md_5.'.'.$tmp;
//$name=date("YmdHis").randName().'.'.$tmp;

$dir='upLoad';

if(!is_dir($dir))
        {
           // echo "<br/>当前目录下，目录".$dir."不存在,并尝试创建";
            mkdir($dir);
           // echo "<br/>";
            if(is_dir($dir))
            {
            //    echo "<br/>当前目录下，目录".$dir."存在";
             //   echo "<br/>创建，成功";
            }else{
              $wrongMsg= "目录".$dir."不存在,并创建失败";
              echoData(-1,$wrongMsg,"src_none");
                exit();
            }
        }
        
		
		
		
 $dir_url=$dir."/" . $name;
$url='upLoad/'.$name;

$fileSizeLimit=10240000/2;//5M



if ((($_FILES[$myFile]["type"] == "image/gif")
        || ($_FILES[$myFile]["type"] == "image/jpeg")
		|| ($_FILES[$myFile]["type"] == "image/jpg")
        || ($_FILES[$myFile]["type"] == "image/png"))
    && ($_FILES[$myFile]["size"] < $fileSizeLimit))
{
    if ($_FILES[$myFile]["error"] > 0)
    {
        $wrongMsg= "error|Return Code: " . $_FILES[$myFile]["error"] . "<br />";
        echoData(-1,$wrongMsg,"src_none");
    }
    else
    {
      if (file_exists($dir."/". $name))
        {
			echoData(2,$url.'已存在,请重试',$url);
        }
        else
        {
                move_uploaded_file($_FILES[$myFile]["tmp_name"],$dir_url);
				
				echoData(1,'success',$url);
				
               //	$md_5=md5_file($dir_url_);//上传的图片md5
        }
    }
}
else
{
	$oldSize=round($_FILES[$myFile]["size"]/1024/1000);
	$oldType=$_FILES[$myFile]["type"];
    $fileSizeLimit=$fileSizeLimit/1024000;
    $wrongMsg= "图片(".$oldSize."MB*".$oldType.")不符合要求（必须是小于".$fileSizeLimit."MB的jpg/png/gif图片)";
    echoData(-1,$wrongMsg,"src_none");
}


	function echoData($code_,$msg_,$src_){
		$json_result=array("code"=>$code_,"msg"=>$msg_,"data"=>$src_);
		echo urldecode (json_encode($json_result));
	}
	function randName(){
		$str='';
		return substr(str_shuffle($str),0,6);
	}
	
	?>
