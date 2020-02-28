// pages/loginChangePWD/loginChangePWD.js

//获取应用实例
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    myInfo: {
      id: "0",
      user_pwd1: "",
      user_pwd2: "",
      user_pwd3: ""
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

    if (_type == "user_pwd1" && !app.globalData.pattJson.psw.test(value)) {
      this.setData({
        toErr: _type
      });
      return;
    }
    if (_type == "user_pwd2" && !app.globalData.pattJson.psw.test(value)) {
      this.setData({
        toErr: _type
      });
      return;
    }
    if (_type == "user_pwd3" && !app.globalData.pattJson.psw.test(value)) {
      this.setData({
        toErr: _type
      });
      return;
    }
  },
  toUpdata: function (e) {
    console.log(this.data.myInfo);
    const that = this;
    const user_id = this.data.myInfo.id;
    const user_pwd1 = this.data.myInfo.user_pwd1;
    const user_pwd2 = this.data.myInfo.user_pwd2;
    const user_pwd3 = this.data.myInfo.user_pwd3;

    if (!app.globalData.pattJson.psw.test(user_pwd1)) {
      wx.showToast({
        title: '旧密码错误',
        icon: 'none'
      })
      return;
    }
    if (!app.globalData.pattJson.psw.test(user_pwd2)) {
      wx.showToast({
        title: '新密码错误，请填写6-10位的字母或数字',
        icon: 'none'
      })
      return;
    }
    if (!app.globalData.pattJson.psw.test(user_pwd3) || user_pwd2 != user_pwd3) {
      wx.showToast({
        title: '重复密码错误，请重复填写新密码',
        icon: 'none'
      })
      return;
    }


    //更新
    app.postAPI({
      type: "user_update_pwd",
      id: user_id,
      user_pwd: user_pwd1,
      user_pwd_new: user_pwd2
    }, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
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
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

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
        ['myInfo.id']: app.globalData.fopinUser.id
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