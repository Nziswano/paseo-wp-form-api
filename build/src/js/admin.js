import {MyRouter} from './contact-us/router'

/* global jQuery Backbone */

jQuery(($) => {
  const router = new MyRouter() // eslint-disable-line no-unused-vars
  Backbone.history.start()
})
