var   globalData= {
    api: "http://www.nanshanqiao.com/fopin/api.php",
	imgs: "http://www.nanshanqiao.com/fopin/getFile.php?dir=upLoad",
	deimgs: "http://www.nanshanqiao.com/fopin/getFile.php?defilename=upLoad/",
    upapi: "http://www.nanshanqiao.com/fopin/upload.php",
    domain: "http://www.nanshanqiao.com/fopin"
	}
var __tdclick=isPC()?"dblclick":"click";
var users,activeCodes,protypes,products,carouses,wants,articles,loginLogs,imgs; 
 var table_json_user=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'user_account',cn:'账号'},
 {en:'user_pwd',cn:'密码（自动加密）'},
 {en:'user_name',cn:'厂名'},
 {en:'user_addr',cn:'厂址'},
 {en:'user_phone',cn:'电话'},
 {en:'user_active_code',cn:'激活码'},
 {en:'user_create_time',cn:'注册时间'},
 {en:'user_end_time',cn:'到期时间'},
 {en:'login_time',cn:'登录时间'},
 {en:'user_mark1',cn:'会员等级'}
 ];
  var table_json_activeCode=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'active_code',cn:'激活码'},
 {en:'active_code_time',cn:'生成时间'},
 {en:'active_code_user',cn:'使用者id'},
 {en:'active_code_mark1',cn:'备注1'},
 {en:'active_code_mark2',cn:'备注2'},
 {en:'active_code_mark3',cn:'备注3'}
 ];
  var table_json_protype=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'pro_type_name',cn:'类别名称'},
 {en:'pro_type_index',cn:'排序依据'},
 {en:'pro_type_mark1',cn:'备注1'},
 {en:'pro_type_mark2',cn:'备注2'},
 {en:'pro_type_mark3',cn:'备注3'}
 ];
  var table_json_product=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'pro_name',cn:'商品名'},
{en:'pro_user_id',cn:'厂家ID'},
{en:'user_name',cn:'厂家'},
 {en:'pro_type',cn:'类别ID'},
 {en:'pro_type_name',cn:'类别名称'},
{en:'pro_img_cover',cn:'封面图'},
{en:'pro_img_carousel',cn:'滚动图'},
{en:'pro_detail_imgs',cn:'详情图片'},
{en:'pro_detail_word',cn:'详情文字'},
{en:'pro_clicks',cn:'点击数'},
{en:'pro_upload_time',cn:'上传时间'},
  {en:'pro_mark1',cn:'首页展示（第n种）'},
 {en:'pro_mark2',cn:'备注2'},
 {en:'pro_mark3',cn:'备注3'}
 ]
   var table_json_carouse=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 
{en:'img',cn:'图片预览'},
{en:'carousel_img',cn:'图片（单张）'},

{en:'carousel_index',cn:'排序依据'},


  {en:'carousel_mark1',cn:'图片点击链接'},
 {en:'carousel_mark2',cn:'备注2'},
 {en:'carousel_mark3',cn:'备注3'}
 ]
 
    var table_json_want=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'want_title',cn:'标题'},
 {en:'want_create_name',cn:'求购人姓名'},
 {en:'want_create_phone',cn:'求购人电话'},
  {en:'want_create_time',cn:'求购时间'},
   {en:'want_detail_imgs',cn:'详情图|'},
    {en:'want_detail_word',cn:'详情文字'},
 {en:'want_mark1',cn:'备注1'},
 {en:'want_mark2',cn:'备注2'},
 {en:'want_mark3',cn:'备注3'}
 ];
 var table_json_article=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'article_title',cn:'标题'},
 {en:'article_type',cn:'分类归属'},
 {en:'article_cover_img',cn:'封面图'},
 {en:'article_create_time',cn:'上传时间'},
 {en:'article_content',cn:'正文html'},
 {en:'article_mark1',cn:'备注1'},
 {en:'article_mark2',cn:'备注2'},
 {en:'article_mark3',cn:'备注3'}
 ];
  var table_json_loginLog=[
 {en:'index',cn:'序号'},
 {en:'id',cn:'ID'},
 {en:'login_user_id',cn:'会员ID'},
 {en:'login_time',cn:'登录时间'},
 {en:'login_mark1',cn:'备注1'},
 {en:'login_mark2',cn:'备注2'},
 {en:'login_mark3',cn:'备注3'}
 ];
   var table_json_img=[
 {en:'index',cn:'序号'},
  {en:'img',cn:'预览'},
 {en:'src',cn:'路径'},
   {en:'create_time',cn:'创建时间'},
    {en:'update_time',cn:'修改时间：'},
 {en:'visit_time',cn:'访问时间'}
 ];
 
