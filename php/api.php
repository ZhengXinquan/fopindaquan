<?php

header('Access-Control-Allow-Origin:http://localhost');

$json_result=array("code"=>"-2","msg"=>"null","data"=>array());

$id="";
////// 会员  1
$user_account="";
$user_pwd="";
$user_pwd_new="";
$user_name="";
$user_addr="";
$user_phone="";
$user_active_code="";
$user_end_time='';
$user_token='';
$user_mark1='';
////激活码  2
$active_code="";
$active_code_time="";
$active_code_user="";


////商品  3
$pro_name="";
$pro_type="";
$pro_img_cover="";
$pro_img_carousel="";
$pro_detail_word="";
$pro_detail_imgs="";
$pro_user_id="";
$pro_clicks="";
$pro_mark1="";
///求购  4
$want_title="";
$want_create_time="";
$want_create_name="";
$want_create_phone="";
$want_detail_word="";
$want_detail_imgs="";
////商品分类  5
$pro_type_name="";//	类别名称
$pro_type_index="";//	排序
///文章   6
$article_title="";
$article_cover_img="";
$article_create_time="";
$article_content="";
$article_type="";
////登陆日志  7
$login_user_id="";//
////首页轮播图 8
$carousel_img="";
$carousel_index="";
$carousel_mark1="";


