<?php
date_default_timezone_set("Asia/Chongqing");
// product			
// 英文	中文	默认值	备注
// id	id	isNull	系统自增
// pro_name	商品名称	isNull	
// pro_type	类别	isNull	单类读取自分类表
// pro_img_cover	封面图	isNull	1张
// pro_img_carousel	轮播图	isNull	用|分割多图
// pro_detail_word	详情文字	isNull	
// pro_detail_imgs	详情图	isNull	用|分割多图
// pro_upload_time	上传时间	表自动	自动
// pro_user_id	上传厂家	isNull	读取自当前登陆
// pro_clicks	点击量	0	排序
// pro_mark1	备注1	isNull	
// pro_mark2	备注2	isNull	
// pro_mark3	备注3	isNull	




class product
{
	private $id;
	private $pro_name;
	private $pro_type;
	private $pro_img_cover;
	private $pro_img_carousel;
	private $pro_detail_word;
	private $pro_detail_imgs;
	private $pro_upload_time;
	private $pro_user_id;
	private $pro_clicks;
	private $pro_mark1;
	private $pro_mark2;
	private $pro_mark3;

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
		$this->pro_name='isNull';//
		$this->pro_type='isNull';//单类读取自分类表
		$this->pro_img_cover='isNull';//1张
		$this->pro_img_carousel='isNull';//用|分割多图
		$this->pro_detail_word='isNull';//
		$this->pro_detail_imgs='isNull';//用|分割多图
		$this->pro_upload_time='表自动';//自动
		$this->pro_user_id='isNull';//读取自当前登陆
		$this->pro_clicks='0';//排序
		$this->pro_mark1='0';// 1,2,3 首页第一二三种展示
		$this->pro_mark2='isNull';//
		$this->pro_mark3='isNull';//


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
		if (array_key_exists('pro_name', $userinfo)) {$this->pro_name=$userinfo ['pro_name'];}
		if (array_key_exists('pro_type', $userinfo)) {$this->pro_type=$userinfo ['pro_type'];}
		if (array_key_exists('pro_img_cover', $userinfo)) {$this->pro_img_cover=$userinfo ['pro_img_cover'];}
		if (array_key_exists('pro_img_carousel', $userinfo)) {$this->pro_img_carousel=$userinfo ['pro_img_carousel'];}
		if (array_key_exists('pro_detail_word', $userinfo)) {$this->pro_detail_word=$userinfo ['pro_detail_word'];}
		if (array_key_exists('pro_detail_imgs', $userinfo)) {$this->pro_detail_imgs=$userinfo ['pro_detail_imgs'];}
		//if (array_key_exists('pro_upload_time', $userinfo)) {$this->pro_upload_time=$userinfo ['pro_upload_time'];}
		if (array_key_exists('pro_user_id', $userinfo)) {$this->pro_user_id=$userinfo ['pro_user_id'];}
		if (array_key_exists('pro_clicks', $userinfo)) {$this->pro_clicks=$userinfo ['pro_clicks'];}
		if (array_key_exists('pro_mark1', $userinfo)) {$this->pro_mark1=$userinfo ['pro_mark1'];}
		if (array_key_exists('pro_mark2', $userinfo)) {$this->pro_mark2=$userinfo ['pro_mark2'];}
		if (array_key_exists('pro_mark3', $userinfo)) {$this->pro_mark3=$userinfo ['pro_mark3'];}

        $flag=false;
        // 创建连接
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
        if ($conn->connect_error) {
            die("connect_error: " . $conn->connect_error);
            return $flag;
        }
        $sql = "INSERT INTO fopin_product (pro_name,pro_type,pro_img_cover,pro_img_carousel,pro_detail_word,pro_detail_imgs,pro_user_id,pro_clicks,pro_mark1,pro_mark2,pro_mark3)
            VALUES ('$this->pro_name', '$this->pro_type', '$this->pro_img_cover', '$this->pro_img_carousel', '$this->pro_detail_word', '$this->pro_detail_imgs', '$this->pro_user_id', '$this->pro_clicks', '$this->pro_mark1', '$this->pro_mark2', '$this->pro_mark3')";
     
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

        $sql="SELECT p.*,u.user_name,u.user_addr,u.user_phone,u.user_create_time,t.pro_type_name FROM fopin_product p, fopin_user u,fopin_protype t where u.user_end_time > now() AND u.id=p.pro_user_id AND t.id=p.pro_type";

        //$sql.=" WHERE 1 ";
		
		
        if (array_key_exists("user_account", $userinfo)) { //按用户账号查询
            $user_account=$userinfo ["user_account"];
            $sql.=" AND u.user_account='$user_account'";
        }
		if (array_key_exists("pro_user_id", $userinfo)) { //按用户id查询
            $pro_user_id=$userinfo ["pro_user_id"];
            $sql.=" AND p.pro_user_id='$pro_user_id'";
        }
        if (array_key_exists("pro_type", $userinfo)) { //按 商品类型
            $this->pro_type=$userinfo ["pro_type"];
            $sql.=" AND p.pro_type='$this->pro_type'";
        }
		if (array_key_exists("pro_name", $userinfo)) { //模糊搜素商品名
            $this->pro_name=$userinfo ["pro_name"];
            $sql.=" AND p.pro_name LIKE '%$this->pro_name%'";
        }
        if (array_key_exists("id", $userinfo)) { //表id
            $this->id=$userinfo ["id"];
            $sql.=" AND p.id='$this->id'";
        }
		if (array_key_exists("pro_mark1", $userinfo)) { //获取首页展示商品
            $this->pro_mark1=$userinfo ["pro_mark1"];
            $sql.=" AND p.pro_mark1='$this->pro_mark1'";
        }
        if (array_key_exists("m", $userinfo)) { //数量  limit 0,5; --同上，返回前5行
            $n=$userinfo ["m"];
            $sql.=" limit $m";
			if (array_key_exists("n", $userinfo)) { //数量  limit 0,5; --同上，返回前5行
				$n=$userinfo ["n"];
				$sql.=",$n";
			}
        }
		
		$sql.=" ORDER BY pro_clicks DESC,pro_upload_time DESC ";


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
		//return array("flag"=>$flag,"sql"=>$sql);
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
			$sql="UPDATE fopin_product SET $updateSqlStr WHERE id='$this->id'";
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
		if (array_key_exists('id', $userinfo)) {
            $this->id=$userinfo ['id'];
			$sql="DELETE FROM fopin_product WHERE id='$this->id'";
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
