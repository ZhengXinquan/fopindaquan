//app.js
App({
  onLaunch: function() {
    // 展示本地存储能力
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)


    //获取用户信息
    wx.getSetting({
      success: res => {
        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称，不会弹框
          wx.getUserInfo({
            success: res => {
              // 可以将 res 发送给后台解码出 unionId
              this.globalData.userInfo = res.userInfo

              // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
              // 所以此处加入 callback 以防止这种情况
              if (this.userInfoReadyCallback) {
                this.userInfoReadyCallback(res)
              }

              console.log("get userinfo:");
              console.log(this.globalData.userInfo);

            }
          })
        }else{
          console.log("has userinfo already");
          console.log(this.globalData.userInfo);
        } 
      }
    })
  },
  globalData: {
    api: "https://www.nanshanqiao.com/fopin/api.php",
    upapi: "https://www.nanshanqiao.com/fopin/upload.php",
    domain: "http://www.nanshanqiao.com/fopin",
    userInfo: null,
    pattJson: {
      mobile: /^[1]([3-9])[0-9]{9}$/,
      psw: /^[a-zA-Z0-9_]{6,10}$/,
      name: /^[\u4E00-\u9FA5·]{2,6}$/,
      cname: /^[\u4E00-\u9FA5\-0-9a-zA-Z_·]+$/,
      phone: /^[0-9\-]{7,12}$/,
      acode: /^[0-9a-fA-F]{16,32}$/,

    },
    fopinUser:null,
  },
  postAPI(data_, callback) {
    wx.showLoading({
      title: '加载中',
    })
    wx.request({
      url: this.globalData.api, //仅为示
      method: "POST",
      data: data_,
      header: {
        // 'content-type': 'application/json' // 默认值
        "Content-Type": "application/x-www-form-urlencoded"
      },
      success: function(res) {
        callback(res);
      },
      fail: function(err) {
        console.log(err);
      },
      complete() {
        wx.hideLoading();
      }
    })
  },
  uploadAPI(imgPath, callback) {
    if (imgPath.indexOf("http://tmp/wx") == -1 && imgPath.indexOf("wxfile://tmp")==-1){
      console.log(imgPath);
      var re = {
        data: JSON.stringify({
          "code": "1",
          "msg": "It is a web image",
          "data": imgPath
        })
      };
      callback(re);
      return;
    }
    wx.uploadFile({
      url: this.globalData.upapi,
      filePath: imgPath,
      name: 'uploadfile_ant',
      // formData: {
      //   'imgIndex': i
      // },
      header: {
        "Content-Type": "multipart/form-data"
      },
      success: function(res) {
        callback(res);
        // var data = JSON.parse(res.data);
        // console.log(res.data);
        // that.setData({
        //   aboutImages: that.data.aboutImages.concat(app.globalData.api + '/' + data.data)
        // });
        //如果是最后一张,则隐藏等待中  
        // if (uploadImgCount == tempFilePaths.length) {
        //   wx.hideToast();
        // }
      },
      fail: function(res) {
        wx.hideToast();
        wx.showModal({
          title: '错误提示',
          content: '上传图片失败',
          showCancel: false,
          success: function(res) {}
        })
      }
    });
  }, toLogin(jsondata){
    const app=this;
    
    app.postAPI(jsondata, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          app.globalData.fopinUser = res.data.data;
          console.log(app.globalData.fopinUser);
          wx.hideToast();
          wx.showModal({
            title: '恭喜您登录成功',
            content: '',
            showCancel: false,
            success: function (res) {
              console.log("恭喜您登录成功");
            }
          });
          wx.navigateBack({
            delta: 1
          })
          return;
        }
        wx.showToast({
          title: res.data.msg,
          icon: 'none'
        })
      } else {
        console.log(typeof res.data);
      }
    });
  },checkLogin(callback){
    const app=this;
    if (app.globalData.fopinUser) {

      callback();

    } else {
      wx.switchTab({
        url: '../login/login',
      })
      wx.showToast({
        title: '请先注册登录',
        icon: 'none',
        duration: 2000
      })
    }
  }
})