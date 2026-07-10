
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>STIL | Page not found</title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" href="<?php echo base_url();?>assets/images/logo.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

<style media="screen">
body {
font-family: "Roboto", sans-serif;
font-size: 16px;
background: #099245;
color: #666;
margin: 0;
}
a {
color: #fff;
text-decoration: none;
-webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
ul {
margin: 0;
padding: 0;
list-style: none;
}

img {
display: block;
width: 100%;
}

.container {
position: relative;
max-width: 800px;
margin: 0 auto 5%;
padding: 5%;
text-align: center;
color: #fff;
}
.container h1 {
font-weight: normal;
font-size: 24px;
margin-bottom: 2em;
}
.container a.btn {
border: 3px solid #fff;
border-radius: 2px;
padding: 10px 30px;
color: #fff;
text-transform: uppercase;
text-decoration: none;
display: inline-block;
}
.container a.btn.search {
border-radius: 0px 2px 2px 0;
}
.container a.btn:hover {
background-color: #fff;
color: #d88705;
}
input[type="text"] {
border: 3px solid #fff;
border-right: none;
border-radius: 2px 0 0 2px;
padding: 10px 30px;
color: #fff;
background-color: transparent;
display: inline-block;
outline: none;
font-size: inherit;
font-family: inherit;
}
.scene {
padding: 0;
margin: 0;
}

/* DD Bottom Bar */
.dd-bar {
position: fixed;
bottom: 0;
left: 0;
width: 100%;
padding: 15px;
background-color: rgba(0, 0, 0, 0.3);
text-align: center;
}
.dd-bar ul {
padding: 0 4%;
}
.dd-bar ul li {
display: inline-block;
padding: 0 10px;
font-size: 14px;
}
.dd-bar ul li a {
opacity: 0.6;
}
.dd-bar ul li a:hover {
opacity: 1;
}

@media only screen and (max-width: 480px), only screen and (max-width: 480px) {
input[type="text"] {
    width: 50%;
    padding: 10px;
}

.container a.btn {
  padding: 10px 20px;
}

.container span {
  display: block;
  margin: 10px 0;
}
}
</style>
</head>
<body>
<div id="container" class="container">
<ul id="scene" class="scene">
<li class="layer" data-depth="1.00"><img src="<?php echo base_url();?>assets/images/404-monster/404-01.png"></li>
<li class="layer" data-depth="0.60"><img src="<?php echo base_url();?>assets/images/404-monster/shadows-01.png"></li>
<li class="layer" data-depth="0.20"><img src="<?php echo base_url();?>assets/images/404-monster/monster-01.png"></li>
<li class="layer" data-depth="0.40"><img src="<?php echo base_url();?>assets/images/404-monster/text-01.png"></li>
<li class="layer" data-depth="0.10"><img src="<?php echo base_url();?>assets/images/404-monster/monster-eyes-01.png"></li>
</ul>
<h1>Maaf, link yang Anda buka tidak valid.</h1>
<a href="<?php echo base_url();?>" class="btn search">Kembali ke Halaman Utama</a>
<span>&nbsp;&nbsp;atau&nbsp;&nbsp;</span>
<a href="<?php echo base_url();?>contact" class="btn">Hubungi Kami</a>
</div>

<script type="47645cc74a22243371ba8848-text/javascript">
//============================================================
//
// The MIT License
//
// Copyright (C) 2014 Matthew Wagerfield - @wagerfield
//
// Permission is hereby granted, free of charge, to any
// person obtaining a copy of this software and associated
// documentation files (the "Software"), to deal in the
// Software without restriction, including without limitation
// the rights to use, copy, modify, merge, publish, distribute,
// sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do
// so, subject to the following conditions:
//
// The above copyright notice and this permission notice
// shall be included in all copies or substantial portions
// of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
// OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
// LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
// FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO
// EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
// FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
// AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE
// OR OTHER DEALINGS IN THE SOFTWARE.
//
//============================================================

/**
 * Parallax.js
 * @author Matthew Wagerfield - @wagerfield
 * @description Creates a parallax effect between an array of layers,
 *              driving the motion from the gyroscope output of a smartdevice.
 *              If no gyroscope is available, the cursor position is used.
 */
;(function(window, document, undefined) {

  // Strict Mode
  'use strict';

  // Constants
  var NAME = 'Parallax';
  var MAGIC_NUMBER = 30;
  var DEFAULTS = {
    relativeInput: false,
    clipRelativeInput: false,
    calibrationThreshold: 100,
    calibrationDelay: 500,
    supportDelay: 500,
    calibrateX: false,
    calibrateY: true,
    invertX: true,
    invertY: true,
    limitX: false,
    limitY: false,
    scalarX: 10.0,
    scalarY: 10.0,
    frictionX: 0.1,
    frictionY: 0.1,
    originX: 0.5,
    originY: 0.5
  };

  function Parallax(element, options) {

    // DOM Context
    this.element = element;
    this.layers = element.getElementsByClassName('layer');

    // Data Extraction
    var data = {
      calibrateX: this.data(this.element, 'calibrate-x'),
      calibrateY: this.data(this.element, 'calibrate-y'),
      invertX: this.data(this.element, 'invert-x'),
      invertY: this.data(this.element, 'invert-y'),
      limitX: this.data(this.element, 'limit-x'),
      limitY: this.data(this.element, 'limit-y'),
      scalarX: this.data(this.element, 'scalar-x'),
      scalarY: this.data(this.element, 'scalar-y'),
      frictionX: this.data(this.element, 'friction-x'),
      frictionY: this.data(this.element, 'friction-y'),
      originX: this.data(this.element, 'origin-x'),
      originY: this.data(this.element, 'origin-y')
    };

    // Delete Null Data Values
    for (var key in data) {
      if (data[key] === null) delete data[key];
    }

    // Compose Settings Object
    this.extend(this, DEFAULTS, options, data);

    // States
    this.calibrationTimer = null;
    this.calibrationFlag = true;
    this.enabled = false;
    this.depths = [];
    this.raf = null;

    // Element Bounds
    this.bounds = null;
    this.ex = 0;
    this.ey = 0;
    this.ew = 0;
    this.eh = 0;

    // Element Center
    this.ecx = 0;
    this.ecy = 0;

    // Element Range
    this.erx = 0;
    this.ery = 0;

    // Calibration
    this.cx = 0;
    this.cy = 0;

    // Input
    this.ix = 0;
    this.iy = 0;

    // Motion
    this.mx = 0;
    this.my = 0;

    // Velocity
    this.vx = 0;
    this.vy = 0;

    // Callbacks
    this.onMouseMove = this.onMouseMove.bind(this);
    this.onDeviceOrientation = this.onDeviceOrientation.bind(this);
    this.onOrientationTimer = this.onOrientationTimer.bind(this);
    this.onCalibrationTimer = this.onCalibrationTimer.bind(this);
    this.onAnimationFrame = this.onAnimationFrame.bind(this);
    this.onWindowResize = this.onWindowResize.bind(this);

    // Initialise
    this.initialise();
  }

  Parallax.prototype.extend = function() {
    if (arguments.length > 1) {
      var master = arguments[0];
      for (var i = 1, l = arguments.length; i < l; i++) {
        var object = arguments[i];
        for (var key in object) {
          master[key] = object[key];
        }
      }
    }
  };

  Parallax.prototype.data = function(element, name) {
    return this.deserialize(element.getAttribute('data-'+name));
  };

  Parallax.prototype.deserialize = function(value) {
    if (value === "true") {
      return true;
    } else if (value === "false") {
      return false;
    } else if (value === "null") {
      return null;
    } else if (!isNaN(parseFloat(value)) && isFinite(value)) {
      return parseFloat(value);
    } else {
      return value;
    }
  };

  Parallax.prototype.camelCase = function(value) {
    return value.replace(/-+(.)?/g, function(match, character){
      return character ? character.toUpperCase() : '';
    });
  };

  Parallax.prototype.transformSupport = function(value) {
    var element = document.createElement('div');
    var propertySupport = false;
    var propertyValue = null;
    var featureSupport = false;
    var cssProperty = null;
    var jsProperty = null;
    for (var i = 0, l = this.vendors.length; i < l; i++) {
      if (this.vendors[i] !== null) {
        cssProperty = this.vendors[i][0] + 'transform';
        jsProperty = this.vendors[i][1] + 'Transform';
      } else {
        cssProperty = 'transform';
        jsProperty = 'transform';
      }
      if (element.style[jsProperty] !== undefined) {
        propertySupport = true;
        break;
      }
    }
    switch(value) {
      case '2D':
        featureSupport = propertySupport;
        break;
      case '3D':
        if (propertySupport) {
          var body = document.body || document.createElement('body');
          var documentElement = document.documentElement;
          var documentOverflow = documentElement.style.overflow;
          if (!document.body) {
            documentElement.style.overflow = 'hidden';
            documentElement.appendChild(body);
            body.style.overflow = 'hidden';
            body.style.background = '';
          }
          body.appendChild(element);
          element.style[jsProperty] = 'translate3d(1px,1px,1px)';
          propertyValue = window.getComputedStyle(element).getPropertyValue(cssProperty);
          featureSupport = propertyValue !== undefined && propertyValue.length > 0 && propertyValue !== "none";
          documentElement.style.overflow = documentOverflow;
          body.removeChild(element);
        }
        break;
    }
    return featureSupport;
  };

  Parallax.prototype.ww = null;
  Parallax.prototype.wh = null;
  Parallax.prototype.wcx = null;
  Parallax.prototype.wcy = null;
  Parallax.prototype.wrx = null;
  Parallax.prototype.wry = null;
  Parallax.prototype.portrait = null;
  Parallax.prototype.desktop = !navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i);
  Parallax.prototype.vendors = [null,['-webkit-','webkit'],['-moz-','Moz'],['-o-','O'],['-ms-','ms']];
  Parallax.prototype.motionSupport = !!window.DeviceMotionEvent;
  Parallax.prototype.orientationSupport = !!window.DeviceOrientationEvent;
  Parallax.prototype.orientationStatus = 0;
  Parallax.prototype.transform2DSupport = Parallax.prototype.transformSupport('2D');
  Parallax.prototype.transform3DSupport = Parallax.prototype.transformSupport('3D');
  Parallax.prototype.propertyCache = {};

  Parallax.prototype.initialise = function() {

    // Configure Context Styles
    if (this.transform3DSupport) this.accelerate(this.element);
    var style = window.getComputedStyle(this.element);
    if (style.getPropertyValue('position') === 'static') {
      this.element.style.position = 'relative';
    }

    // Setup
    this.updateLayers();
    this.updateDimensions();
    this.enable();
    this.queueCalibration(this.calibrationDelay);
  };

  Parallax.prototype.updateLayers = function() {

    // Cache Layer Elements
    this.layers = this.element.getElementsByClassName('layer');
    this.depths = [];

    // Configure Layer Styles
    for (var i = 0, l = this.layers.length; i < l; i++) {
      var layer = this.layers[i];
      if (this.transform3DSupport) this.accelerate(layer);
      layer.style.position = i ? 'absolute' : 'relative';
      layer.style.display = 'block';
      layer.style.left = 0;
      layer.style.top = 0;

      // Cache Layer Depth
      this.depths.push(this.data(layer, 'depth') || 0);
    }
  };

  Parallax.prototype.updateDimensions = function() {
    this.ww = window.innerWidth;
    this.wh = window.innerHeight;
    this.wcx = this.ww * this.originX;
    this.wcy = this.wh * this.originY;
    this.wrx = Math.max(this.wcx, this.ww - this.wcx);
    this.wry = Math.max(this.wcy, this.wh - this.wcy);
  };

  Parallax.prototype.updateBounds = function() {
    this.bounds = this.element.getBoundingClientRect();
    this.ex = this.bounds.left;
    this.ey = this.bounds.top;
    this.ew = this.bounds.width;
    this.eh = this.bounds.height;
    this.ecx = this.ew * this.originX;
    this.ecy = this.eh * this.originY;
    this.erx = Math.max(this.ecx, this.ew - this.ecx);
    this.ery = Math.max(this.ecy, this.eh - this.ecy);
  };

  Parallax.prototype.queueCalibration = function(delay) {
    clearTimeout(this.calibrationTimer);
    this.calibrationTimer = setTimeout(this.onCalibrationTimer, delay);
  };

  Parallax.prototype.enable = function() {
    if (!this.enabled) {
      this.enabled = true;
      if (this.orientationSupport) {
        this.portrait = null;
        window.addEventListener('deviceorientation', this.onDeviceOrientation);
        setTimeout(this.onOrientationTimer, this.supportDelay);
      } else {
        this.cx = 0;
        this.cy = 0;
        this.portrait = false;
        window.addEventListener('mousemove', this.onMouseMove);
      }
      window.addEventListener('resize', this.onWindowResize);
      this.raf = requestAnimationFrame(this.onAnimationFrame);
    }
  };

  Parallax.prototype.disable = function() {
    if (this.enabled) {
      this.enabled = false;
      if (this.orientationSupport) {
        window.removeEventListener('deviceorientation', this.onDeviceOrientation);
      } else {
        window.removeEventListener('mousemove', this.onMouseMove);
      }
      window.removeEventListener('resize', this.onWindowResize);
      cancelAnimationFrame(this.raf);
    }
  };

  Parallax.prototype.calibrate = function(x, y) {
    this.calibrateX = x === undefined ? this.calibrateX : x;
    this.calibrateY = y === undefined ? this.calibrateY : y;
  };

  Parallax.prototype.invert = function(x, y) {
    this.invertX = x === undefined ? this.invertX : x;
    this.invertY = y === undefined ? this.invertY : y;
  };

  Parallax.prototype.friction = function(x, y) {
    this.frictionX = x === undefined ? this.frictionX : x;
    this.frictionY = y === undefined ? this.frictionY : y;
  };

  Parallax.prototype.scalar = function(x, y) {
    this.scalarX = x === undefined ? this.scalarX : x;
    this.scalarY = y === undefined ? this.scalarY : y;
  };

  Parallax.prototype.limit = function(x, y) {
    this.limitX = x === undefined ? this.limitX : x;
    this.limitY = y === undefined ? this.limitY : y;
  };

  Parallax.prototype.origin = function(x, y) {
    this.originX = x === undefined ? this.originX : x;
    this.originY = y === undefined ? this.originY : y;
  };

  Parallax.prototype.clamp = function(value, min, max) {
    value = Math.max(value, min);
    value = Math.min(value, max);
    return value;
  };

  Parallax.prototype.css = function(element, property, value) {
    var jsProperty = this.propertyCache[property];
    if (!jsProperty) {
      for (var i = 0, l = this.vendors.length; i < l; i++) {
        if (this.vendors[i] !== null) {
          jsProperty = this.camelCase(this.vendors[i][1] + '-' + property);
        } else {
          jsProperty = property;
        }
        if (element.style[jsProperty] !== undefined) {
          this.propertyCache[property] = jsProperty;
          break;
        }
      }
    }
    element.style[jsProperty] = value;
  };

  Parallax.prototype.accelerate = function(element) {
    this.css(element, 'transform', 'translate3d(0,0,0)');
    this.css(element, 'transform-style', 'preserve-3d');
    this.css(element, 'backface-visibility', 'hidden');
  };

  Parallax.prototype.setPosition = function(element, x, y) {
    x += 'px';
    y += 'px';
    if (this.transform3DSupport) {
      this.css(element, 'transform', 'translate3d('+x+','+y+',0)');
    } else if (this.transform2DSupport) {
      this.css(element, 'transform', 'translate('+x+','+y+')');
    } else {
      element.style.left = x;
      element.style.top = y;
    }
  };

  Parallax.prototype.onOrientationTimer = function(event) {
    if (this.orientationSupport && this.orientationStatus === 0) {
      this.disable();
      this.orientationSupport = false;
      this.enable();
    }
  };

  Parallax.prototype.onCalibrationTimer = function(event) {
    this.calibrationFlag = true;
  };

  Parallax.prototype.onWindowResize = function(event) {
    this.updateDimensions();
  };

  Parallax.prototype.onAnimationFrame = function() {
    this.updateBounds();
    var dx = this.ix - this.cx;
    var dy = this.iy - this.cy;
    if ((Math.abs(dx) > this.calibrationThreshold) || (Math.abs(dy) > this.calibrationThreshold)) {
      this.queueCalibration(0);
    }
    if (this.portrait) {
      this.mx = this.calibrateX ? dy : this.iy;
      this.my = this.calibrateY ? dx : this.ix;
    } else {
      this.mx = this.calibrateX ? dx : this.ix;
      this.my = this.calibrateY ? dy : this.iy;
    }
    this.mx *= this.ew * (this.scalarX / 100);
    this.my *= this.eh * (this.scalarY / 100);
    if (!isNaN(parseFloat(this.limitX))) {
      this.mx = this.clamp(this.mx, -this.limitX, this.limitX);
    }
    if (!isNaN(parseFloat(this.limitY))) {
      this.my = this.clamp(this.my, -this.limitY, this.limitY);
    }
    this.vx += (this.mx - this.vx) * this.frictionX;
    this.vy += (this.my - this.vy) * this.frictionY;
    for (var i = 0, l = this.layers.length; i < l; i++) {
      var layer = this.layers[i];
      var depth = this.depths[i];
      var xOffset = this.vx * depth * (this.invertX ? -1 : 1);
      var yOffset = this.vy * depth * (this.invertY ? -1 : 1);
      this.setPosition(layer, xOffset, yOffset);
    }
    this.raf = requestAnimationFrame(this.onAnimationFrame);
  };

  Parallax.prototype.onDeviceOrientation = function(event) {

    // Validate environment and event properties.
    if (!this.desktop && event.beta !== null && event.gamma !== null) {

      // Set orientation status.
      this.orientationStatus = 1;

      // Extract Rotation
      var x = (event.beta  || 0) / MAGIC_NUMBER; //  -90 :: 90
      var y = (event.gamma || 0) / MAGIC_NUMBER; // -180 :: 180

      // Detect Orientation Change
      var portrait = this.wh > this.ww;
      if (this.portrait !== portrait) {
        this.portrait = portrait;
        this.calibrationFlag = true;
      }

      // Set Calibration
      if (this.calibrationFlag) {
        this.calibrationFlag = false;
        this.cx = x;
        this.cy = y;
      }

      // Set Input
      this.ix = x;
      this.iy = y;
    }
  };

  Parallax.prototype.onMouseMove = function(event) {

    // Cache mouse coordinates.
    var clientX = event.clientX;
    var clientY = event.clientY;

    // Calculate Mouse Input
    if (!this.orientationSupport && this.relativeInput) {

      // Clip mouse coordinates inside element bounds.
      if (this.clipRelativeInput) {
        clientX = Math.max(clientX, this.ex);
        clientX = Math.min(clientX, this.ex + this.ew);
        clientY = Math.max(clientY, this.ey);
        clientY = Math.min(clientY, this.ey + this.eh);
      }

      // Calculate input relative to the element.
      this.ix = (clientX - this.ex - this.ecx) / this.erx;
      this.iy = (clientY - this.ey - this.ecy) / this.ery;

    } else {

      // Calculate input relative to the window.
      this.ix = (clientX - this.wcx) / this.wrx;
      this.iy = (clientY - this.wcy) / this.wry;
    }
  };

  // Expose Parallax
  window[NAME] = Parallax;

})(window, document);