var sortMark=-1;
$(document).ready(function(){

	
	$("#nav li").click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		var __index=$(this).index();
		$('[data-nav="display"]').not(__index).hide();
		$('[data-nav="display"]').eq(__index).show();
	});
	$("#nav li").eq(0).click();
	
	$(".table-responsive").on("click","tbody td",function(){
	$("td").removeClass('active');
	$(this).addClass('active');
	});
	
	$("#searchUserform").submit(function(event){
		event.preventDefault();
		var __account=$("#user_account").val();
		var __name=$("#user_name").val();
		
		layer.msg('正在查找：账号='+ __account+' , 厂家='+ __name);
		var __json={};
		
			__json['type']="user_show";
		if(__account!=''){__json['user_account']=__account;}
		if(__name!=''){__json['user_name']=__name;}
			
		  $.post(globalData.api,__json,function(data,status){
			data=JSON.parse(data) ;
			users=data.data;
			displayTable('userlist',users,table_json_user);
		  });
	});
	$("#userlist").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_user[__index].en;
		sortBy(users,__type);
		displayTable('userlist',users,table_json_user)
	});
	$("#userlist").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<2){return}
		var __id=$(this).parent().attr('data-thisid');
		var __old=$(this).html();
		var __type=table_json_user[__index].en;
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="user_update";
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getUserList();
			});
		});
	});


	$("#addActiveCode").submit(function(event){
		event.preventDefault();
		var __addActiveCodeNumbers=$("#addActiveCodeNumbers").val();
		layer.msg('正在生成：数量='+ __addActiveCodeNumbers+'');
		var __json={};
			__json['type']="activecode_insert";
		if(__addActiveCodeNumbers!=''){
			var __mark=0;
			for(var i=0;i<__addActiveCodeNumbers;i++){
				$.post(globalData.api,__json,function(data,status){
					__mark++;
					if(__mark>=__addActiveCodeNumbers){
						getActiveCodeList();
					}
				  });
			}
		}
	});
	$("#activeCodeList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_activeCode[__index].en;
		sortBy(activeCodes,__type);
		displayTable('activeCodeList',activeCodes,table_json_activeCode);
	});
	$("#activeCodeList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<2){return}
		var __id=$(this).parent().attr('data-thisid');
		var __old=$(this).html();
		var __type=table_json_activeCode[__index].en;////////////////////////////////////
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="user_update";////////////////////////////////////
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getActiveCodeList();////////////////////////////////////
			});
		});
	});


//createProtypeform //protypeList
	$("#createProtypeform").submit(function(event){
		event.preventDefault();
		var __pro_type_name=$("#pro_type_name").val();
		var __pro_type_index=$("#pro_type_index").val();
		layer.msg('正在新增：类别名称='+ __pro_type_name+'排序依据='+ __pro_type_index+'');
		var __json={};
			__json['type']="protype_insert";
		if(__pro_type_name!=''){__json['pro_type_name']=__pro_type_name;}
		if(__pro_type_index!=''){__json['pro_type_index']=__pro_type_index;}

		$.post(globalData.api,__json,function(data,status){
			getProtypeList();
		 });
	});
	$("#protypeList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_protype[__index].en;
		sortBy(protypes,__type);
		displayTable('protypeList',protypes,table_json_protype);///
	});
	$("#protypeList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __id=$(this).parent().attr('data-thisid');
		
		
		if(__index==1){
			layer.msg('您要删除id='+__id+'?', {
			  time: 0 //不自动关闭
			  ,btn: ['确认删除', '点错了']
			  ,yes: function(index){
				layer.close(index);
				
				var __json={};
				__json['type']="protype_delete";////////////////////////////////////
				__json['id']=__id;

				$.post(globalData.api,__json,function(data,status){
					data=JSON.parse(data) ;
					console.log(data);
					 layer.msg('处理完成，刷新中……');
					 getProtypeList();////////////////////////////////////
				});
			  }
			});
		return;
		}
		
		var __old=$(this).html();
		var __type=table_json_protype[__index].en;////////////////////////////////////
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="protype_update";////////////////////////////////////
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getProtypeList();////////////////////////////////////
			});
		});
	});

