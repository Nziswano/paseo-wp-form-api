/* global jQuery PASEOFORM Backbone */
/* eslint no-undef: "error" */
jQuery(($) => {
  let MyRouter = Backbone.Router.extend({
    routes: {'hello': 'sayHello'},
    sayHello: () => {
      console.log('Saying hello')
    }
  })

  let router = new MyRouter()

  Backbone.history.start()

  // let CaptchaSetting = Backbone.Model.extend({
  //   urlRoot: PASEOFORM.api.url
  // })

  // let setting = new CaptchaSetting({
  //   captcha_enabled: PASEOFORM.settings.captcha_enabled,
  //   captcha_private_key: PASEOFORM.settings.captcha_private_key,
  //   captcha_public_key: PASEOFORM.settings.captcha_public_key
  // })

  // let SettingView = Backbone.View.extend({
  //   initialize: function () {
  //     this.render()
  //   },
  //   render: function () {
  //     let self = this
  //     let output = self.template(self.model.attributes)
  //     this.$el.append(output)
  //     return this
  //   },
  //   template: template
  // })

  // let view = new SettingView({
  //   model: setting,
  //   el: '#settings-form'
  // })
})
