<?php
date_default_timezone_set("Asia/Chongqing");
// carousel			
// 英文	中文	默认值	备注
// id	id	isNull	系统自增
// carousel_img	图片	isNull	
// carousel_index	排序	isNull	
// carousel_mark1	备注1	isNull	
// carousel_mark2	备注2	isNull	
// carousel_mark3	备注3	isNull	



class carousel
{
private $id;
private $carousel_img;
private $carousel_index;
private $carousel_mark1;
private $carousel_mark2;
private $carousel_mark3;




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
		$this->carousel_img='isNull';//
		$this->carousel_index='isNull';//
		$this->carousel_mark1='isNull';//
		$this->carousel_mark2='isNull';//
		$this->carousel_mark3='isNull';//

    }
    /**
     * 插入新的分类
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
		if (array_key_exists('carousel_img', $userinfo)) {$this->carousel_img=$userinfo ['carousel_img'];}
		if (array_key_exists('carousel_index', $userinfo)) {$this->carousel_index=$userinfo ['carousel_index'];}
		if (array_key_exists('carousel_mark1', $userinfo)) {$this->carousel_mark1=$userinfo ['carousel_mark1'];}
		if (array_key_exists('carousel_mark2', $userinfo)) {$this->carousel_mark2=$userinfo ['carousel_mark2'];}
		if (array_key_exists('carousel_mark3', $userinfo)) {$this->carousel_mark3=$userinfo ['carousel_mark3'];}


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
        $sql = "INSERT INTO fopin_carousel (carousel_img,carousel_index,carousel_mark1,carousel_mark2,carousel_mark3)
            VALUES ('$this->carousel_img', '$this->carousel_index', '$this->carousel_mark1', '$this->carousel_mark2', '$this->carousel_mark3')";
     
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
     * 查询并显示分类
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

        $sql="SELECT * FROM fopin_carousel";
        $sql.=" WHERE 1 ";
		
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
		
		$sql.=" ORDER BY carousel_index DESC";
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
     * update  分类 （名称和排序）
     * @param  userinfo 键值对组成的关联array，会更新array内的指定id
     * @return Boolean false  失败，
     * @return Boolean true   成功，
	 * ******************************
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
			$sql="UPDATE fopin_carousel SET $updateSqlStr WHERE id='$this->id'";
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
     * delete 按id删除分类
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
			$sql="DELETE FROM fopin_carousel WHERE id='$this->id'";
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
