const template = require('../templates/settings.hbs')

/* global Backbone */
/* eslint no-undef: "error" */

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
