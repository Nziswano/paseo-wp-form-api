/* global Backbone PASEOFORM $ */

const template = require('./settings.hbs')

const Setting = Backbone.Model.extend({
  default: {
    captcha_enabled: '',
    captcha_private_key: '',
    captcha_public_key: ''
  },
  url: PASEOFORM.api.settings_url
})

let setting = new Setting({
  captcha_enabled: PASEOFORM.settings.captcha_enabled,
  captcha_private_key: PASEOFORM.settings.captcha_private_key,
  captcha_public_key: PASEOFORM.settings.captcha_public_key,
  captcha_url: PASEOFORM.settings.captcha_url
})

const View = Backbone.View.extend({

  initialize: function () {
    this.render()
  },

  model: setting,

  events: {
    'click button.settings': 'saveForm',
    'change': 'itemChange'
  },

  saveForm: function (evt) {
    evt.preventDefault()
    this.model.save(this.model.attributes,
      {
        success: this.saveSuccess,
        error: function () {
          console.log('error when saving')
        }
      })
  },

  itemChange: function (evt) {
    let target = evt.target
    let value = target.value
    if (target.name === 'captcha_enabled') {
      let selected = $(target).is(':checked')
      value = selected
    }
    this.model.set(target.name, value)
  },
  saveSuccess: function (e) {
    console.log('saved', e)
  },

  el: '#app',

  template: template,

  render: function () {
    'use strict'
    this.$el.empty()
    let output = this.template(this.model.attributes)
    this.$el.html(output)
    return this
  }

})

export function settings () {
  let view = new View({})
  return view
}
