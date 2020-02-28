<?php
date_default_timezone_set("Asia/Chongqing");
// activecode			
// 英文	中文	默认值	备注
// id	id	isNull	系统自增
// active_code	激活码	需要生成	生成
// active_code_time	生成时间	表自动	表自动
// active_code_user	使用者id	0	
// active_code_mark1	备注1	isNull	
// active_code_mark2	备注2	isNull	
// active_code_mark3	备注3	isNull	
//激活码，注册时使用，查询此表，===  1  code存在，2  未被使用		



class activecode
{
	private $id;
	private $active_code;
	private $active_code_time;
	private $active_code_user;
	private $active_code_mark1;
	private $active_code_mark2;
	private $active_code_mark3;
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
		$this->active_code='需要生成';//生成
		$this->active_code_time='表自动';//表自动
		$this->active_code_user='0';//
		$this->active_code_mark1='isNull';//
		$this->active_code_mark2='isNull';//
		$this->active_code_mark3='isNull';//

    }
    /**
     * 插入新的用户
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
		$this->active_code=$this->create_active_code();
		//if (array_key_exists('active_code_time', $userinfo)) {$this->active_code_time=$userinfo ['active_code_time'];}
		if (array_key_exists('active_code_user', $userinfo)) {$this->active_code_user=$userinfo ['active_code_user'];}
		if (array_key_exists('active_code_mark1', $userinfo)) {$this->active_code_mark1=$userinfo ['active_code_mark1'];}
		if (array_key_exists('active_code_mark2', $userinfo)) {$this->active_code_mark2=$userinfo ['active_code_mark2'];}
		if (array_key_exists('active_code_mark3', $userinfo)) {$this->active_code_mark3=$userinfo ['active_code_mark3'];}
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
        $sql = "INSERT INTO fopin_activecode (active_code,active_code_user,active_code_mark1,active_code_mark2,active_code_mark3)
            VALUES ('$this->active_code', '$this->active_code_user', '$this->active_code_mark1', '$this->active_code_mark2', '$this->active_code_mark3')";
     
        $result = mysqli_query($conn, $sql);
        if ($result=== true) {
            $this->id=mysqli_insert_id($conn);
           // $flag=$this->id;
			$flag=$this->active_code;
        } else {
            die("INSERT_Error: " . $sql . "<br>" . $conn->error);
            return $flag;
        }
        $conn->close();
        return $flag;
    }

    /**
     * 查询并显示内容
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

        $sql="SELECT * FROM fopin_activecode ";

        $sql.=" WHERE 1 ";
		
		
        if (array_key_exists("active_code", $userinfo)) { //激活码
            $this->active_code=$userinfo ["active_code"];
            $sql.=" AND fopin_activecode.active_code='$this->active_code'";
        }
        if (array_key_exists("active_code_user", $userinfo)) { //用户id 当id=0时，是查询未被使用的id
            $this->active_code_user=$userinfo ["active_code_user"];
            $sql.=" AND fopin_activecode.active_code_user='$this->active_code_user'";
        }
        if (array_key_exists("id", $userinfo)) { //表id
            $this->id=$userinfo ["id"];
            $sql.=" AND fopin_activecode.id='$this->id'";
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
	 * ******************************注册时使用激活码，链接到某会员id
     */
    public function update($userinfo=array())
    {
        $updateSqlArr=array();
        foreach ($userinfo as $key => $value) {
            $userinfo[$key] = trim($value); //去掉用户内容后面的空格.

            if ($key!=="id" && $key!=="active_code") {
                array_push($updateSqlArr, " ".$key."='".$value."' ");
            }
        }
        $updateSqlStr=implode(",", $updateSqlArr);

		if (array_key_exists('active_code', $userinfo)) {
            $this->active_code=$userinfo ['active_code'];
			$sql="UPDATE fopin_activecode SET $updateSqlStr WHERE active_code='$this->active_code'";
        }
        
		if (array_key_exists('id', $userinfo)) {
            $this->id=$userinfo ['id'];
			$sql="UPDATE fopin_activecode SET $updateSqlStr WHERE id='$this->id'";
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
        $flag = mysqli_query($conn, $sql);

        $conn->close();
        return $flag;
    }

    /**
     * delete 按id或激活码删除激活码，对已被使用的激活码无效
     * @param  id  active_code
     * @return Boolean false  失败，
     * @return Boolean true   成功，
     */
    public function delete($userinfo=array())
    {
		
		foreach ($userinfo as $key => $value) {
            $userinfo[$key] = trim($value); //去掉用户内容后面的空格.
        }
		
		
		$sql="";
		if (array_key_exists('active_code', $userinfo)) {
            $this->active_code=$userinfo ['active_code'];
			$sql="DELETE FROM fopin_activecode WHERE active_code='$this->active_code'";
        }
		
		if (array_key_exists('id', $userinfo)) {
            $this->id=$userinfo ['id'];
			$sql="DELETE FROM fopin_activecode WHERE id='$this->id'";
        }
		
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
        $retval=mysqli_query($conn, $sql);
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
     * 生成激活码
     * @return active_code，
     */
    public function create_active_code(){
		$key="create_active_code is yaoyao";
		$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$randStr = str_shuffle($str);//打乱字符串
		$rands= substr($randStr,0,12);//substr(string,start,length);返回字符串的一部分
		$this->active_code = md5 (date("Y-m-d H:i:s").$rands.$key);
        return $this->active_code;
    }
	
    /**
     * 判断激活码是否可用
     * @param active_code 激活码
     * @return Boolean false  无效，
     * @return Boolean true   可用，
     */
    public function codeIsRight($active_code){
		//是否存在，是否被使用
		$isExist=$this->show(array("active_code"=>$active_code));
		if(!$isExist){
			return false;//不存在，无效
		}
		$isUsed=$isExist[0]['active_code_user'];
		if($isUsed!="0"){
			return false;//被使用，无效
		}
        return true;
    }

    public function __destruct()
    {
    }
}
