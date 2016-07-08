var user = function() {

	this.bindEvents = function() {
		$('[data-interaction=enable]').unbind('click').bind('click', function() {
			var id = $(this).closest('tr').attr('data-id');
			var disable = $(this).attr('data-disable');
			var url = dt.ajaxUrl + "/enable/" + id + (disable ? "/0" : "");

			app.block(1);
			$.post(url)
				.success(function(data) {
					if(data.response) {
						app.success('User ' + (disable ? 'disabled' : 'enabled'));
						app.reload();
					} else {
						app.warning('', data.message);
					}
					app.block(0);
				})
				.error(function() {
					app.block(0);
					app.error('', 'Unable to enable User!');
				});
		});
	};

	this.bindEvents();

};
