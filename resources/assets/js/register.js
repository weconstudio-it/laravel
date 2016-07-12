var register = function() {
	
	this.bindEvents = function() {
		$('#country').unbind('change').bind('change', function() {
			var currency = $(this).find('option:selected').attr('data-currency');
			$('#currency').val(currency);
		});

		$('#country').trigger("change");
	};
	
	this.bindEvents();
};
