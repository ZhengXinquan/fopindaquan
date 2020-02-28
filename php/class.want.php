<?php
date_default_timezone_set("Asia/Chongqing");
// want			
// 英文	中文	默认值	备注
// id	id	isNull	系统自增
// want_title	标题	isNull	
// want_create_time	时间	表自动	自动
// want_create_name	求购人姓名	isNull	
// want_create_phone	联系电话	isNull	
// want_detail_word	备注文字	isNull	
// want_detail_imgs	图片	isNull	多张
// want_mark1	备注1	isNull	
// want_mark2	备注2	isNull	
// want_mark3	备注3	isNull	
// 游客可发布			


class want
{
	private $id;
	private $want_title;
	private $want_create_time;
	private $want_create_name;
	private $want_create_phone;
	private $want_detail_word;
	private $want_detail_imgs;
	private $want_mark1;
	private $want_mark2;
	private $want_mark3;


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
		$this->want_title='isNull';//
		$this->want_create_time='表自动';//自动
		$this->want_create_name='isNull';//
		$this->want_create_phone='isNull';//
		$this->want_detail_word='isNull';//
		$this->want_detail_imgs='isNull';//多张
		$this->want_mark1='isNull';//
		$this->want_mark2='isNull';//
		$this->want_mark3='isNull';//
    }
    /**
     * 插入新的求购
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
		if (array_key_exists('want_title', $userinfo)) {$this->want_title=$userinfo ['want_title'];}
		//if (array_key_exists('want_create_time', $userinfo)) {$this->want_create_time=$userinfo ['want_create_time'];}
		if (array_key_exists('want_create_name', $userinfo)) {$this->want_create_name=$userinfo ['want_create_name'];}
		if (array_key_exists('want_create_phone', $userinfo)) {$this->want_create_phone=$userinfo ['want_create_phone'];}
		if (array_key_exists('want_detail_word', $userinfo)) {$this->want_detail_word=$userinfo ['want_detail_word'];}
		if (array_key_exists('want_detail_imgs', $userinfo)) {$this->want_detail_imgs=$userinfo ['want_detail_imgs'];}
		if (array_key_exists('want_mark1', $userinfo)) {$this->want_mark1=$userinfo ['want_mark1'];}
		if (array_key_exists('want_mark2', $userinfo)) {$this->want_mark2=$userinfo ['want_mark2'];}
		if (array_key_exists('want_mark3', $userinfo)) {$this->want_mark3=$userinfo ['want_mark3'];}


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
        $sql = "INSERT INTO fopin_want (want_title,want_create_name,want_create_phone,want_detail_word,want_detail_imgs,want_mark1,want_mark2,want_mark3)
            VALUES ('$this->want_title', '$this->want_create_name', '$this->want_create_phone', '$this->want_detail_word', '$this->want_detail_imgs', '$this->want_mark1', '$this->want_mark2', '$this->want_mark3')";
     
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
     * 查询并显示求购内容
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

        $sql="SELECT * FROM fopin_want";
        $sql.=" WHERE 1 ";
		
		if (array_key_exists("want_title", $userinfo)) { //模糊搜素商品名
            $this->want_title=$userinfo ["want_title"];
            $sql.=" AND want_title LIKE '%$this->want_title%'";
        }
        if (array_key_exists("id", $userinfo)) { //表id
            $this->id=$userinfo ["id"];
            $sql.=" AND id='$this->id'";
        }
        if (array_key_exists("m", $userinfo)) { //数量  limit 0,5; --同上，返回前5行
            $n=$userinfo ["m"];
            $sql.=" limit $m";
			if (array_key_exists("n", $userinfo)) { //数量  limit 0,5; --同上，返回前5行
				$n=$userinfo ["n"];
				$sql.=",$n";
			}
        }
		
		$sql.=" ORDER BY want_create_time DESC";
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

            if ($key!=="id") {
                array_push($updateSqlArr, " ".$key."='".$value."' ");
            }
        }
        $updateSqlStr=implode(",", $updateSqlArr);

		$sql="";
		if (array_key_exists('id', $userinfo)) {
            $this->id=$userinfo ['id'];
			$sql="UPDATE fopin_want SET $updateSqlStr WHERE id='$this->id'";
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
     * delete 按id删除求购
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
		if (array_key_exists('id', $userinfo)) {
            $this->id=$userinfo ['id'];
			$sql="DELETE FROM fopin_want WHERE id='$this->id'";
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


    public function __destruct()
    {
    }
}
