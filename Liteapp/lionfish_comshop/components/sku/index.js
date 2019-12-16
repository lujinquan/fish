var a = require("../../utils/public"), app = getApp();

Component({
  properties: {
    visible: {
      type: Boolean,
      value: false,
      observer: function (t) {
        t && this.setData({
          value: 1,
          loading: false
        })
      }
    },
    cur_sku_arr: {
      type: Object,
      value: {}
    },
    skuList: {
      type: Object,
      value: {}
    },
    sku_val: {
      type: Number,
      value: 1
    },
    sku: {
      type: Array,
      value: []
    },
    goodsid: {
      type: Number,
      value: 0
    },
    type: {
      type: Number,
      value: 0
    },
    buyType: {
      type: String,
      value: ''
    }
  },
  focusFlag: false,
  data: {
    value: 1,
    loading: false
  },
  methods: {
    close: function () {
      this.triggerEvent("cancel");
    },
    selectSku: function (event) {
      var that = this;
      let str = event.currentTarget.dataset.type;
      let obj = str.split("_");
      let arr = that.data.sku;
      let temp = {
        name: obj[3],
        id: obj[2],
        index: obj[0],
        idx: obj[1]
      };
      arr.splice(obj[0], 1, temp);
      var id = '';
      for (let i = 0; i < arr.length; i++) {
        if (i == arr.length - 1) {
          id = id + arr[i]['id'];
        } else {
          id = id + arr[i]['id'] + "_";
        }
      }
      var options = this.data.skuList;
      var cur_sku_arr = options.sku_mu_list[id];

      that.setData({
        cur_sku_arr: cur_sku_arr,
        sku: arr
      })
    },

    /**
     * 数量加减
    */
    setNum: function (event) {
      let types = event.currentTarget.dataset.type;
      var that = this;
      var num = 1;
      let sku_val = this.data.sku_val * 1;
      if (types == 'add') {
        num = sku_val + 1;
      } else if (types == 'decrease') {
        if (sku_val > 1) {
          num = sku_val - 1;
        }
      }

      let arr = that.data.sku;
      var options = this.data.skuList;

      if (arr.length > 0) {
        var id = '';
        for (let i = 0; i < arr.length; i++) {
          if (i == arr.length - 1) {
            id = id + arr[i]['id'];
          } else {
            id = id + arr[i]['id'] + "_";
          }
        }
      }

      if (options.length > 0) {
        let cur_sku_arr = options.sku_mu_list[id];
        if (num > cur_sku_arr['canBuyNum']) {
          num = num - 1;
        }
      } else {
        let cur_sku_arr = this.data.cur_sku_arr;
        if (num > cur_sku_arr['canBuyNum']) {
          num = num - 1;
        }
      }
      this.setData({
        sku_val: num
      })
    },

    gocarfrom: function (e) {
      var that = this;
      var is_just_addcar = 1;
      wx.showLoading();
      a.collectFormIds(e.detail.formId);
      that.goOrder();
    },

    goOrder: function () {
      let that = this;
      let tdata = that.data;
      if (tdata.can_car) tdata.can_car = false;

      var token = wx.getStorageSync('token');
      var community = wx.getStorageSync('community');
      var community_id = community.communityId;

      var goods_id = tdata.goodsid;
      console.log('goods_id', goods_id)
      var quantity = tdata.sku_val;
      var cur_sku_arr = tdata.cur_sku_arr;

      var sku_str = '';
      var is_just_addcar = 1;
      if (cur_sku_arr && cur_sku_arr.option_item_ids) sku_str = cur_sku_arr.option_item_ids;

      let buy_type = this.data.buyType ? this.data.buyType: 'dan';

      app.util.request({
        'url': 'entry/wxapp/user',
        'data': {
          controller: 'car.add',
          token,
          goods_id,
          community_id,
          quantity,
          sku_str,
          buy_type,
          pin_id: 0,
          is_just_addcar
        },
        dataType: 'json',
        method: 'POST',
        success: function (res) {
          if (buy_type =='integral'){
            if (res.data.code == 3) {
              wx.showToast({
                title: res.data.msg,
                icon: 'none',
                duration: 2000
              })
            } else if (res.data.code == 6) {
              // 积分不足
              var msg = res.data.msg;
              wx.showToast({
                title: msg,
                icon: 'none',
                duration: 2000
              })
            } else {
              //跳转结算页面
              wx.navigateTo({
                url: `/lionfish_comshop/pages/order/placeOrder?type=integral`,
              })
            }
          } else {
            if (res.data.code == 3) {
              wx.showToast({
                title: res.data.msg,
                icon: 'none',
                duration: 2000
              })
            } else if (res.data.code == 4) {
              wx.showToast({
                title: '您未登录',
                duration: 2000,
                success: () => {
                  that.setData({
                    needAuth: true
                  })
                }
              })
            } else if (res.data.code == 6) {
              let max_quantity = res.data.max_quantity || '';
              (max_quantity > 0) && that.setData({
                sku_val: max_quantity
              })
              var msg = res.data.msg;
              wx.showToast({
                title: msg,
                icon: 'none',
                duration: 2000
              })
            } else {
              if (is_just_addcar == 1) {
                that.close();
                wx.hideLoading();
                res.data.total && that.triggerEvent("changeCartNum", res.data.total);
                wx.showToast({
                  title: "已加入购物车",
                  image: "../../images/addShopCart.png"
                })
              } else {
                var pages_all = getCurrentPages();
                if (pages_all.length > 3) {
                  wx.redirectTo({
                    url: '/lionfish_comshop/pages/buy/index?type=' + tdata.order.buy_type
                  })
                } else {
                  wx.navigateTo({
                    url: '/lionfish_comshop/pages/buy/index?type=' + tdata.order.buy_type
                  })
                }
              }
            }
          }
        }
      })
    },

    // 输入框获得焦点
    handleFocus: function () {
      this.focusFlag = true;
    },

    handleBlur: function (t) {
      let a = t.detail;
      let val = parseInt(a.value);
      if (val == '' || isNaN(val)) {
        this.setData({ sku_val: 1 })
      }
    },

    // 监控输入框变化
    changeNumber: function (t) {
      let { cur_sku_arr, sku_val } = this.data;
      let max = cur_sku_arr.stock * 1;
      let a = t.detail;
      this.focusFlag = false;
      if (a) {
        let val = parseInt(a.value);
        val = val < 1 ? 1 : val;
        if (val > max) {
          wx.showToast({
            title: `最多只能购买${max}件`,
            icon: 'none'
          })
          sku_val = max;
        } else {
          sku_val = val;
        }
      }
      this.setData({ sku_val })
    }
  }
});