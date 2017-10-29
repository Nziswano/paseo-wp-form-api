/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ 25:
/*!***************************!*\
  !*** ./src/scss/app.scss ***!
  \***************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMjUuanMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvc2Nzcy9hcHAuc2Nzcz83ZmM0Il0sInNvdXJjZXNDb250ZW50IjpbIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luXG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9zcmMvc2Nzcy9hcHAuc2Nzc1xuLy8gbW9kdWxlIGlkID0gMjVcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQSIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///25\n");

/***/ }),

/***/ 3:
/*!*********************!*\
  !*** ./src/main.ts ***!
  \*********************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\r\nObject.defineProperty(exports, \"__esModule\", { value: true });\r\n__webpack_require__(/*! ./js/admin.js */ 4);\r\n__webpack_require__(/*! ./scss/app.scss */ 25);\r\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9zcmMvbWFpbi50cz84Y2ZlIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBcIi4vanMvYWRtaW4uanNcIjtcbmltcG9ydCBcIi4vc2Nzcy9hcHAuc2Nzc1wiO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHNyYy9tYWluLnRzIl0sIm1hcHBpbmdzIjoiOztBQUFBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///3\n");

/***/ }),

/***/ 4:
/*!*************************!*\
  !*** ./src/js/admin.js ***!
  \*************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("/* WEBPACK VAR INJECTION */(function(jQuery, Backbone) {\n\n/* global jQuery PASEOFORM Backbone */\n/* eslint no-undef: \"error\" */\njQuery(function ($) {\n  var MyRouter = Backbone.Router.extend({\n    routes: { 'hello': 'sayHello' },\n    sayHello: function sayHello() {\n      console.log('Saying hello');\n    }\n  });\n\n  var router = new MyRouter();\n\n  Backbone.history.start();\n\n  // let CaptchaSetting = Backbone.Model.extend({\n  //   urlRoot: PASEOFORM.api.url\n  // })\n\n  // let setting = new CaptchaSetting({\n  //   captcha_enabled: PASEOFORM.settings.captcha_enabled,\n  //   captcha_private_key: PASEOFORM.settings.captcha_private_key,\n  //   captcha_public_key: PASEOFORM.settings.captcha_public_key\n  // })\n\n  // let SettingView = Backbone.View.extend({\n  //   initialize: function () {\n  //     this.render()\n  //   },\n  //   render: function () {\n  //     let self = this\n  //     let output = self.template(self.model.attributes)\n  //     this.$el.append(output)\n  //     return this\n  //   },\n  //   template: template\n  // })\n\n  // let view = new SettingView({\n  //   model: setting,\n  //   el: '#settings-form'\n  // })\n});\n/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(/*! jquery */ 5), __webpack_require__(/*! backbone */ 6)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9zcmMvanMvYWRtaW4uanM/YmU3OSJdLCJzb3VyY2VzQ29udGVudCI6WyIvKiBnbG9iYWwgalF1ZXJ5IFBBU0VPRk9STSBCYWNrYm9uZSAqL1xuLyogZXNsaW50IG5vLXVuZGVmOiBcImVycm9yXCIgKi9cbmpRdWVyeSgoJCkgPT4ge1xuICBsZXQgTXlSb3V0ZXIgPSBCYWNrYm9uZS5Sb3V0ZXIuZXh0ZW5kKHtcbiAgICByb3V0ZXM6IHsnaGVsbG8nOiAnc2F5SGVsbG8nfSxcbiAgICBzYXlIZWxsbzogKCkgPT4ge1xuICAgICAgY29uc29sZS5sb2coJ1NheWluZyBoZWxsbycpXG4gICAgfVxuICB9KVxuXG4gIGxldCByb3V0ZXIgPSBuZXcgTXlSb3V0ZXIoKVxuXG4gIEJhY2tib25lLmhpc3Rvcnkuc3RhcnQoKVxuXG4gIC8vIGxldCBDYXB0Y2hhU2V0dGluZyA9IEJhY2tib25lLk1vZGVsLmV4dGVuZCh7XG4gIC8vICAgdXJsUm9vdDogUEFTRU9GT1JNLmFwaS51cmxcbiAgLy8gfSlcblxuICAvLyBsZXQgc2V0dGluZyA9IG5ldyBDYXB0Y2hhU2V0dGluZyh7XG4gIC8vICAgY2FwdGNoYV9lbmFibGVkOiBQQVNFT0ZPUk0uc2V0dGluZ3MuY2FwdGNoYV9lbmFibGVkLFxuICAvLyAgIGNhcHRjaGFfcHJpdmF0ZV9rZXk6IFBBU0VPRk9STS5zZXR0aW5ncy5jYXB0Y2hhX3ByaXZhdGVfa2V5LFxuICAvLyAgIGNhcHRjaGFfcHVibGljX2tleTogUEFTRU9GT1JNLnNldHRpbmdzLmNhcHRjaGFfcHVibGljX2tleVxuICAvLyB9KVxuXG4gIC8vIGxldCBTZXR0aW5nVmlldyA9IEJhY2tib25lLlZpZXcuZXh0ZW5kKHtcbiAgLy8gICBpbml0aWFsaXplOiBmdW5jdGlvbiAoKSB7XG4gIC8vICAgICB0aGlzLnJlbmRlcigpXG4gIC8vICAgfSxcbiAgLy8gICByZW5kZXI6IGZ1bmN0aW9uICgpIHtcbiAgLy8gICAgIGxldCBzZWxmID0gdGhpc1xuICAvLyAgICAgbGV0IG91dHB1dCA9IHNlbGYudGVtcGxhdGUoc2VsZi5tb2RlbC5hdHRyaWJ1dGVzKVxuICAvLyAgICAgdGhpcy4kZWwuYXBwZW5kKG91dHB1dClcbiAgLy8gICAgIHJldHVybiB0aGlzXG4gIC8vICAgfSxcbiAgLy8gICB0ZW1wbGF0ZTogdGVtcGxhdGVcbiAgLy8gfSlcblxuICAvLyBsZXQgdmlldyA9IG5ldyBTZXR0aW5nVmlldyh7XG4gIC8vICAgbW9kZWw6IHNldHRpbmcsXG4gIC8vICAgZWw6ICcjc2V0dGluZ3MtZm9ybSdcbiAgLy8gfSlcbn0pXG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gc3JjL2pzL2FkbWluLmpzIl0sIm1hcHBpbmdzIjoiOztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFKQTtBQUNBO0FBTUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///4\n");

/***/ }),

/***/ 5:
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

eval("module.exports = jQuery;//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9leHRlcm5hbCBcImpRdWVyeVwiPzBjYjgiXSwic291cmNlc0NvbnRlbnQiOlsibW9kdWxlLmV4cG9ydHMgPSBqUXVlcnk7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gZXh0ZXJuYWwgXCJqUXVlcnlcIlxuLy8gbW9kdWxlIGlkID0gNVxuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///5\n");

/***/ }),

/***/ 6:
/*!***************************!*\
  !*** external "Backbone" ***!
  \***************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

eval("module.exports = Backbone;//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9leHRlcm5hbCBcIkJhY2tib25lXCI/NzA5ZCJdLCJzb3VyY2VzQ29udGVudCI6WyJtb2R1bGUuZXhwb3J0cyA9IEJhY2tib25lO1xuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIGV4dGVybmFsIFwiQmFja2JvbmVcIlxuLy8gbW9kdWxlIGlkID0gNlxuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///6\n");

/***/ })

/******/ });