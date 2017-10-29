import {MyRouter} from './contact-us/router'

/* global jQuery Backbone */
/* eslint no-undef: "error" */

jQuery(($) => {
  /* eslint no-under: "error" */
  const router = new MyRouter()
  Backbone.history.start()
})
