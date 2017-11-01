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
  },
  events: {
    'click button': 'updateProcessed'
  },
  updateProcessed: function () {
    this.model.save({is_processed: 1}, {patch: true})
  }
})

let EntriesView = Backbone.View.extend({
  el: '#app',
  initialize: function () {
    this.listenTo(this.collection, 'sync', function () {
      this.render()
    })
    this.collection.fetch()
  },
  collection: entries,
  render: function () {
    this.$el.empty()
    let self = this
    self.collection.each(
      function (item) {
        let entryView = new EntryView(
          {
            model: item
          }
        )
        self.$el.append(entryView.render().el)
      }, self
    )
    return self
  }
})

export function entriesView () {
  return new EntriesView({})
}
