/* ==========================================================
 * bootstrap-alerts.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#alerts
 * ==========================================================
 * Copyright 2011 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */!function(e){"use strict";var t;e(document).ready(function(){e.support.transition=function(){var e=document.body||document.documentElement,t=e.style,n=t.transition!==undefined||t.WebkitTransition!==undefined||t.MozTransition!==undefined||t.MsTransition!==undefined||t.OTransition!==undefined;return n}();if(e.support.transition){t="TransitionEnd";e.browser.webkit?t="webkitTransitionEnd":e.browser.mozilla?t="transitionend":e.browser.opera&&(t="oTransitionEnd")}});var n=function(t,n){if(n=="close")return this.close.call(t);this.settings=e.extend({},e.fn.alert.defaults,n);this.$element=e(t).delegate(this.settings.selector,"click",this.close)};n.prototype={close:function(n){function s(){r.remove()}var r=e(this),i="alert-message";r=r.hasClass(i)?r:r.parent();n&&n.preventDefault();r.removeClass("in");e.support.transition&&r.hasClass("fade")?r.bind(t,s):s()}};e.fn.alert=function(t){return t===!0?this.data("alert"):this.each(function(){var r=e(this),i;if(typeof t=="string"){i=r.data("alert");if(typeof i=="object")return i[t].call(r)}e(this).data("alert",new n(this,t))})};e.fn.alert.defaults={selector:".close"};e(document).ready(function(){new n(e("body"),{selector:".alert-message[data-alert] .close"})})}(window.jQuery||window.ender);