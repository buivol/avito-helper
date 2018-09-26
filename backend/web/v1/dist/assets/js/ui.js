"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/*jshint esversion: 6 */
var UIRender =
/*#__PURE__*/
function () {
  function UIRender() {
    var saveBtn = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '#save';

    _classCallCheck(this, UIRender);

    this.saveBtn = $(saveBtn);
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

      console.log(data, selArray);
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
  }]);

  return UIRender;
}();