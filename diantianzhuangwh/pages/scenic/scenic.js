// pages/scenic/scenic.js
var app = getApp();
//引入这个插件，使html内容自动转换成wxml内容
var WxParse = require('../../wxParse/wxParse.js');
Page({
  data:{
     text:'',
    'jing':[
      {
       'img':'../../image/li.jpg',
       'biao':'▎麓湖景区',
       'qu':'麓湖游览区是白云山风景区南端的第一个游览区。麓湖公园建于1958年，位于白云山南麓，麓边有湖、曲桥、亭廊、寺庙古刹，故名麓湖公园。占地面积3.7平方公里。是广州市内最大的开放式、多功能公园。',
      },
        {
       'img':'../../image/lo.jpg',
       'biao':'▎麓湖景区',
       'qu':'麓湖游览区是白云山风景区南端的第一个游览区。麓湖公园建于1958年，位于白云山南麓，麓边有湖、曲桥、亭廊、寺庙古刹，故名麓湖公园。占地面积3.7平方公里。是广州市内最大的开放式、多功能公园。',
      }
    ]
  },
  onLoad:function(options){
    // 页面初始化 options为页面跳转所带来的参数
    var that = this;
    var proId = options.proId;
    console.log(proId);
    wx.request({
      url: app.pubData.hostUrl + '/Api/Product/details',
      method: 'post',
      data: { pro_id: proId },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if (status == 1) {
          var content = res.data.content;
          WxParse.wxParse('content', 'html', content, that, 3);
          that.setData({
            text: res.data.content
          });
        }else{
          wx.showToast({
            title: '商品不存在或已下架！',
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