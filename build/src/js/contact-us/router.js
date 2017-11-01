/* global Backbone */
/* eslint no-undef: "error" */
import {settings} from './settings/settings'
import {entriesView} from './entries/entries'

let MyRouter = Backbone.Router.extend({
  routes: {
    'set': 'Settings',
    'list': 'Listing',
    '': 'Listing',
    '*default': 'Listing'
  },
  Settings: () => {
    console.log('settings')
    settings()
  },
  Listing: () => {
    console.log('listing')
    entriesView()
  }
})

export {MyRouter}
