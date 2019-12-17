function getdomain() {
  var app = getApp();

  var new_domain = app.siteInfo.uniacid + '_' + app.siteInfo.siteroot;

  var api = new_domain;
  return api;
}

function api() {
  var api = 'https://mall.shiziyu888.com/dan/';
  return api;
}

function check_login() {
  let token = wx.getStorageSync('token');
  let member_id = wx.getStorageSync('member_id');

  if (token && member_id != undefined && member_id.length > 0) {
    return true;
  } else {
    return false;
  }
}

/**
 * 检查登录状态
 * return promise [Boolean]
 */
function check_login_new() {
  let token = wx.getStorageSync('token');
  let member_id = wx.getStorageSync('member_id');
  return new Promise(function (resolve, reject) {
    wx.checkSession({
      success() {
        console.log('checkSession 未过期');
        if (token && member_id != undefined && member_id.length > 0) {
          resolve(true)
        } else {
          resolve(false)
        }
      },
      fail() {
        console.log('checkSession 过期');
        resolve(false)
      }
    })
  })
}

/**
 * 检查跳转权限控制
 * return [Boolean]
 */
function checkRedirectTo(url, needAuth) {
  let status = false;
  if (needAuth) {
    const needAuthUrl = [
      "/lionfish_comshop/pages/groupCenter/apply", 
      "/lionfish_comshop/pages/supply/apply",
      "/lionfish_comshop/pages/user/charge",
      "/lionfish_comshop/pages/order/index"
    ];
    let idx = needAuthUrl.indexOf(url);
    if (idx !== -1) status = true;
  }
  return status;
}

/**
 * s_link: 回调链接
 * type：跳转方式 0 redirectTo， 1 switchTab
 */
function login(s_link, type = 0) {
  var app = getApp();
  var share_id = wx.getStorageSync('share_id');
  if (share_id == undefined) {
    share_id = '0';
  }

  wx.login({
    success: function(res) {
      if (res.code) {
        console.log(res.code);
        app.util.request({
          'url': 'entry/wxapp/user',
          'data': {
            controller: 'user.applogin',
            'code': res.code
          },
          dataType: 'json',
          success: function(res) {
            console.log(res);
            wx.setStorage({
              key: "token",
              data: res.data.token
            })
            wx.getUserInfo({
              success: function(msg) {
                var userInfo = msg.userInfo
                wx.setStorage({
                  key: "userInfo",
                  data: userInfo
                })
                console.log(msg.userInfo);
                app.util.request({
                  'url': 'entry/wxapp/user',
                  'data': {
                    controller: 'user.applogin_do',
                    'token': res.data.token,
                    share_id: share_id,
                    nickName: msg.userInfo.nickName,
                    avatarUrl: msg.userInfo.avatarUrl,
                    encrypteddata: msg.encryptedData,
                    iv: msg.iv
                  },
                  method: 'post',
                  dataType: 'json',
                  success: function(res) {
                    wx.setStorage({
                      key: "member_id",
                      data: res.data.member_id
                    })
                    wx.showToast({
                      title: '资料已更新',
                      icon: 'success',
                      duration: 2000,
                      success: function() {
                        //s_link
                        if (s_link && s_link.length > 0){
                          if (type == 1) {
                            wx.switchTab({
                              url: s_link,
                            })
                          } else {
                            wx.redirectTo({
                              url: s_link
                            })
                          }
                        }
                      }
                    })
                  }
                })
              },
              fail: function(msg) {
                // console.log(msg);
              }
            })
          }
        });
      } else {
        //console.log('获取用户登录态失败！' + res.errMsg)
      }
    }
  })
}

