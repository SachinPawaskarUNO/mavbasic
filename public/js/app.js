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

eval("//\n// /**\n//  * First we will load all of this project's JavaScript dependencies which\n//  * include Vue and Vue Resource. This gives a great starting point for\n//  * building robust, powerful web applications using Vue and Laravel.\n//  */\n//\n// require('./bootstrap');\n//\n// /**\n//  * Next, we will create a fresh Vue application instance and attach it to\n//  * the body of the page. From here, you may begin adding components to\n//  * the application, or feel free to tweak this setup for your needs.\n//  */\n//\n// Vue.component('example', require('./components/Example.vue'));\n//\n// const app = new Vue({\n//     el: '#app'\n// });\n\n// New stuff added by Sachin.\n/*\n * confirmDelete: Asks the user for confirmation when a record is being deleted\n */\nfunction confirmDelete() {\n    var x = confirm(\"Are you sure you want to delete?\");\n\n    if (x) {\n        return true;\n    } else {\n        return false;\n    }\n}\n\n$.ajaxSetup({\n    headers: {\n        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n    }\n});\n\n$(document).ready(function(){\n    $('table.mav-datatable').DataTable({\n        \"columnDefs\": [ {\n            \"targets\"  : 'no-sort',\n            \"orderable\": false\n        }],\n    });\n    $('.mav-select').select2();\n});\n\nfunction setPageLength(pagelength) {\n    var oTableApi = $('table.mav-datatable').dataTable().api();\n    oTableApi.page.len( pagelength ).draw();\n}\n\nfunction deleteConfirm() {\n    var x = confirm(\"Are you sure you want to delete?\");\n\n    if (x) {\n        return true;\n    } else {\n        return false;\n    }\n}\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcz84YjY3Il0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyAvKipcbi8vICAqIEZpcnN0IHdlIHdpbGwgbG9hZCBhbGwgb2YgdGhpcyBwcm9qZWN0J3MgSmF2YVNjcmlwdCBkZXBlbmRlbmNpZXMgd2hpY2hcbi8vICAqIGluY2x1ZGUgVnVlIGFuZCBWdWUgUmVzb3VyY2UuIFRoaXMgZ2l2ZXMgYSBncmVhdCBzdGFydGluZyBwb2ludCBmb3Jcbi8vICAqIGJ1aWxkaW5nIHJvYnVzdCwgcG93ZXJmdWwgd2ViIGFwcGxpY2F0aW9ucyB1c2luZyBWdWUgYW5kIExhcmF2ZWwuXG4vLyAgKi9cbi8vXG4vLyByZXF1aXJlKCcuL2Jvb3RzdHJhcCcpO1xuLy9cbi8vIC8qKlxuLy8gICogTmV4dCwgd2Ugd2lsbCBjcmVhdGUgYSBmcmVzaCBWdWUgYXBwbGljYXRpb24gaW5zdGFuY2UgYW5kIGF0dGFjaCBpdCB0b1xuLy8gICogdGhlIGJvZHkgb2YgdGhlIHBhZ2UuIEZyb20gaGVyZSwgeW91IG1heSBiZWdpbiBhZGRpbmcgY29tcG9uZW50cyB0b1xuLy8gICogdGhlIGFwcGxpY2F0aW9uLCBvciBmZWVsIGZyZWUgdG8gdHdlYWsgdGhpcyBzZXR1cCBmb3IgeW91ciBuZWVkcy5cbi8vICAqL1xuLy9cbi8vIFZ1ZS5jb21wb25lbnQoJ2V4YW1wbGUnLCByZXF1aXJlKCcuL2NvbXBvbmVudHMvRXhhbXBsZS52dWUnKSk7XG4vL1xuLy8gY29uc3QgYXBwID0gbmV3IFZ1ZSh7XG4vLyAgICAgZWw6ICcjYXBwJ1xuLy8gfSk7XG5cbi8vIE5ldyBzdHVmZiBhZGRlZCBieSBTYWNoaW4uXG4vKlxuICogY29uZmlybURlbGV0ZTogQXNrcyB0aGUgdXNlciBmb3IgY29uZmlybWF0aW9uIHdoZW4gYSByZWNvcmQgaXMgYmVpbmcgZGVsZXRlZFxuICovXG5mdW5jdGlvbiBjb25maXJtRGVsZXRlKCkge1xuICAgIHZhciB4ID0gY29uZmlybShcIkFyZSB5b3Ugc3VyZSB5b3Ugd2FudCB0byBkZWxldGU/XCIpO1xuXG4gICAgaWYgKHgpIHtcbiAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cbn1cblxuJC5hamF4U2V0dXAoe1xuICAgIGhlYWRlcnM6IHtcbiAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICB9XG59KTtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKXtcbiAgICAkKCd0YWJsZS5tYXYtZGF0YXRhYmxlJykuRGF0YVRhYmxlKHtcbiAgICAgICAgXCJjb2x1bW5EZWZzXCI6IFsge1xuICAgICAgICAgICAgXCJ0YXJnZXRzXCIgIDogJ25vLXNvcnQnLFxuICAgICAgICAgICAgXCJvcmRlcmFibGVcIjogZmFsc2VcbiAgICAgICAgfV0sXG4gICAgfSk7XG4gICAgJCgnLm1hdi1zZWxlY3QnKS5zZWxlY3QyKCk7XG59KTtcblxuZnVuY3Rpb24gc2V0UGFnZUxlbmd0aChwYWdlbGVuZ3RoKSB7XG4gICAgdmFyIG9UYWJsZUFwaSA9ICQoJ3RhYmxlLm1hdi1kYXRhdGFibGUnKS5kYXRhVGFibGUoKS5hcGkoKTtcbiAgICBvVGFibGVBcGkucGFnZS5sZW4oIHBhZ2VsZW5ndGggKS5kcmF3KCk7XG59XG5cbmZ1bmN0aW9uIGRlbGV0ZUNvbmZpcm0oKSB7XG4gICAgdmFyIHggPSBjb25maXJtKFwiQXJlIHlvdSBzdXJlIHlvdSB3YW50IHRvIGRlbGV0ZT9cIik7XG5cbiAgICBpZiAoeCkge1xuICAgICAgICByZXR1cm4gdHJ1ZTtcbiAgICB9IGVsc2Uge1xuICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgfVxufVxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvYXBwLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQXlCQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);