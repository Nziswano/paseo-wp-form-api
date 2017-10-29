/* global Backbone */
/* eslint no-undef: "error" */
import {settings} from './settings/settings'
import {entries} from './entries/listing'

let MyRouter = Backbone.Router.extend({
  routes: {
    '': 'Listing',
    'setting': 'Settings'
  },
  Settings: () => {
    settings()
  },
  Listing: () => {
    entries()
  }
})

export {MyRouter}
