const template = require('./settings.hbs')

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

export {SettingView}
