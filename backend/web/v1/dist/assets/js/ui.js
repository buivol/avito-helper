"use strict";

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; var ownKeys = Object.keys(source); if (typeof Object.getOwnPropertySymbols === 'function') { ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) { return Object.getOwnPropertyDescriptor(source, sym).enumerable; })); } ownKeys.forEach(function (key) { _defineProperty(target, key, source[key]); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/*jshint esversion: 6 */
var UIRender =
/*#__PURE__*/
function () {
  function UIRender(sa) {
    var saveBtn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '#save';

    _classCallCheck(this, UIRender);

    this.saveBtn = $(saveBtn);
    this.sa = sa.mixin({
      confirmButtonClass: 'btn btn-lg btn-primary',
      cancelButtonClass: 'btn btn-lg btn-link',
      buttonsStyling: false
    });
    this.param = $('meta[name=csrf-param]').attr('content');
    this.token = $('meta[name=csrf-token]').attr('content');
  }

  _createClass(UIRender, [{
    key: "version",
    value: function version() {
      return '0.2';
    }
  }, {
    key: "appendObjTo",
    value: function appendObjTo(thatArray, newObj) {
      var frozenObj = Object.freeze(newObj);
      return Object.freeze(thatArray.concat(frozenObj));
    }
    /**
     *
     * @param url
     * @param selArray
     */

  }, {
    key: "post",
    value: function post(url, selArray) {
      var _this = this;

      this.saveBtn.addClass('btn-loading');
      $('.ui-error').hide(0);
      var data = [{
        name: this.param,
        value: this.token
      }];

      for (var i = 0; i < selArray.length; i++) {
        data = this.appendObjTo(data, $(selArray[i]).serializeArray());
      }

      $.post(url, data, function (responseText) {
        var response = JSON.parse(responseText);

        if (response.status === 'ok') {
          if (response.needRedirect) {
            window.location.href = response.redirect;
          }
        } else if (response.status === 'error') {
          $.each(response.errors, function (block, errors) {
            _this.error(block, errors);
          });
        }

        _this.saveBtn.removeClass('btn-loading');
      }).fail(function (response) {
        _this.error('main', response.responseText);

        _this.saveBtn.removeClass('btn-loading');
      });
    }
  }, {
    key: "api",
    value: function api(_ref) {
      var _this2 = this;

      var url = _ref.url,
          _ref$data = _ref.data,
          data = _ref$data === void 0 ? false : _ref$data,
          _ref$success = _ref.success,
          _success = _ref$success === void 0 ? false : _ref$success,
          _ref$error = _ref.error,
          _error = _ref$error === void 0 ? false : _ref$error,
          _ref$method = _ref.method,
          method = _ref$method === void 0 ? "post" : _ref$method,
          _ref$block = _ref.block,
          block = _ref$block === void 0 ? "" : _ref$block,
          _ref$eid = _ref.eid,
          eid = _ref$eid === void 0 ? 0 : _ref$eid;

      $('.ui-error').hide(0);
      data = data ? data : {};

      var requestData = _objectSpread(_defineProperty({}, this.param, this.token), data);

      $.ajax({
        type: method,
        url: '/api/' + url,
        data: requestData,
        success: function success(msg) {
          if (_success !== false) {
            _success(msg);
          }

          var response = JSON.parse(msg);

          if (response.status === 'ok') {
            if (response.needRedirect) {
              window.location.href = response.redirect;
            }
          } else if (response.status === 'error') {
            $.each(response.errors, function (block, errors) {
              _this2.error(block, errors, eid);
            });
          }
        },
        error: function error(jqXHR, exception) {
          var msg = jqXHR.responseText;

          if (_error) {
            _error(msg);
          } else {
            _this2.error(block, msg, eid);
          }
        }
      });
    }
  }, {
    key: "error",
    value: function error() {
      var block = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var message = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'Ошибка';
      var eid = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
      var messageHtml = '';

      if (Array.isArray(message)) {
        if (message.length > 1) {
          messageHtml += '<ul>';

          for (var i = 0; i < message.length; i++) {
            messageHtml += '<li>' + message[i] + '</li>';
          }

          messageHtml += '</ul>';
        } else {
          messageHtml = message[0];
        }
      } else {
        messageHtml = message;
      }

      var id = 'ui-block-' + block + '-' + eid;
      var $b = $('#' + id);

      if (!$b.length) {
        var h = '<div id="' + id + '"class="ui-error card-alert alert alert-danger mb-0" style="display:block;">';
        h += messageHtml;
        h += '</div>';
        var $card = null;

        if (eid) {
          $card = $('.card[data-ui="' + block + '"]');
        } else {
          $card = $('.card[data-ui="' + block + '"][data-id="' + eid + '"]');
        }

        if ($card.length) {
          var $cardBody = $card.find('.card-body');

          if (!$cardBody.length) {
            $cardBody = $card.find('.c-body');
          }

          $cardBody.before(h);
          $('html, body').animate({
            scrollTop: $('#' + id).offset().top
          }, 700);
        } else {
          var _$card = $('.card:first');

          if (_$card.length) {
            _$card.find('.card-body').before(h);

            $('html, body').animate({
              scrollTop: $('#' + id).offset().top
            }, 700);
          } else {
            this.alert(messageHtml);
          }
        }
      } else {
        $b.html(messageHtml);
        $b.show(0);
        $('html, body').animate({
          scrollTop: $b.offset().top
        }, 700);
      }
    }
  }, {
    key: "question",
    value: function question(_ref2) {
      var _this3 = this;

      var _ref2$title = _ref2.title,
          title = _ref2$title === void 0 ? 'Подтверждение' : _ref2$title,
          _ref2$yes = _ref2.yes,
          yes = _ref2$yes === void 0 ? 'Да, сделать это' : _ref2$yes,
          _ref2$no = _ref2.no,
          no = _ref2$no === void 0 ? 'Нет, отменить' : _ref2$no,
          _ref2$message = _ref2.message,
          message = _ref2$message === void 0 ? 'Вы уверены, что хотите это сделать' : _ref2$message,
          _ref2$success = _ref2.success,
          success = _ref2$success === void 0 ? false : _ref2$success,
          _ref2$onsuccess = _ref2.onsuccess,
          onsuccess = _ref2$onsuccess === void 0 ? false : _ref2$onsuccess,
          _ref2$cancel = _ref2.cancel,
          cancel = _ref2$cancel === void 0 ? false : _ref2$cancel,
          _ref2$oncancel = _ref2.oncancel,
          oncancel = _ref2$oncancel === void 0 ? false : _ref2$oncancel;
      this.sa({
        title: title,
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true
      }).then(function (result) {
        if (result.value) {
          var successTitle = 'Готово',
              successMessage = 'Это сделано';

          if (onsuccess !== false) {
            onsuccess();
          }

          if (success !== false) {
            successTitle = typeof success.title !== 'undefined' ? success.title : successTitle;
            successMessage = typeof success.message !== 'undefined' ? success.message : successMessage;

            _this3.sa(successTitle, successMessage, 'success').then(function (res) {});
          }
        } else if ( // Read more about handling dismissals
        result.dismiss === _this3.sa.DismissReason.cancel) {
          var cancelTitle = 'Отменено',
              cancelMessage = 'Действие не было выполнено';

          if (cancel !== false) {
            cancelTitle = typeof cancel.title !== 'undefined' ? cancel.title : cancelTitle;
            cancelMessage = typeof cancel.message !== 'undefined' ? cancel.message : cancelMessage;

            _this3.sa(cancelTitle, cancelMessage, 'error').then(function (res) {
              if (oncancel !== false) {
                oncancel();
              }
            });
          } else {
            if (oncancel !== false) {
              oncancel();
            }
          }
        }
      });
    }
  }, {
    key: "alert",
    value: function alert(message) {
      this.sa({
        text: message,
        type: 'error',
        confirmButtonText: 'Понятно'
      });
    }
  }, {
    key: "test",
    value: function test(message) {
      this.sa('Хуй пизда джигруда');
    }
  }]);

  return UIRender;
}();