if (is_array($_POST)&&count($_POST)>0) {
	if (isset($_POST["id"])) {
        if (strlen($_POST["id"])>0) {
            $id=$_POST["id"];
        }
    }
	////会员   1
    if (isset($_POST["user_account"])) {
        if (strlen($_POST["user_account"])>0) {
            $user_account=$_POST["user_account"];
        }
    }
	if (isset($_POST["user_pwd"])) {
        if (strlen($_POST["user_pwd"])>0) {
            $user_pwd=$_POST["user_pwd"];
        }
    }
		if (isset($_POST["user_pwd_new"])) {
        if (strlen($_POST["user_pwd_new"])>0) {
            $user_pwd_new=$_POST["user_pwd_new"];
        }
    }
	if (isset($_POST["user_name"])) {
        if (strlen($_POST["user_name"])>0) {
            $user_name=$_POST["user_name"];
        }
    }
	if (isset($_POST["user_addr"])) {
        if (strlen($_POST["user_addr"])>0) {
            $user_addr=$_POST["user_addr"];
        }
    }
	if (isset($_POST["user_phone"])) {
        if (strlen($_POST["user_phone"])>0) {
            $user_phone=$_POST["user_phone"];
        }
    }
	if (isset($_POST["user_active_code"])) {
        if (strlen($_POST["user_active_code"])>0) {
            $user_active_code=$_POST["user_active_code"];
        }
    }
	if (isset($_POST["user_end_time"])) {
        if (strlen($_POST["user_end_time"])>0) {
            $user_end_time=$_POST["user_end_time"];
        }
    }
	if (isset($_POST["user_token"])) {
        if (strlen($_POST["user_token"])>0) {
            $user_token=$_POST["user_token"];
        }
    }
	if (isset($_POST["user_mark1"])) {
        if (strlen($_POST["user_mark1"])>0) {
            $user_mark1=$_POST["user_mark1"];
        }
    }
	
	
	////激活码  2
	if (isset($_POST["active_code"])) {
        if (strlen($_POST["active_code"])>0) {
            $active_code=$_POST["active_code"];
        }
    }
	if (isset($_POST["active_code_time"])) {
        if (strlen($_POST["active_code_time"])>0) {
            $active_code_time=$_POST["active_code_time"];
        }
    }
	if (isset($_POST["active_code_user"])) {
        if (strlen($_POST["active_code_user"])>0) {
            $active_code_user=$_POST["active_code_user"];
        }
    }
	/////////////////////////产品  3
	if (isset($_POST["pro_name"])) {
        if (strlen($_POST["pro_name"])>0) {
            $pro_name=$_POST["pro_name"];
        }
    }
	if (isset($_POST["pro_type"])) {
        if (strlen($_POST["pro_type"])>0) {
            $pro_type=$_POST["pro_type"];
        }
    }
	if (isset($_POST["pro_img_cover"])) {
        if (strlen($_POST["pro_img_cover"])>0) {
            $pro_img_cover=$_POST["pro_img_cover"];
        }
    }
	if (isset($_POST["pro_img_carousel"])) {
        if (strlen($_POST["pro_img_carousel"])>0) {
            $pro_img_carousel=$_POST["pro_img_carousel"];
        }
    }
	if (isset($_POST["pro_detail_word"])) {
        if (strlen($_POST["pro_detail_word"])>0) {
            $pro_detail_word=$_POST["pro_detail_word"];
        }
    }
	if (isset($_POST["pro_detail_imgs"])) {
        if (strlen($_POST["pro_detail_imgs"])>0) {
            $pro_detail_imgs=$_POST["pro_detail_imgs"];
        }
    }
	if (isset($_POST["pro_user_id"])) {
        if (strlen($_POST["pro_user_id"])>0) {
            $pro_user_id=$_POST["pro_user_id"];
        }
    }
	if (isset($_POST["pro_clicks"])) {
        if (strlen($_POST["pro_clicks"])>0) {
            $pro_clicks=$_POST["pro_clicks"];
        }
    }
	if (isset($_POST["pro_mark1"])) {
        if (strlen($_POST["pro_mark1"])>0) {
            $pro_mark1=$_POST["pro_mark1"];
        }
    }
	
//////////////////////////////////求购  4
	if (isset($_POST["want_title"])) {
        if (strlen($_POST["want_title"])>0) {
            $want_title=$_POST["want_title"];
        }
	}
	if (isset($_POST["want_create_time"])) {
        if (strlen($_POST["want_create_time"])>0) {
            $want_create_time=$_POST["want_create_time"];
        }
    }
	if (isset($_POST["want_create_name"])) {
        if (strlen($_POST["want_create_name"])>0) {
            $want_create_name=$_POST["want_create_name"];
        }
    }
	if (isset($_POST["want_create_phone"])) {
        if (strlen($_POST["want_create_phone"])>0) {
            $want_create_phone=$_POST["want_create_phone"];
        }
    }
	if (isset($_POST["want_detail_word"])) {
        if (strlen($_POST["want_detail_word"])>0) {
            $want_detail_word=$_POST["want_detail_word"];
        }
    }
	if (isset($_POST["want_detail_imgs"])) {
        if (strlen($_POST["want_detail_imgs"])>0) {
            $want_detail_imgs=$_POST["want_detail_imgs"];
        }
    }
	////////////商品分类  5
	if (isset($_POST["pro_type_name"])) {
        if (strlen($_POST["pro_type_name"])>0) {
            $pro_type_name=$_POST["pro_type_name"];
        }
    }
	if (isset($_POST["pro_type_index"])) {
        if (strlen($_POST["pro_type_index"])>0) {
            $pro_type_index=$_POST["pro_type_index"];
        }
    }

//////////文章  6
	if (isset($_POST["article_title"])) {
        if (strlen($_POST["article_title"])>0) {
            $article_title=$_POST["article_title"];
        }
    }
	if (isset($_POST["article_cover_img"])) {
        if (strlen($_POST["article_cover_img"])>0) {
            $article_cover_img=$_POST["article_cover_img"];
        }
    }
	if (isset($_POST["article_create_time"])) {
        if (strlen($_POST["article_create_time"])>0) {
            $article_create_time=$_POST["article_create_time"];
        }
    }
	if (isset($_POST["article_content"])) {
        if (strlen($_POST["article_content"])>0) {
            $article_content=$_POST["article_content"];
        }
    }
	if (isset($_POST["article_type"])) {
        if (strlen($_POST["article_type"])>0) {
            $article_type=$_POST["article_type"];
        }
    }
		////////////登陆信息  7
	if (isset($_POST["login_user_id"])) {
        if (strlen($_POST["login_user_id"])>0) {
            $login_user_id=$_POST["login_user_id"];
        }
    }
	////首页轮播图 8
	if (isset($_POST["carousel_img"])) {
        if (strlen($_POST["carousel_img"])>0) {
            $carousel_img=$_POST["carousel_img"];
        }
    }
	if (isset($_POST["carousel_index"])) {
        if (strlen($_POST["carousel_index"])>0) {
            $carousel_index=$_POST["carousel_index"];
        }
	}
	if (isset($_POST["carousel_mark1"])) {
        if (strlen($_POST["carousel_mark1"])>0) {
            $carousel_mark1=$_POST["carousel_mark1"];
        }
    }
//////
    ob_clean();
    if (isset($_POST["type"])) {
        if (strlen($_POST["type"])>0) {
            switch ($_POST["type"]) {
				case 'user_update_pwd':
					$userInfo=array();
					if ($id!==''&&$user_pwd!==''&&$user_pwd_new!=='') {
						$userInfo["id"] = $id;
						$userInfo["user_pwd"] = $user_pwd;
						$userInfo["user_pwd_new"] = $user_pwd_new;
						echo json_encode(user_update_pwd($userInfo));
					}else{
						echo json_encode($json_result);
					}
					
					break;
				//////会员  1
                case 'user_show':
				
					$userInfo=array();
					if ($user_account!=='') {$userInfo["user_account"] = $user_account;}//按用户账号查询
					if ($user_name!=='') {$userInfo["user_name"] = $user_name;}//按用户user_name模糊查询
					if ($id!=='') {$userInfo["id"] = $id;}//表id
					if ($user_mark1!=='') {$userInfo["user_mark1"] = $user_mark1;}//1,2,3 首页第一二三种展示

					echo json_encode(user_show($userInfo));
					break;
				
				
				case 'register':
					echo json_encode(userRegister($user_account, $user_pwd, $user_name, $user_addr, $user_phone, $user_active_code));
					break;
                case 'login':
                    echo json_encode(userLogin($user_account, $user_pwd));
                    break;
				case 'user_update':
					$userInfo=array();
					if ($id!=='') {$userInfo["id"] = $id;}
					if ($user_account!=='') {$userInfo["user_account"] = $user_account;}//账号？
					if ($user_pwd!=='') {$userInfo["user_pwd"] = $user_pwd;}
					if ($user_name!=='') {$userInfo["user_name"] = $user_name;}
					if ($user_addr!=='') {$userInfo["user_addr"] = $user_addr;}
					if ($user_phone!=='') {$userInfo["user_phone"] = $user_phone;}
					if ($user_end_time!=='') {$userInfo["user_end_time"] = $user_end_time;}//有效期？
					if ($user_mark1!=='') {$userInfo["user_mark1"] = $user_mark1;}
					echo json_encode(user_update($userInfo));
                    break;
					////激活码 2
                case 'activecode_insert':
						$activecodeInfo=array(
							// "active_code"=>$active_code,
							// "active_code_time"=>$active_code_time,
							// "active_code_user"=>$active_code_user
						);
                    echo json_encode(activecode_insert($activecodeInfo));
                    break;
				case 'activecode_show':
					$activecodeInfo=array();
					if ($id!=='') {$activecodeInfo["id"] = $id;}//表id
					echo json_encode(activecode_show($activecodeInfo));
					break;
				case 'activecode_delete':
                    echo json_encode(activecode_delete($id));
					break;
//////////////////////////商品 3
                case 'product_insert':
						$productInfo=array();
					if ($pro_name!=='') {$productInfo["pro_name"] = $pro_name;}//商品名称
					if ($pro_type!=='') {$productInfo["pro_type"] = $pro_type;}//类别
					if ($pro_img_cover!=='') {$productInfo["pro_img_cover"] = $pro_img_cover;}//封面图
					if ($pro_img_carousel!=='') {$productInfo["pro_img_carousel"] = $pro_img_carousel;}//轮播图
					if ($pro_detail_word!=='') {$productInfo["pro_detail_word"] = $pro_detail_word;}//详情文字
					if ($pro_detail_imgs!=='') {$productInfo["pro_detail_imgs"] = $pro_detail_imgs;}//详情图
					if ($pro_user_id!=='') {$productInfo["pro_user_id"] = $pro_user_id;}//上传厂家
						
                    echo json_encode(product_insert($productInfo));
                    break;
                case 'product_update':
				
				$__checkToken=checkToken($pro_user_id,$user_token);
				if($__checkToken){
					$productInfo=array();
					if ($id!=='') {$productInfo["id"] = $id;}
					if ($pro_name!=='') {$productInfo["pro_name"] = $pro_name;}//商品名称
					if ($pro_type!=='') {$productInfo["pro_type"] = $pro_type;}//类别
					if ($pro_img_cover!=='') {$productInfo["pro_img_cover"] = $pro_img_cover;}//封面图
					if ($pro_img_carousel!=='') {$productInfo["pro_img_carousel"] = $pro_img_carousel;}//轮播图
					if ($pro_detail_word!=='') {$productInfo["pro_detail_word"] = $pro_detail_word;}//详情文字
					if ($pro_detail_imgs!=='') {$productInfo["pro_detail_imgs"] = $pro_detail_imgs;}//详情图
					if ($pro_user_id!=='') {$productInfo["pro_user_id"] = $pro_user_id;}//上传厂家
					if ($pro_clicks!=='') {$productInfo["pro_clicks"] = $pro_clicks;}//点击量
					if ($pro_mark1!=='') {$productInfo["pro_mark1"] = $pro_mark1;}//1,2,3 首页第一二三种展示

					echo json_encode(product_update($productInfo));
				}else{
					$json_result=array("code"=>"-2","msg"=>"__checkToken__err","data"=>$__checkToken);
					echo json_encode($json_result);
				}

                    break;
                case 'product_show':
				
					$productInfo=array();
					if ($user_account!=='') {$productInfo["user_account"] = $user_account;}//按用户账号查询
					if ($pro_user_id!=='') {$productInfo["pro_user_id"] = $pro_user_id;}//按用户id查询
					if ($pro_type!=='') {$productInfo["pro_type"] = $pro_type;}//商品类型
					if ($pro_name!=='') {$productInfo["pro_name"] = $pro_name;}//模糊搜素商品名
					if ($id!=='') {$productInfo["id"] = $id;}//表id
					if ($pro_mark1!=='') {$productInfo["pro_mark1"] = $pro_mark1;}//1,2,3 首页第一二三种展示

					echo json_encode(product_show($productInfo));
					break;
					
                case 'product_delete':
					
                    echo json_encode(product_delete($id));
                    break;
////////////////////////////////  求购  4
                case 'want_insert':
						$wantInfo=array();
						if ($want_title!=='') {$wantInfo["want_title"] = $want_title;}
						if ($want_create_name!=='') {$wantInfo["want_create_name"] = $want_create_name;}
						if ($want_create_phone!=='') {$wantInfo["want_create_phone"] = $want_create_phone;}
						if ($want_detail_word!=='') {$wantInfo["want_detail_word"] = $want_detail_word;}
						if ($want_detail_imgs!=='') {$wantInfo["want_detail_imgs"] = $want_detail_imgs;}
                    echo json_encode(want_insert($wantInfo));
					break;
				case 'want_update':
						$wantInfo=array();
						if ($id!=='') {$wantInfo["id"] = $id;}
						if ($want_title!=='') {$wantInfo["want_title"] = $want_title;}
						if ($want_create_time!=='') {$wantInfo["want_create_time"] = $want_create_time;}
						if ($want_create_name!=='') {$wantInfo["want_create_name"] = $want_create_name;}
						if ($want_create_phone!=='') {$wantInfo["want_create_phone"] = $want_create_phone;}
						if ($want_detail_word!=='') {$wantInfo["want_detail_word"] = $want_detail_word;}
						if ($want_detail_imgs!=='') {$wantInfo["want_detail_imgs"] = $want_detail_imgs;}
					echo json_encode(want_update($wantInfo));
                    break;
                case 'want_show':
					$wantInfo=array();
					if ($want_title!=='') {$wantInfo["want_title"] = $want_title;}//模糊搜素商品名
					if ($id!=='') {$wantInfo["id"] = $id;}//表id
					echo json_encode(want_show($wantInfo));
					break;
                case 'want_delete':
                    echo json_encode(want_delete($id));
                    break;
/////////////////////////////  商品分类 5
                case 'protype_insert':
						$protypeInfo=array();
						
					if ($pro_type_name!=='') {$protypeInfo["pro_type_name"] = $pro_type_name;}//类别名称
					if ($pro_type_index!=='') {$protypeInfo["pro_type_index"] = $pro_type_index;}//
					
                    echo json_encode(protype_insert($protypeInfo));
                    break;
                case 'protype_update':
				
					$protypeInfo=array();
					if ($id!=='') {$protypeInfo["id"] = $id;}
					if ($pro_type_name!=='') {$protypeInfo["pro_type_name"] = $pro_type_name;}//类别名称
					if ($pro_type_index!=='') {$protypeInfo["pro_type_index"] = $pro_type_index;}//

					echo json_encode(protype_update($protypeInfo));
                    break;
                case 'protype_show':
					$protypeInfo=array();
					if ($pro_type_name!=='') {$protypeInfo["pro_type_name"] = $pro_type_name;}//模糊搜素类别名称
					if ($id!=='') {$protypeInfo["id"] = $id;}//表id
					echo json_encode(protype_show($protypeInfo));
					break;
                case 'protype_delete':
                    echo json_encode(protype_delete($id));
                    break;
/////////////////////////////  文章 6
                case 'article_insert':
						$articleInfo=array(
							"article_title"=>$article_title,
							"article_cover_img"=>$article_cover_img,
							"article_create_time"=>$article_create_time,
							"article_content"=>$article_content,
							"article_type"=>$article_type
						);
                    echo json_encode(article_insert($articleInfo));
                    break;
                case 'article_update':
					$articleInfo=array();
					if ($id!=='') {$articleInfo["id"] = $id;}
					if ($article_title!=='') {$articleInfo["article_title"] = $article_title;}
					if ($article_cover_img!=='') {$articleInfo["article_cover_img"] = $article_cover_img;}
					if ($article_create_time!=='') {$articleInfo["article_create_time"] = $article_create_time;}
					if ($article_content!=='') {$articleInfo["article_content"] = $article_content;}
					if ($article_type!=='') {$articleInfo["article_type"] = $article_type;}// //0平台介绍 1会员介绍 2展会
					
					echo json_encode(article_update($articleInfo));
                    break;
                case 'article_show':
					$articleInfo=array();
					if ($article_type!=='') {$articleInfo["article_type"] = $article_type;}// //0平台介绍 1会员介绍 2展会
					if ($id!=='') {$articleInfo["id"] = $id;}//表id
					echo json_encode(article_show($articleInfo));
					break;
                case 'article_delete':
                    echo json_encode(article_delete($id));
                    break;
////////////////////////////////  登陆信息7
                case 'login_insert':
						$loginInfo=array(
							"login_user_id"=>$login_user_id
						);
                    echo json_encode(login_insert($loginInfo));
                    break;
                case 'login_show':
					$loginInfo=array();
					if ($login_user_id!=='') {$loginInfo["login_user_id"] = $login_user_id;}
					if ($id!=='') {$loginInfo["id"] = $id;}//表id
					echo json_encode(login_show($loginInfo));
					break;
					
	//////////////// 首页轮播图 8
                case 'carousel_insert':
						$carouselInfo=array();
					if ($carousel_img!=='') {$carouselInfo["carousel_img"] = $carousel_img;}
					if ($carousel_index!=='') {$carouselInfo["carousel_index"] = $carousel_index;}
					if ($carousel_mark1!=='') {$carouselInfo["carousel_mark1"] = $carousel_mark1;}
                    echo json_encode(carousel_insert($carouselInfo));
                    break;
                case 'carousel_update':
					$carouselInfo=array();
					if ($id!=='') {$carouselInfo["id"] = $id;}
					if ($carousel_img!=='') {$carouselInfo["carousel_img"] = $carousel_img;}
					if ($carousel_index!=='') {$carouselInfo["carousel_index"] = $carousel_index;}
					if ($carousel_mark1!=='') {$carouselInfo["carousel_mark1"] = $carousel_mark1;}
					echo json_encode(carousel_update($carouselInfo));
                    break;
                case 'carousel_show':
					$carouselInfo=array();
					if ($id!=='') {$carouselInfo["id"] = $id;}
					if ($carousel_img!=='') {$carouselInfo["carousel_img"] = $carousel_img;}
					if ($carousel_index!=='') {$carouselInfo["carousel_index"] = $carousel_index;}
					echo json_encode(carousel_show($carouselInfo));
					break;
                case 'carousel_delete':
                    echo json_encode(carousel_delete($id));
                    break;		
/////////////////////////////
                default:
            }
        }
    }
}


