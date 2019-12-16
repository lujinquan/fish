var app = getApp();
var util = require('../../utils/util.js');
var WxParse = require('../../wxParse/wxParse.js');

Page({

  /**
   * 页面的初始数据
   */
  data: {
    canPay: false,
    money: 0,
    onFocus: false,
    accountMoney: 0,
    chargetype_list: [],
    activeTypeId: ''
  },
  rech_id: 0,

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.getAccountMoney();
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    if (!util.check_login()) {
      wx.redirectTo({
        url: '/lionfish_comshop/pages/user/me',
      })
    }
  },

  getAccountMoney(){
    let token = wx.getStorageSync('token');
    let that = this;
    app.util.request({
      'url': 'entry/wxapp/user',
      'data': {
        controller: 'user.get_account_money',
        token: token
      },
      dataType: 'json',
      success: function (res) {
        if (res.data.code == 0){
          let rdata= res.data;
          let member_charge_publish = rdata.member_charge_publish;
          WxParse.wxParse('article', 'html', member_charge_publish, that, 15, app.globalData.systemInfo);

          let chargetype_list = rdata.chargetype_list;
          that.setData({ accountMoney: rdata.data, chargetype_list }) 
        } else if(res.data.code == 1) {
          wx.redirectTo({
            url: '/lionfish_comshop/pages/user/me',
          })
        }
      }
    })
  },

  getMoney: function(e){
    var val = e.detail.value;
    val ? this.setData({ canPay: true }) : this.setData({ canPay: false });
    let money =  val
    this.setData({ money });
    // return money;
  },

  /**
  * 余额充值
  */
  wxcharge: function (sendMoney=0) {
    let oriMoney = 0;
    if (sendMoney>0) {
      oriMoney = sendMoney;
    } else {
      oriMoney = this.data.money;
      var reg = /^\d+(\.\d+)?$/;
      if(!reg.test(oriMoney)) {
        wx.showToast({
          title: '请输入正确的金额',
          icon: 'none'
        })
        return false;
      }
    }
    let money = parseFloat(oriMoney).toFixed(2) || 0;
    let token = wx.getStorageSync('token');
    let that = this;
    
    that.data.canPay&&app.util.request({
      url: 'entry/wxapp/user',
      data: {
        controller: 'car.wxcharge',
        token: token,
        money: money,
        rech_id: that.rech_id
      },
      dataType: 'json',
      success: function (res) {
        wx.requestPayment({
          "appId": res.data.appId,
          "timeStamp": res.data.timeStamp,
          "nonceStr": res.data.nonceStr,
          "package": res.data.package,
          "signType": res.data.signType,
          "paySign": res.data.paySign,
          'success': function (wxres) {
            that.setData({ canPay: false, activeTypeId: 0 })
            that.getAccountMoney();
            that.rech_id = 0;
            wx.showToast({
              icon: 'none',
              title: '充值成功',
            })
            setTimeout(() => {
              wx.reLaunch({
                url: '/lionfish_comshop/pages/user/me',
              })
            }, 2000)
          },
          'fail': function (error) {
            if (that.rech_id > 0) that.setData({ canPay: false, activeTypeId: 0 }), that.rech_id = 0;
            wx.showToast({
              icon: 'none',
              title: '充值失败，请重试！',
            })
          }
        })
      }
    })
  },

  /**
   * 获得焦点
   */
  bindIptFocus: function(){
    this.setData({
      onFocus: true,
      activeTypeId: 0,
      money: 0,
      canPay: false
    })
  },

  /**
   * 失去焦点
   */
  bindIptBlur: function () {
    this.setData({ onFocus: false })
  },

  goCharge: function(e){
    let that = this;
    let chargetype_list = this.data.chargetype_list;
    let idx = e.currentTarget.dataset.idx;
    let rech_id = chargetype_list[idx].id;
    let money = chargetype_list[idx].money;
    this.rech_id = rech_id;
    this.setData({
      canPay: true
    },()=>{
      that.wxcharge(money);
    })
  },

  selChargeType: function(e){
    let that = this;
    let chargetype_list = this.data.chargetype_list;
    let idx = e.currentTarget.dataset.idx;
    let activeTypeId = chargetype_list[idx].id || 0;
    let money = chargetype_list[idx].money;
    this.rech_id = activeTypeId;
    that.setData({
      activeTypeId,
      money,
      canPay: true
    })
  }
})