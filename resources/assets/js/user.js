var user = function(ajaxUrl) {

	this.bindEvents = function(dataTable) {
		$('[data-interaction=enable]').unbind('click').bind('click', function() {
			var id = $(this).closest('tr').attr('data-id');
			var disable = $(this).attr('data-disable');
			var url = ajaxUrl + "/enable/" + id + (disable ? "?enable=0" : "?enable=1");

			app.block(1);
			$.post(url)
				.success(function(data) {
					if(data.response) {
						app.success('User ' + (disable ? 'disabled' : 'enabled'));
						dataTable.table.draw('page');
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
