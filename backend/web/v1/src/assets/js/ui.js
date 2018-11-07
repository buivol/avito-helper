/*jshint esversion: 6 */


class UIRender {
	constructor(sa, saveBtn = '#save') {
		this.saveBtn = $(saveBtn);
		this.sa = sa.mixin({
			confirmButtonClass: 'btn btn-lg btn-primary',
			cancelButtonClass: 'btn btn-lg btn-link',
			buttonsStyling: false
		});
		$('.ui-nav').css('cursor', 'pointer').on('click', function (e) {
			e.preventDefault();
			let href = $(this).data('href');
			if (href.length) {
				window.location.href = href;
			}
		});

		$('.ui-sibl-parent').on('change', function (e) {
			$(this).prop('indeterminate', false);
			$('.ui-sibl-child[data-sibl="' + $(this).data('sibl') + '"]').prop({
				indeterminate: false,
				checked: $(this).prop("checked")
			});
			$(this).trigger('sibl-change');
		});

		$('.ui-sibl-child').on('change', function (e) {
			const $_this = $(this);
			const checked = $_this.prop("checked");
			const id = $_this.data('sibl');
			let all = true;
			$('.ui-sibl-child[data-sibl="' + id + '"]').each(function () {
				return all = ($(this).prop("checked") === checked && all);
			});
			$('.ui-sibl-parent[data-sibl="' + $(this).data('sibl') + '"]').prop({
				indeterminate: !all,
				checked: all ? checked : false
			});
			$(this).trigger('sibl-change');
		});

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

	api({url, data = false, success = false, error = false, method = "post", block = "", eid = 0}) {
		$('.ui-error').hide(0);
		data = data ? data : {};
		const requestData = {[this.param]: this.token, ...data};
		$.ajax({
			type: method,
			url: '/api/' + url,
			data: requestData,
			success: (msg) => {
				if (success !== false) {
					success(msg);
				}
				const response = JSON.parse(msg);
				if (response.status === 'ok') {
					if (response.needRedirect) {
						window.location.href = response.redirect;
					}
				} else if (response.status === 'error') {
					$.each(response.errors, (block, errors) => {
						this.error(block, errors, eid);
					});
				}
			},
			error: (jqXHR, exception) => {
				let msg = jqXHR.responseText;
				if (error) {
					error(msg);
				} else {
					this.error(block, msg, eid);
				}
			}
		});
	}

	error(block = '', message = 'Ошибка', eid = 0) {
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

		let id = 'ui-block-' + block + '-' + eid;
		let $b = $('#' + id);
		if (!$b.length) {
			let h = '<div id="' + id + '"class="ui-error card-alert alert alert-danger mb-0" style="display:block;">';
			h += messageHtml;
			h += '</div>';
			let $card = null;
			if (eid) {
				$card = $('.card[data-ui="' + block + '"]');
			} else {
				$card = $('.card[data-ui="' + block + '"][data-id="' + eid + '"]');
			}
			if ($card.length) {
				let $cardBody = $card.find('.card-body');
				if (!$cardBody.length) {
					$cardBody = $card.find('.c-body');
				}
				$cardBody.before(h);
				$('html, body').animate({scrollTop: $('#' + id).offset().top}, 700);
			} else {
				const $card = $('.card:first');
				if ($card.length) {
					$card.find('.card-body').before(h);
					$('html, body').animate({scrollTop: $('#' + id).offset().top}, 700);
				} else {
					this.alert(messageHtml)
				}
			}
		} else {
			$b.html(messageHtml);
			$b.show(0);
			$('html, body').animate({scrollTop: $b.offset().top}, 700);
		}
	}

	question({title = 'Подтверждение', yes = 'Да, сделать это', no = 'Нет, отменить', message = 'Вы уверены, что хотите это сделать', success = false, onsuccess = false, cancel = false, oncancel = false}) {
		this.sa({
			title: title,
			text: message,
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: yes,
			cancelButtonText: no,
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				let successTitle = 'Готово',
					successMessage = 'Это сделано';
				if (onsuccess !== false) {
					onsuccess();
				}
				if (success !== false) {
					successTitle = (typeof success.title !== 'undefined') ? success.title : successTitle;
					successMessage = (typeof success.message !== 'undefined') ? success.message : successMessage;
					this.sa(
						successTitle,
						successMessage,
						'success'
					).then((res) => {

					})
				}

			} else if (
				// Read more about handling dismissals
				result.dismiss === this.sa.DismissReason.cancel
			) {
				let cancelTitle = 'Отменено',
					cancelMessage = 'Действие не было выполнено'
				if (cancel !== false) {
					cancelTitle = (typeof cancel.title !== 'undefined') ? cancel.title : cancelTitle;
					cancelMessage = (typeof cancel.message !== 'undefined') ? cancel.message : cancelMessage;
					this.sa(
						cancelTitle,
						cancelMessage,
						'error'
					).then((res) => {
						if (oncancel !== false) {
							oncancel();
						}
					})
				} else {
					if (oncancel !== false) {
						oncancel();
					}
				}
			}
		});
	}

	alert(message) {
		this.sa({
			text: message,
			type: 'error',
			confirmButtonText: 'Понятно'
		});
	}

	test(message) {
		this.sa('Хуй пизда джигруда');
	}
}

