// pages/loginMyProEdit/loginMyProEdit.js
import {
  $init,
  $digest
} from '../../utils/common.util'

const app = getApp();
Page({
  data: {
    id:"",
    titleCount: 0,
    titleMax: 12,
    contentCount: 0,
    contentMax: 500,
    protype: [],
    protypeIndex: 0,
    images: {
      cover: [],
      coverMax: 1,
      carousel: [],
      carouselMax: 3,
      detail: [],
      detailMax: 5
    },
    product: {
      "type": "product_insert",
      "pro_name": "",
      "pro_type": "",
      "pro_img_cover": "",
      "pro_img_carousel": "",
      "pro_detail_word": "",
      "pro_detail_imgs": "",
      "pro_user_id": ""
    }
  },
  onLoad(options) {
    var that = this;
    $init(this);
     ////////获取当前商品id//////
    if (options.id){
      that.setData({
        id: options.id
      });
    } else {
      wx.navigateBack({
        delta: 1
      });
      return;
    }


    ////////获取当前商家id//////
    if (app.globalData.fopinUser) {
      that.setData({
        ['product.pro_user_id']: app.globalData.fopinUser.id
      });
    } else {
      wx.navigateBack({
        delta: 1
      });
      return;
    }

    /////////加载 类别/////////////
    app.postAPI({
      type: "protype_show"
    }, function (res) {
      that.setData({
        protype: res.data.data,
       // ['product.pro_type']: res.data.data[0].id
      });
      console.log(res);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          app.postAPI({
            type: "product_show",
            id:that.data.id
          }, function (res) {
            console.log(res.data);
            if (typeof res.data == 'object') {
              if (res.data.code == "1") {

            
                var img_det = res.data.data[0].pro_detail_imgs.split('|');
                if (img_det[0] == "isNull") {
                  img_det = [];
                }
 
                that.setData({
                  product: res.data.data[0],
                  titleCount: res.data.data[0].pro_name.length,
                  contentCount: res.data.data[0].pro_detail_word.length,
                  protypeIndex: res.data.data[0].pro_type-1,
                  ['images.cover']: res.data.data[0].pro_img_cover.split('|'),
                  ['images.carousel']: res.data.data[0].pro_img_carousel.split('|'),
                  ['images.detail']: img_det
                });
              } else { }
            } else {
              console.log(typeof res.data);
            }
          });

        } else { }
      } else {
        console.log(typeof res.data);
      }
    });
  },
  pickChange: function (e) {
    const that = this;
    this.setData({
      protypeIndex: e.detail.value,
      ['product.pro_type']: that.data.protype[e.detail.value].id
    });
  },
  handleTitleInput(e) {
    const value = e.detail.value
    this.data.titleCount = value.length //计算已输入的标题字数
    this.setData({
      ['product.pro_name']: value
    });
    $digest(this)
  },
  handleContentInput(e) {
    const value = e.detail.value;
    this.data.contentCount = value.length //计算已输入的正文字数
    this.setData({
      ['product.pro_detail_word']: value
    });
    $digest(this)
  },
  chooseImage(e) {
    var imgType = e.currentTarget.dataset['type'];
    var limit = (imgType == "cover") ? this.data.images.coverMax : imgType == "carousel" ? this.data.images.carouselMax : this.data.images.detailMax;
    wx.chooseImage({
      sizeType: ['original', 'compressed'], //可选择原图或压缩后的图片
      sourceType: ['album', 'camera'], //可选择性开放访问相册、相机
      success: res => {
        const images = this.data.images[imgType].concat(res.tempFilePaths)
        // 限制最多只能留下3张照片
        this.data.images[imgType] = images.length <= limit ? images : images.slice(0, limit)
        $digest(this)
      }
    })
  },
  removeImage(e) {
    const idx = e.target.dataset.idx
    const imgType = e.currentTarget.dataset['type'];
    this.data.images[imgType].splice(idx, 1)
    $digest(this)
  },
  handleImagePreview(e) {
    const idx = e.target.dataset.idx
    const imgType = e.currentTarget.dataset['type'];
    const images = this.data.images[imgType]
    wx.previewImage({
      current: images[idx], //当前预览的图片
      urls: images, //所有要预览的图片
    })
  },
  submitForm(e) {
    var that = this;

    if (this.data.titleCount <= 0) {
      wx.showToast({
        title: '请输入商品名称',
        icon: 'none'
      });
      return;
    }
    if (this.data.images.cover.length != 1) {
      wx.showToast({
        title: '请选择1张封面图',
        icon: 'none'
      });
      return;
    }
    if (this.data.images.carousel.length < 1) {
      wx.showToast({
        title: '请选择至少1张轮播图',
        icon: 'none'
      });
      return;
    }
    if (this.data.contentCount <= 0) {
      wx.showToast({
        title: '请输入商品详情正文',
        icon: 'none'
      });
      return;
    }

    // tempFilePaths.concat(this.data.images.cover);
    // tempFilePaths.concat(this.data.images.carousel);
    // tempFilePaths.concat(this.data.images.detail);

    //console.log(tempFilePaths);
    //启动上传等待中...  
    wx.showToast({
      title: '正在上传...',
      icon: 'loading',
      mask: true,
      duration: 10000
    })
    const l_arr = [that.data.images.cover.length, that.data.images.carousel.length, that.data.images.detail.length, 0];
    if (l_arr[0] > 0) {
      l_arr[3]++;
    } //几类图片需要上传
    if (l_arr[1] > 0) {
      l_arr[3]++;
    } //几类图片需要上传
    if (l_arr[2] > 0) {
      l_arr[3]++;
    } //几类图片需要上传
    var c_arr = [0, 0, 0, 0];
    var img_arr = [
      [],
      [],
      []
    ];

    for (var i = 0; i < l_arr[0]; i++) {
      (function (i) {
        app.uploadAPI(that.data.images.cover[i], function (res) {
          c_arr[0]++;
          console.log(res);
          console.log(res.data);
          var data = JSON.parse(res.data);
         
          if (data.code < 1) {
            wx.hideToast();
            wx.showModal({
              title: '第 ' + Number(i + 1) + ' 张封面图错误',
              content: String(data.msg),
              showCancel: false,
              success: function (res) { }
            })
            return;
          }
          img_arr[0][i] = (data.data.indexOf("http") == 0) ? data.data:app.globalData.domain + '/' + data.data;

          //如果是最后一张,则隐藏等待中  
          if (c_arr[0] == l_arr[0]) {
            c_arr[3]++;
            if (c_arr[3] == l_arr[3]) {
              that.insertPro(img_arr);
            }
          }
        });
      })(i);
    }
    for (var i = 0; i < l_arr[1]; i++) {
      (function (i) {
        app.uploadAPI(that.data.images.carousel[i], function (res) {
          c_arr[1]++;
         
          var data = JSON.parse(res.data);
          console.log(res.data);
          if (data.code < 1) {
            wx.hideToast();
            wx.showModal({
              title: '第 ' + Number(i + 1) + ' 张轮播图错误',
              content: String(data.msg),
              showCancel: false,
              success: function (res) { }
            })
            return;
          }
          img_arr[1][i] = (data.data.indexOf("http") == 0) ? data.data :app.globalData.domain + '/' + data.data;

          //如果是最后一张,则隐藏等待中  
          if (c_arr[1] == l_arr[1]) {
            c_arr[3]++;
            if (c_arr[3] == l_arr[3]) {
              that.insertPro(img_arr);
            }
          }
        });
      })(i);
    }
    for (var i = 0; i < l_arr[2]; i++) {
      (function (i) {
        app.uploadAPI(that.data.images.detail[i], function (res) {
          c_arr[2]++;

          var data = JSON.parse(res.data);
          console.log(res.data);
          if (data.code < 1) {
            wx.hideToast();
            wx.showModal({
              title: '第 ' + Number(i + 1) + ' 张详情图错误',
              content: String(data.msg),
              showCancel: false,
              success: function (res) { }
            })
            return;
          }
          img_arr[2][i] = (data.data.indexOf("http") == 0) ? data.data : app.globalData.domain + '/' + data.data;

          //如果是最后一张,则隐藏等待中  
          if (c_arr[2] == l_arr[2]) {
            c_arr[3]++;
            if (c_arr[3] == l_arr[3]) {
              that.insertPro(img_arr);
            }
          }
        });
      })(i);
    }
    //   }
    // });
  },
  insertPro(img_arr) {
    const that = this;
    that.setData({
      ['product.pro_img_cover']: img_arr[0].join("|"),
      ['product.pro_img_carousel']: img_arr[1].join("|"),
      ['product.pro_detail_imgs']: img_arr[2].join("|"),
    });
    console.log(that.data.product);
    var upJSON = {
      type: "product_update",
      pro_user_id: that.data.product.pro_user_id,
      user_token: app.globalData.fopinUser.user_token,
      id: that.data.product.id,
      pro_name: that.data.product.pro_name,
      pro_type: that.data.product.pro_type,
      pro_img_cover: that.data.product.pro_img_cover,
      pro_img_carousel: that.data.product.pro_img_carousel,
      pro_detail_word: that.data.product.pro_detail_word,
      pro_detail_imgs: that.data.product.pro_detail_imgs
    };
    console.log(upJSON);
    /////////新增商品 /////////////
    app.postAPI(upJSON, function (res) {
      console.log(res.data);
      if (typeof res.data == 'object') {
        if (res.data.code == "1") {
          wx.showModal({
            title: '信息',
            content: res.data.msg,
            showCancel: false,
            success: function (res) { }
          })
        } else { }
      } else {
        console.log(res);
      }
    });
  }

})