//searchProductform displayTable('productList',products,table_json_product);///////////


					
					
	$("#searchProductform").submit(function(event){
		event.preventDefault();
		var __user_account=$("#user_account2").val();
		var __pro_user_id=$("#pro_user_id").val();
		var __pro_type=$("#pro_type").val();
		var __pro_name=$("#pro_name").val();
					
		layer.msg('正在查询：厂家账号='+ __user_account+',厂家ID='+ __pro_user_id+',类别id='+ __pro_type+',商品名称='+ __pro_name+',');
		var __json={};
			__json['type']="product_show";
		if(__user_account!=''){__json['user_account']=__user_account;}
		if(__pro_user_id!=''){__json['pro_user_id']=__pro_user_id;}
		if(__pro_type!=''){__json['pro_type']=__pro_type;}
		if(__pro_name!=''){__json['pro_name']=__pro_name;}

		$.post(globalData.api,__json,function(data,status){
			data=JSON.parse(data) ;
			products=data.data;/////////
			displayTable('productList',products,table_json_product);///////////
			//getProductList();
		 });
	});
	$("#productList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_product[__index].en;//////
		sortBy(products,__type);
		displayTable('productList',products,table_json_product);///
	});
	$("#productList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __id=$(this).parent().attr('data-thisid');
		
		
		if(__index==1){
			layer.msg('您要删除id='+__id+'?', {
			  time: 0 //不自动关闭
			  ,btn: ['确认删除', '点错了']
			  ,yes: function(index){
				layer.close(index);
				
				var __json={};
				__json['type']="product_delete";////////////////////////////////////
				__json['id']=__id;

				$.post(globalData.api,__json,function(data,status){
					data=JSON.parse(data) ;
					console.log(data);
					 layer.msg('处理完成，刷新中……');
					 getProductList();////////////////////////////////////
				});
			  }
			});
		return;
		}
		
		var __old=$(this).html();
		var __type=table_json_product[__index].en;////////////////////////////////////
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="product_update";////////////////////////////////////
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getProductList();////////////////////////////////////
			});
		});
	});



	$("#carouselList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_carouse[__index].en;//////
		sortBy(carouses,__type);
		displayTable('carouselList',carouses,table_json_carouse);///
	});
	$("#carouselList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __id=$(this).parent().attr('data-thisid');
		
		
		if(__index==1){
			layer.msg('您要删除id='+__id+'?', {
			  time: 0 //不自动关闭
			  ,btn: ['确认删除', '点错了']
			  ,yes: function(index){
				layer.close(index);
				
				var __json={};
				__json['type']="carousel_delete";////////////////////////////////////
				__json['id']=__id;

				$.post(globalData.api,__json,function(data,status){
					data=JSON.parse(data) ;
					console.log(data);
					 layer.msg('处理完成，刷新中……');
					 getCarouselList();////////////////////////////////////
				});
			  }
			});
		return;
		}
		
		var __old=$(this).html();
		var __type=table_json_carouse[__index].en;////////////////////////////////////
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="carousel_update";////////////////////////////////////
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getCarouselList();////////////////////////////////////
			});
		});
	});




	$("#searchWantform").submit(function(event){
		event.preventDefault();
		var __want_title=$("#want_title").val();
		layer.msg('正在查找：标题包含【'+ __want_title+'】');
		var __json={};
		
			__json['type']="want_show";
		if(__want_title!=''){__json['want_title']=__want_title;}
			
		  $.post(globalData.api,__json,function(data,status){
			data=JSON.parse(data) ;
			wants=data.data;
			displayTable('wantList',wants,table_json_want);
		  });
	});
	$("#wantList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_want[__index].en;
		sortBy(wants,__type);
		displayTable('wantList',wants,table_json_want)
	});
	$("#wantList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __id=$(this).parent().attr('data-thisid');
		
		
		if(__index==1){
			layer.msg('您要删除id='+__id+'?', {
			  time: 0 //不自动关闭
			  ,btn: ['确认删除', '点错了']
			  ,yes: function(index){
				layer.close(index);
				
				var __json={};
				__json['type']="want_delete";////////////////////////////////////
				__json['id']=__id;

				$.post(globalData.api,__json,function(data,status){
					data=JSON.parse(data) ;
					console.log(data);
					 layer.msg('处理完成，刷新中……');
					 getWantList();////////////////////////////////////
				});
			  }
			});
		return;
		}
		var __old=$(this).html();
		var __type=table_json_want[__index].en;
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="want_update";
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getWantList();
			});
		});
	});



	$("#searchArticleform").submit(function(event){
		event.preventDefault();
		var __article_type=$("#article_type").val();
		layer.msg('正在查找：标题包含【'+ __article_type+'】');
		var __json={};
		
			__json['type']="article_show";
		if(__article_type!=''){__json['article_type']=__article_type;}
			
		  $.post(globalData.api,__json,function(data,status){
			data=JSON.parse(data) ;
			articles=data.data;
			displayTable('articleList',articles,table_json_article,6);
		  });
	});
	$("#articleList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_article[__index].en;
		sortBy(articles,__type);
		displayTable('articleList',articles,table_json_article,6);
	});
	$("#articleList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __id=$(this).parent().attr('data-thisid');
		
		
		if(__index==1){
			layer.msg('您要删除id='+__id+'?', {
			  time: 0 //不自动关闭
			  ,btn: ['确认删除', '点错了']
			  ,yes: function(index){
				layer.close(index);
				
				var __json={};
				__json['type']="article_delete";////////////////////////////////////
				__json['id']=__id;

				$.post(globalData.api,__json,function(data,status){
					data=JSON.parse(data) ;
					console.log(data);
					 layer.msg('处理完成，刷新中……');
					 getArticleList();////////////////////////////////////
				});
			  }
			});
		return;
		}
		var __old=$(this).html();
		var __type=table_json_article[__index].en;
		//prompt层
		layer.prompt({title: '为id='+__id+'的 ['+__type+'] ['+__old+'] 输入新的值，并确认',maxlength:'auto'}, function(value, index){
			layer.close(index);

			layer.msg('正在处理您的修改值：'+ value);

			var __json={};
			__json['type']="article_update";
			__json['id']=__id;
			__json[__type]=value;

			$.post(globalData.api,__json,function(data,status){
				data=JSON.parse(data) ;
				console.log(data);
				 layer.msg('处理完成，刷新中……');
				 getArticleList();
			});
		});
	});

	$("#searchLoginLogform").submit(function(event){
		event.preventDefault();
		var __login_user_id=$("#login_user_id").val();
		layer.msg('正在查找：会员id='+ __login_user_id+'');
		var __json={};
		
			__json['type']="login_show";
		if(__login_user_id!=''){__json['login_user_id']=__login_user_id;}
			
		  $.post(globalData.api,__json,function(data,status){
			data=JSON.parse(data) ;
			loginLogs=data.data;
			displayTable('loginLogList',loginLogs,table_json_loginLog);
		  });
	});
	$("#loginLogList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_loginLog[__index].en;
		sortBy(loginLogs,__type);
		displayTable('loginLogList',loginLogs,table_json_loginLog);
	});

	$("#imgList").on("click","th",function(){
		var __index=$(this).index();
		if(__index<1){return}
		var __type=table_json_img[__index].en;
		sortBy(imgs,__type);
		displayTable('imgList',imgs,table_json_img);
	});
	$("#imgList").on(__tdclick,"tbody td",function(){
		var __index=$(this).index();
		var __src=$(this).html;
		if(__index==1){
			
			var __id=Number($(this).prev().html())-1;
			var __img=imgs[__id];
		
			layer.msg(__img.img, {
			  time: 0 //不自动关闭
			  ,btn: ['删除图片', '点错了']
			  ,yes: function(index){
					layer.close(index);
					$.get(globalData.deimgs+__img.filename,function(data,status){
						data=JSON.parse(data) ;
						layer.msg(data.msg);
						getimgList();
					});
				
			  }
			});
		
		}
	});


});
function getimgList(){
	
	$.get(globalData.imgs,function(data,status){
	data=JSON.parse(data) ;
	imgs=data.data;
	
	var newAr=[];
	for(i in imgs){
		var img=imgs[i];
		if(img.src.indexOf(".php")==-1){
			
			newAr.push( {
				id:i,
				filename:img.src,
				src:globalData.domain+"/upLoad/"+img.src,
				img:'<img style="max-width:200px;" src="'+globalData.domain+"/upLoad/"+img.src+'" />',
				create_time:img.create_time,
				update_time:img.update_time,
				visit_time:img.visit_time,
			});
			
		}
		
	}
	imgs=newAr;
	displayTable('imgList',imgs,table_json_img);
	console.log(newAr);
  });



}

