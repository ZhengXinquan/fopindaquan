<?php
date_default_timezone_set("Asia/Chongqing");
// login			
// 英文	中文	默认值	备注
// id	id	系统自增	
// login_user_id	登陆用户的id	isNull	
// login_time	访问时间	自动	自动
// login_mark1	备注1	isNull	
// login_mark2	备注2	isNull	
// login_mark3	备注3	isNull	
	
	


class login
{
private $id;
private $login_user_id;
private $login_time;
private $login_mark1;
private $login_mark2;
private $login_mark3;




    /////////////////////
    private $servername;
    private $username;
    private $password;
    private $dbname;

    private $common;

    public function __construct()
    {
        require 'sql.php';
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        require_once 'class.common.php';
        $this->common=new commonFun();
        
$this->id='系统自增';//
$this->login_user_id='isNull';//
$this->login_time='自动';//自动
$this->login_mark1='isNull';//
$this->login_mark2='isNull';//
$this->login_mark3='isNull';//

    }
    /**
     * 插入登陆日志
     * @param userinfo array('userID'='',a=''...);
     * @return Boolean false  失败
     * @return String  返回active_code    成功
     */
    public function insert($userinfo=array())
    {
        foreach ($userinfo as $key => $value) {
            $userinfo[$key] = trim($value); //去掉用户内容后面的空格.
        }
				
//if (array_key_exists('id', $userinfo)) {$this->id=$userinfo ['id'];}
if (array_key_exists('login_user_id', $userinfo)) {$this->login_user_id=$userinfo ['login_user_id'];}
//if (array_key_exists('login_time', $userinfo)) {$this->login_time=$userinfo ['login_time'];}
if (array_key_exists('login_mark1', $userinfo)) {$this->login_mark1=$userinfo ['login_mark1'];}
if (array_key_exists('login_mark2', $userinfo)) {$this->login_mark2=$userinfo ['login_mark2'];}
if (array_key_exists('login_mark3', $userinfo)) {$this->login_mark3=$userinfo ['login_mark3'];}


        $flag=false;
        // 创建连接
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
        if ($conn->connect_error) {
            die("connect_error: " . $conn->connect_error);
            return $flag;
        }
        $sql = "INSERT INTO fopin_login (login_user_id,login_mark1,login_mark2,login_mark3)
            VALUES ('$this->login_user_id', '$this->login_mark1', '$this->login_mark2', '$this->login_mark3')";
     
        $result = mysqli_query($conn, $sql);
        if ($result=== true) {
            $this->id=mysqli_insert_id($conn);
            $flag=$this->id;
        } else {
            die("INSERT_Error: " . $sql . "<br>" . $conn->error);
            return $flag;
        }
        $conn->close();
        return $flag;
    }

    /**
     * 查询并显示登陆日志
     * @param userinfo array('id'='',active_code_user=''，active_code);
     * @param n 输出几条数据
     * @return Boolean false 失败            
     * @return Array  信息   成功 可能为空  注意：array()==false，返回true,即可判断有没有存在
     * 
     * return==false; //true 不存在（含false,array()空值）
     * return!=false; //true 存在 array(有值)
     */
    public function show($userinfo=array())
    {
		//select * from t_news where activity_end_time > now()
		
        foreach ($userinfo as $key => $value) {
            $userinfo[$key] = trim($value); //去掉用户内容后面的空格.
        }
        $flag=false;
        // 创建连接
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
        if ($conn->connect_error) {
            die("connect_error: " . $conn->connect_error);
            return $flag;
        }

        $sql="SELECT * FROM fopin_login";
        $sql.=" WHERE 1 ";
		
        if (array_key_exists("id", $userinfo)) { //表id
            $this->id=$userinfo ["id"];
            $sql.=" AND id='$this->id'";
        }
		if (array_key_exists("login_user_id", $userinfo)) { //表id
            $this->login_user_id=$userinfo ["login_user_id"];
            $sql.=" AND login_user_id='$this->login_user_id'";
        }
        if (array_key_exists("m", $userinfo)) { //数量  limit 0,5; --同上，返回前5行
            $n=$userinfo ["m"];
            $sql.=" limit $m";
			if (array_key_exists("n", $userinfo)) { //数量  limit 0,5; --同上，返回前5行
				$n=$userinfo ["n"];
				$sql.=",$n";
			}
        }
		
		$sql.=" ORDER BY login_time DESC";
        $result = mysqli_query($conn, $sql);

        if ($result===false) {
            return $flag;
        }
        if ($result->num_rows > 0) {
            // 输出数据
            $arr=array();
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($arr, $row);
            }
            $flag= $arr;
        } else {
            $flag=array();
        }

        $conn->close();
        return $flag;
    }

    public function __destruct()
    {
    }
}
