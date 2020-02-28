//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    swiperHeight:"480rpx",
    curClass:"",
    inputValue:"",
    motto: 'Hello World',
    userInfo: {},
    hasUserInfo: false,
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    bnrUrl: [],
    indexMenu: [{
      url: "../product/product",
      openType: "switchTab",
      src: "../../images/home-1.png",
      text: "产品"
    }, {
      url: "../want/want",
      openType: "switchTab",
        src: "../../images/home-2.png",
      text: "求购"
    }, {
        url: "../aboutShow/aboutShow",
      openType: "navigate",
        src: "../../images/home-3.png",
      text: "展会"
    }, {
        url: "../aboutAdd/aboutAdd",
        openType: "navigate",
        src: "../../images/home-4.png",
      text: "会员"
    }],
    productsType: [{
      title: "今日 · 热购",
      products: [
        // {
        //   id: "11",
        //   pro_img_cover: "http://img0.imgtn.bdimg.com/it/u=3036435550,272081210&fm=15&gp=0.jpg",
        //   pro_name: "name111111"
        // }
      ]
    }, {
      title: "产品 · 推荐",
      products: []
    }, {
        title: "热搜 · 排行",
      products: []
    }, ]
  },
  toClickSwiper: function (e) {
    var prourl = e.currentTarget.dataset['prourl'];
    if (prourl.length<8){return}
    console.log("prourl=" + prourl);
    wx.navigateTo({
      url: prourl
    })
  },
  //事件处理函数
  toProductById: function(e) {
    var id = e.currentTarget.dataset['proid'];
    console.log("id=" + id);
    wx.navigateTo({
      url: '../productOne/productOne?id=' + id
    })
  },
  //搜索框文本内容显示
  inputBind: function (event) {
    this.setData({
      inputValue: event.detail.value
    })
    console.log('bindInput' + this.data.inputValue)

  },
  /**
    * 搜索执行按钮
    */
  query: function (event) {
    const that=this;
    wx.setStorage({
      key: 'searchValue',
      data: that.data.inputValue
    })
    wx.switchTab({
      url: '../product/product',
      success: function (e) {
        var page = getCurrentPages().pop();
        if (page == undefined || page == null) return;
        page.onLoad();
      }
    });
  },
  // bindViewTap: function() {
  //   wx.navigateTo({
  //     url: '../logs/logs'
  //   })
  // },
  indexINIT() {
    const that = this;
    /////////加载 三排商品/////////////
    for (var i = 0; i < 3; i++) {
      (function(i) {
        app.postAPI({
          type: "product_show",
          pro_mark1: i + 1
        }, function(res) {
          console.log(res.data);
          let productsType_products = 'productsType[' + i + '].products';
          if (typeof res.data == 'object') {
            if (res.data.code == "1") {
              that.setData({
                [productsType_products]: res.data.data
              });
            } else {

            }
          } else {
            console.log(typeof res.data);
          }
        });
      })(i)
    }
    /////////加载 轮播图/////////////
    app.postAPI({
      type: "carousel_show"
    }, function(res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        that.setData({
          bnrUrl: res.data.data
        });
      } else {
        console.log(typeof res.data);
      }
    });
  },
  onPullDownRefresh() {
    this.indexINIT();
    setTimeout(function() {
      wx.stopPullDownRefresh();
    }, 2000);
  },
  onLoad: function() {
    const that = this;


    // app.toLogin({
    //   type: "login",
    //   "user_account": '13503952445',
    //   "user_pwd": '123456'
    // });


    // setTimeout(function() {
    //   wx.navigateTo({
    //     url: '../productPublish/productPublish?id=17'
    //   });
    // }, 1000);
    //return;

    that.indexINIT();



    const query = that.createSelectorQuery()
    query.select('#swiper').boundingClientRect()
query.exec(function(res){
  console.log(res)    
 
      that.setData({
      swiperHeight: res[0].height
    })
})




  //  wx.switchTab({
  //    url: '../login/login'
  //  });
    // wx.navigateTo({
    //   url: '../wantOne/wantOne?id=1'
    // })
    // wx.showToast({
    //   title: '佛品大全欢迎您',
    //   icon: 'success',
    //   duration: 2000
    // });

    //新增轮播图
    //  app.postAPI({
    //    type: "carousel_insert",
    //    carousel_img:"http://img4.imgtn.bdimg.com/it/u=3081108087,555312235&fm=26&gp=0.jpg"
    //  }, function (res) {
    //    console.log(res.data);
    //    if (typeof res.data == 'object') {
    //     //  bnrUrl
    //    } else {
    //      console.log(typeof res.data);
    //    }
    //  });

    //"新增激活码成功"
    //  for(var i=0;i<10;i++){
    //    app.postAPI({
    //      type: "activecode_insert"
    //    }, function (res) {
    //      console.log(res.data);
    //      if (typeof res.data == 'object') {
    //      } else {
    //        console.log(typeof res.data);
    //      }
    //    });
    //  }

    //"新增分类成功"
    // for(var i=1;i<=5;i++){
    // var typeName="第"+i+"个分类";
    //     app.postAPI({
    //       type: "protype_insert",
    //       pro_type_name: typeName
    //     }, function (res) {
    //       console.log(res.data);
    //       if (typeof res.data == 'object') {
    //       } else {
    //         console.log(typeof res.data);
    //       }
    //     });
    // }



  },
  // 页面滚动
  onPageScroll(e) {
    if (e.scrollTop >= this.data.swiperHeight && !this.data.curClass) {
      // 当页面顶端距离大于一定高度时
      this.setData({
        curClass: 'item_fix'
      })
    } else if (e.scrollTop <= this.data.swiperHeight && this.data.curClass) {
      this.setData({
        curClass: ''
      })
    }
  }

})