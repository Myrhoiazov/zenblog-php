const btnToggleAjax = document.querySelector('.js-trigger');

btnToggleAjax.addEventListener('click', (e) => {
	const targetEl = e.target;
	const textEl = targetEl.nextElementSibling;
	let text = {
		php: 'PHP post form',
		ajax: 'Ajax post form',
	};

	textEl.textContent = targetEl.checked ? text.ajax : text.php;
	const form = targetEl.closest('form');
	form.classList.toggle('ajax-form');
	makeAjaxRequest(form);
});

function makeAjaxRequest(form) {
	if (form.classList.contains('ajax-form')) {
		form.addEventListener('submit', async (e) => {
			e.preventDefault();

			let method = form.getAttribute('method');
			let action = form.getAttribute('action');

			const formData = new FormData(form);
			// const data = {};
			// formData.forEach((value, key) => {
			// 	data[key] = value;
			// });

			method = method.toLowerCase() === 'post' ? 'POST' : 'GET';
			console.log('method: ', method);

			try {
				const res = await fetch(action, {
					method,
					headers: {
						'X-Requested-With': 'XMLHttpRequest',
						// 'Content-Type': 'application/json',
					},
					body: formData,
				});
				const result = await res.json();
				console.log('result: ', result);
				if (result.status === 'success') {
					console.log('result: ', result);
					Swal.fire({
						icon: 'success',
						title: 'Nice job',
						showConfirmButton: false,
						timer: 1500,
					});
					form.reset();
				}
			} catch (error) {
				console.log('error: ', error);
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: error.message,
				});
			}
		});
	}
}

// --------------------- Jquery reqiest
// $(function () {
// let currentUri = location.origin + location.pathname.replace(/\/$/, '');
// $('.navbar-menu a').each(function () {
// 	let href = $(this).attr('href').replace(/\/$/, '');
// 	if (href === currentUri) {
// 		$(this).addClass('active');
// 	}
// });

// let iziModalAlertSuccess = $('.iziModal-alert-success');
// let iziModalAlertError = $('.iziModal-alert-error');

// iziModalAlertSuccess.iziModal({
// 	padding: 20,
// 	title: 'Success',
// 	headerColor: '#00897b',
// });
// iziModalAlertError.iziModal({
// 	padding: 20,
// 	title: 'Error',
// 	headerColor: '#e53935',
// });

/*let form = document.querySelector('.ajax-form2');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let res = fetch('https://fr.loc/register', {
            method: 'post',
            body: new FormData(form),
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            });
    });*/

// $('.ajax-form').on('submit', function (e) {
// 	e.preventDefault();

// 	let form = $(this);
// 	// let btn = form.find('button');
// 	// let btnText = btn.text();
// 	let method = form.attr('method');
// 	if (method) {
// 		method = method.toLowerCase();
// 	}
// 	let action = form.attr('action') ? form.attr('action') : location.href;

// 	$.ajax({
// 		url: action,
// 		type: method === 'post' ? 'post' : 'get',
// 		data: form.serialize(),
// 		// beforeSend: function () {
// 		//     btn.prop('disabled', true).text('Отправляю...');
// 		// },
// 		success: function (res) {
// 			res = JSON.parse(res);
// 			console.log('res: ', res);
// 			// if (res.status === 'success') {
// 			//     iziModalAlertSuccess.iziModal('setContent', {
// 			//         content: res.data
// 			//     });
// 			//     form.trigger('reset');
// 			//     iziModalAlertSuccess.iziModal('open');
// 			//     if (res.redirect) {
// 			//         $(document).on('closed', iziModalAlertSuccess, function (e) {
// 			//             location = res.redirect;
// 			//         });
// 			//     }
// 			// } else {
// 			//     iziModalAlertError.iziModal('setContent', {
// 			//         content: res.data
// 			//     });
// 			//     iziModalAlertError.iziModal('open');
// 			// }
// 			// btn.prop('disabled', false).text(btnText);
// 		},
// 		error: function () {
// 			alert('Error!');
// 			// btn.prop('disabled', false).text(btnText);
// 		},
// 	});
// });
// });