// echo '<meta charset="UTF-8">';


//var_dump(userRegister('13588213453', '123456', '厂家名2', '地址2', '1243675', '4acf7ff9f8eb5fa0cc4c10eb0619d735'));
//var_dump(userLogin('13588213453', '123456'));

					
					// $protype_Info=array(
					// "id"=>"1",
					// "pro_type_name"=>"笔111",
					// "pro_type_index"=>"111"
					// );
					//var_dump(protype_insert($protype_Info));
					//var_dump(protype_show());
					//var_dump(protype_delete('3'));
					//var_dump(protype_show());
					//var_dump(protype_update($protype_Info));
					
		//var_dump(login_insert(array("login_user_id"=>"3")));



function checkToken($id,$token){
	$checkToken=false;
	
		require_once 'class.user.php';
		$user=new user();
		$checkToken = $user->checkToken($id,$token);
		if(!$checkToken || $id==''|| $token=='' ){
			$json_result=array("code"=>"0","msg"=>"登录失效，请重新登录","data"=>$checkToken);
			return  $json_result;
		}
	
	return  $checkToken;
}
				
/**
 * 新增首页轮播图
 * @return json_encode
 */
function carousel_insert($carouselInfo)
{
	foreach ($carouselInfo as $key => $value) {
		$carouselInfo[$key] = trim($value); //去掉用户内容后面的空格.
		if($value==""){
			return array("code"=>"0","msg"=>"新增首页轮播图失败，信息不完整","data"=>array());
		}
	}
	require_once 'class.carousel.php';
	$DBcarousel=new carousel();
	$carouselID=$DBcarousel->insert($carouselInfo);
	if ($carouselID!==false) {
		$json_result=array("code"=>"1","msg"=>"新增首页轮播图成功","data"=>$carouselID);
	} else {
		$json_result=array("code"=>"0","msg"=>"新增首页轮播图失败","data"=>array());
	}
	return $json_result;
}
/**
 * 编辑更新首页轮播图
 * @return json_encode
 */
