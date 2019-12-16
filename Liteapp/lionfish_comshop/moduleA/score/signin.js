// lionfish_comshop/moduleA/score/signin.js
var util = require('../../utils/util.js');
var app = getApp();

Page({
  mixins: [require('../../mixin/scoreCartMixin.js')],
  data: {
    info: {},
    dayScore: []
  },

  onLoad: function () {
    wx.showLoading();
    this.getData();
  },

  onShow: function () {
    let that = this;
    util.check_login_new().then((res) => {
      if (!res) {
        that.setData({
          needAuth: true
        })
      }
    })
  },

  /**
   * 授权成功回调
   */
  authSuccess: function () {
    let that = this;
    this.setData({
      needAuth: false,
      showAuthModal: false
    }, () => {
      that.getData();
    })
  },

  authModal: function () {
    if (this.data.needAuth) {
      this.setData({ showAuthModal: !this.data.showAuthModal });
      return false;
    }
    return true;
  },

  getData: function(){
    var token = wx.getStorageSync('token');
    let that = this;
    app.util.request({
      url: 'entry/wxapp/user',
      data: {
        controller: 'signinreward.get_signinreward_baseinfo',
        token: token
      },
      dataType: 'json',
      success: function (res) {
        wx.hideLoading();
        if (res.data.code == 0) {
          let info = res.data.data || {};
          let dayScore = [];
          dayScore.push(info.signinreward_day1_score || 0);
          dayScore.push(info.signinreward_day2_score || 0);
          dayScore.push(info.signinreward_day3_score || 0);
          dayScore.push(info.signinreward_day4_score || 0);
          dayScore.push(info.signinreward_day5_score || 0);
          dayScore.push(info.signinreward_day6_score || 0);
          dayScore.push(info.signinreward_day7_score || 0);

          let isopen_signinreward = info.isopen_signinreward;
          if (isopen_signinreward!=1) {
            app.util.message('未开启签到送积分功能', 'switchTo:/lionfish_comshop/pages/index/index', 'error');
          }

          that.setData({
            info: res.data.data || {},
            dayScore
          })
        } else {
          that.setData({ needAuth: true })
        }
      }
    })
  },

  signIn: function () {
    if (!this.authModal()) return;
    var token = wx.getStorageSync('token');
    let that = this;
    app.util.request({
      url: 'entry/wxapp/user',
      data: {
        controller: 'signinreward.sub_signin',
        token: token
      },
      dataType: 'json',
      success: function (res) {
        wx.hideLoading();
        if (res.data.code == 0) {
          let { score, continuity_day, reward_socre } = res.data;
          let info = that.data.info;
          info.score = score;
          info.today_is_signin = 1;
          info.has_continuity_day = continuity_day;
          info.show_day_arr[continuity_day-1].is_signin = 1;
          that.setData({ info })
          app.util.message('签到成功', '', 'success');
        } else{
          app.util.message(res.data.msg || '签到失败', '', 'success');
        }
      }
    })
  },

  goLink: function (event) {
    if (!this.authModal()) return;
    let link = event.currentTarget.dataset.link;
    var pages_all = getCurrentPages();
    if (pages_all.length > 3) {
      wx.redirectTo({
        url: link
      })
    } else {
      wx.navigateTo({
        url: link
      })
    }
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
    let info = this.data.info;
    let { signinreward_share_title, signinreward_share_image } = info;
    var share_id = wx.getStorageSync('member_id');
    var share_path = 'lionfish_comshop/moduleA/score/signin?share_id=' + share_id;
    console.log('签到分享地址：', share_path);

    return {
      title: signinreward_share_title,
      path: share_path,
      imageUrl: signinreward_share_image,
      success: function (res) {
        // 转发成功
      },
      fail: function (res) {
        // 转发失败
      }
    }
  }
})