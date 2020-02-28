<?php
date_default_timezone_set("Asia/Chongqing");
// user			
// 英文	中文	默认值	备注
// id	id	isNull	系统自增
// user_account	账号	isNull	只能手机号
// user_pwd	密码	isNull	6-10位 数字或英文字母
// user_name	厂家名称	isNull	会员
// user_addr	厂家地址	isNull	会员
// user_phone	厂家电话	isNull	会员
// user_active_code	激活码	isNull	后台生成
// user_create_time	注册时间	表自动	自动
// user_token	会话标识	isNull	
// user_mark1	备注1	isNull	
// user_mark2	备注2	isNull	
// user_mark3	备注3	isNull	

class user
{
    private $id;
	private $user_account;
	private $user_pwd;
	private $user_name;
	private $user_addr;
	private $user_phone;
	private $user_active_code;
	private $user_end_time;
	private $user_mark1;
	private $user_mark2;
	private $user_mark3;

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
        
		$this->id='isNull';//系统自增
		$this->user_account='isNull';//只能手机号
		$this->user_pwd='isNull';//6-10位 数字或英文字母
		$this->user_name='isNull';//会员
		$this->user_addr='isNull';//会员
		$this->user_phone='isNull';//会员
		$this->user_active_code='isNull';//后台生成
		$this->user_create_time= date("Y-m-d H:i:s");//自动
		$this->user_end_time=date('Y-m-d H:i:s', strtotime("+1 year"));//默认1年后过期;//可修改
		$this->user_token='isNull';//
		$this->user_mark1='VIP会员';//
		$this->user_mark2='isNull';//
		$this->user_mark3='isNull';//
    }
    /**
     * 插入新的用户
     * @param userinfo array('userID'='',a=''...);
     * @return Boolean false  失败，ip已存在
     * @return String  错误信息  失败
     * @return String  返回id    成功
     */
    public function insert($userinfo)
    {
        foreach ($userinfo as $key => $value) {
            $userinfo[$key] = trim($value); //去掉用户内容后面的空格.
        }
		
		if (array_key_exists('user_account', $userinfo)) {$this->user_account=$userinfo ['user_account'];}
		if (array_key_exists('user_pwd', $userinfo)) {$this->user_pwd=$userinfo ['user_pwd'];}
		$this->user_pwd=$this->createPassWord($this->user_pwd);
		
		if (array_key_exists('user_name', $userinfo)) {$this->user_name=$userinfo ['user_name'];}
		if (array_key_exists('user_addr', $userinfo)) {$this->user_addr=$userinfo ['user_addr'];}
		if (array_key_exists('user_phone', $userinfo)) {$this->user_phone=$userinfo ['user_phone'];}
		if (array_key_exists('user_active_code', $userinfo)) {$this->user_active_code=$userinfo ['user_active_code'];}
		//if (array_key_exists('user_create_time', $userinfo)) {$this->user_create_time=$userinfo ['user_create_time'];}
		//if (array_key_exists('user_end_time', $userinfo)) {$this->user_end_time=$userinfo ['user_end_time'];}
		//if (array_key_exists('user_token', $userinfo)) {$this->user_token=$userinfo ['user_token'];}
		
		$this->user_token=$this->createToken($this->user_account);
		
		if (array_key_exists('user_mark1', $userinfo)) {$this->user_mark1=$userinfo ['user_mark1'];}
		if (array_key_exists('user_mark2', $userinfo)) {$this->user_mark2=$userinfo ['user_mark2'];}
		if (array_key_exists('user_mark3', $userinfo)) {$this->user_mark3=$userinfo ['user_mark3'];}

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
     
        $sql = "INSERT INTO fopin_user (user_account,user_pwd,user_name,user_addr,user_phone,user_active_code,user_create_time,user_end_time,user_token,user_mark1,user_mark2,user_mark3)
            VALUES ('$this->user_account', '$this->user_pwd', '$this->user_name', '$this->user_addr', '$this->user_phone', '$this->user_active_code','$this->user_create_time','$this->user_end_time', '$this->user_token', '$this->user_mark1', '$this->user_mark2', '$this->user_mark3')";
     
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
     * 查询并显示内容
     * @param userinfo array('id'='',user_account='');
     * @param n 输出几条数据
     * @return Boolean false 失败            
     * @return Array  信息   成功 可能为空  注意：array()==false，返回true,即可判断有没有存在
     * 
     * return==false; //true 用户不存在（含false,array()空值）
     * return!=false; //true 用户存在 array(有值)
     */
    public function show($userinfo=array())
    {
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

        $sql="SELECT u.*,l.login_time FROM fopin_user u LEFT JOIN (select aaaaaa.* from (select * from fopin_login order by login_time desc) aaaaaa group by aaaaaa.login_user_id) l ON u.id=l.login_user_id ";

        $sql.=" WHERE 1 ";

        if (array_key_exists("user_account", $userinfo)) { //用户账号
            $this->user_account=$userinfo ["user_account"];
            $sql.=" AND u.user_account='$this->user_account'";
        }
        if (array_key_exists("id", $userinfo)) { //用户id
            $this->id=$userinfo ["id"];
            $sql.=" AND u.id='$this->id'";
        }
		if (array_key_exists("user_name", $userinfo)) { //模糊用户名
            $this->user_name=$userinfo ["user_name"];
            $sql.=" AND u.user_name LIKE '%$this->user_name%'"; 
        }
        if (array_key_exists("n", $userinfo)) { //数量
            $n=$userinfo ["n"];
            $sql.=" limit $n";
        }
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
    /**
     * update
     * @param  userinfo 键值对组成的关联array，会更新array内的指定id
     * @return Boolean false  失败，
     * @return Boolean true   成功，
	 * ******************************登陆/更新token时，需要传入账号
     */
    public function update($userinfo=array())
    {
        $updateSqlArr=array();
        foreach ($userinfo as $key => $value) {
            $userinfo[$key] = trim($value); //去掉用户内容后面的空格.

            if ($key=="user_pwd") {
                $value=$this->createPassWord($value);
            }
            if ($key=="user_token") {
                $value=$this->createToken($value);
            };

            if ($key!=="id") {
                array_push($updateSqlArr, " ".$key."='".$value."' ");
            }
        }
        $updateSqlStr=implode(",", $updateSqlArr);
        if (array_key_exists('id', $userinfo)) {
            $this->id=$userinfo ['id'];
        }
        $sql="UPDATE fopin_user SET $updateSqlStr WHERE id='$this->id'";

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
        $flag = mysqli_query($conn, $sql);

        $conn->close();
        return $flag;
    }

    /**
     * delete
     * @param  id
     * @return Boolean false  失败，
     * @return Boolean true   成功，
     */
    public function delete($id)
    {
        $flag=false;

        $this->id=$id;
        // 创建连接
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
        if ($conn->connect_error) {
            die("connect_error: " . $conn->connect_error);
            return $flag;
        }
        $retval=mysqli_query($conn, "DELETE FROM fopin_user WHERE id='$this->id'");
        if (! $retval) {
            die('DELETE_ERR: ' . mysqli_error($conn));
            $flag=false;
        } else {
            $flag=true;
        }
        $conn->close();
        return $flag;
    }

    /**
     * 检测登陆状态
     * @param user_account 会员账号，即手机号
	 * @param user_token
     * @return Boolean false  失败，
     * @return Boolean true   成功，
     */
    public function checkToken($id,$user_token){
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
        $sql="SELECT user_token FROM fopin_user WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result===false) {
            return $flag;
        }
        if ($result->num_rows == 1) {
            // 输出数据
            $row = mysqli_fetch_assoc($result);
            $flag = ($user_token==$row["user_token"]);
        } else {
            $flag=array();
        }
        $conn->close();
        return $flag;
    }
	
    /**
     * 生成user_token
     * @param account 会员账号，即手机号
     * @return loginToken  信息   成功
     */
    public function createToken($account){
        //md5 取值范围仅限于 0-9 和 a-f
        $this->user_token = md5 ($account.date("Y-m-d H:i:s")."createToken is yaoyao");
        // $temp=$token_id."|".$userID."|".$loginWebID."|".$loginkeep."|".$userAuthorize;
        // require_once 'class.common.php';
        // $common=new commonFun();
        // $this->loginToken =$common->encrypt($temp);
        return $this->user_token;
    }
    /**
     * 加密
     * @param passWord 明文;
     * @return String 密文
     */
    public function createPassWord($passWord)
    {
        return md5($passWord."createPassWord is yaoyao");
    }
    public function __destruct()
    {
    }
}