function getLoginLogList(){
  $.post(globalData.api,{type: "login_show"},function(data,status){
	data=JSON.parse(data) ;
	loginLogs=data.data;
	displayTable('loginLogList',loginLogs,table_json_loginLog);
  });
}
function addOneArticle(){
		  $.post(globalData.api,{
		  type: "article_insert",						
		  article_title: "请填写标题",
		  article_cover_img: "封面图",
		  article_create_time: new Date().Format("yyyy-MM-dd HH:mm:ss"),
		  article_content: "正文html",
		  article_type: "2"
		  },function(data,status){/////////
			data=JSON.parse(data) ;
			articles=data.data;/////////
			getArticleList();
		  });
}
function getArticleList(){
  $.post(globalData.api,{type: "article_show"},function(data,status){
	data=JSON.parse(data) ;
	articles=data.data;
	displayTable('articleList',articles,table_json_article,6);
  });
}
function addOneWant(){
		  $.post(globalData.api,{
		  type: "want_insert",
		  want_title: "请填写标题",
		  want_create_name: "请填写姓名",
		  want_create_phone: "13588888888",
		  want_detail_word: "详情文字",
		  want_detail_imgs: "详情图|详情图|详情图"
		  },function(data,status){/////////
			data=JSON.parse(data) ;
			wants=data.data;/////////
			//displayTable('productList',products,table_json_product);///////////
			getWantList();
		  });
}
function getWantList(){
  $.post(globalData.api,{type: "want_show"},function(data,status){
	data=JSON.parse(data) ;
	wants=data.data;
	displayTable('wantList',wants,table_json_want);
  });
}

