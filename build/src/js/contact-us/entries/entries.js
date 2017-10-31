/* global Backbone */

const template = require('./listing.hbs')

const Entry = Backbone.Model.extend({
  default: {
    listing: 'this is a listing'
  }
})

let entry = new Entry({
  listing: 'This is a test message'
})

const View = Backbone.View.extend({
  el: '#app',
  initialize: function () {
    this.render()
  },
  template: template,
  render: function () {
    'use strict'
    let output = this.template(this.model.attributes)
    this.$el.html(output)
    return this
  }
})

export function view () {
  let view = new View({
    model: entry
  }
  )
  return view
}
