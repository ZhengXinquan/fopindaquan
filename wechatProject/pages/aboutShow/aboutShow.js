// pages/aboutShow/aboutShow.js

const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    articles:[]
  },
  //事件处理函数
  toDetailByID: function (e) {
    var id = e.currentTarget.dataset['did'];
    console.log("id=" + id);
    wx.navigateTo({
      url: '../aboutShowOne/aboutShowOne?id=' + id
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    const that = this;


    app.postAPI({
      type: "article_show",
       article_type: 2
    }, function (res) {
      console.log(res.data);

      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          let articles = res.data.data
          if (Array.isArray(articles) && articles.length > 0) {
            that.setData({ articles: articles });
          } else {
            wx.showToast({
              title: '暂无信息',
              icon: 'none'
            });
          }
        } else {

        }
      } else {
        console.log(typeof res.data);
      }
    });
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