function login_prosime(needPosition=true) {
  var app = getApp();
  var share_id = wx.getStorageSync('share_id');
  if (share_id == undefined) {
    share_id = '0';
  }
  var community = wx.getStorageSync('community');
  var community_id = community && (community.communityId || 0);
  community && wx.setStorageSync('lastCommunity', community);

  return new Promise(function (resolve, reject) {
    wx.login({
      success: function (res) {
        if (res.code) {
          console.log(res.code);
          app.util.request({
            'url': 'entry/wxapp/user',
            'data': {
              controller: 'user.applogin',
              'code': res.code
            },
            dataType: 'json',
            success: function (res) {
              console.log(res);
              wx.setStorage({
                key: "token",
                data: res.data.token
              })
              wx.getUserInfo({
                success: function (msg) {
                  var userInfo = msg.userInfo
                  wx.setStorage({
                    key: "userInfo",
                    data: userInfo
                  })
                  console.log(msg.userInfo);
                  app.util.request({
                    url: 'entry/wxapp/user',
                    data: {
                      controller: 'user.applogin_do',
                      token: res.data.token,
                      share_id: share_id,
                      nickName: msg.userInfo.nickName,
                      avatarUrl: msg.userInfo.avatarUrl,
                      encrypteddata: msg.encryptedData,
                      iv: msg.iv,
                      community_id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function (res) {
                      let isblack = res.data.isblack || 0;
                      if (isblack==1) {
                        app.globalData.isblack = 1;
                        wx.removeStorageSync('token');
                        wx.switchTab({
                          url: '/lionfish_comshop/pages/index/index',
                        })
                      } else {
                        wx.setStorage({
                          key: "member_id",
                          data: res.data.member_id
                        })
                        console.log('needPosition', needPosition)
                        needPosition && getCommunityInfo();
                      }
                      resolve(res);
                    }
                  })
                },
                fail: function (msg) {
                  reject(msg)
                }
              })
            }
          });
        } else {
          reject(res.errMsg)
        }
      }
    })
  })
}

function stringToJson(data) {
  return JSON.parse(data);
}

function jsonToString(data) {
  return JSON.stringify(data);
}

function imageUtil(e) {
  var imageSize = {};
  var originalWidth = e.detail.width; //图片原始宽  
  var originalHeight = e.detail.height; //图片原始高  
  var originalScale = originalHeight / originalWidth; //图片高宽比  

  //获取屏幕宽高  
  wx.getSystemInfo({
    success: function(res) {
      var windowWidth = res.windowWidth;
      var windowHeight = res.windowHeight;
      var windowscale = windowHeight / windowWidth; //屏幕高宽比  

      //console.log('windowWidth: ' + windowWidth)
      //console.log('windowHeight: ' + windowHeight)
      if (originalScale < windowscale) { //图片高宽比小于屏幕高宽比  
        //图片缩放后的宽为屏幕宽  
        imageSize.imageWidth = windowWidth;
        imageSize.imageHeight = (windowWidth * originalHeight) / originalWidth;
      } else { //图片高宽比大于屏幕高宽比  
        //图片缩放后的高为屏幕高  
        imageSize.imageHeight = windowHeight;
        imageSize.imageWidth = (windowHeight * originalWidth) / originalHeight;
      }
    }
  })
  //console.log('缩放后的宽: ' + imageSize.imageWidth)
  //console.log('缩放后的高: ' + imageSize.imageHeight)
  return imageSize;
}

const formatTime = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

const formatNumber = n => {
  n = n.toString()
  return n[1] ? n : '0' + n
}

//获取社区存本地
const getCommunityInfo = function (param = {}) {
  let community = wx.getStorageSync('community');
  let app = getApp();
  let that = this;
  var token = wx.getStorageSync('token');
  return new Promise(function (resolve, reject) {
    // if (!community){
      app.util.request({
        url: 'entry/wxapp/index',
        data: {
          controller: 'index.load_history_community',
          token: token
        },
        dataType: 'json',
        success: function (res) {
          if (res.data.code == 0) {
            let history_communities = res.data.list;
            if (Object.keys(history_communities).length > 0 || history_communities.communityId != 0){
              wx.setStorageSync('community', history_communities);
              app.globalData.community = history_communities;
              resolve(history_communities);
            } else {
              resolve('');
            }
          }else{
            console.log(param)
            if (check_login() && param.communityId === void 0){
              wx.redirectTo({
                url: '/lionfish_comshop/pages/position/community',
              })
              resolve('');
            } else {
              resolve(param);
            }
          }
        }
      })
    // } else {
    //   resolve('')
    // }
  })
}

/**
 * 通过社区id获取社区信息
 * 单社区控制
 * data：该id社区信息
 * open_danhead_model：是否开启单社区
 * default_head_info： 自定义单社区信息
 */
const getCommunityById = function (community_id){
  return new Promise(function (resolve, reject) {
    getApp().util.request({
      url: 'entry/wxapp/index',
      data: {
        controller: 'index.get_community_info',
        community_id
      },
      dataType: 'json',
      success: function (res) {
        console.log('util..');
        console.log(res.data.code);
        if(res.data.code==0) resolve(res.data);
      }
    })
  })
}

module.exports = {
  formatTime: formatTime,
  login: login,
  check_login: check_login,
  api: api,
  getdomain: getdomain,
  imageUtil: imageUtil,
  jsonToString: jsonToString,
  stringToJson: stringToJson,
  login_prosime,
  getCommunityInfo,
  check_login_new,
  checkRedirectTo,
  getCommunityById
}