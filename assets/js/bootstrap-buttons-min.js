/* ============================================================
 * bootstrap-buttons.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#buttons
 * ============================================================
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
 * ============================================================ */!function(e){"use strict";function t(t,n){var r="disabled",i=e(t),s=i.data();n+="Text";s.resetText||i.data("resetText",i.html());i.html(s[n]||e.fn.button.defaults[n]);setTimeout(function(){n=="loadingText"?i.addClass(r).attr(r,r):i.removeClass(r).removeAttr(r)},0)}function n(t){e(t).toggleClass("active")}e.fn.button=function(e){return this.each(function(){if(e=="toggle")return n(this);e&&t(this,e)})};e.fn.button.defaults={loadingText:"loading..."};e(function(){e("body").delegate(".btn[data-toggle]","click",function(){e(this).button("toggle")})})}(window.jQuery||window.ender);