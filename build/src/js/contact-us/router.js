/* global Backbone */
/* eslint no-undef: "error" */
import {settings} from './settings/settings'

let MyRouter = Backbone.Router.extend({
  routes: {
    '': 'Listing',
    'setting': 'Settings'
  },
  Settings: () => {
    settings()
  },
  Listing: () => {
    console.log('Main listing')
  }
})

export {MyRouter}
