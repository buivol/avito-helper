"use strict";

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
    key: "error",
    value: function error(block, message) {
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

      var id = 'ui-block-' + block;
      var $b = $('#' + id);

      if (!$b.length) {
        var h = '<div id="' + id + '"class="ui-error card-alert alert alert-danger mb-0" style="display: block;">';
        h += messageHtml;
        h += '</div>';
        var $card = $('.card[data-ui="' + block + '"]');

        if ($card.length) {
          $card.find('.card-body').before(h);
          $('html, body').animate({
            scrollTop: $('#' + id).offset().top
          }, 700);
        } else {
          $card = $('.card')[0];

          if ($card.length) {
            $card.find('.card-body').before(h);
            $('html, body').animate({
              scrollTop: $('#' + id).offset().top
            }, 700);
          } else {
            console.log('ui: any cards not found');
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
    value: function question(_ref) {
      var _this2 = this;

      var _ref$title = _ref.title,
          title = _ref$title === void 0 ? 'Подтверждение' : _ref$title,
          _ref$yes = _ref.yes,
          yes = _ref$yes === void 0 ? 'Да, сделать это' : _ref$yes,
          _ref$no = _ref.no,
          no = _ref$no === void 0 ? 'Нет, отменить' : _ref$no,
          _ref$message = _ref.message,
          message = _ref$message === void 0 ? 'Вы уверены, что хотите это сделать' : _ref$message,
          _ref$success = _ref.success,
          success = _ref$success === void 0 ? false : _ref$success,
          _ref$onsuccess = _ref.onsuccess,
          onsuccess = _ref$onsuccess === void 0 ? false : _ref$onsuccess,
          _ref$error = _ref.error,
          error = _ref$error === void 0 ? false : _ref$error,
          _ref$onerror = _ref.onerror,
          onerror = _ref$onerror === void 0 ? false : _ref$onerror;
      console.log();
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

          if (success !== false) {
            successTitle = typeof success.title !== 'undefined' ? success.title : successTitle;
            successMessage = typeof success.message !== 'undefined' ? success.message : successMessage;
          }

          _this2.sa(successTitle, successMessage, 'success').then(function (res) {
            if (onsuccess !== false) {
              onsuccess();
            }
          });
        } else if ( // Read more about handling dismissals
        result.dismiss === _this2.sa.DismissReason.cancel) {
          var errorTitle = 'Отменено',
              errorMessage = 'Действие не было выполнено';

          if (error !== false) {
            errorTitle = typeof error.title !== 'undefined' ? error.title : errorTitle;
            errorMessage = typeof error.message !== 'undefined' ? error.message : errorMessage;
          }

          _this2.sa(errorTitle, errorMessage, 'error').then(function (res) {
            if (onerror !== false) {
              onerror();
            }
          });
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