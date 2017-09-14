// pages/classify/classify.js
var app = getApp();
Page({
  data:{
    // 供求
    page:2,
    catId:0,
    proData:[],
    keyword: '',
    store_list:[]
  },
jieshao:function(e){
    var proId = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '../scenic/scenic?proId=' + proId,
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
    var that = this;
    var catId = options.catId;
    var title = options.title;
    var keyword = options.keyword;
    console.log(catId);
    console.log(keyword);
    that.setData({
      catId: catId,
      keyword: keyword
    });

    //设置当前分类标题
    wx.setNavigationBarTitle({ title: title });
    //ajax请求数据
    wx.request({
      url: app.pubData.hostUrl + '/Api/Shangchang/index',
      method: 'post',
      data: {
        cat_id: catId,
        keyword: keyword
      },
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var store_list = res.data.store_list;
        that.setData({
          store_list: store_list
        })
      },
      error: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      }
    })
  },

  //点击加载更多
  getMore: function (e) {
    var that = this;
    var page = that.data.page;
    wx.request({
      url: app.pubData.hostUrl + '/Api/Shangchang/get_more',
      method: 'post',
      data: {
        page: page,
        cat_id: that.data.catId,
        keyword: that.data.keyword
      },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var store_list = res.data.store_list;
        if (store_list == '') {
          wx.showToast({
            title: '没有更多数据！',
            duration: 2000
          });
          return false;
        }
        //that.initProductData(data);
        that.setData({
          page: page + 1,
          store_list: that.data.proData.concat(store_list)
        });
        //endInitData
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      }
    })
  },

  qiye: function (e) {
    var shopId = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '../synopsis/synopsis?shopId=' + shopId,
      success: function (res) {
        // success
      },
      fail: function () {
        // fail
      },
      complete: function () {
        // complete
      }
    })
  },
  onReady:function(){
    // 页面渲染完成
  },
  onShow:function(){
    // 页面显示
  },
  onHide:function(){
    // 页面隐藏
  },
  onUnload:function(){
    // 页面关闭
  }
})