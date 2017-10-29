const template = require('./settings.hbs')

/* global Backbone */
/* eslint no-undef: "error" */

let SettingView = Backbone.View.extend({
  initialize: function () {
    this.render()
  },
  template: template
})

export {SettingView}
