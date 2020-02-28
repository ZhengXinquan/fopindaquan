// pages/productOne/productOne.js

//获取应用实例
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    proID:"7",
    pro_detail_imgs:[],
    pro_img_carousel:[],
    product: {
      id: "7",
      pro_clicks: "0",
      pro_detail_imgs: '',
      pro_detail_word: "",
      pro_img_carousel: '',
      pro_img_cover: "",
      pro_mark1: "2",
      pro_mark2: "isNull",
      pro_mark3: "isNull",
      pro_name: "",
      pro_type: "1",
      pro_type_name: "",
      pro_upload_time: "",
      pro_user_id: "2",
      user_addr: "",
      user_create_time: "",
      user_name: "",
      user_phone: "",
    }
  },



  onShareAppMessage(res) {
    if (res.from === 'button') {
      // 来自页面内转发按钮
      console.log(res.target)
    }
    return {
      title: '自定义转发标题',
      path: '/page/user?id=123'
    }
  },
  makePhoneCall(){
    const that=this;
    wx.makePhoneCall({
      phoneNumber: that.data.product.user_phone 
    })
  },
  handleImagePreview(e) {
    const idx = e.target.dataset.idx
    const images = this.data.pro_detail_imgs;
    wx.previewImage({
      current: images[idx], //当前预览的图片
      urls: images, //所有要预览的图片
    })
  },
  indexINIT:function(){
    const that=this;
    const proID = that.data.proID;
    /////////加载 商品/////////////
    app.postAPI({
      type: "product_show",
      id: proID
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          that.setData({
            product: res.data.data[0]
          });

          var img_car = that.data.product.pro_img_carousel.split("|");
          var img_det = that.data.product.pro_detail_imgs.split("|");
          if (img_det[0] == "isNull") {
            img_det = [];
          }
          that.setData({
            pro_img_carousel: img_car,
            pro_detail_imgs: img_det,
          });

        } else { }
      } else {
        console.log(typeof res.data);
      }
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function(options) {

    const that = this;
    ////////获取当前商品id//////
    if (options.id) {
      that.setData({
        proID: options.id
      });
      that.indexINIT();
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
  onReady: function() {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function() {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function() {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function() {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function() {
    this.indexINIT();
    setTimeout(function () {
      wx.stopPullDownRefresh();
    }, 2000);
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function() {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function() {

  }
})