/* global Backbone PASEOFORM */

const template = require('./settings.hbs')

const Setting = Backbone.Model.extend({
  default: {
    captcha_enabled: '',
    captcha_private_key: '',
    captcha_public_key: ''
  },
  url: PASEOFORM.api.url
})

let setting = new Setting({
  captcha_enabled: PASEOFORM.settings.captcha_enabled,
  captcha_private_key: PASEOFORM.settings.captcha_private_key,
  captcha_public_key: PASEOFORM.settings.captcha_public_key
})

const View = Backbone.View.extend({

  initialize: function () {
    this.render()
  },

  el: '#app',
  template: template,

  render: function () {
    'use strict'
    console.log('setting render')
    let output = this.template(this.model.attributes)
    this.$el.html(output)
    return this
  }

})

export function settings () {
  let view = new View({
    model: setting
  })

  return view
}
