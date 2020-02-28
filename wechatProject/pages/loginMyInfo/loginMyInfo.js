// pages/loginMyInfo/loginMyInfo.js

//获取应用实例
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    myInfo: {
      id: "0",
      login_time: "loading",
      user_account: "loading",
      user_active_code: "loading",
      user_addr: "loading",
      user_create_time: "loading",
      user_end_time: "loading",
      user_mark1: "loading",
      user_mark2: "loading",
      user_mark3: "loading",
      user_name: "loading",
      user_phone: "loading",
      user_pwd: "loading",
      user_token: "loading"
    }
  },


  handleInput(e) { //采购人
    const _type = e.currentTarget.dataset['type'];
    const _myInfo = 'myInfo.' + _type;
    const value = e.detail.value

    this.setData({
      toErr: '',
      [_myInfo]: value
    });

    if (_type == "user_name" && !app.globalData.pattJson.cname.test(value)) {
      this.setData({
        toErr: _type
      });
      return;
    }
    if (_type == "user_addr" && !app.globalData.pattJson.cname.test(value)) {
      this.setData({
        toErr: _type
      });
      return;
    }
    if (_type == "user_phone" && !app.globalData.pattJson.phone.test(value)) {
      this.setData({
        toErr: _type
      });
      return;
    }
  },


  toUpdata: function (e) {
    console.log(this.data.myInfo);
    const that = this;

    const user_name = this.data.myInfo.user_name;
    const user_addr = this.data.myInfo.user_addr;
    const user_phone = this.data.myInfo.user_phone;

    if (!app.globalData.pattJson.cname.test(user_name) || user_name.length < 1) {
      wx.showToast({
        title: '厂家名称为空或错误，请排除特殊字符',
        icon: 'none'
      })
      return;
    }
    if (!app.globalData.pattJson.cname.test(user_addr) || user_addr.length < 1) {
      wx.showToast({
        title: '厂家地址为空或错误，请排除特殊字符',
        icon: 'none'
      })
      return;
    }
    if (!app.globalData.pattJson.phone.test(user_phone)) {
      wx.showToast({
        title: '厂家电话格式错误',
        icon: 'none'
      })
      return;
    }


    //更新
    app.postAPI({
      type:"user_update",
      id:that.data.myInfo.id,
      user_name: user_name,
      user_addr: user_addr,
      user_phone: user_phone
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          app.globalData.fopinUser = res.data.data;
          console.log(app.globalData.fopinUser);
          wx.hideToast();
        }
        wx.showToast({
          title: res.data.msg,
          icon: 'none'
        })
      } else {
        console.log(typeof res.data);
      }
    });
  },
  indexINIT:function(e){
    const that = this;
    wx.showLoading({
      title: '加载中',
    })
    app.checkLogin(function () {
      that.setData({
        myInfo: app.globalData.fopinUser
      });
      wx.hideLoading();
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function(options) {
    this.indexINIT();
  },
  toLoginOut: function () {
    const that=this;
    app.globalData.userInfo = null; 
    app.globalData.fopinUser = null; 
    that.setData({
      myInfo: null
    });
    wx.switchTab({
      url: '../index/index'
    });
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
    }, 1000);
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