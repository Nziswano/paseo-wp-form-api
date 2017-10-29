const template = require('./listing.hbs')

/* global Backbone */
/* eslint no-undef: "error" */

let ListingView = Backbone.View.extend({
  initialize: function () {
    this.render()
  },
  render: function () {
    let self = this
    let output = self.template({listing: 'this is the listing site'})
    this.$el.append(output)
    return this
  },
  template: template
})

export {ListingView}
