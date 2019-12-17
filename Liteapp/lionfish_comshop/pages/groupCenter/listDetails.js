// lionfish_comshop/pages/groupCenter/listDetails.js
var app =getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    isIpx: app.globalData.isIpx,
    list: [],
    state: 0
  },
  list_id: '',

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let list_id = options.id || '';
    let state = options.state || 0;
    if (list_id) {
      this.setData({ state });
      wx.showLoading();
      this.list_id = list_id;
      this.getData(list_id);
    } else {
      wx.redirectTo({
        url: '/lionfish_comshop/pages/groupCenter/list',
      })
    }
  },

  getData: function (list_id) {
    let that = this;
    var token = wx.getStorageSync('token');
    app.util.request({
      'url': 'entry/wxapp/index',
      'data': {
        controller: 'community.get_head_deliverygoods',
        token: token,
        list_id: list_id
      },
      dataType: 'json',
      success: function (res) {
        wx.hideLoading();
        console.log(res);
        if (res.data.code == 0) {
          that.setData({
            list: res.data.data || []
          })
        }
      },
      fail: (err)=> {
        console.log(err);
        wx.hideLoading();
      }
    })
  },

  signAll: function () {
    let that = this;
    let token = wx.getStorageSync('token');
    let list_id = this.list_id;
    app.util.request({
      'url': 'entry/wxapp/index',
      'data': {
        controller: 'community.sub_head_delivery',
        token: token,
        list_id: list_id
      },
      dataType: 'json',
      success: function (res) {
        wx.hideLoading();
        console.log(res);
        if (res.data.code == 0) {
          wx.showToast({
            title: '收货成功',
            icon: false
          })
          setTimeout(()=>{
            wx.redirectTo({
              url: '/lionfish_comshop/pages/groupCenter/list',
            })
          }, 2000);
        } else {
          wx.showToast({
            title: '签收失败，请重试！',
            icon: false
          })
        }
      },
      fail: (err) => {
        console.log(err);
        wx.hideLoading();
      }
    })
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

  }
})