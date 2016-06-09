var popup = function(gridId) {
	
	var popup = this;

	this.bindEvents = function() {
		$('[data-interaction=update]').unbind('click').bind('click', function () {
			app.block(1);
			app.formSubmit("popup", $("[data-interaction=frmPopup]"), {}, function (data) {
				if (data.response) {
					app.href('#popup/' + data.message);
				} else {
					app.error(data.message);
				}
				app.block(0);
			}, function(){
				app.block(0);
			});
		});

		$('[data-interaction="delete"]').unbind('click').bind('click', function () {
			var id = $(this).attr("data-id");
			$.delete("popup/"+id, function(data){
				if (data.response) {
					app.href("#popup");
				} else {
					app.error(data.message);
				}
			});
		});

		$('[data-interaction=edit]').unbind('click').bind('click', function() {
			var url = $(this).attr('data-url');
			var id = $("#" + gridId).jqGrid('getGridParam', 'selrow') || 0;

			if(!id) {
				app.warning("Devi selezionare una riga");
				return;
			}

			app.href(url + "/" + id);
		});
	};
	
	this.bindEvents();
	
};