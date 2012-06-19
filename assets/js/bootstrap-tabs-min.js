/* ========================================================
 * bootstrap-tabs.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#tabs
 * ========================================================
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
 * ======================================================== */!function(e){"use strict";function t(e,t){t.find("> .active").removeClass("active").find("> .dropdown-menu > .active").removeClass("active");e.addClass("active");e.parent(".dropdown-menu")&&e.closest("li.dropdown").addClass("active")}function n(n){var r=e(this),i=r.closest("ul:not(.dropdown-menu)"),s=r.attr("href"),o,u;if(/^#\w+/.test(s)){n.preventDefault();if(r.parent("li").hasClass("active"))return;o=i.find(".active a").last()[0];u=e(s);t(r.parent("li"),i);t(u,u.parent());r.trigger({type:"change",relatedTarget:o})}}e.fn.tabs=e.fn.pills=function(t){return this.each(function(){e(this).delegate(t||".tabs li > a, .pills > li > a","click",n)})};e(document).ready(function(){e("body").tabs("ul[data-tabs] li > a, ul[data-pills] > li > a")})}(window.jQuery||window.ender);