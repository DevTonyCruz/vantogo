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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/front/js/payment.js":
/*!***************************************!*\
  !*** ./resources/front/js/payment.js ***!
  \***************************************/
/*! exports provided: createOrderConektaCard, createConektaOxxoOrder */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createOrderConektaCard", function() { return createOrderConektaCard; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createConektaOxxoOrder", function() { return createConektaOxxoOrder; });
/*
    Create conekta pay method by card
*/
var conektaSuccessResponseHandler = function conektaSuccessResponseHandler(token) {
  var nombre = $('#nombre').val();
  var apellido = $('#apellido').val();
  var telefono = $('#telefono').val();
  var correo = $('#correo').val();
  var data = {
    token: token.id,
    nombre: nombre,
    apellido: apellido,
    telefono: telefono,
    correo: correo,
    tipo: 'conekta-card'
  };
  createOrderConektaCard(data);
};

$(function () {
  $("#conekta-card").on('click', function (event) {
    if ($("#accept-terms-card-conekta").is(":checked")) {
      var $form = $("#card-form-conekta");
      $(this).prop("disabled", true);
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    } else {
      printErrorProcess('Debe aceptar los terminos y condiciones');
      $(this).removeAttr("disabled");
    }
  });
});

var conektaErrorResponseHandler = function conektaErrorResponseHandler(response) {
  console.log(response.message_to_purchaser);
  $("#conekta-card").removeAttr("disabled");
  printErrorProcess(response.message_to_purchaser);
};

function createOrderConektaCard(data) {
  RequestObject.AjaxJson('POST', '/payment', data).then(function (response) {
    $("#conekta-card").removeAttr("disabled");

    if ($.isEmptyObject(response.errors)) {
      window.location = response.data.redirect;
    } else {
      $("#conekta-card").removeAttr("disabled");

      if (response.type == 'validation') {
        printErrorValidation(response.errors);
      }

      if (type == 'process') {
        printErrorProcess(daresponse.errorsta);
      }

      if (type == 'redirect') {
        printErrorRedirect(response.errors, response.place);
      }
    }

    console.log(response);
  }, function (xhrObj, textStatus, err) {
    if (!$.isEmptyObject(xhrObj.responseJSON.data.errors)) {
      var _type = xhrObj.responseJSON.data.type;
      var _data = xhrObj.responseJSON.data.errors;

      if (_type == 'validation') {
        printErrorValidation(_data);
      }

      if (_type == 'process') {
        printErrorProcess(_data);
      }

      if (_type == 'redirect') {
        var place = xhrObj.responseJSON.data.place;
        printErrorRedirect(_data, place);
      }
    }
  });
}
;
function createConektaOxxoOrder() {
  $("#conekta-oxxo").prop("disabled", true);

  if (!$("#accept-terms-oxxo-conekta").is(":checked")) {
    $("#conekta-oxxo").removeAttr("disabled");
    printErrorProcess('Debe aceptar los terminos y condiciones');
  }

  var nombre = $('#nombre').val();
  var apellido = $('#apellido').val();
  var telefono = $('#telefono').val();
  var correo = $('#correo').val();
  var data = {
    nombre: nombre,
    apellido: apellido,
    telefono: telefono,
    correo: correo,
    tipo: 'conekta-oxxo'
  };
  RequestObject.AjaxJson('POST', '/payment', data).then(function (response) {
    $("#conekta-oxxo").removeAttr("disabled");

    if ($.isEmptyObject(response.errors)) {
      window.location = response.data.redirect;
    } else {
      if (response.type == 'validation') {
        printErrorValidation(response.errors);
      }

      if (type == 'process') {
        printErrorProcess(daresponse.errorsta);
      }

      if (type == 'redirect') {
        printErrorRedirect(response.errors, response.place);
      }
    }
  }, function (xhrObj, textStatus, err) {
    if (!$.isEmptyObject(xhrObj.responseJSON.data.errors)) {
      var _type2 = xhrObj.responseJSON.data.type;
      var _data2 = xhrObj.responseJSON.data.errors;

      if (_type2 == 'validation') {
        printErrorValidation(_data2);
      }

      if (_type2 == 'process') {
        printErrorProcess(_data2);
      }

      if (_type2 == 'redirect') {
        var place = xhrObj.responseJSON.data.place;
        printErrorRedirect(_data2, place);
      }
    }
  });
}

function printErrorValidation(msg) {
  if ($('#modal-json .modal-body ol').length > 0) {
    $('#modal-json .modal-body ol').remove();
  }

  $('#modal-json .modal-body').append('<ol></ol>');
  $("#modal-json .modal-body").find("ol").html('');
  $.each(msg, function (key, value) {
    $("#modal-json .modal-body").find("ol").append('<li>' + value + '</li>');
  });
  $("#modal-json .modal-title").html('¡Error!');
  $("#modal-json").modal('show');
}

function printErrorProcess(msg) {
  if ($('#modal-json .modal-body ol').length > 0) {
    $('#modal-json .modal-body ol').remove();
  }

  $('#modal-json .modal-body').append('<ol></ol>');
  $("#modal-json .modal-body").find("ol").html('');
  $("#modal-json .modal-body").find("ol").append('<li>' + msg + '</li>');
  $("#modal-json .modal-title").html('¡Error!');
  $("#modal-json").modal('show');
}

function printErrorRedirect(msg, place) {
  if ($('#modal-json .modal-body ol').length > 0) {
    $('#modal-json .modal-body ol').remove();
  }

  $('#modal-json .modal-body').append('<ol></ol>');
  $("#modal-json .modal-body").find("ol").html('');
  $("#modal-json .modal-body").find("ol").append('<li>' + msg + '</li>');
  $("#modal-json .modal-title").html('¡Error!');
  $("#modal-json").modal('show');
  setTimeout(function () {
    window.location.href = place;
  }, 5000);
}

/***/ }),

/***/ 3:
/*!*********************************************!*\
  !*** multi ./resources/front/js/payment.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\repositorios\vantogo\resources\front\js\payment.js */"./resources/front/js/payment.js");


/***/ })

/******/ });