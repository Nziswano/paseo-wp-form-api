import {MyRouter} from './contact-us/router'

/* global jQuery Backbone */
/* eslint no-undef: "error" */

jQuery(($) => {
  const router = new MyRouter()
  Backbone.history.start()
  console.log(router)
})
