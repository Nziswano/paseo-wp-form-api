const template = require('../templates/settings.hbs')
/* global jQuery PASEOFORM Backbone */
/* eslint no-undef: "error" */
jQuery(($) => {
  /*
  {settings: {…}, api: {…}}api: nonce: "8de90f6dfd"url: "http://paseo.demo/wp-json/paseo/v1/settings"__proto__: Objectsettings: captcha_enabled: truecaptcha_private_key: "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe"captcha_public_key: "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"captcha_url: "https://www.google.com/recaptcha/api/siteverify"__proto__: Object__proto__: Object
  */
  let CaptchaSetting = Backbone.Model.extend({
    urlRoot: PASEOFORM.api.url
  })

  let setting = new CaptchaSetting({
    captcha_enabled: PASEOFORM.settings.captcha_enabled,
    captcha_private_key: PASEOFORM.settings.captcha_private_key,
    captcha_public_key: PASEOFORM.settings.captcha_public_key
  })

  console.log(setting)

  let SettingView = Backbone.View.extend({
    initialize: function () {
      this.render()
    },
    render: function () {
      let self = this
      let output = self.template(self.model.attributes)
      this.$el.append(output)
      return this
    },
    template: template
  })

  let view = new SettingView({
    model: setting,
    el: '#settings-form'
  })
})
