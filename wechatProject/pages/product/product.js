// pages/product/product.js
//获取应用实例
const app = getApp();
Page({
  data: {
    scrollTop:10,
    scrollHeight:'450',
    inputValue: '', //搜索的内容
    protype:[],
    protypeactive:1,
    prolist:[]
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
    var that = this;
    console.log("搜索: "+that.data.inputValue);
    that.setData({ protypeactive: 0 });
    app.postAPI({
      type: "product_show",
      pro_name: that.data.inputValue
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          that.setData({ prolist: res.data.data });
        } else {
        }
      } else {
        console.log(typeof res.data);
      }
    });
  },
  //事件处理函数
  toProductById: function (e) {
    var id = e.currentTarget.dataset['proid'];
    console.log("id=" + id);
    wx.navigateTo({
      url: '../productOne/productOne?id=' + id
    })
  },
  //////////前往发布产品//////////////
  publishProduct:function(){
    var that = this;
    if (app.globalData.fopinUser){
        wx.showToast({
          title: '前往发布产品',
          icon: 'none',
          duration: 2000
        })
        wx.navigateTo({
          url: '../productPublish/productPublish'
        })
    }else{
      wx.switchTab({
        url: '../login/login',
      })
      wx.showToast({
        title: '请先注册登录',
        icon: 'none',
        duration: 2000
      })
    }
    
  },
   /////////加载某个类别/////////////
  getProductByTypeID:function(e){
    var typeid;
    if(typeof e == "object"){
      typeid = e.currentTarget.dataset['typeid'];
    }else{
      typeid = e;
    };
    var that = this;
    that.setData({ protypeactive: typeid });
    app.postAPI({
      type: "product_show",
      pro_type: typeid
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          that.setData({ prolist: res.data.data });
        } else {
        }
        that.setData({ scrollTop: 0 });
      } else {
        console.log(typeof res.data);
      }
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  indexINIT:function(e){
    var that = this; 
    /////////加载 类别/////////////
    app.postAPI({
      type: "protype_show"
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          that.setData({ protype: res.data.data });
          try {
            const value = wx.getStorageSync('searchValue')
            if (value) {
              // Do something with return value
              console.log("searchValue:"+value);

              that.setData({
                inputValue: value
              })

              that.query();

              wx.removeStorage({
                key: 'searchValue',
                success(res) {
                  console.log(res)
                }
              })
            }else{
              console.log("searchValue: value false");
              that.getProductByTypeID(that.data.protype[0].id);
            }
          } catch (e) {
            console.log("searchValue: catch error");
            console.log(e);
            // Do something when catch error
          }


        

        } else {
        }
      } else {
        console.log(typeof res.data);
      }
    });
    ///////


    let clientHeight = wx.getSystemInfoSync().windowHeight;
    let clientWidth = wx.getSystemInfoSync().windowWidth;
    let scrollHeight = 750 / clientWidth * clientHeight -115;
    console.log("scrollHeight="+scrollHeight+"rpx");
    this.setData({
      scrollHeight: scrollHeight
    })
  },
  /**
 * 页面相关事件处理函数--监听用户下拉动作
 */
  onPullDownRefresh: function () {
    this.indexINIT();
    setTimeout(function () {
      wx.stopPullDownRefresh();
    }, 2000);
  },

  onLoad: function (options) {
 
	this.indexINIT();

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },



  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})