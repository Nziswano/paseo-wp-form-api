/* global Backbone PASEOFORM */

const Entry = Backbone.Model.extend({
  default: {
    id: 'id',
    fingerprint: 'fingerprint',
    contact_info: 'contact info',
    created: 'created',
    is_processed: false,
    when_processed: 'when_processed'
  },
  url: PASEOFORM.api.listings_url
})

const Entries = Backbone.Collection.extend({
  model: Entry,
  url: PASEOFORM.api.listings_url
})

let entry = new Entry({})

let entries = new Entries()

export {entry, entries}