function addOneCarousel(){
		  $.post(globalData.api,{
		  type: "carousel_insert",
		  carousel_img: "请填写图片地址"
		  },function(data,status){/////////
			data=JSON.parse(data) ;
			//wants=data.data;/////////
			//displayTable('productList',products,table_json_product);///////////
			getCarouselList();
		  });
}

function getCarouselList(){
		  $.post(globalData.api,{type: "carousel_show"},function(data,status){/////////
			data=JSON.parse(data) ;
			carouses=data.data;/////////
			
			

				for(i in carouses){
					carouses[i]['img']='<img style="max-width:200px;" src="'+carouses[i].carousel_img+'" />';
				}

	
	
			displayTable('carouselList',carouses,table_json_carouse);///////////
		  });
}



function addOneProduct(){
		  $.post(globalData.api,{
		  type: "product_insert",
		  pro_name: "请填写商品名称",
		  pro_type: "1",
		  pro_img_cover: "封面图",
		  pro_img_carousel: "轮播图|轮播图",
		  pro_detail_word: "请填写详情文字",
		  pro_detail_imgs: "详情图|详情图|详情图",
		  pro_user_id: "1",
		  
		  },function(data,status){/////////
			data=JSON.parse(data) ;
			products=data.data;/////////
			//displayTable('productList',products,table_json_product);///////////
			getProductList();
		  });
}
function getProTypeForProductList(){
	getProtypeList(function(){
		var selectHtml="";
		selectHtml+='<option value="">未选择</option>';
		for(i in protypes){
			var protype=protypes[i];
			selectHtml+='<option value="'+protype.id+'">'+protype.pro_type_name+'</option>';
		}
		$("#pro_type").html(selectHtml);
	});
}
function getProductList(){
		  $.post(globalData.api,{type: "product_show"},function(data,status){/////////
			data=JSON.parse(data) ;
			products=data.data;/////////
			displayTable('productList',products,table_json_product);///////////
		  });
}


