<?php
date_default_timezone_set("Asia/Chongqing");
header('Access-Control-Allow-Origin:http://localhost');

// php获取目录中的所有文件名

// 1、先打开要操作的目录，并用一个变量指向它

//打开当前目录下的目录pic下的子目录common。



if(is_array($_GET)&&count($_GET)>0){
	
	    if (isset($_GET["defilename"])) {
        if(strlen($_GET["defilename"])>0){
			$__myfile=$_GET["defilename"];
		if(file_exists($_GET["defilename"])){
			
			unlink($__myfile);
			
			 if(file_exists($__myfile)){
				 echo json_encode(array("code"=>"0","msg"=>"删除失败","data"=>$__myfile));
			 }else{
				 echo json_encode(array("code"=>"1","msg"=>"删除成功","data"=>$__myfile));
			 }
		}else{
			 echo json_encode(array("code"=>"0","msg"=>"不存在","data"=>$__myfile));
		}}}
	
    if (isset($_GET["dir"])) {
        if(strlen($_GET["dir"])>0){
            if(file_exists($_GET["dir"])){
                $handler = opendir($_GET["dir"]);
                // 2、循环的读取目录下的所有文件
                /*其中$filename = readdir($handler)是每次循环的时候将读取的文件名赋值给$filename，为了不陷于死循环，所以还要让$filename !== false。一定要用!==，因为如果某个文件名如果叫’0′，或者某些被系统认为是代表false，用!=就会停止循环*/
				$fileArr=array();
                while( ($filename = readdir($handler)) !== false ) 
                {
                    //   3、目录下都会有两个文件，名字为’.'和‘..’，不要对他们进行操作
                    if($filename !="." && $filename !="..")
                    {
						$myfile=$_GET["dir"].'/'.$filename;
						$a=filectime($myfile);
						$a=date("Y-m-d H:i:s",$a);//创建时间
						$b=filemtime($myfile);
						$b=date("Y-m-d H:i:s",$b);//修改时间：
						$c=fileatime($myfile);
						$c=date("Y-m-d H:i:s",$c);//访问时间
						array_push($fileArr,array(
						"src"=>$filename,
						"create_time"=>$a,
						"update_time"=>$b,
						"visit_time"=>$c
						));
                    }
                }
				echo json_encode(array("code"=>"1","msg"=>"获取成功","data"=>$fileArr));
                // 5、关闭目录
                closedir($handler);
        }}}}

?>