var app = getApp()
var locat = require('../../utils/Location.js');
var util = require('../../utils/util.js');
var status = require('../../utils/index.js');
var wcache = require('../../utils/wcache.js');

Page({

  /**
   * 页面的初始数据
   */
  data: {
    payBtnLoading: false,
    showConfirmModal: false,
    receiverAddress: "", //快递送货地址
    tuan_send_address: "", //团长送货地址
    showGetPhone: false,
    lou_meng_hao:'',
    pickUpAddress: "",
    disUserName: "",
    pickUpCommunityName: "",
    is_limit_distance_buy: 0,
    tabList: [
      { id: 0, name: '到点自提', dispatching: 'pickup', enabled: false },
      { id: 1, name: '免费配送', dispatching: 'tuanz_send', enabled: false },
      { id: 2, name: '快递配送', dispatching: 'express', enabled: false }
    ],
    originTabList: [
      { id: 0, name: '到点自提', dispatching: 'pickup' },
      { id: 1, name: '免费配送', dispatching: 'tuanz_send'},
      { id: 2, name: '快递配送', dispatching: 'express'}
    ],
    tabIdx: 0,
    region: ['选择地址', '', ''],
    tot_price: 0,
    needAuth: false,
    reduce_money: 0,
    hide_quan: true,
    tuan_region: ['选择地址','',''],
    groupInfo: {
      group_name: '社区',
      owner_name: '团长',
      placeorder_tuan_name: '配送费',
      placeorder_trans_name: '快递费'
    },
    comment: '',
    is_yue_open: 0,
    can_yupay: 0,
    ck_yupay: 0,
    use_score: 0,
    commentArr: {}
  },
  canPay: true,

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function(options) {
    var that = this;
    status.setGroupInfo().then((groupInfo) => { that.setData({ groupInfo }) });
    var token = wx.getStorageSync('token');
    var community = wx.getStorageSync('community');
    var community_id = community.communityId;
    util.check_login() ? this.setData({ needAuth: false }) : (this.setData({ needAuth: true }), wx.hideTabBar());
    let is_limit = options.is_limit || 0;
    this.setData({
      buy_type: options.type || '',
      pickUpAddress: community.fullAddress || '',
      pickUpCommunityName: community.communityName || '',
      disUserName: community.disUserName || ''
    })
    wx.showLoading()

    let latitude = wx.getStorageSync('latitude2');
    let longitude = wx.getStorageSync('longitude2');
    if (is_limit==1) {
      if (latitude && longitude) {
        console.log('---------is here ?-----------');
        checkOut();
      } else {
        checkOut();
      }
    } else {
      checkOut();
    }

    function checkOut(){
      app.util.request({
        url: 'entry/wxapp/user',
        data: {
          controller: 'car.checkout',
          token: token,
          community_id,
          buy_type: options.type,
        },
        dataType: 'json',
        method: 'POST',
        success: function (res) {
          let rdata = res.data;
          // 提货方式
          let tabIdx = 0;
          let tabLength = 0;
          let tabList = that.data.tabList;
          let sortTabList = [];

          let { 
            delivery_express_name, 
            delivery_tuanzshipping_name, 
            delivery_ziti_name, 
            delivery_diy_sort,
            delivery_type_express,
            delivery_type_tuanz,
            delivery_type_ziti,
            delivery_tuanz_money,
            is_vip_card_member,
            vipcard_save_money,
            level_save_money,
            is_open_vipcard_buy,
            is_member_level_buy,
            total_integral
          } = res.data;

          // 是否可以会员折扣购买
          let canLevelBuy = false;
          if (is_open_vipcard_buy == 1) {
            if (is_vip_card_member != 1 && is_member_level_buy == 1) canLevelBuy = true;
          } else {
            (is_member_level_buy == 1) && (canLevelBuy = true);
          }

          if (delivery_type_express == 1) tabList[2].enabled = true, tabLength++;
          if (delivery_type_tuanz == 1) tabList[1].enabled = true, tabLength++;
          if (delivery_type_ziti == 1) tabList[0].enabled = true, tabLength++;

          if (delivery_diy_sort) {
            let sortArr = delivery_diy_sort.split(',');
            if (sortArr[2] && tabList[sortArr[2]] && tabList[sortArr[2]].enabled) tabIdx = sortArr[2];
            if (sortArr[1] && tabList[sortArr[1]] && tabList[sortArr[1]].enabled) tabIdx = sortArr[1];
            if (sortArr[0] && tabList[sortArr[0]] && tabList[sortArr[0]].enabled) tabIdx = sortArr[0];

            sortArr.forEach(function(item){
              sortTabList.push(tabList[item]);
            })
          }

          delivery_express_name && (tabList[2].name = delivery_express_name);
          delivery_tuanzshipping_name && (tabList[1].name = delivery_tuanzshipping_name);
          delivery_ziti_name && (tabList[0].name = delivery_ziti_name);

          let shippingFee = 0;
          if (tabIdx == 1) { shippingFee = delivery_tuanz_money; } else if (tabIdx == 2) { shippingFee = rdata.trans_free_toal;}

          var addres = 0;
          addres = 1;
          wx.hideLoading();
          var seller_chose_id = 0;
          var seller_chose_store_id = 0;
          var seller_goods = rdata.seller_goodss;

          let len = Object.keys(seller_goods).length;
          let commentArr = {};
          for (let key in seller_goods) commentArr[key] = '';

          let sel_chose_vouche = '';
          for (var i in seller_goods) {
            if (seller_goods[i].show_voucher == 1) { 
              if (seller_goods[i].chose_vouche.id) seller_chose_id = seller_goods[i].chose_vouche.id;
              if (seller_goods[i].chose_vouche.store_id) seller_chose_store_id = seller_goods[i].chose_vouche.store_id;

              if (Object.prototype.toString.call(seller_goods[i].chose_vouche) == '[object Object]'){
                sel_chose_vouche = seller_goods[i].chose_vouche;
              }
            }
            seller_goods[i].goodsnum = Object.keys(seller_goods[i].goods).length;
            for (var j in seller_goods[i].goods) {
              if (seller_goods[i].goods[j].header_disc > 0 && seller_goods[i].goods[j].header_disc < 100) {
                seller_goods[i].goods[j].header_disc = (seller_goods[i].goods[j].header_disc / 10).toFixed(1);
              }
            }
          }

          let param = {
            loadover: true,
            commentArr,
            sel_chose_vouche,
            tabList: sortTabList,
            is_limit_distance_buy: rdata.is_limit_distance_buy || 0,
            tabIdx: tabIdx,
            tabLength: tabLength,
            tuan_send_address: rdata.tuan_send_address,
            is_open_order_message: rdata.is_open_order_message,
            is_yue_open: rdata.is_yue_open,
            can_yupay: rdata.can_yupay,
            show_voucher: rdata.show_voucher,
            current_distance: rdata.current_distance || '',
            man_free_tuanzshipping: rdata.man_free_tuanzshipping*1 || 0,
            man_free_shipping: rdata.man_free_shipping*1 || 0,
            index_hide_headdetail_address: rdata.index_hide_headdetail_address || 0,
            open_score_buy_score: rdata.open_score_buy_score || 0,
            score: rdata.score || 0,
            score_for_money: rdata.score_for_money || 0,
            bue_use_score: rdata.bue_use_score || 0,
            is_man_delivery_tuanz_fare: rdata.is_man_delivery_tuanz_fare,   //是否达到满xx减团长配送费
            fare_man_delivery_tuanz_fare_money: rdata.fare_man_delivery_tuanz_fare_money,   //达到满xx减团长配送费， 减了多少钱
            is_man_shipping_fare: rdata.is_man_shipping_fare,    //是否达到满xx减运费
            fare_man_shipping_fare_money: rdata.fare_man_shipping_fare_money,   //达到满xx减运费，司机减了多少运费
            is_vip_card_member,
            vipcard_save_money,
            level_save_money,
            is_open_vipcard_buy,
            is_member_level_buy,
            canLevelBuy,
            total_integral: total_integral || ''
          }
          let addrObj = rdata.address;
          if (Object.keys(addrObj) && Object.keys(addrObj).length > 0){
              param.ziti_name = rdata.address.name
              param.ziti_mobile = addrObj.telephone
              param.receiverAddress = addrObj.address
              param.region = [addrObj.province_name || "选择地址", addrObj.city_name || "", addrObj.country_name || ""]
          } else {
            param.ziti_name = rdata.ziti_name
            param.ziti_mobile = rdata.ziti_mobile
          }

          let tuan_send_address_info = rdata.tuan_send_address_info;
          if (Object.keys(tuan_send_address_info) && Object.keys(tuan_send_address_info).length > 0) {
            param.tuan_region = [tuan_send_address_info.province_name, tuan_send_address_info.city_name, tuan_send_address_info.country_name]
            param.lou_meng_hao = tuan_send_address_info.lou_meng_hao
          }

          if (addres == 1) {
            that.setData({
              ...param,
              pick_up_time: res.data.pick_up_time,
              pick_up_type: res.data.pick_up_type,
              pick_up_weekday: res.data.pick_up_weekday,
              addressState: true,
              is_integer: res.data.is_integer,
              is_ziti: res.data.is_ziti,
              pick_up_arr: res.data.pick_up_arr,
              seller_goodss: res.data.seller_goodss,
              seller_chose_id: seller_chose_id,
              seller_chose_store_id: seller_chose_store_id,
              goods: res.data.goods,
              buy_type: res.data.buy_type,
              yupay: res.data.can_yupay,
              is_yue_open: res.data.is_yue_open,
              yu_money: res.data.yu_money,
              total_free: res.data.total_free,
              trans_free_toal: res.data.trans_free_toal,
              delivery_tuanz_money: res.data.delivery_tuanz_money,
              reduce_money: res.data.reduce_money,
              is_open_fullreduction: res.data.is_open_fullreduction,
              cha_reduce_money: res.data.cha_reduce_money
            }, () => {
              that.calcPrice();
            })
          } else {
            that.setData({
              ...param,
              is_integer: res.data.is_integer,
              addressState: false,
              goods: res.data.goods,
              is_ziti: res.data.is_ziti,
              pick_up_arr: res.data.pick_up_arr,
              seller_goodss: res.data.seller_goodss,
              seller_chose_id: seller_chose_id,
              seller_chose_store_id: seller_chose_store_id,
              buy_type: res.data.buy_type,
              yupay: res.data.can_yupay,
              is_yue_open: res.data.is_yue_open,
              yu_money: res.data.yu_money,
              total_free: res.data.total_free,
              trans_free_toal: res.data.trans_free_toal,
              delivery_tuanz_money: res.data.delivery_tuanz_money,
              reduce_money: res.data.reduce_money,
              is_open_fullreduction: res.data.is_open_fullreduction,
              cha_reduce_money: res.data.cha_reduce_money
            },()=>{
              that.calcPrice();
            })
          }
          // if (!that.data.ziti_mobile && !wx.getStorageSync('mobile')){
          //   that.setData({ showGetPhone: true })
          // }

        }
      })
    }

  },

  /**
   * 授权成功回调
   */
  authSuccess: function () {
    this.onLoad();
  },

  /**
   * 设置手机号
   */
  getReceiveMobile: function (e) {
    var num = e.detail;
    this.setData({
      t_ziti_mobile: num,
      showGetPhone: false
    });
  },

  ck_wxpays: function () {
    this.setData({
      ck_yupay: 0
    })
  },

  ck_yupays: function () {
    this.setData({
      ck_yupay: 1
    })
  },

  scoreChange: function (e) {
    console.log('是否使用', e.detail.value)
    let tdata = this.data;
    let score_for_money = tdata.score_for_money*1;
    let tot_price = tdata.tot_price*1;
    let disAmount = tdata.disAmount*1;
    if (e.detail.value){
      tot_price = (tot_price - score_for_money).toFixed(2);
      disAmount += score_for_money;
    } else {
      tot_price = (tot_price + score_for_money).toFixed(2);
      disAmount -= score_for_money;
    }
    this.setData({
      use_score: e.detail.value?1:0,
      tot_price,
      disAmount: disAmount.toFixed(2)
    })
  },

  /**
   * 未登录
   */
  needAuth: function(){
    this.setData({
      needAuth: true
    });
  },

  /**
   * 关闭手机授权
   */
  close: function () {
    this.setData({
      showGetPhone: false
    });
  },

  goOrderfrom: function() {
    var t_ziti_name = this.data.ziti_name;
    var t_ziti_mobile = this.data.ziti_mobile;
    var receiverAddress = this.data.receiverAddress;
    var region = this.data.region;
    var tuan_send_address = this.data.tuan_send_address;
    var lou_meng_hao = this.data.lou_meng_hao;

    if (t_ziti_name == '') {
      this.setData({
        focus_name: true
      })
      let tip = '请填写收货人';
      if (this.data.tabIdx == 0) tip = '请填写提货人';
      wx.showToast({
        title: tip,
        icon: 'none'
      })
      return false;
    }
    if (t_ziti_mobile == '' || !(/^1(3|4|5|6|7|8|9)\d{9}$/.test(t_ziti_mobile))) {
      this.setData({
        focus_mobile: true
      })
      wx.showToast({
        title: '手机号码有误',
        icon: 'none'
      })
      return false;
    }

    if (this.data.tabIdx == 2 && region[0] == '选择地址') {
      wx.showToast({
        title: '请选择所在地区',
        icon: 'none'
      })
      return false;
    }

    if (this.data.tabIdx == 2 && receiverAddress == ''){
      this.setData({
        focus_addr: true
      })
      wx.showToast({
        title: '请填写详细地址',
        icon: 'none'
      })
      return false;
    }

    if (this.data.tabIdx == 1) {
      if (tuan_send_address == '选择位置' || tuan_send_address == '') {
        wx.showToast({
          title: '请选择位置',
          icon: 'none'
        })
        return false;
      }

      if (lou_meng_hao == ''){
        wx.showToast({
          title: '输入楼号门牌',
          icon: 'none'
        })
        return false;
      }
      
    }

    if (this.data.tabIdx == 2){ this.prepay(); } else { this.conformOrder(); }
  },

  prepay: function() {
    console.log(this.canPay)
    if (this.data.is_limit_distance_buy == 1 && (this.data.tabIdx == 1)){
      wx.showModal({
        title: '提示',
        content: '离团长太远了，暂不支持下单',
        showCancel: false,
        confirmColor: '#F75451'
      })
      return false;
    }
    if(this.canPay){
      this.setData({ payBtnLoading: true })
      this.canPay = false;
      var that = this;
      let tdata = this.data;
      var token = wx.getStorageSync('token');
      var voucher_id = tdata.seller_chose_id;
      var seller_chose_store_id = tdata.seller_chose_store_id;
      var ck_yupay = tdata.ck_yupay;
      var tabIdx = tdata.tabIdx;
      var tabList = tdata.tabList;
      var dispatching = '';
      tabList.forEach(function(item){
        if (item.id == tabIdx) dispatching = item.dispatching;
      })

      var commentArr = tdata.commentArr;
      let arr = [];
      for (let key in commentArr) arr.push(commentArr[key]);
      let comment = arr.join('@EOF@');
      var receiverAddress = tdata.receiverAddress;
      var region = tdata.region;
      var t_ziti_name = tdata.ziti_name;
      var t_ziti_mobile = tdata.ziti_mobile;
      var quan_arr = [];

      if (voucher_id > 0) {
        var t_tmp = seller_chose_store_id + '_' + voucher_id;
        quan_arr.push(t_tmp);
      }

      let tuan_send_address = '';
      let tuan_region = '';
      let address_name = '';
      let province_name = '';
      let city_name = '';
      let country_name = '';

      if (tabIdx==1){
        tuan_send_address = tdata.tuan_send_address;
        tuan_region = tdata.tuan_region;
        province_name = tuan_region[0];
        city_name = tuan_region[1];
        country_name = tuan_region[2];
      } else if (tabIdx == 2) {
        address_name = receiverAddress;
        province_name = region[0];
        city_name = region[1];
        country_name = region[2];
      }

      var community = wx.getStorageSync('community');
      var community_id = community.communityId;
      var pick_up_id = community_id;

      let latitude = wx.getStorageSync('latitude2');
      let longitude = wx.getStorageSync('longitude2');

      let { use_score, buy_type } = this.data;

      wx.showLoading();
      app.util.request({
        'url': 'entry/wxapp/user',
        'data': {
          controller: 'car.sub_order',
          token: token,
          pay_method: 'wxpay',
          buy_type,
          pick_up_id,
          dispatching,
          ziti_name: t_ziti_name,
          quan_arr,
          comment,
          ziti_mobile: t_ziti_mobile,
          latitude,
          longitude,
          ck_yupay,
          tuan_send_address,
          lou_meng_hao: that.data.lou_meng_hao,
          address_name,
          province_name,
          city_name,
          country_name,
          use_score
        },
        dataType: 'json',
        method: 'POST',
        success: function (res) {
          wx.hideLoading();
          let has_yupay = res.data.has_yupay || 0;
          var order_id = res.data.order_id;
          console.log('支付日志：', res);
          if (res.data.code == 0) {
            that.changeIndexList();
            if (has_yupay == 1) {
              that.canPay = true;
              if (buy_type == "dan" || buy_type == "pindan" || buy_type == "integral") {
                if (res.data.is_go_orderlist <= 1) {
                  wx.redirectTo({
                    url: '/lionfish_comshop/pages/order/order?id=' + order_id + '&is_show=1'
                  })
                } else {
                  wx.redirectTo({
                    url: '/lionfish_comshop/pages/order/index?is_show=1'
                  })
                }
              } else {
                wx.redirectTo({
                  url: `/lionfish_comshop/moduleA/pin/share?id=${order_id}`
                })
              }
            } else {
              wx.requestPayment({
                "appId": res.data.appId,
                "timeStamp": res.data.timeStamp,
                "nonceStr": res.data.nonceStr,
                "package": res.data.package,
                "signType": res.data.signType,
                "paySign": res.data.paySign,
                'success': function (wxres) {
                  that.canPay = true;
                  if (buy_type == "dan" || buy_type == "pindan" || buy_type == "integral") {
                    if (res.data.is_go_orderlist<=1){
                      wx.redirectTo({
                        url: '/lionfish_comshop/pages/order/order?id=' + order_id + '&is_show=1'
                      })
                    } else {
                      wx.redirectTo({
                        url: '/lionfish_comshop/pages/order/index?is_show=1'
                      })
                    }
                  } else {
                    wx.redirectTo({
                      url: `/lionfish_comshop/moduleA/pin/share?id=${order_id}`
                    })
                  }
                },
                'fail': function (error) {
                  if (res.data.is_go_orderlist <= 1) {
                    wx.redirectTo({
                      url: '/lionfish_comshop/pages/order/order?id=' + order_id + '&?isfail=1'
                    })
                  } else {
                    wx.redirectTo({
                      url: '/lionfish_comshop/pages/order/index?isfail=1'
                    })
                  }
                }
              })
            }
          } else if (res.data.code == 1) {
            that.canPay = true;
            wx.showToast({
              title: '支付失败',
              icon: "none"
            });
          } else if (res.data.code == 2) {
            that.canPay = true;
            wx.showToast({
              title: res.data.msg,
              icon: "none"
            });
          }
          that.setData({ btnLoading: false, payBtnLoading:false })
        }
      })
    }
  },

  /**
   * 监听收货人
   */
  changeReceiverName: function(e) {
    var receiverName = e.detail.value.trim();
    if (receiverName) {
      this.setData({
        ziti_name: receiverName
      })
    } else {
      let tip = '请填写收货人';
      if (this.data.tabIdx == 0) tip = '请填写提货人';
      wx.showToast({
        title: tip,
        icon: "none"
      });
      this.setData({
        ziti_name: receiverName
      });
    }
    return {
      value: e.detail.value.trim()
    }
  },

  /**
   * 监听手机号
   */
  bindReceiverMobile: function(e) {
    this.setData({
      receiverMobile: e.detail.value.trim()
    });
    var mobile = e.detail.value.trim();
    this.setData({
      ziti_mobile: mobile
    });
    return {
      value: e.detail.value.trim()
    }
  },

  /**
   * 监控快递地址变化
   */
  changeReceiverAddress: function(e){
    this.setData({
      receiverAddress: e.detail.value.trim()
    });
    return {
      value: e.detail.value.trim()
    }
  },

  /**
   * 监控团长送货地址变化
   */
  changeTuanAddress: function (e) {
    this.setData({
      lou_meng_hao: e.detail.value.trim()
    });
    return {
      value: e.detail.value.trim()
    }
  },

  /**
   * 结算
   */
  conformOrder: function() {
    this.setData({
      showConfirmModal: true
    });
  },

  /**
   * 关闭结算
   */
  closeConfirmModal: function() {
    this.canPay = true;
    this.setData({
      showConfirmModal: false
    });
  },

  /**
   * 地区选择
   */
  bindRegionChange: function (e) {
    let region = e.detail.value;
    region && this.checkOut(region[1]);
    this.setData({ region })
  },

  checkOut: function (mb_city_name) {
    var that = this;
    var token = wx.getStorageSync('token');
    var community = wx.getStorageSync('community');
    var community_id = community.communityId;
    let latitude = wx.getStorageSync('latitude2');
    let longitude = wx.getStorageSync('longitude2');
    let buy_type = this.data.buy_type;

    app.util.request({
      url: 'entry/wxapp/user',
      data: {
        controller: 'car.checkout',
        token,
        community_id,
        mb_city_name,
        latitude: latitude,
        longitude: longitude,
        buy_type
      },
      dataType: 'json',
      method: 'POST',
      success: function (res) {
        if(res.data.code==1){
          let rdata = res.data;
          let { vipcard_save_money, shop_buy_distance, is_limit_distance_buy, current_distance, level_save_money } = rdata;
          if (that.data.tabIdx == 1 && is_limit_distance_buy == 1 && (current_distance > shop_buy_distance)) {
            wx.showModal({
              title: '提示',
              content: '超出配送范围，请重新选择',
              showCancel: false,
              confirmColor: '#F75451'
            })
          }

          that.setData({
            vipcard_save_money,
            level_save_money,
            is_limit_distance_buy: is_limit_distance_buy || 0,
            current_distance: current_distance || '',
            trans_free_toal: rdata.trans_free_toal,
            is_man_delivery_tuanz_fare: rdata.is_man_delivery_tuanz_fare,   //是否达到满xx减团长配送费
            fare_man_delivery_tuanz_fare_money: rdata.fare_man_delivery_tuanz_fare_money,   //达到满xx减团长配送费， 减了多少钱
            is_man_shipping_fare: rdata.is_man_shipping_fare,    //是否达到满xx减运费
            fare_man_shipping_fare_money: rdata.fare_man_shipping_fare_money   //达到满xx减运费，司机减了多少运费
          }, () => { that.calcPrice() })
        }
      }
    })
  },

  /**
   * 定位获取地址
   */
  choseLocation: function() {
    var that = this;
    wx.chooseLocation({
      success: function (e) {
        var path = e;
        var s_region = that.data.region;
        var dol_path = '';
        var str = path;
        var patt = new RegExp("(.*?省)(.*?市)(.*?区)", "g");
        var result = patt.exec(str);
        if (result == null) {
          patt = new RegExp("(.*?省)(.*?市)(.*?市)", "g");
          result = patt.exec(str);
          if (result == null) {
            patt = new RegExp("(.*?省)(.*?市)(.*县)", "g");
            result = patt.exec(str);
            if (result == null) {
            } else {
              s_region[0] = result[1];
              s_region[1] = result[2];
              s_region[2] = result[3];
              dol_path = path.replace(result[0], '');
            }
          } else {
            s_region[0] = result[1];
            s_region[1] = result[2];
            s_region[2] = result[3];
            dol_path = path.replace(result[0], '');
          }
        } else {
          s_region[0] = result[1];
          s_region[1] = result[2];
          s_region[2] = result[3];
          dol_path = path.replace(result[0], '');
        }
      
        var filename = dol_path + e.name;
        // if (s_region[0] == '省')
        let address_component = '';
        wcache.put('latitude2', e.latitude);
        wcache.put('longitude2', e.longitude);
        
        locat.getGpsLocation(e.latitude, e.longitude).then((res) => {
          console.log('反推了') 
          address_component = res;
          if (address_component) {
            s_region[0] = address_component.province;
            s_region[1] = address_component.city;
            s_region[2] = address_component.district;
          }
          setRes();
        });

        function setRes(){
          console.log('setData')
          s_region && (s_region[1] != "市") && that.checkOut(s_region[1]);
          let tuan_region = ['选择地址', '', ''];
          if (that.data.tabIdx == 1){
            console.log('选择地图后返回，tabIdx=1：'+s_region);
            tuan_region = s_region;
            that.setData({
              tuan_send_address: filename,
              tuan_region
            })
          } else {
            that.setData({
              region: s_region,
              receiverAddress: filename
            })
          }
        }
      },
      fail: function (error) {
        console.log(error)
        if (error.errMsg =='chooseLocation:fail auth deny') {
          console.log('无权限')
          locat.checkGPS(app, locat.openSetting())
          // app.globalData.canGetGPS || locat.openSetting()
        }
      }
    })
  },

  /**
   * 微信获取地址
   */
  getWxAddress: function() {
    let region = this.data.region;
    let that = this;
    wx.getSetting({
      success(res) {
        console.log("vres.authSetting['scope.address']：", res.authSetting['scope.address'])
        if (res.authSetting['scope.address']) {
          wx.chooseAddress({
            success(res) {
              console.log("step1")
              region[0] = res.provinceName || "选择地址";
              region[1] = res.cityName || "";
              region[2] = res.countyName || "";
              let receiverAddress = res.detailInfo;
              let ziti_name = res.userName;
              let ziti_mobile = res.telNumber;
              let tuan_region = that.data.tuan_region;
              if (that.data.tabIdx == 1){
                tuan_region = region;
                that.setData({
                  tuan_send_address: receiverAddress, tuan_region
                })
              } else {
                that.setData({
                  region, receiverAddress
                })
              }
              that.setData({
                ziti_name, ziti_mobile
              })
              region && (region[1] != "市") && that.checkOut(region[1]);
            },
            fail(res){
              console.log("step4")
              console.log(res)
            }
          })
        } else {
          if (res.authSetting['scope.address'] == false) {
            wx.openSetting({
              success(res) {
                console.log(res.authSetting)
              }
            })
          } else {
            console.log("step2")
            wx.chooseAddress({
              success(res) {
                console.log("step3")
                region[0] = res.provinceName || "选择地址";
                region[1] = res.cityName || "";
                region[2] = res.countyName || "";
                let receiverAddress = res.detailInfo;
                let ziti_name = res.userName;
                let ziti_mobile = res.telNumber;
                region && (region[1] != "市") && that.checkOut(region[1]);
                let tuan_region = that.data.tuan_region;
                if (that.data.tabIdx == 1) {
                  tuan_region = region;
                  that.setData({
                    tuan_send_address: receiverAddress, tuan_region
                  })
                } else {
                  that.setData({
                    region, receiverAddress
                  })
                }
                that.setData({
                  ziti_name, ziti_mobile
                })
              }
            })
          }
        }
      }
    })
  },

  /**
   * tab切换
   */
  tabSwitch: function (t) {
    let idx = 1 * t.currentTarget.dataset.idx;
    (idx != 0) && wx.showToast({ title: '配送变更，费用已变化', icon: "none"});
    this.setData({
      tabIdx: idx
    },function(){
      this.calcPrice(1);
    })
  },

  /**
   * 打开优惠券
   */
  show_voucher: function (event) {
    var that = this;
    var serller_id = event.currentTarget.dataset.seller_id;
    var voucher_list = [];
    var seller_chose_id = this.data.seller_chose_id;
    var seller_chose_store_id = this.data.seller_chose_store_id;
    var seller_goods = this.data.seller_goodss;
    for (var i in seller_goods) {
      var s_id = seller_goods[i].store_info.s_id;
      if (s_id == serller_id) {
        voucher_list = seller_goods[i].voucher_list;
        if (seller_chose_id == 0) {
          seller_chose_id = seller_goods[i].chose_vouche.id || 0;
          seller_chose_store_id = seller_goods[i].chose_vouche.store_id || 0;
        }
      }
    }
    that.setData({
      ssvoucher_list: voucher_list,
      voucher_serller_id: serller_id,
      seller_chose_id: seller_chose_id,
      seller_chose_store_id: seller_chose_store_id,
      hide_quan: false
    })
  },

  // 选择优惠券
  chose_voucher_id: function (event) { 
    wx.showLoading();
    var voucher_id = event.currentTarget.dataset.voucher_id;
    var seller_id = event.currentTarget.dataset.seller_id;
    var that = this;
    var token = wx.getStorageSync('token');
    var use_quan_str = seller_id + "_" + voucher_id;
    let latitude = wx.getStorageSync('latitude2');
    let longitude = wx.getStorageSync('longitude2');
    var buy_type = that.data.buy_type;

    var community_id = wx.getStorageSync('community').communityId || '';

    app.util.request({
      url: 'entry/wxapp/user',
      data: {
        controller: 'car.checkout',
        token,
        community_id,
        voucher_id,
        use_quan_str,
        buy_type,
        latitude,
        longitude
      },
      dataType: 'json',
      method: 'POST',
      success: function (res) {
        wx.hideLoading();
        if(res.data.code ==1){
          let seller_goodss = res.data.seller_goodss;
          let sel_chose_vouche = '';
          for (var i in seller_goodss) {
            seller_goodss[i].goodsnum = Object.keys(seller_goodss[i].goods).length;
            if (Object.prototype.toString.call(seller_goodss[i].chose_vouche) == '[object Object]') {
              sel_chose_vouche = seller_goodss[i].chose_vouche;
            }
          }
          const rdata = res.data;
          that.setData({
            seller_goodss: seller_goodss,
            seller_chose_id: voucher_id,
            seller_chose_store_id: seller_id,
            hide_quan: true,
            goods: rdata.goods,
            buy_type: rdata.buy_type || 'dan',
            yupay: rdata.can_yupay,
            is_yue_open: rdata.is_yue_open,
            total_free: rdata.total_free,
            sel_chose_vouche: sel_chose_vouche, 
            current_distance: rdata.current_distance || ''
          },()=>{
            that.calcPrice();
          })
        }
      }
    })
  },

  //关闭优惠券
  closeCouponModal: function(){
    this.setData({
      hide_quan: true
    })
  },

  /**
   * 计算总额
   */
  calcPrice: function(isTabSwitch = 0){
    let tdata = this.data;
    let { total_free, delivery_tuanz_money, trans_free_toal, tabIdx, goods } = tdata;
    total_free *= 1; //合计金额（扣除满减、优惠券，不含运费）
    delivery_tuanz_money *= 1; //配送费
    trans_free_toal *= 1; //运费

    let tot_price = 0; //计算后合计+运费
    // 商品总额
    let total_goods_price = 0;

    for (let gidx of Object.keys(goods)) {
      let item = goods[gidx];
      total_goods_price += item.total;
    }
    console.log(total_goods_price)

    let total_all = total_goods_price; //总额
    // 商品总额+配送费
    if(tabIdx==0){
      tot_price = total_free;
    } else if (tabIdx==1){
      // 满免运费
      let is_man_delivery_tuanz_fare = tdata.is_man_delivery_tuanz_fare; //是否达到满xx减团长配送费

      if (is_man_delivery_tuanz_fare==0) { 
        tot_price = delivery_tuanz_money + total_free;
      } else {
        tot_price = total_free;
      }
      total_all += delivery_tuanz_money;
    } else if(tabIdx==2) {
      // 满免运费
      let is_man_shipping_fare = tdata.is_man_shipping_fare; //是否达到满xx减运费

      total_all += trans_free_toal;
      if (is_man_shipping_fare == 0) {
        tot_price = trans_free_toal + total_free;
      } else {
        tot_price = total_free;
      }
    }

    //使用积分
    let use_score = tdata.use_score;
    if (isTabSwitch && use_score) {
      let score_for_money = tdata.score_for_money * 1;
      tot_price = tot_price - score_for_money;
    }

    let disAmount = 0; //优惠金额
    disAmount = (total_all - tot_price*1).toFixed(2);

    this.setData({
      total_all: total_all.toFixed(2),
      disAmount,
      tot_price: tot_price.toFixed(2),
      total_goods_price: total_goods_price.toFixed(2)
    })

  },

  /**
   * 订单留言 20190219
   */
  bindInputMessage: function (event) {
    let commentArr = this.data.commentArr;
    let idx = event.currentTarget.dataset.idx;
    var val = event.detail.value;
    commentArr[idx] = val;
    this.setData({ commentArr })
  },

  /**
   * 修改首页列表商品购物车数量
   */
  changeIndexList: function(){
    let goods = this.data.goods || [];
    if(goods.length>0){
      goods.forEach((item)=>{
        item.option.length == 0 && status.indexListCarCount(item.goods_id, 0);
      })
    }
  }
})