var reg = /^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/;
var app = getApp();
Page({
  data:{
    user : {},
    disabled: false,
    array:["个人","企业",],
    index:1,
    blNumber:'',
    truename:'',
    tel:'',
    audit:0,
    ptype:0,
    yezhu: '',
    wuye: '',
    project_name: '',
    name: '',
    phone: '',
    danwei: '',
    brand: '',
    spec: '',
    heavier: '',
    speed: '',
    floor: '',
    num: '',
    addtime: '',
    master_name: '',
    master_num: '',
    master_phone: '',
    special: '',
    old_weihu: '',
    endtime: '',
    content: '',
    hege: '',
    register: '',
    yuanli: '',
    shuoming: '',
    component: '',
    supervision: '',
    regular: '',
    plan: '',
    save: '',
    qita:'',
  },
  // 上传图片
  chooseImage: function () {
    var that = this
    wx.chooseImage({
      count: 1,
      sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有  
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
      success: function (res) {
        var imageSrc = res.tempFilePaths[0];
        wx.uploadFile({
          url: app.pubData.hostUrl + '/Api/User/uploadbl',
          filePath: imageSrc,
          name: 'img',
          formData: {
            uid: app.pubData.userId
          },
          header: {
            'Content-Type': 'multipart/form-data'
          },
          success: function (res) {
            //console.log('uploadImage success, res is:', res);
            var statusCode = res.statusCode;
            if (statusCode==200){
              wx.showToast({
                title: '上传成功',
                icon: 'success',
                duration: 2000
              })
              that.setData({
                imageSrc
              })
            }
          },
          fail: function ({errMsg}) {
            console.log('uploadImage fail, errMsg is', errMsg)
            wx.showToast({
              title: '上传失败',
              icon: 'success',
              duration: 2000
            })
          }
        })

      },
      fail: function ({errMsg}) {
        console.log('chooseImage fail, err is', errMsg)
        wx.showToast({
          title: '图片选择失败',
          icon: 'success',
          duration: 2000
        })
      }
    })
  },

//类型选择 更改事件
bindPickerChange: function(e) {
  console.log(e.detail.value);
    this.setData({
      index: e.detail.value
    })
  },

//营业执照编号失去焦点事件
numberInputEvent:function(e){
    this.setData({
      blNumber:e.detail.value
    })
 },

//窗体加载事件
onLoad: function (options) {
    var that = this;
    var uid = app.pubData.userId;
  },

//提交认证
formDataCommit: function (e) {
    var that = this;
    var yezhu = that.data.yezhu;
    var wuye = that.data.wuye;
    var project_name = that.data.project_name;
    var name = that.data.name;
    var phone = that.data.phone;
    var danwei = that.data.danwei;
    var brand = that.data.brand;
    var spec = that.data.spec;
    var heavier = that.data.heavier;
    var speed = that.data.speed;
    var floor = that.data.floor;
    var num = that.data.num;
    var addtime = that.data.addtime;
    var master_name = that.data.master_name;
    var master_num = that.data.master_num;
    var master_phone = that.data.master_phone;
    var special = that.data.special;
    var old_weihu = that.data.old_weihu;
    var endtime = that.data.endtime;
    var content = that.data.content;
    var hege = that.data.hege;
    var register = that.data.register;
    var yuanli = that.data.yuanli;
    var shuoming = that.data.shuoming;
    var component = that.data.component;
    var supervision = that.data.supervision;
    var regular = that.data.regular;
    var plan = that.data.plan;
    var save = that.data.save;
    var qita = that.data.qita;

    if(phone == ''){
      wx.showToast({
        title: '请输入联系人手机号码！',
        duration: 2000
      });
      return false;
    }
    wx.request({
      url: app.pubData.hostUrl + '/Api/Apply/sendApply',
      method: 'post',
      data: { 
        uid:app.pubData.userId,
        yezhu: yezhu,
        wuye: wuye,
        project_name: project_name,
        name: name,
        phone: phone,
        danwei: danwei,
        brand: brand,
        spec: spec,
        heavier: heavier,
        speed: speed,
        floor: floor,
        num: num,
        addtime: addtime,
        master_name: master_name,
        master_num: master_num,
        master_phone: master_phone,
        special: special,
        old_weihu: old_weihu,
        endtime: endtime,
        content: content,
        hege: hege,
        register: register,
        yuanli: yuanli,
        shuoming: shuoming,
        component: component,
        supervision: supervision,
        regular: regular,
        plan: plan,
        save: save,
        qita: qita,

      },
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

        }else{
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        }
        //endInitData
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },

//姓名焦点事件
bindKeyname(e) {
  console.log(e.detail.value);
  this.setData({
    truename: e.detail.value,
  })
},
bindDateChange: function (e) {
  console.log('picker发送选择改变，携带值为', e.detail.value)
  this.setData({
    addtime: e.detail.value
  })
},
bindDateChange2: function (e) {
  console.log('picker发送选择改变，携带值为', e.detail.value)
  this.setData({
    endtime: e.detail.value
  })
},
getyezhu:function (e) {
  console.log(e)
  this.setData({
    yezhu: e.detail.value
  })
},
getwuye: function (e) {
  this.setData({
    wuye: e.detail.value
  })
},
getproject: function (e) {
  this.setData({
    project_name: e.detail.value
  })
},
getname: function (e) {
  this.setData({
    name: e.detail.value
  })
},
getphone: function (e) {
  this.setData({
    phone: e.detail.value
  })
},
getdanwei: function (e) {
  this.setData({
    danwei: e.detail.value
  })
},
getbrand: function (e) {
  this.setData({
    brand: e.detail.value
  })
},
getspec: function (e) {
  this.setData({
    spec: e.detail.value
  })
},
getheavier: function (e) {
  this.setData({
    heavier: e.detail.value
  })
},
getspeed: function (e) {
  this.setData({
    speed: e.detail.value
  })
},
getfloor: function (e) {
  this.setData({
    floor: e.detail.value
  })
},
getnum: function (e) {
  this.setData({
    num: e.detail.value
  })
},
getmasterName: function (e) {
  this.setData({
    master_name: e.detail.value
  })
},
getmasterNum: function (e) {
  this.setData({
    master_num: e.detail.value
  })
},
getmasterPhone: function (e) {
  this.setData({
    master_phone: e.detail.value
  })
},
getspecial: function (e) {
  this.setData({
    special: e.detail.value
  })
},
getoldWeihu: function (e) {
  console.log(e)
  this.setData({
    old_weihu: e.detail.value
  })
},
getcontent: function (e) {
  this.setData({
    content: e.detail.value
  })
},
getphone: function (e) {
  console.log()
  this.setData({
    phone: e.detail.value
  })
},

//手机焦点事件
bindTelInput (e){
  console.log(e.detail.value);
    this.setData({
      tel: e.detail.value,
      userver : reg.test(e.detail.value)
    }) 
},

  watch (){
    console.log(1)
  },
  radioChange: function (e) {
    var hege = e.detail.value;
    this.setData({
      hege:hege
    });
  },
  radioChange2: function (e) {
    var register = e.detail.value;
    this.setData({
      register: register
    });
  },
  radioChange3: function (e) {
    var yuanli = e.detail.value;
    this.setData({
      yuanli: yuanli
    });
  },
  radioChange4: function (e) {
    var shuoming = e.detail.value;
    this.setData({
      shuoming: shuoming
    });
  },
  radioChange5: function (e) {
    var component = e.detail.value;
    this.setData({
      component: component
    });
  },
  radioChange6: function (e) {
    var supervision = e.detail.value;
    this.setData({
      supervision: supervision
    });
  },
  radioChange7: function (e) {
    var regular = e.detail.value;
    this.setData({
      regular: regular
    });
  },
  radioChange8: function (e) {
    var plan = e.detail.value;
    this.setData({
      plan: plan
    });
  },
  radioChange9: function (e) {
    var save = e.detail.value;
    this.setData({
      save: save
    });
  },
  radioChange10: function (e) {
    var qita = e.detail.value;
    this.setData({
      qita: qita
    });
  },
})