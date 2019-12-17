var app = getApp();
var status = require('../../../utils/index.js');

Component({
  externalClasses: ["i-class"],
  properties: {
    likeTitle: {
      type: String,
      value: '大家常买'
    }
  },

  /**
   * 组件的初始数据
   */
  data: {
    disabled: false,
    list: [],
    show_goods_guess_like: 1
  },

  attached() {
    this.getData();
  },

  /**
   * 组件的方法列表
   */
  methods: {
    getData: function () {
      var token = wx.getStorageSync('token');
      var that = this;
      var cur_community = wx.getStorageSync('community');
      app.util.request({
        'url': 'entry/wxapp/index',
        'data': {
          controller: 'signinreward.load_sign_goodslist',
          token: token,
          pageNum: 1,
          is_random: 1,
          head_id: cur_community.communityId
        },
        dataType: 'json',
        success: function (res) {
          console.log('guess', res.data)
          if (res.data.code == 0) {
            let oldList = that.data.list;
            let list = res.data.list || [];
            list = oldList.concat(list);
            let show_goods_guess_like = 1;
            that.setData({ list, show_goods_guess_like })
          } else {
            that.setData({ noMore: true })
          }
        }
      })
    },
    openSku: function (e) {
      let idx = e.currentTarget.dataset.idx;
      this.setData({ disabled: false })
      let spuItem = this.data.list[idx];
      if (spuItem.skuList.length === void 0) {
        this.triggerEvent("openSku", {
          actId: spuItem.actId,
          skuList: spuItem.skuList,
          promotionDTO: spuItem.promotionDTO || '',
          allData: {
            spuName: spuItem.spuName,
            skuImage: spuItem.skuImage,
            actPrice: spuItem.actPrice,
            canBuyNum: spuItem.spuCanBuyNum,
            stock: spuItem.spuCanBuyNum,
            marketPrice: spuItem.marketPrice
          }
        })
      } else {
        this.addCart({ value: 1, type: "plus", idx });
      }
    },
    addCart: function (t) {
      wx.showLoading();
      var token = wx.getStorageSync('token');
      var community = wx.getStorageSync('community');
      let idx = t.idx;
      let list = this.data.list;
      let spuItem = list[idx];
      var goods_id = spuItem.actId;
      var community_id = community.communityId;
      let that = this;
      if (t.type == 'plus') {
        app.util.request({
          url: 'entry/wxapp/user',
          data: {
            controller: 'car.add',
            token: token,
            goods_id: goods_id,
            community_id: community_id,
            quantity: 1,
            sku_str: '',
            buy_type: 'dan',
            pin_id: 0,
            is_just_addcar: 1,
            buy_type: 'integral'
          },
          dataType: 'json',
          method: 'POST',
          success: function (res) {
            wx.hideLoading();
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
          }
        })
      }
    }
  }
})
