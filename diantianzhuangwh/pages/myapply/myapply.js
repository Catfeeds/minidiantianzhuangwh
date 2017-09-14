// pages/classify/classify.js
var app = getApp();
Page({
  data:{
    // 供求
    apply:[],
  },

detail:function(e){
    console.log(e.currentTarget.dataset.id)
    wx.redirectTo({
      url: '../applydetail/applydetail?id='+e.currentTarget.dataset.id,
      success: function(res){
        // success
      },
      fail: function() {
        // fail
      },
      complete: function() {
        // complete
      }
    })
  },
  onLoad:function(options){
    // 页面初始化 options为页面跳转所带来的参数
    
  },

  del:function (e) {
    var id = e.currentTarget.dataset.id;
    var uid = app.pubData.userId;
    var that = this;
    wx.request({
      url: app.pubData.hostUrl + '/Api/Apply/del',
      method: 'post',
      data: { apply_id: id, uid:uid },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if (status == 1) {
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        } else {
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        };
        that.reShow()
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },
  onReady:function(){
    // 页面渲染完成
  },
  onShow:function(){
    // 页面显示
    var that = this;
    var uid = app.pubData.userId;
    wx.request({
      url: app.pubData.hostUrl + '/Api/User/my_apply',
      method: 'post',
      data: { uid: uid },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if (status == 1) {
          var list = res.data.list;
          that.setData({
            apply: list,
          });
        } else {
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        }
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },
  reShow:function () {
    var that = this;
    var uid = app.pubData.userId;
    wx.request({
      url: app.pubData.hostUrl + '/Api/User/my_apply',
      method: 'post',
      data: { uid: uid },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if (status == 1) {
          var list = res.data.list;
          that.setData({
            apply: list,
          });
        } else {
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        }
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },
  onHide:function(){
    // 页面隐藏
  },
  onUnload:function(){
    // 页面关闭
  }
})