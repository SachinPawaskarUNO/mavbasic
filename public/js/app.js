/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("//\n// /**\n//  * First we will load all of this project's JavaScript dependencies which\n//  * include Vue and Vue Resource. This gives a great starting point for\n//  * building robust, powerful web applications using Vue and Laravel.\n//  */\n//\n// require('./bootstrap');\n//\n// /**\n//  * Next, we will create a fresh Vue application instance and attach it to\n//  * the body of the page. From here, you may begin adding components to\n//  * the application, or feel free to tweak this setup for your needs.\n//  */\n//\n// Vue.component('example', require('./components/Example.vue'));\n//\n// const app = new Vue({\n//     el: '#app'\n// });\n\n// New stuff added by Sachin.\n/*\n * ConfirmDelete: Asks the user for confirmation when a record is being deleted\n */\nfunction ConfirmDelete() {\n    var x = confirm(\"Are you sure you want to delete?\");\n\n    if (x) {\n        return true;\n    } else {\n        return false;\n    }\n}\n\n$.ajaxSetup({\n    headers: {\n        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n    }\n});\n\n$(document).ready(function(){\n    $('table.mav-datatable').DataTable({\n        \"columnDefs\": [ {\n            \"targets\"  : 'no-sort',\n            \"orderable\": false\n        }],\n        // \"pageLength\": {{ json_encode(Auth::user()->getSettingValue('LinesPerPage') }}\n        // \"pageLength\": JSON.parse(\"{{ json_encode(Auth::user()->getSettingValue('LinesPerPage')) }}\")\n    });\n    $('.mav-select').select2();\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcz84YjY3Il0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyAvKipcbi8vICAqIEZpcnN0IHdlIHdpbGwgbG9hZCBhbGwgb2YgdGhpcyBwcm9qZWN0J3MgSmF2YVNjcmlwdCBkZXBlbmRlbmNpZXMgd2hpY2hcbi8vICAqIGluY2x1ZGUgVnVlIGFuZCBWdWUgUmVzb3VyY2UuIFRoaXMgZ2l2ZXMgYSBncmVhdCBzdGFydGluZyBwb2ludCBmb3Jcbi8vICAqIGJ1aWxkaW5nIHJvYnVzdCwgcG93ZXJmdWwgd2ViIGFwcGxpY2F0aW9ucyB1c2luZyBWdWUgYW5kIExhcmF2ZWwuXG4vLyAgKi9cbi8vXG4vLyByZXF1aXJlKCcuL2Jvb3RzdHJhcCcpO1xuLy9cbi8vIC8qKlxuLy8gICogTmV4dCwgd2Ugd2lsbCBjcmVhdGUgYSBmcmVzaCBWdWUgYXBwbGljYXRpb24gaW5zdGFuY2UgYW5kIGF0dGFjaCBpdCB0b1xuLy8gICogdGhlIGJvZHkgb2YgdGhlIHBhZ2UuIEZyb20gaGVyZSwgeW91IG1heSBiZWdpbiBhZGRpbmcgY29tcG9uZW50cyB0b1xuLy8gICogdGhlIGFwcGxpY2F0aW9uLCBvciBmZWVsIGZyZWUgdG8gdHdlYWsgdGhpcyBzZXR1cCBmb3IgeW91ciBuZWVkcy5cbi8vICAqL1xuLy9cbi8vIFZ1ZS5jb21wb25lbnQoJ2V4YW1wbGUnLCByZXF1aXJlKCcuL2NvbXBvbmVudHMvRXhhbXBsZS52dWUnKSk7XG4vL1xuLy8gY29uc3QgYXBwID0gbmV3IFZ1ZSh7XG4vLyAgICAgZWw6ICcjYXBwJ1xuLy8gfSk7XG5cbi8vIE5ldyBzdHVmZiBhZGRlZCBieSBTYWNoaW4uXG4vKlxuICogQ29uZmlybURlbGV0ZTogQXNrcyB0aGUgdXNlciBmb3IgY29uZmlybWF0aW9uIHdoZW4gYSByZWNvcmQgaXMgYmVpbmcgZGVsZXRlZFxuICovXG5mdW5jdGlvbiBDb25maXJtRGVsZXRlKCkge1xuICAgIHZhciB4ID0gY29uZmlybShcIkFyZSB5b3Ugc3VyZSB5b3Ugd2FudCB0byBkZWxldGU/XCIpO1xuXG4gICAgaWYgKHgpIHtcbiAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cbn1cblxuJC5hamF4U2V0dXAoe1xuICAgIGhlYWRlcnM6IHtcbiAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICB9XG59KTtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKXtcbiAgICAkKCd0YWJsZS5tYXYtZGF0YXRhYmxlJykuRGF0YVRhYmxlKHtcbiAgICAgICAgXCJjb2x1bW5EZWZzXCI6IFsge1xuICAgICAgICAgICAgXCJ0YXJnZXRzXCIgIDogJ25vLXNvcnQnLFxuICAgICAgICAgICAgXCJvcmRlcmFibGVcIjogZmFsc2VcbiAgICAgICAgfV0sXG4gICAgICAgIC8vIFwicGFnZUxlbmd0aFwiOiB7eyBqc29uX2VuY29kZShBdXRoOjp1c2VyKCktPmdldFNldHRpbmdWYWx1ZSgnTGluZXNQZXJQYWdlJykgfX1cbiAgICAgICAgLy8gXCJwYWdlTGVuZ3RoXCI6IEpTT04ucGFyc2UoXCJ7eyBqc29uX2VuY29kZShBdXRoOjp1c2VyKCktPmdldFNldHRpbmdWYWx1ZSgnTGluZXNQZXJQYWdlJykpIH19XCIpXG4gICAgfSk7XG4gICAgJCgnLm1hdi1zZWxlY3QnKS5zZWxlY3QyKCk7XG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUF5QkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);