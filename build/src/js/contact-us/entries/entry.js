/* global Backbone PASEOFORM */

const Entry = Backbone.Model.extend({
  default: {
    fingerprint: 'fingerprint'
  },
  url: PASEOFORM.api.listings_url
})

const Entries = Backbone.Collection.extend({
  model: Entry,
  url: PASEOFORM.api.listings_url
})

let entry = new Entry({})

let entries = new Entries({
  model: new Entry({})
})

export {entry, entries}