/**
 * Request Animation Frame Polyfill.
 * @author Tino Zijdel
 * @author Paul Irish
 * @see https://gist.github.com/paulirish/1579671
 */
;(function() {

  var lastTime = 0;
  var vendors = ['ms', 'moz', 'webkit', 'o'];

  for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
    window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
  }

  if (!window.requestAnimationFrame) {
    window.requestAnimationFrame = function(callback, element) {
      var currTime = new Date().getTime();
      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function() { callback(currTime + timeToCall); },
        timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };
  }

  if (!window.cancelAnimationFrame) {
    window.cancelAnimationFrame = function(id) {
      clearTimeout(id);
    };
  }

}());
</script>
<script type="47645cc74a22243371ba8848-text/javascript">
	// Pretty simple huh?
	var scene = document.getElementById('scene');
	var parallax = new Parallax(scene);
	</script>
<script data-cf-settings="47645cc74a22243371ba8848-|49" defer="">
!function(){"use strict";function t(){return"cf-marker-"+Math.random().toString().slice(2)}function e(){for(var t=[],e=0;e<arguments.length;e++)t[e]=arguments[e];(n=console.warn||console.log).call.apply(n,[console,"[ROCKET LOADER] "].concat(t));var n}function n(t,e){var n=e.parentNode;n&&h(t,n,e)}function r(t,e){h(t,e,e.childNodes[0])}function o(t){var e=t.parentNode;e&&e.removeChild(t)}function i(t){var e=t.namespaceURI===E?"xlink:href":"src";return t.getAttribute(e)}function a(t,e){var n=t.type.substr(e.length);return!(n&&!A[n.trim()])&&((!k||!t.hasAttribute("nomodule"))&&!(!k&&"module"===n))}function c(t){return a(t,"")}function s(t,e){return function(n){if(e(),t)return t.call(this,n)}}function u(t,e){t.onload=s(t.onload,e),t.onerror=s(t.onerror,e)}function p(t){var e=document.createElementNS(t.namespaceURI,"script");e.async=t.hasAttribute("async"),e.textContent=t.textContent;for(var n=0;n<t.attributes.length;n++){var r=t.attributes[n];try{r.namespaceURI?e.setAttributeNS(r.namespaceURI,r.name,r.value):e.setAttribute(r.name,r.value)}catch(o){}}return e}function l(t,e){var n=new I(e);t.dispatchEvent(n)}function d(e){var n=e.namespaceURI===E,r=t();e.setAttribute(r,"");var i=n?"<svg>"+e.outerHTML+"</svg>":e.outerHTML;L.call(document,i);var a=document.querySelector("["+r+"]");if(a){a.removeAttribute(r);var c=n&&a.parentNode;c&&o(c)}return a}function f(t){if(t&&"handleEvent"in t){var e=t.handleEvent;return"function"==typeof e?e.bind(t):e}return t}function h(t,e,n){var r=n?function(t){return e.insertBefore(t,n)}:function(t){return e.appendChild(t)};Array.prototype.slice.call(t).forEach(r)}function v(){return/chrome/i.test(navigator.userAgent)&&/google/i.test(navigator.vendor)}function y(t,e){function n(){this.constructor=t}H(t,e),t.prototype=null===e?Object.create(e):(n.prototype=e.prototype,new n)}function m(t){return t instanceof Window?["load"]:t instanceof Document?["DOMContentLoaded","readystatechange"]:[]}function b(t){var e=t.getAttribute(R);if(!e)return null;var n=e.split(T);return{nonce:n[0],handlerPrefixLength:+n[1],bailout:!t.hasAttribute("defer")}}function g(t){var e=B+t.nonce;Array.prototype.forEach.call(document.querySelectorAll("["+e+"]"),function(n){n.removeAttribute(e),Array.prototype.forEach.call(n.attributes,function(e){/^on/.test(e.name)&&"function"!=typeof n[e.name]&&n.setAttribute(e.name,e.value.substring(t.handlerPrefixLength))})})}function S(){var t=window;"undefined"!=typeof Promise&&(t.__cfQR={done:new Promise(function(t){return U=t})})}function w(t){var e=new N(t),n=new C(e);e.harvestScriptsInDocument(),new W(e,{nonce:t,blocking:!0,docWriteSimulator:n,callback:function(){}}).run()}function x(t){var e=new N(t),n=new C(e);e.harvestScriptsInDocument();var r=new W(e,{nonce:t,blocking:!1,docWriteSimulator:n,callback:function(){window.__cfRLUnblockHandlers=!0,r.removePreloadHints(),P(t)}});r.insertPreloadHints(),M.runOnLoad(function(){r.run()})}function P(t){var e=new O(t);M.simulateStateBeforeDeferScriptsActivation(),e.harvestDeferScriptsInDocument(),new W(e,{nonce:t,blocking:!1,callback:function(){M.simulateStateAfterDeferScriptsActivation(),U&&U()}}).run()}var E="http://www.w3.org/2000/svg",A={"application/ecmascript":!0,"application/javascript":!0,"application/x-ecmascript":!0,"application/x-javascript":!0,"text/ecmascript":!0,"text/javascript":!0,"text/javascript1.0":!0,"text/javascript1.1":!0,"text/javascript1.2":!0,"text/javascript1.3":!0,"text/javascript1.4":!0,"text/javascript1.5":!0,"text/jscript":!0,"text/livescript":!0,"text/x-ecmascript":!0,"text/x-javascript":!0,module:!0},k=void 0!==document.createElement("script").noModule,I=function(){var t=window;return t.__rocketLoaderEventCtor||Object.defineProperty(t,"__rocketLoaderEventCtor",{value:Event}),t.__rocketLoaderEventCtor}(),L=document.write,_=document.writeln,H=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])},D=function(){function t(t){this.nonce=t,this.items=[]}return Object.defineProperty(t.prototype,"hasItems",{get:function(){return this.items.length>0},enumerable:!0,configurable:!0}),t.prototype.pop=function(){return this.items.pop()},t.prototype.forEach=function(t){this.items.forEach(function(e){var n=e.script;return t(n)})},t.prototype.harvestScripts=function(t,e){var n=this,r=e.filter,o=e.mutate;Array.prototype.slice.call(t.querySelectorAll("script")).filter(r).reverse().forEach(function(t){o(t),n.pushScriptOnStack(t)})},t.prototype.pushScriptOnStack=function(t){var e=t.parentNode,n=this.createPlaceholder(t),r=!!i(t);e.replaceChild(n,t),this.items.push({script:t,placeholder:n,external:r,async:r&&t.hasAttribute("async"),executable:c(t)})},t.prototype.hasNonce=function(t){return 0===t.type.indexOf(this.nonce)},t.prototype.removeNonce=function(t){t.type=t.type.substr(this.nonce.length)},t.prototype.makeNonExecutable=function(t){t.type=this.nonce+t.type},t.prototype.isPendingDeferScript=function(t){return t.hasAttribute("defer")||t.type===this.nonce+"module"&&!t.hasAttribute("async")},t}(),N=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return y(e,t),e.prototype.harvestScriptsInDocument=function(){var t=this;this.harvestScripts(document,{filter:function(e){return t.hasNonce(e)},mutate:function(e){t.isPendingDeferScript(e)||t.removeNonce(e)}})},e.prototype.harvestScriptsAfterDocWrite=function(t){var e=this;this.harvestScripts(t,{filter:c,mutate:function(t){e.isPendingDeferScript(t)&&e.makeNonExecutable(t)}})},e.prototype.createPlaceholder=function(t){return document.createComment(t.outerHTML)},e}(D),O=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return y(e,t),e.prototype.harvestDeferScriptsInDocument=function(){var t=this;this.harvestScripts(document,{filter:function(e){return t.hasNonce(e)&&t.isPendingDeferScript(e)},mutate:function(e){return t.removeNonce(e)}})},e.prototype.createPlaceholder=function(t){var e=p(t);return this.makeNonExecutable(e),e},e}(D),C=function(){function t(t){this.scriptStack=t}return t.prototype.enable=function(t){var e=this;this.insertionPointMarker=t,this.buffer="",document.write=function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];return e.write(t,!1)},document.writeln=function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];return e.write(t,!0)}},t.prototype.flushWrittenContentAndDisable=function(){document.write=L,document.writeln=_,this.buffer.length&&(document.contains(this.insertionPointMarker)?this.insertionPointMarker.parentNode===document.head?this.insertContentInHead():this.insertContentInBody():e("Insertion point marker for document.write was detached from document:","Markup will not be inserted"))},t.prototype.insertContentInHead=function(){var t=new DOMParser,e="<!DOCTYPE html><head>"+this.buffer+"</head>",o=t.parseFromString(e,"text/html");if(this.scriptStack.harvestScriptsAfterDocWrite(o),n(o.head.childNodes,this.insertionPointMarker),o.body.childNodes.length){for(var i=Array.prototype.slice.call(o.body.childNodes),a=this.insertionPointMarker.nextSibling;a;)i.push(a),a=a.nextSibling;document.body||L.call(document,"<body>"),r(i,document.body)}},t.prototype.insertContentInBody=function(){var t=this.insertionPointMarker.parentElement,e=document.createElement(t.tagName);e.innerHTML=this.buffer,this.scriptStack.harvestScriptsAfterDocWrite(e),n(e.childNodes,this.insertionPointMarker)},t.prototype.write=function(t,e){var n=document.currentScript;n&&i(n)&&n.hasAttribute("async")?(r=e?_:L).call.apply(r,[document].concat(t)):this.buffer+=t.map(String).join(e?"\n":"");var r},t}(),j=function(){function t(){var t=this;this.simulatedReadyState="loading",this.bypassEventsInProxies=!1,this.nativeWindowAddEventListener=window.addEventListener;try{Object.defineProperty(document,"readyState",{get:function(){return t.simulatedReadyState}})}catch(e){}this.setupEventListenerProxy(),this.updateInlineHandlers()}return t.prototype.runOnLoad=function(t){var e=this;this.nativeWindowAddEventListener.call(window,"load",function(n){if(!e.bypassEventsInProxies)return t(n)})},t.prototype.updateInlineHandlers=function(){this.proxyInlineHandler(document,"onreadystatechange"),this.proxyInlineHandler(window,"onload"),document.body&&this.proxyInlineHandler(document.body,"onload")},t.prototype.simulateStateBeforeDeferScriptsActivation=function(){this.bypassEventsInProxies=!0,this.simulatedReadyState="interactive",l(document,"readystatechange"),this.bypassEventsInProxies=!1},t.prototype.simulateStateAfterDeferScriptsActivation=function(){var t=this;this.bypassEventsInProxies=!0,l(document,"DOMContentLoaded"),this.simulatedReadyState="complete",l(document,"readystatechange"),l(window,"load"),this.bypassEventsInProxies=!1,window.setTimeout(function(){return t.bypassEventsInProxies=!0},0)},t.prototype.setupEventListenerProxy=function(){var t=this;("undefined"!=typeof EventTarget?[EventTarget.prototype]:[Node.prototype,Window.prototype]).forEach(function(e){return t.patchEventTargetMethods(e)})},t.prototype.patchEventTargetMethods=function(t){var e=this,n=t.addEventListener,r=t.removeEventListener;t.addEventListener=function(t,r){for(var o=[],i=2;i<arguments.length;i++)o[i-2]=arguments[i];var a=m(this),c=r&&r.__rocketLoaderProxiedHandler;if(!c){var s=f(r);"function"==typeof s?(c=function(n){if(e.bypassEventsInProxies||a.indexOf(t)<0)return s.call(this,n)},Object.defineProperty(r,"__rocketLoaderProxiedHandler",{value:c})):c=r}n.call.apply(n,[this,t,c].concat(o))},t.removeEventListener=function(t,e){for(var n=[],o=2;o<arguments.length;o++)n[o-2]=arguments[o];var i=e&&e.__rocketLoaderProxiedHandler||e;r.call.apply(r,[this,t,i].concat(n))}},t.prototype.proxyInlineHandler=function(t,e){try{var n=t[e];if(n&&!n.__rocketLoaderInlineHandlerProxy){var r=this;t[e]=function(t){if(r.bypassEventsInProxies)return n.call(this,t)},Object.defineProperty(t[e],"__rocketLoaderInlineHandlerProxy",{value:!0})}}catch(o){return void console.warn("encountered an error when accessing "+e+" handler:",o.message)}},t}(),M=function(){var t=window;return t.__rocketLoaderLoadProgressSimulator||Object.defineProperty(t,"__rocketLoaderLoadProgressSimulator",{value:new j}),t.__rocketLoaderLoadProgressSimulator}(),W=function(){function t(t,e){this.scriptStack=t,this.settings=e,this.preloadHints=[]}return t.prototype.insertPreloadHints=function(){var t=this;this.scriptStack.forEach(function(e){if(a(e,t.settings.nonce)){var n=i(e),r=v()&&e.hasAttribute("integrity");if(n&&!r){var o=document.createElement("link");o.setAttribute("rel","preload"),o.setAttribute("as","script"),o.setAttribute("href",n),e.crossOrigin&&o.setAttribute("crossorigin",e.crossOrigin),document.head.appendChild(o),t.preloadHints.push(o)}}})},t.prototype.removePreloadHints=function(){this.preloadHints.forEach(function(t){return o(t)})},t.prototype.run=function(){for(var t=this,e=this;this.scriptStack.hasItems;){var n=function(){var n=e.settings.docWriteSimulator,r=e.scriptStack.pop();n&&!r.async&&n.enable(r.placeholder);var o=e.activateScript(r);return o?r.external&&r.executable&&!r.async?(u(o,function(){t.finalizeActivation(r),t.run()}),{value:void 0}):void e.finalizeActivation(r):(n&&n.flushWrittenContentAndDisable(),"continue")}();if("object"==typeof n)return n.value}this.scriptStack.hasItems||this.settings.callback()},t.prototype.finalizeActivation=function(t){this.settings.docWriteSimulator&&!t.async&&this.settings.docWriteSimulator.flushWrittenContentAndDisable(),M.updateInlineHandlers(),o(t.placeholder)},t.prototype.activateScript=function(t){var n=t.script,r=t.placeholder,o=t.external,i=t.async,a=r.parentNode;if(!document.contains(r))return e("Placeholder for script \n"+n.outerHTML+"\n was detached from document.","Script will not be executed."),null;var c=this.settings.blocking&&o&&!i?d(n):p(n);return c?(a.insertBefore(c,r),c):(e("Failed to create activatable copy of script \n"+n.outerHTML+"\n","Script will not be executed."),null)},t}(),R="data-cf-settings",T="|",B="data-cf-modified-",U=void 0;!function(){var t=document.currentScript;if(t){var n=b(t);n?(o(t),g(n),M.updateInlineHandlers(),n.bailout?w(n.nonce):(S(),x(n.nonce))):e("Activator script doesn't have settings. No scripts will be executed.")}else e("Can't obtain activator script. No scripts will be executed.")}()}();
</script></body>
</html>
