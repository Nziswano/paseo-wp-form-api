/* global Backbone */
import {entry} from './model'
const template = require('./listing.hbs')

const SiteView = Backbone.View.extend({
  initialize: function () {
    this.render()
  }
})

export function entries () {
  let view = new SiteView({
    template: template,
    model: entry,
    el: '#app',
    render: function () {
      let self = this
      let output = self.template(self.model)
      this.$el.append(output)
      return self
    }
  })
  console.log('entries view')
  return view
}