function carousel_update($carouselInfo)
{
	
	    if (array_key_exists("id", $carouselInfo)) { //id
           if(""==$carouselInfo ["id"]){
			   		$json_result=array("code"=>"0","msg"=>"更新首页轮播图失败，未识别此首页轮播图id","data"=>array());
					return $json_result;
		   }
        }else{
					$json_result=array("code"=>"0","msg"=>"更新首页轮播图失败，未识别此首页轮播图id","data"=>array());
					return $json_result;
		}

	foreach ($carouselInfo as $key => $value) {
		$carouselInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.carousel.php';
	$DBcarousel=new carousel();
	$result=$DBcarousel->update($carouselInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"更新首页轮播图成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"更新首页轮播图失败","data"=>array());
	}
	return $json_result;
}

/**
 * 查询首页轮播图
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function carousel_show($carouselInfo=array())
{
	foreach ($carouselInfo as $key => $value) {
		$carouselInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.carousel.php';
	$DBcarousel=new carousel();
	$result=$DBcarousel->show($carouselInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新首页轮播图成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新首页轮播图失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 删除首页轮播图
 * @param    $id
 * @return json_encode
 */
function carousel_delete($id)
{
	if($id==""){
		$json_result=array("code"=>"0","msg"=>"删除首页轮播图失败，未识别此首页轮播图id","data"=>array());
		return $json_result;
	}
	$carouselInfo=array("id"=>$id);
	require_once 'class.carousel.php';
	$DBcarousel=new carousel();
	$result=$DBcarousel->delete($carouselInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"删除首页轮播图成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"删除首页轮播图失败","data"=>array());
	}
	return $json_result;
}

//////////////////////////////////////	

					
/**
 * 新增文章
 * @return json_encode
 */
function article_insert($articleInfo)
{
	foreach ($articleInfo as $key => $value) {
		$articleInfo[$key] = trim($value); //去掉用户内容后面的空格.
		if($value==""){
			return array("code"=>"0","msg"=>"新增文章失败，信息不完整","data"=>array());
		}
	}
	require_once 'class.article.php';
	$DBarticle=new article();
	$articleID=$DBarticle->insert($articleInfo);
	if ($articleID!==false) {
		$json_result=array("code"=>"1","msg"=>"新增文章成功","data"=>$articleID);
	} else {
		$json_result=array("code"=>"0","msg"=>"新增文章失败","data"=>array());
	}
	return $json_result;
}
/**
 * 编辑更新文章
 * @return json_encode
 */
function article_update($articleInfo)
{
	
	    if (array_key_exists("id", $articleInfo)) { //id
           if(""==$articleInfo ["id"]){
			   		$json_result=array("code"=>"0","msg"=>"更新文章失败，未识别此文章id","data"=>array());
					return $json_result;
		   }
        }else{
					$json_result=array("code"=>"0","msg"=>"更新文章失败，未识别此文章id","data"=>array());
					return $json_result;
		}

	foreach ($articleInfo as $key => $value) {
		$articleInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.article.php';
	$DBarticle=new article();
	$result=$DBarticle->update($articleInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"更新文章成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"更新文章失败","data"=>array());
	}
	return $json_result;
}

/**
 * 查询文章
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function article_show($articleInfo=array())
{
	foreach ($articleInfo as $key => $value) {
		$articleInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.article.php';
	$DBarticle=new article();
	$result=$DBarticle->show($articleInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新文章成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新文章失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 删除文章
 * @param    $id
 * @return json_encode
 */
function article_delete($id)
{
	if($id==""){
		$json_result=array("code"=>"0","msg"=>"删除文章失败，未识别此文章id","data"=>array());
		return $json_result;
	}
	$articleInfo=array("id"=>$id);
	require_once 'class.article.php';
	$DBarticle=new article();
	$result=$DBarticle->delete($articleInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"删除文章成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"删除文章失败","data"=>array());
	}
	return $json_result;
}

//////////////////////////////////////					
					
/**
 * 新增登陆日志
 * @return json_encode
 */
function login_insert($loginInfo)
{
	foreach ($loginInfo as $key => $value) {
		$loginInfo[$key] = trim($value); //去掉用户内容后面的空格.
		if($value==""){
			return array("code"=>"0","msg"=>"新增登陆日志失败，信息不完整","data"=>array());
		}
	}
	require_once 'class.login.php';
	$DBlogin=new login();
	$loginID=$DBlogin->insert($loginInfo);
	if ($loginID!==false) {
		$json_result=array("code"=>"1","msg"=>"新增登陆日志成功","data"=>$loginID);
	} else {
		$json_result=array("code"=>"0","msg"=>"新增登陆日志失败","data"=>array());
	}
	return $json_result;
}

/**
 * 查询登陆日志
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function login_show($loginInfo=array())
{
	foreach ($loginInfo as $key => $value) {
		$loginInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.login.php';
	$DBlogin=new login();
	$result=$DBlogin->show($loginInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新登陆日志成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新登陆日志失败","data"=>$result);
	}
	return $json_result;
}		

//////////////////////////////////////					
					
/**
 * 新增分类
 * @return json_encode
 */
function protype_insert($protypeInfo)
{
	foreach ($protypeInfo as $key => $value) {
		$protypeInfo[$key] = trim($value); //去掉用户内容后面的空格.
		if($value==""){
			return array("code"=>"0","msg"=>"新增分类失败，信息不完整","data"=>$protypeInfo);
		}
	}
	require_once 'class.protype.php';
	$DBprotype=new protype();
	$protypeID=$DBprotype->insert($protypeInfo);
	if ($protypeID!==false) {
		$json_result=array("code"=>"1","msg"=>"新增分类成功","data"=>$protypeID);
	} else {
		$json_result=array("code"=>"0","msg"=>"新增分类失败","data"=>array());
	}
	return $json_result;
}
/**
 * 编辑更新分类
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 * @param    $pro_detail_word
 * @param    $pro_detail_imgs
 * @param    $pro_user_id
 * @param    $pro_clicks
 
 * @return json_encode
 */
function protype_update($protypeInfo)
{
	
	    if (array_key_exists("id", $protypeInfo)) { //id
           if(""==$protypeInfo ["id"]){
			   		$json_result=array("code"=>"0","msg"=>"更新分类失败，未识别此分类id","data"=>array());
					return $json_result;
		   }
        }else{
					$json_result=array("code"=>"0","msg"=>"更新分类失败，未识别此分类id","data"=>array());
					return $json_result;
		}

	foreach ($protypeInfo as $key => $value) {
		$protypeInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.protype.php';
	$DBprotype=new protype();
	$result=$DBprotype->update($protypeInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"更新分类成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"更新分类失败","data"=>array());
	}
	return $json_result;
}

/**
 * 查询分类
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function protype_show($protypeInfo=array())
{
	foreach ($protypeInfo as $key => $value) {
		$protypeInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.protype.php';
	$DBprotype=new protype();
	$result=$DBprotype->show($protypeInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新分类成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新分类失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 删除分类
 * @param    $id
 * @return json_encode
 */
function protype_delete($id)
{
	if($id==""){
		$json_result=array("code"=>"0","msg"=>"删除商品分类失败，未识别此分类id","data"=>array());
		return $json_result;
	}
	$protypeInfo=array("id"=>$id);
	require_once 'class.protype.php';
	$DBprotype=new protype();
	$result=$DBprotype->delete($protypeInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"删除商品分类成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"删除商品分类失败","data"=>array());
	}
	return $json_result;
}
//////////////////
				
/**
 * 发布求购
						$wantInfo=array(
							"want_title"=>$want_title,
							"want_create_name"=>$want_create_name,
							"want_create_phone"=>$want_create_phone,
							"want_detail_word"=>$want_detail_word,
							"want_detail_imgs"=>$want_detail_imgs
						);

 * @return json_encode
 */
function want_insert($wantInfo)
{
	require_once 'class.want.php';
	$DBwant=new want();
	$wantID=$DBwant->insert($wantInfo);
	if ($wantID!==false) {
		$json_result=array("code"=>"1","msg"=>"发布求购成功","data"=>$wantID);
	} else {
		$json_result=array("code"=>"0","msg"=>"发布求购失败","data"=>array());
	}
	return $json_result;
}
/**
 * 编辑更新求购
 
 * @return json_encode
 */
function want_update($wantInfo)
{
	
	    if (array_key_exists("id", $wantInfo)) { //id
           if(""==$wantInfo ["id"]){
			   		$json_result=array("code"=>"0","msg"=>"更新求购失败，求购id为空","data"=>array());
					return $json_result;
		   }
        }else{
					$json_result=array("code"=>"0","msg"=>"更新求购失败，无此求购id","data"=>array());
					return $json_result;
		}

	foreach ($wantInfo as $key => $value) {
		$wantInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.want.php';
	$DBwant=new want();
	$result=$DBwant->update($wantInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"更新求购成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"更新求购失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 展示求购
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function want_show($wantInfo)
{
	foreach ($wantInfo as $key => $value) {
		$wantInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.want.php';
	$DBwant=new want();
	$result=$DBwant->show($wantInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新求购信息成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新求购信息失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 删除求购
 * @param    $id
 * @return json_encode
 */
function want_delete($id)
{
	if($id==""){
		$json_result=array("code"=>"0","msg"=>"删除失败（id err）","data"=>array());
		return $json_result;
	}
	$wantInfo=array("id"=>$id);
	require_once 'class.want.php';
	$DBwant=new want();
	$result=$DBwant->delete($wantInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"删除成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"删除失败","data"=>array());
	}
	return $json_result;
}


////////////////////////////////////////
//////////////////////////////////////					
					
/**
 * 发布商品
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 * @param    $pro_detail_word
 * @param    $pro_detail_imgs
 * @param    $pro_user_id

 * @return json_encode
 */
function product_insert($productInfo)
{
	foreach ($productInfo as $key => $value) {
		$productInfo[$key] = trim($value); //去掉用户内容后面的空格.
		if($value==""){
			return array("code"=>"0","msg"=>"发布商品失败，信息不完整","data"=>array());
		}
	}
	require_once 'class.product.php';
	$DBproduct=new product();
	$productID=$DBproduct->insert($productInfo);
	if ($productID!==false) {
		$json_result=array("code"=>"1","msg"=>"发布商品成功","data"=>$productID);
	} else {
		$json_result=array("code"=>"0","msg"=>"发布商品失败","data"=>array());
	}
	return $json_result;
}
/**
 * 编辑更新商品
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 * @param    $pro_detail_word
 * @param    $pro_detail_imgs
 * @param    $pro_user_id
 * @param    $pro_clicks
 
 * @return json_encode
 */
function product_update($productInfo)
{
	
	    if (array_key_exists("id", $productInfo)) { //id
           if(""==$productInfo ["id"]){
			   		$json_result=array("code"=>"0","msg"=>"更新商品失败，商品id为空","data"=>array());
					return $json_result;
		   }
        }else{
					$json_result=array("code"=>"0","msg"=>"更新商品失败，未识别此商品id","data"=>array());
					return $json_result;
		}

	foreach ($productInfo as $key => $value) {
		$productInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.product.php';
	$DBproduct=new product();
	$result=$DBproduct->update($productInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"更新商品成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"更新商品失败","data"=>$result);
	}
	return $json_result;
}

/**
 * 查询展示商品
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function product_show($productInfo)
{
	foreach ($productInfo as $key => $value) {
		$productInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.product.php';
	$DBproduct=new product();
	$result=$DBproduct->show($productInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 删除商品
 * @param    $id
 * @return json_encode
 */
function product_delete($id)
{
	if($id==""){
		$json_result=array("code"=>"0","msg"=>"删除商品失败，未识别此商品id","data"=>array());
		return $json_result;
	}
	$productInfo=array("id"=>$id);
	require_once 'class.product.php';
	$DBproduct=new product();
	$result=$DBproduct->delete($productInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"删除商品成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"删除商品失败","data"=>array());
	}
	return $json_result;
}



////////////////// 激活码


					
/**
 * 新增激活码
 * @return json_encode
 */
function activecode_insert($activecodeInfo)
{
	foreach ($activecodeInfo as $key => $value) {
		$activecodeInfo[$key] = trim($value); //去掉用户内容后面的空格.
		if($value==""){
			return array("code"=>"0","msg"=>"新增激活码失败，信息不完整","data"=>array());
		}
	}
	require_once 'class.activecode.php';
	$DBactivecode=new activecode();
	$active_code=$DBactivecode->insert($activecodeInfo); //返回active_code
	if ($active_code!==false) {
		$json_result=array("code"=>"1","msg"=>"新增激活码成功","data"=>$active_code);
	} else {
		$json_result=array("code"=>"0","msg"=>"新增激活码失败","data"=>array());
	}
	return $json_result;
}
/**
 * 查询激活码
 * @param    $pro_name
 * @param    $pro_type
 * @param    $pro_img_cover
 * @param    $pro_img_carousel
 
 * @return json_encode
 */
function activecode_show($activecodeInfo=array())
{
	foreach ($activecodeInfo as $key => $value) {
		$activecodeInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.activecode.php';
	$DBactivecode=new activecode();
	$result=$DBactivecode->show($activecodeInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新激活码成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新激活码失败","data"=>$result);
	}
	return $json_result;
}
/**
 * 删除激活码
 * @param    $id
 * @return json_encode
 */
function activecode_delete($id)
{
	if($id==""){
		$json_result=array("code"=>"0","msg"=>"删除激活码失败，未识别此激活码id","data"=>array());
		return $json_result;
	}
	$activecodeInfo=array("id"=>$id);
	require_once 'class.activecode.php';
	$DBactivecode=new activecode();
	$result=$DBactivecode->delete($activecodeInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"删除激活码成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"删除激活码失败","data"=>array());
	}
	return $json_result;
}

//////////////////////////////////////	

/**
 * 更新密码
 * @param    $protypeInfo
 
 * @return json_encode
 */
function user_update_pwd($userInfo){
	if (array_key_exists("id", $userInfo)) { //id
        if(""==$userInfo ["id"]){
			$json_result=array("code"=>"0","msg"=>"更新密码失败，未识别此会员信息id","data"=>array());
			return $json_result;
		}
    }else{
		$json_result=array("code"=>"0","msg"=>"更新密码失败，未识别此会员信息id","data"=>array());
		return $json_result;
	}
		
	foreach ($userInfo as $key => $value) {
		$userInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.user.php';
	$DBuser=new user();
	$md5_user_pwd_old=$DBuser->createPassWord($userInfo["user_pwd"]);
	$userOne=$DBuser->show(array("id"=>$userInfo ["id"]));
	$userOne=$userOne[0];
	if($md5_user_pwd_old==$userOne["user_pwd"]){
		$result=$DBuser->update(array(
		"id"=>$userInfo ["id"],
		"user_pwd"=>$userInfo["user_pwd_new"]
		));
		if ($result!==false) {
			$json_result=array("code"=>"1","msg"=>"更新密码成功","data"=>$newInfo[0]);
		} else {
			$json_result=array("code"=>"0","msg"=>"更新密码失败","data"=>$result);
		}
	}else{
		$json_result=array("code"=>"0","msg"=>"旧密码不正确","data"=>array());
	}
	return $json_result;
}
/**
 * 会员列表
 * @param    $protypeInfo
 
 * @return json_encode
 */
 function user_show($userInfo)
{
		foreach ($userInfo as $key => $value) {
		$userInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.user.php';
	$DBuser=new user();
	$result=$DBuser->show($userInfo);
	if ($result!==false) {
		$json_result=array("code"=>"1","msg"=>"刷新成功","data"=>$result);
	} else {
		$json_result=array("code"=>"0","msg"=>"刷新失败","data"=>$result);
	}
	return $json_result;
}

/**
 * 更新会员信息
 * @param    $protypeInfo
 
 * @return json_encode
 */
function user_update($userInfo)
{
	    if (array_key_exists("id", $userInfo)) { //id
           if(""==$userInfo ["id"]){
			   		$json_result=array("code"=>"0","msg"=>"更新会员信息失败，未识别此会员信息id","data"=>array());
					return $json_result;
		   }
        }else{
					$json_result=array("code"=>"0","msg"=>"更新会员信息失败，未识别此会员信息id","data"=>array());
					return $json_result;
		}

	foreach ($userInfo as $key => $value) {
		$userInfo[$key] = trim($value); //去掉用户内容后面的空格.
	}
	require_once 'class.user.php';
	$DBuser=new user();
	$result=$DBuser->update($userInfo);
	if ($result!==false) {
		
			$newInfo=$DBuser->show(array("id"=>$userInfo ["id"]));
		
		
		$json_result=array("code"=>"1","msg"=>"更新会员信息成功","data"=>$newInfo[0]);
	} else {
		$json_result=array("code"=>"0","msg"=>"更新会员信息失败","data"=>$result);
	}
	return $json_result;
}


		// require_once 'class.user.php';
        // $user=new user();
		// $checkToken = $user->checkToken('13588213453','b4111eea43c368eea0893c90e9679865');
/**
 * 登陆
 * @param    $user_account 账号   $user_pwd  密码
 * @return json_encode
 */
function userLogin($user_account, $user_pwd){
    if (!isMatchMobile($user_account)) {
        $json_result=array("code"=>"-1","msg"=>"账号为11位手机号","data"=>array());
    } elseif (!isMatchPSw($user_pwd)) {
        $json_result=array("code"=>"-1","msg"=>"密码为6-10位英文字母、数字","data"=>array());
    } else {
		
		require_once 'class.user.php';
        $DBuser=new user();
        $showUserList=$DBuser->show(array("user_account"=>$user_account));
        if ($showUserList==false) {//判断账号手机号是否存在
            $json_result=array("code"=>"-1","msg"=>"账号不存在","data"=>array());
			return $json_result;
        }
		
		$userInfo=$showUserList[0];
		
		$endTime=$userInfo['user_end_time'];
		require_once 'class.common.php';
        $common=new commonFun();
		$endTimeIsRight=$common->checkTime($endTime);
		if($endTimeIsRight<=0){//大于0，表示endTime比现在更晚
            $json_result=array("code"=>"-1","msg"=>"会员到期，请联系客服续期","data"=>array());
			return $json_result;
		}
		
		if($userInfo['user_pwd']==$DBuser->createPassWord($user_pwd)){
			$json_result=array("code"=>"1","msg"=>"登陆成功","data"=>$userInfo);
			$retoken=$DBuser->update(array("user_token"=>$user_account,"id"=>$userInfo['id']));
			if(!$retoken){
				$json_result=array("code"=>"1","msg"=>"登陆成功，但更新token失败","data"=>array());
			}
			require_once 'class.login.php';
			$DBlogin=new login();
			$DBlogininsert=$DBlogin->insert(array("login_user_id"=>$userInfo['id']));
			
		}else{
			$json_result=array("code"=>"-1","msg"=>"账号或密码错误","data"=>array());
		}
	}
	 return $json_result;
}
/**
 * 注册
 * @param    $name 账号   $psw  密码
 user_account
user_pwd
user_name
user_addr
user_phone
user_active_code

 * @return json_encode
 */
function userRegister($user_account, $user_pwd, $user_name, $user_addr, $user_phone, $user_active_code)
{
    if (!isMatchMobile($user_account)) {
        $json_result=array("code"=>"-1","msg"=>"账号为11位手机号","data"=>array());
    } elseif (!isMatchPSw($user_pwd)) {
        $json_result=array("code"=>"-1","msg"=>"密码为6-10位英文字母、数字","data"=>array());
    } elseif (!isMatchPhone($user_phone)) {
        $json_result=array("code"=>"-1","msg"=>"联系方式（电话号码）不正确","data"=>array());
    } else {
		
		
        require_once 'class.user.php';
        $DBuser=new user();
        $showUserList=$DBuser->show(array("user_account"=>$user_account));
        if ($showUserList!=false) {//判断账号手机号是否存在
            $json_result=array("code"=>"-1","msg"=>"手机号已存在","data"=>array());
			return $json_result;
        } 
			
        require_once 'class.activecode.php';
        $DBactivecode=new activecode();
        $codeIsRight=$DBactivecode->codeIsRight($user_active_code);
        if ($codeIsRight==false) {//判断user_active_code是否可用
            $json_result=array("code"=>"-1","msg"=>"激活码不可用","data"=>array());
			return $json_result;
        } 
			
		$userInfo=array(
			"user_account"=>$user_account,
			"user_pwd"=>$user_pwd,
			"user_name"=>$user_name,
			"user_addr"=>$user_addr,
			"user_phone"=>$user_phone,
			"user_active_code"=>$user_active_code
		);
		
		$userID=$DBuser->insert($userInfo);
		if ($userID!==false) {
			$json_result=array("code"=>"1","msg"=>"注册成功","data"=>$userID);
			$codeToUser=$DBactivecode->update(array("active_code"=>$user_active_code,"active_code_user"=>$userID));
			if(!$codeToUser){
				$json_result=array("code"=>"1","msg"=>"注册成功(code_false)","data"=>$userID);
			}
		} else {
			$json_result=array("code"=>"0","msg"=>"注册失败","data"=>array());
		}
        
    }
    return $json_result;
}

function isMatchLoginName($str)
{
    if (preg_match('/^[a-zA-Z]([a-zA-Z0-9_]{4,14})+$/', $str)) {
        return true;
    } else {
        return false;
    }
}
function isMatchName($str)
{
    if (preg_match('/^[a-zA-Z]([a-zA-Z0-9_]{5,14})+$/', $str)) {
        return true;
    } else {
        return false;
    }
}
function isMatchMobile($str)
{
    if (preg_match('/^[1]([3-9])[0-9]{9}+$/', $str)) {
        return true;
    } else {
        return false;
    }
}
function isMatchPhone($str)
{
    if (preg_match('/^[0-9\-]{7,12}+$/', $str)) {
        return true;
    } else {
        return false;
    }
}
function isMatchPSw($str)
{
    if (preg_match('/^[a-zA-Z0-9_]{6,10}+$/', $str)) {
        return true;
    } else {
        return false;
    }
}
