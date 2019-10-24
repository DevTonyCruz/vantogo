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
/*! exports provided: createOrderConektaCard, createOrderConektaOxxo */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createOrderConektaCard", function() { return createOrderConektaCard; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createOrderConektaOxxo", function() { return createOrderConektaOxxo; });
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
    correo: correo
  };
  createOrderConektaCard(data);
};

var conektaErrorResponseHandler = function conektaErrorResponseHandler(response) {
  console.log(response);
};

$(function () {
  $("#conekta-card").on('click', function (event) {
    if ($("#accept-terms-card-conekta").is(":checked")) {
      var $form = $("#card-form-conekta");
      $(this).prop("disabled", true);
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    } else {
      alert('Debe aceptar los terminos y condiciones');
    }
  });
});
function createOrderConektaCard(data) {
  RequestObject.AjaxJson('POST', 'payment/conekta/cart', data).then(function (response) {
    //window.location = URL_WEB + '/payment/order-process/' + response.data.order_code;
    //window.location = response.data.redirect;
    if ($.isEmptyObject(response.error)) {
      alert(response.success);
    } else {
      printErrorMsg(response.error);
    }

    console.log(response);
  }, function (xhrObj, textStatus, err) {
    var data = xhrObj.responseJSON.errors;
    console.log(xhrObj.responseJSON.errors);
    printErrorMsg(data);
  });
}
;

function printErrorMsg(msg) {
  $(".print-error-msg").find("ul").html('');
  $.each(msg, function (key, value) {
    console.log(msg);
    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
  });
  $('#error-payment').modal('show');
}

function createOrderConektaOxxo() {
  $('.btn-payment-total').attr('disabled', true);
  $('.spinner-payment-total').fadeIn();

  if ($("#receiver_store").is(':checked')) {
    $('#user_email').val($('#email_receiver_store').val());
  }

  var type_payment = $('#type_payment').val();
  var user_id = $('#user_id').val();
  var user_email = $('#user_email').val();
  var receiver_store = $('#receiver_store').is(':checked') ? 1 : null;
  var shipping_id = $('#id_shipping').val();
  var invoice_id = $('#id_invoice').val();
  var email_receiver_store = $('#email_receiver_store').val();
  var name_receiver_store = $('#name_receiver_store').val();
  var phone_receiver_store = $('#phone_receiver_store').val();
  var sucursal_receiver_store = $('#sucursal_receiver_store').val();
  var data = {
    id_local: local_uuid,
    user_id: user_id,
    type_payment: type_payment,
    shipping_id: shipping_id,
    invoice_id: invoice_id,
    user_email: user_email,
    email_receiver_store: email_receiver_store,
    name_receiver_store: name_receiver_store,
    phone_receiver_store: phone_receiver_store,
    sucursal_receiver_store: sucursal_receiver_store,
    receiver_store: receiver_store
  };
  RequestObject.AjaxJson('POST', 'payment/conekta/oxxo', data).then(function (response) {
    window.location = URL_WEB + '/payment/order-process/' + response.data.order_code;
  }, function (xhrObj, textStatus, err) {
    var data = xhrObj.responseJSON.data;
    $('.spinner-payment-total').fadeOut();
    $('.btn-payment-total').removeAttr('disabled');

    if (typeof data !== 'undefined') {
      $("#payment-modal .body-msg").html(data.msg);
      $("#payment-modal").modal();
    }
  });
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