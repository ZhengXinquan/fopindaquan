// pages/aboutFopin/aboutFopin.js

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
  onLoad: function(options) {
    const that = this;


    app.postAPI({
      type: "article_show",
      article_type: 0
    }, function(res) {
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
        } else {

        }
      } else {
        console.log(typeof res.data);
      }
    });


    // var article ='<p><img src="http://www.nanshanqiao.com/fopin/upLoad/lunbo3.jpg"/></p><h1 style="text-align: center;">关于【佛品大全】<br/></h1><p>对于客户：一键查找，一键拨号，腾讯导航，直接对接优质厂家进一手货！</p><p>对于客户：【殉葬】【民俗】【佛品】厂商家入驻，厂商可以通过注册会员把自己的优质产品与服务上传到平台来展示，让客户轻松的找到你！</p><p>平台宗旨：会员形成结盟，资源合理共享，完成顾客省钱，实现厂商联盟！</p><p>商务合作：扫描二维码，添加客服微信进行咨询。</p><p><img src="http://www.nanshanqiao.com/fopin/upLoad/kf-wechat.jpg"/></p><p><br/></p>';
    /**
* WxParse.wxParse(bindName , type, data, target,imagePadding)
* 1.bindName绑定的数据名(必填)
* 2.type可以为html或者md(必填)
* 3.data为传入的具体数据(必填)
* 4.target为Page对象,一般为this(必填)
* 5.imagePadding为当图片自适应是左右的单一padding(默认为0,可选)
  WxParse.wxParse('article', 'html', article, that, 5);
*/

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