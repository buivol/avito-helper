/*jshint esversion: 6 */

class UIRender {
	constructor(saveBtn = '#save') {
		this.saveBtn = $(saveBtn);
		this.param = $('meta[name=csrf-param]').attr('content');
		this.token = $('meta[name=csrf-token]').attr('content');
	}

	version() {
		return '0.2';
	}

	appendObjTo(thatArray, newObj) {
		const frozenObj = Object.freeze(newObj);
		return Object.freeze(thatArray.concat(frozenObj));
	}

	/**
	 *
	 * @param url
	 * @param selArray
	 */
	post(url, selArray) {
		this.saveBtn.addClass('btn-loading');
		$('.ui-error').hide(0);
		let data = [{name: this.param, value: this.token}];
		for (let i = 0; i < selArray.length; i++) {
			data = this.appendObjTo(data, $(selArray[i]).serializeArray());
		}
		$.post(url, data, responseText => {
			const response = JSON.parse(responseText);
			if (response.status === 'ok') {
				if (response.needRedirect) {
					window.location.href = response.redirect;
				}
			} else if (response.status === 'error') {
				$.each(response.errors, (block, errors) => {
					this.error(block, errors);
				});
			}
			this.saveBtn.removeClass('btn-loading');
		})
			.fail(response => {
				this.error('main', response.responseText);
				this.saveBtn.removeClass('btn-loading');
			});

	}

	error(block, message) {
		let messageHtml = '';

		if (Array.isArray(message)) {
			if (message.length > 1) {
				messageHtml += '<ul>';
				for (let i = 0; i < message.length; i++) {
					messageHtml += '<li>' + message[i] + '</li>';
				}
				messageHtml += '</ul>';
			} else {
				messageHtml = message[0];
			}
		} else {
			messageHtml = message;
		}

		let id = 'ui-block-' + block;
		let $b = $('#' + id);
		if (!$b.length) {
			let h = '<div id="' + id + '"class="ui-error card-alert alert alert-danger mb-0" style="display: block;">';
			h += messageHtml;
			h += '</div>';
			let $card = $('.card[data-ui="' + block + '"]');
			if ($card.length) {
				$card.find('.card-body').before(h);
				$('html, body').animate({scrollTop: $('#' + id).offset().top}, 700);
			} else {
				$card = $('.card')[0];
				if ($card.length) {
					$card.find('.card-body').before(h);
					$('html, body').animate({scrollTop: $('#' + id).offset().top}, 700);
				} else {
					console.log('ui: any cards not found');
				}
			}
		} else {
			$b.html(messageHtml);
			$b.show(0);
			$('html, body').animate({scrollTop: $b.offset().top}, 700);
		}


	}
}

