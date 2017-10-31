/* global Backbone */
/* eslint no-undef: "error" */
import {settings} from './settings/settings'
import {view} from './entries/entries'

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
    view()
  }
})

export {MyRouter}
