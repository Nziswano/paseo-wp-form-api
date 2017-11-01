/* global Backbone */

import {entries} from './entry'
import table from './list'

const template = require('./listing.hbs')

const EntryView = Backbone.View.extend({
  tagName: 'tr',
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
    this.model.save({is_processed: 1})
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
    let output = $(table)
    self.collection.each(
      function (item) {
        let entryView = new EntryView(
          {
            model: item
          }
        )
        output.append(entryView.render().el)
      }, self
    )
    self.$el.html(output)
    return self
  }
})

export function entriesView () {
  return new EntriesView({})
}
