/* ===================================================
 * bootstrap-transition.js v2.0.0
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 * ===================================================
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
 * ========================================================== */!function(e){e(function(){"use strict";e.support.transition=function(){var t=document.body||document.documentElement,n=t.style,r=n.transition!==undefined||n.WebkitTransition!==undefined||n.MozTransition!==undefined||n.MsTransition!==undefined||n.OTransition!==undefined;return r&&{end:function(){var t="TransitionEnd";e.browser.webkit?t="webkitTransitionEnd":e.browser.mozilla?t="transitionend":e.browser.opera&&(t="oTransitionEnd");return t}()}}()})}(window.jQuery);