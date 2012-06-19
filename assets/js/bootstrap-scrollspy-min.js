/* =============================================================
 * bootstrap-scrollspy.js v2.0.0
 * http://twitter.github.com/bootstrap/javascript.html#scrollspy
 * =============================================================
 * Copyright 2012 Twitter, Inc.
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
 * ============================================================== */!function(e){"use strict";function t(t,n){var r=e.proxy(this.process,this),i=e(t).is("body")?e(window):e(t),s;this.options=e.extend({},e.fn.scrollspy.defaults,n);this.$scrollElement=i.on("scroll.scroll.data-api",r);this.selector=(this.options.target||(s=e(t).attr("href"))&&s.replace(/.*(?=#[^\s]+$)/,"")||"")+" .nav li > a";this.$body=e("body").on("click.scroll.data-api",this.selector,r);this.refresh();this.process()}t.prototype={constructor:t,refresh:function(){this.targets=this.$body.find(this.selector).map(function(){var t=e(this).attr("href");return/^#\w/.test(t)&&e(t).length?t:null});this.offsets=e.map(this.targets,function(t){return e(t).position().top})},process:function(){var e=this.$scrollElement.scrollTop()+this.options.offset,t=this.offsets,n=this.targets,r=this.activeTarget,i;for(i=t.length;i--;)r!=n[i]&&e>=t[i]&&(!t[i+1]||e<=t[i+1])&&this.activate(n[i])},activate:function(e){var t;this.activeTarget=e;this.$body.find(this.selector).parent(".active").removeClass("active");t=this.$body.find(this.selector+'[href="'+e+'"]').parent("li").addClass("active");t.parent(".dropdown-menu")&&t.closest("li.dropdown").addClass("active")}};e.fn.scrollspy=function(n){return this.each(function(){var r=e(this),i=r.data("scrollspy"),s=typeof n=="object"&&n;i||r.data("scrollspy",i=new t(this,s));typeof n=="string"&&i[n]()})};e.fn.scrollspy.Constructor=t;e.fn.scrollspy.defaults={offset:10};e(function(){e('[data-spy="scroll"]').each(function(){var t=e(this);t.scrollspy(t.data())})})}(window.jQuery);