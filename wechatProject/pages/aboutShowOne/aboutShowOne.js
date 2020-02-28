// pages/aboutShowOne/aboutShowOne.js
var WxParse = require('../../wxParse/wxParse.js');
//获取应用实例
const app = getApp();

Page({

  /**
   * 页面的初始数据
   */
  data: {
    article: ''
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    const that = this;
    ////////获取当前商品id//////
    if (options.id) {
      const proID = options.id;
      /////////加载 商品/////////////
      app.postAPI({
        type: "article_show",
        id: proID
      }, function (res) {
        console.log(res.data);
        if (typeof res.data == 'object') {
          if (res.data.code == "1") {
            let articles = res.data.data
            if (Array.isArray(articles) && articles.length > 0) {
              let article = articles[0].article_content;
              WxParse.wxParse('article', 'html', article, that, 5);
            } else {
              wx.showToast({
                title: '暂无信息',
                icon: 'none'
              })
            }

          } else { }
        } else {
          console.log(typeof res.data);
        }
      });










    } else {
      wx.navigateBack({
        delta: 1
      });
      return;
    }
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
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

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