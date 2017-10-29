/* global PASEOFORM Backbone */
/* eslint no-undef: "error" */

let CaptchaSetting = Backbone.Model.extend({
  urlRoot: PASEOFORM.api.url
})

let setting = new CaptchaSetting({
  captcha_enabled: PASEOFORM.settings.captcha_enabled,
  captcha_private_key: PASEOFORM.settings.captcha_private_key,
  captcha_public_key: PASEOFORM.settings.captcha_public_key
})

export {setting}
