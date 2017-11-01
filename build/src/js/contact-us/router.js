/* global Backbone */
/* eslint no-undef: "error" */
import {settings} from './settings/settings'
import {entriesView} from './entries/entries'

let MyRouter = Backbone.Router.extend({
  routes: {
    'listing': 'Listing',
    'setting': 'Settings',
    '': 'Listing',
    '*default': 'Listing'
  },
  Settings: () => {
    settings()
  },
  Listing: () => {
    entriesView()
  }
})

export {MyRouter}
