// pages/loginMyPro/loginMyPro.js

//获取应用实例
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    user_id:"",
    user_token:"",
    myPro:[]
  },
  //事件处理函数
  toEditByID: function (e) {
    var id = e.currentTarget.dataset['did'];
    console.log("id=" + id);
    wx.navigateTo({
      url: '../loginMyProEdit/loginMyProEdit?id=' + id
    })
  },
  toDetailByID: function (e) {
    var id = e.currentTarget.dataset['did'];
    console.log("id=" + id);
    wx.navigateTo({
      url: '../productOne/productOne?id=' + id
    })
  },
  toDeleteByID: function (e) {
    const that=this;
    var id = e.currentTarget.dataset['did'];
    console.log("id=" + id);

    wx.showModal({
      title: '提示',
      content: '确定删除此商品吗？',
      success(res) {
        if (res.confirm) {
          console.log('用户点击确定');



          app.postAPI({
            type: "product_delete",
            id: id
          }, function (res) {
            console.log(res.data);
            if (typeof res.data == 'object') {
              if (res.data.code == "1") {
                wx.showToast({
                  title: res.data.msg,
                  icon: 'success'
                });
                that.pageINIT();
              } else {

              }
            } else {
              console.log(typeof res.data);
            }
          });


        } else if (res.cancel) {
          console.log('用户点击取消');
          wx.showToast({
            title: '取消',
            icon: 'success'
          });
        }
      }
    })

  },
  toPublish: function (e) {
    wx.navigateTo({
      url: '../productPublish/productPublish'
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  pageINIT(){
    const that=this;

    app.checkLogin(function () {
      that.setData({
        user_id: app.globalData.fopinUser.id,
        user_token: app.globalData.fopinUser.user_token
      });
    });


    app.postAPI({
      type: "product_show",
      pro_user_id: this.data.user_id
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          that.setData({
            myPro: res.data.data
          });
        } else {

        }
      } else {
        console.log(typeof res.data);
      }
    });
  },
  onLoad: function (options) {
    this.pageINIT();
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
    const that = this;
    app.checkLogin(function () {
      that.setData({
        user_id: app.globalData.fopinUser.id,
        user_token: app.globalData.fopinUser.user_token
      });
    });
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
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
    this.pageINIT();
    setTimeout(function () {
      wx.stopPullDownRefresh();
    }, 1500);
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