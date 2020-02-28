<?php
require_once("sql.php");

// 创建连接
$conn = new mysqli($servername, $username, $password);
//new mysqli("localhost", "username", "password", "", port)//其他端口（默认为3306）
// 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
if ($conn->connect_error) {
    die("connect_error: " . $conn->connect_error);
}
// 创建数据库
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === true) {
    echo "Database created";
} else {
    echo "Error creating database: " . $conn->error;
}
echo "<hr><br>";
$conn->close();

createUserTable($servername, $username, $password, $dbname);echo "<br>";
createProductTable($servername, $username, $password, $dbname);echo "<br>";
createWantTable($servername, $username, $password, $dbname);echo "<br>";
createCarouselTable($servername, $username, $password, $dbname);echo "<br>";
createArticleTable($servername, $username, $password, $dbname);echo "<br>";
createProtypeTable($servername, $username, $password, $dbname);echo "<br>";
createActivecodeTable($servername, $username, $password, $dbname);echo "<br>";
createLoginTable($servername, $username, $password, $dbname);echo "<br>";
                        

function createUserTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
 
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_user (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			user_account VARCHAR(32) NOT NULL,
			user_pwd VARCHAR(32) NOT NULL,
			user_name VARCHAR(32) NOT NULL,
			user_addr text NOT NULL,
			user_phone VARCHAR(32) NOT NULL,
			user_active_code VARCHAR(32) NOT NULL,
			user_create_time TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
			user_end_time TIMESTAMP Null,
			user_token VARCHAR(32) NOT NULL,
			user_mark1 text,
			user_mark2 text,
			user_mark3 text
			)";
 
    if ($conn->query($sql) === true) {
        echo "Table fopin_user created successfully";
    } else {
        echo "Table fopin_user created wrong: " . $conn->error;
    }
 
    $conn->close();
}


function createProductTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
 
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_product (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			pro_name text NOT NULL,
			pro_type VARCHAR(32) NOT NULL,
			pro_img_cover text NOT NULL,
			pro_img_carousel text NOT NULL,
			pro_detail_word text NOT NULL,
			pro_detail_imgs text NOT NULL,
			pro_upload_time TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
			pro_user_id VARCHAR(32) NOT NULL,
			pro_clicks VARCHAR(32) NOT NULL,
			pro_mark1 text,
			pro_mark2 text,
			pro_mark3 text
			)";
 
    if ($conn->query($sql) === true) {
        echo "Table fopin_product created successfully";
    } else {
        echo "Table fopin_product created wrong: " . $conn->error;
    }
 
    $conn->close();
}


function createWantTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
 
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_want (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			want_title text NOT NULL,
			want_create_time TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
			want_create_name VARCHAR(32) NOT NULL,
			want_create_phone VARCHAR(32) NOT NULL,
			want_detail_word text NOT NULL,
			want_detail_imgs text NOT NULL,
			want_mark1 text,
			want_mark2 text,
			want_mark3 text
			)";
 
    if ($conn->query($sql) === true) {
        echo "Table fopin_want created successfully";
    } else {
        echo "Table fopin_want created wrong: " . $conn->error;
    }
 
    $conn->close();
}


function createCarouselTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
 
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_carousel (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			carousel_img text NOT NULL,
			carousel_index VARCHAR(32) NOT NULL,
			carousel_mark1 text,
			carousel_mark2 text,
			carousel_mark3 text
			)";
 
    if ($conn->query($sql) === true) {
        echo "Table fopin_carousel created successfully";
    } else {
        echo "Table fopin_carousel created wrong: " . $conn->error;
    }
 
    $conn->close();
}

function createArticleTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
 
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_article (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			article_title text NOT NULL,
			article_cover_img text NOT NULL,
			article_create_time TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
			article_content text NOT NULL,
			article_type VARCHAR(32) NOT NULL,
			article_mark1 text,
			article_mark2 text,
			article_mark3 text
			)";
 
    if ($conn->query($sql) === true) {
        echo "Table fopin_article created successfully";
    } else {
        echo "Table fopin_article created wrong: " . $conn->error;
    }
 
    $conn->close();
}


function createProtypeTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_protype (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			pro_type_name VARCHAR(32) NOT NULL,
			pro_type_index VARCHAR(32) NOT NULL,
			pro_type_mark1 text,
			pro_type_mark2 text,
			pro_type_mark3 text
			)";
    if ($conn->query($sql) === true) {
        echo "Table fopin_protype created successfully";
    } else {
        echo "Table fopin_protype created wrong: " . $conn->error;
    }
    $conn->close();
}

function createActivecodeTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_activecode (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			active_code VARCHAR(32) NOT NULL,
			active_code_time TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
			active_code_user VARCHAR(32) NOT NULL,
			active_code_mark1 text,
			active_code_mark2 text,
			active_code_mark3 text
			)";
    if ($conn->query($sql) === true) {
        echo "Table fopin_activecode created successfully";
    } else {
        echo "Table fopin_activecode created wrong: " . $conn->error;
    }
    $conn->close();
}

function createLoginTable($servername, $username, $password, $dbname)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 设置编码，防止中文乱码
		mysqli_query($conn , "set names utf8");
		// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE fopin_login (
			id INT AUTO_INCREMENT PRIMARY KEY, 
			login_user_id VARCHAR(32) NOT NULL,
			login_time TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
			login_mark1 text,
			login_mark2 text,
			login_mark3 text
			)";
    if ($conn->query($sql) === true) {
        echo "Table fopin_login created successfully";
    } else {
        echo "Table fopin_login created wrong: " . $conn->error;
    }
    $conn->close();
}