function getProtypeList(callback){
	layer.msg('刷新中');
  $.post(globalData.api,{type: "protype_show"},function(data,status){/////////
	data=JSON.parse(data) ;
	protypes=data.data;/////////
	displayTable('protypeList',protypes,table_json_protype);///////////
	if(callback){
		callback();
	}
	
  });
}
function getActiveCodeList(){
	layer.msg('刷新中');
  $.post(globalData.api,{type: "activecode_show"},function(data,status){
	data=JSON.parse(data) ;
	activeCodes=data.data;
	displayTable('activeCodeList',activeCodes,table_json_activeCode);
  });
}

function getUserList(){
  $.post(globalData.api,{type: "user_show"},function(data,status){
	data=JSON.parse(data) ;
	users=data.data;
	displayTable('userlist',users,table_json_user);
  });
}
function sortBy(__json,__str){  
	sortMark=-sortMark;
	console.log("sortBy="+__str);
    __json.sort(function(a,b){  
      // return sortMark*(a[__str]-b[__str]); 
		var xxx=(a[__str] + '').localeCompare(b[__str] + '')
		return sortMark*xxx;	   
    });
}
function displayTable(__elementID,__datas,__table_json_data,row=0){
  var l=__datas.length;
  var ll=__table_json_data.length;
  var html="";
  html+='<table class="table">';
  
  html+='<thead><tr>';
  for(var ii=0;ii<ll;ii++){html+='<th>'+__table_json_data[ii].cn+'</th>';}
  html+='</tr></thead>';
  
  html+='<tbody>';
  for(var i=0;i<l;i++){
	var __data=__datas[i],n=i+1;
	html+='<tr data-thisid="'+__data.id+'"><td>'+n+'</td>';
	for(var iii=1;iii<ll;iii++){
		if(iii==row){
			var _html_=__data[__table_json_data[iii].en];
			
			html+='<td><input value=\''+_html_+'\'></td>';
			//html+='<td><script type="text/html" style="display:block">'+_html_+'</scipt></td>';
		}else{
			html+='<td>'+__data[__table_json_data[iii].en]+'</td>';
		}
		
	}
	html+='</tr>';
  }
  html+='</tbody>';
  
  html+='</table>';
  $("#"+__elementID).html(html);
  console.log(__datas);console.log(status);
}



function imgPreview(fileDom) {
	//判断是否支持FileReader
	if(window.FileReader) {
		var reader = new FileReader();
	} else {
		layer.msg("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
	}
	//获取文件
	var file = fileDom.files[0];
	var imageType = /^image\//;
	//是否是图片
	if(!imageType.test(file.type)) {
		layer.msg("请选择图片！");
		return;
	}
	//读取完成
	reader.onload = function(e) {
		//获取图片dom
		var img = document.getElementById("preview");
		//图片路径设置为读取的图片
		img.src = e.target.result;
	};
	reader.readAsDataURL(file);
}

function upimg(){
	var formData = new FormData(); 
formData.append('uploadfile_ant', $('#input_file')[0].files[0]);  //添加图片信息的参数
//formData.append('sizeid',123);  //添加其他参数
$.ajax({
    url: globalData.upapi,
    type: 'POST',
    cache: false, //上传文件不需要缓存 什么鬼到你关系
    data: formData,
    processData: false, // 告诉jQuery不要去处理发送的数据
    contentType: false, // 告诉jQuery不要去设置Content-Type请求头
    success: function (data) {
	data=JSON.parse(data) ;
             layer.msg(globalData.domain+"/"+data.data,{
			 time: 0 //不自动关闭
			 });
			 
			 getimgList();
    },
    error: function (data) {
        layer.msg("上传失败");
    }
});
}

Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "H+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}
function isPC() {
                if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                    /*window.location.href="你的手机版地址";*/
                    return false;
                }
                else {
                    /*window.location.href="你的电脑版地址";    */
                     return true;
                }
            }