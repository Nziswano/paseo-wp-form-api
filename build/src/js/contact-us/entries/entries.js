/* global Backbone */

import {entries} from './entry'

const template = require('./listing.hbs')

const EntryView = Backbone.View.extend({
  tagName: 'li',
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

let EntriesView = Backbone.View.extend({
  el: '#app',
  initialize: function () {
    console.log('initialized')
    this.listenTo(this.collection, 'sync', function () {
      this.render()
    })
    this.collection.fetch()
    console.log('initialized finished')
  },
  collection: entries,
  render: function () {
    let self = this
    self.collection.each(
      function (item) {
        let entryView = new EntryView(
          {
            model: item
          }
        )
        console.log('Entry: ', item.attributes)
        self.$el.append(entryView.render().el)
      }, self
    )
  }
})

export function entriesView () {
  return new EntriesView({})
}
