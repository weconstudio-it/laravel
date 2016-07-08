var crud = function(options) {

	this.bindEvents = function() {
		$('[data-interaction=delete]').unbind('click').bind('click', function() {
			var url = $(this).attr('data-url');
			var error = $(this).attr('data-error');
			var reload = $(this).attr('data-reload');
			var href = $(this).attr('data-href');

			app.block(1);
			$.delete(url)
				.success(function(data) {
					if(data.response) {
						if(reload) app.reload();
						if(href) app.href(href);
					} else {
						app.warning("", data.message);
					}
					app.block(0);
				})
				.error(function() {
					app.block(0);
					app.error('', 'Delete error!');
				});
		});

		$('[data-interaction=save]').unbind('click').bind('click', function(e) {
			e.preventDefault();

			var error = $(this).attr('data-error');
			var reload = $(this).attr('data-reload');
			var href = $(this).attr('data-href');

			app.block(1);
			app.formSubmit($("#" + options.form).attr("action"), $("#" + options.form), {}, function(data) {
				if(data.response) {
					app.success("", "Saved!");
					setTimeout(function() {
						if(reload) app.reload();
						if(href) app.href(href);
					}, 500);
					app.href();
				} else {
					app.warning("", data.message);
				}
				app.block(0);
			}, function() {
				app.error("", error);
				app.block(0);
			});
		});
	};

	this.bindEvents();

};