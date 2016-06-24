var app = {
	baseUrl: undefined,
	default_url: undefined,
	errorPage: undefined,
	init: function(default_url) {
		errorHandler.init();

		app.default_url = default_url || 'dashboard';

		if(app.baseUrl) {
			app.default_url_error = app.baseUrl + "/error";
			$.get(app.default_url_error)
				.success(function(data) {
					app.errorPage = data;
				});
		}

		app.runBind();

		app.initKeepalive();



		// Laravel CSRF protection
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		// ACE Ajax manager
		$('#page-content-section').
			ace_ajax({
				content_url: function(hash) {

					//debugger

					//hash is the value from document url hash
					//take "url" param and return the relevant url to load
					return hash;
				},
				default_url: app.default_url,
				loading_icon: "fa fa-cog fa-2x blue fa-spin"
			})
			.on('ajaxloadcomplete', function(e, params) {
				app.runBind();
			})
			.on('ajaxloaderror', function() {
				// recupero una pagina di errore e la mostra
				$("#page-content-section").html(app.errorPage);
			});

	},

	initKeepalive: function () {
		// window.setInterval(function () {
		// 	$.post("?p=server&a=keepalive", function (data) {
		// 		if (!data.response)
		// 			app.reload();
		// 	});
		// }, 3 * 60 * 1000);
	},

	/**
	 * Aggiunge N scripts alla pagina
	 *  es: getMultiScripts(aScripts).done(function(){...});
	 * @param arr
	 * @param path
	 * @returns {*}
	 */
	getMultiScripts: function(arr, path) {
		var _arr = jQuery.map(arr, function(scr) {
			return jQuery.getScript( (path||"") + scr );
		});
	
		_arr.push(jQuery.Deferred(function( deferred ){
			jQuery( deferred.resolve );
		}));
	
		return jQuery.when.apply(jQuery, _arr);
	},
	
	/**
	 *
	 * @param nome
	 * @param cognome
	 * @param comune
	 * @param provincia
	 * @param dataNascita
	 * @param sesso: M|F
	 * @param callback
	 */
	calcoloCodiceFiscale: function (nome, cognome, comune, provincia, dataNascita, sesso, stato, callback) {

		if (nome == "") {
			app.warning("", "Campo vuoto 'nome'");
			return;
		}
		if (cognome == "") {
			app.warning("", "Campo vuoto 'cognome'");
			return;
		}

		if (comune == "" && provincia != "ES") {
			app.warning("", "Campo vuoto 'comune'");
			return;
		}
		if (provincia == "") {
			app.warning("", "Campo vuoto 'provincia'");
			return;
		}
		if (dataNascita == "") {
			app.warning("", "Campo vuoto 'dataNascita'");
			return;
		}
		if (sesso == "") {
			app.warning("", "Campo vuoto 'sesso'");
			return;
		}

		stato = stato || "";

		$.post("?p=server&a=calcolaCodiceFiscale", {
			nome: nome,
			cognome: cognome,
			data: dataNascita,
			comune: comune,
			provincia: provincia,
			sesso: sesso,
			stato: stato
		}, function (data) {
			if (data.response) {
				if (typeof callback == 'function') {
					callback(data.message);
				} else {
					app.warning("", "Callback mancante");
					console.log(data.message);
				}
			}

		}).error(function () {
			app.error('Errore durante la chiamata calcolaCodiceFiscale');
		});
	},

	initAutocomplete: function () {

		$('[data-autocomplete]').each(function () {
			var tipo = $(this).attr('data-autocomplete');

			var url = $(this).attr('data-url');
			url = url || "geoname";

			if($.trim($(this).html()) === "") { // così posso partire con una option già selezionata
				$(this).html("<option></option>");
			}

			$(this).ajaxChosen({
				type: 'GET',
				url: app.baseUrl + "/" + url + "/" + tipo,
				dataType: 'json'
			}, function (data) {
				var results = [];

				$.each(data, function (i, val) {
					results.push({ value: val.value, text: val.text });
				});

				return results;
			}, {allow_single_deselect: true});
		});

		$('[data-autocompleteui]').each(function () {

			var tipo = $(this).attr('data-autocomplete');

			var itemOptional = $(this).attr('data-itemopzionale');
			itemOptional = itemOptional || 0;

			var url = $(this).attr('data-url');
			url = url || "geoname";
			
			var callback = $(this).attr('data-callback');

			function getTextValueFromResponseAutocomplete(obj) {

				if (typeof obj.txt != 'undefined')
					return obj.txt;

				return "";
			}

			$(this).autocomplete({
				source: function (request, response) {
					$.getJSON(url + "/" + tipo + "/" + request.term, function (data) {
						response($.map(data.message, function (value, key) {

							var textValue = "";
							if (typeof value == 'string') {
								textValue = value;
							} else {
								if (typeof value == 'object') {
									textValue = getTextValueFromResponseAutocomplete(value);
								}
							}

							return {
								label: textValue,
								obj: value,
								value: key
							};
						}));
					});
				},
				minLength: 0,
				select: function (event, ui) {
					var textValue = "";

					if (typeof ui.item.obj == 'object') {
						textValue = getTextValueFromResponseAutocomplete(ui.item.obj);
					} else {
						textValue = ui.item.label;
					}

					$(this).val(textValue);

					$(this).attr('data-id', ui.item.value);

					if (callback) {
						functionCallBack = eval(callback);
						if (typeof functionCallBack == 'function') {
							functionCallBack($(this), tipo, ui.item);
						} else {
							console.warn("Callback non trovata: " + callback);
						}
					}

					return false;
				},
				change: function (event, ui) {
					if (ui.item) {
						// valido
						$(this).val(ui.item.label);
						$(this).attr('data-id', ui.item.value);
					} else {
						if (!itemOptional) {
							$(this).attr('data-id', 0);
							$(this).val('');
						}
					}
				},
			});
		});
	},

	runBind: function () {
		// inizializzazione timepicker in italiano

		if (jQuery.datetimepicker) {
			jQuery.datetimepicker.setLocale('it');
		}

		// TODO: mettere nel bower.json inputmask
		// $(".euro").inputmask('decimal', {digits: 2});

		/* inizializzazione editor descrizione */
		$('.wysiwyg-editor').each(function () {
			var editor = $(this).ace_wysiwyg({
				toolbar: [
					'font',
					null,
					'fontSize',
					null,
					{name: 'bold', className: 'btn-info'},
					{name: 'italic', className: 'btn-info'},
					{name: 'strikethrough', className: 'btn-info'},
					{name: 'underline', className: 'btn-info'},
					null,
					{name: 'insertunorderedlist', className: 'btn-success'},
					{name: 'insertorderedlist', className: 'btn-success'},
					{name: 'outdent', className: 'btn-purple'},
					{name: 'indent', className: 'btn-purple'},
					null,
					{name: 'justifyleft', className: 'btn-primary'},
					{name: 'justifycenter', className: 'btn-primary'},
					{name: 'justifyright', className: 'btn-primary'},
					{name: 'justifyfull', className: 'btn-inverse'},
					null,
					{name: 'createLink', className: 'btn-pink'},
					{name: 'unlink', className: 'btn-pink'},
					null,
					null,
					null,
					'foreColor',
					null,
					{name: 'undo', className: 'btn-grey'},
					{name: 'redo', className: 'btn-grey'}
				],
				'wysiwyg': {
					/* fileUploadError: showErrorAlert */
				}
			}).prev().addClass('wysiwyg-style2');

			if ($(this).hasClass("wysiwyg-editor-disabled"))
				$(this).attr("contenteditable", "false");
		});

		$(".datepicker").datetimepicker({
			dayOfWeekStart: 1,
			// mask: true,
			format: "d/m/Y",
			closeOnDateSelect: true,
			timepicker: false,
			scrollInput: false
		}); //TODO impostare lingua e mettere data di default

		var date = new Date(2016, 01, 01, 06, 45, 00), interval = 15, arrTime = [];
		for (var i = 0; i < (12 * 4); i++) {
			date.setMinutes(date.getMinutes() + interval);
			arrTime.push(date.getHours() + '.' + date.getMinutes());
		}

		$(".datetimepicker").datetimepicker({
			dayOfWeekStart: 1,
			// mask: true,
			format: "d/m/Y H:i",
			step: 30,
			closeOnTimeSelect: true,
			scrollInput: false,
			allowTimes: arrTime
		});

		$("[data-interaction=dropzone]").each(function () {
			var url = $(this).attr("data-url");
			var parameters = $(this).attr("data-parameters") || "";
			var callback = $(this).attr("data-callback") || null;

			if(!$(this).attr('dropzoned')) {
				$(this).attr('dropzoned', 'true');

				$(this).dropzone(
					{
						url: url + parameters,
						headers: $.ajaxSetup().headers,
						previewTemplate : '<div style="display:none"></div>',
						success: function (file, data) {
							app.blockUI(0);
							$('.dz-preview').detach();

							if(callback) {
								functionCallBack = eval(callback);
								if (typeof functionCallBack == 'function') {
									functionCallBack($(this), data);
								}else{
									console.warn("Callback non trovata: " + callback);
								}
							}

						},
						error: function () {
							app.blockUI(0);
							app.error("Errore in fase di caricamento");
						}
					}
				);
			}
		});

		app.initAutocomplete();

	},

	locationHref: function (url, withBlank) {

		withBlank = withBlank || 0;

		//if (noBlockUI == 0)
		//	app.blockUI(true);

		url = url.replace("#", "");
		if(url.indexOf(app.baseUrl) < 0) {
			if(url[0] == "/") url = url.substring(1, url.length);
			url = app.baseUrl + "/" + url;
		}

		if (withBlank == 1) {
			window.open(
				url,
				'_blank'
			);
			//app.blockUI(false);
		}
		else {
			// se non è stato aggiunto base_url lo aggiungo in automatico
			if(document.URL.replace("#", "") == url) {
				app.reload();
			} else {
				window.location.href = url;
			}
		}

	},

	href: function (url) {
		app.locationHref(url);
	},

	block: function (blk) {
		if (blk) {
			// BlockUI
			$.blockUI({
				message: 'CARICAMENTO IN CORSO...',
				css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					'border-radius': '10px',
					opacity: .8,
					color: '#fff'
				}
			});
		} else {
			$.unblockUI();
		}
	},

	location: function (location) {
		app.block(1);
		window.location.href = location;
	},

	reload: function () {
		app.blockUI(true);

		// AJAX
		$('#page-content-section').ace_ajax("reload");

		app.blockUI(false);
	},

	setLoading: function (active) {

	},

	/**
	 * Mostra un confirm
	 */
	requestConfirm: function (title, message) {

		var passVerificata = false;

		if (confirm(message)) {

			var password = prompt("Inserire la password di conferma");

			if ($.trim(password) != "") {
				$.ajax({
					type: "POST",
					url: "?p=server&a=checkPassword",
					async: false,
					data: "password=" + password,
					success: function (data) {

						if (data.response) {
							passVerificata = true;
						} else {
							app.error(data.message);
						}

					}

				});
			}
		}

		return passVerificata;
	},

	/**
	 * Mostra un GRITTER messaggio di warning
	 */
	warning: function (title, message) {
		$.gritter.add({
			title: title,
			text: message,
			class_name: 'gritter-warning'
		});
	},

	/**
	 * Mostra un GRITTER messaggio di error
	 */
	error: function (title, message) {
		$.gritter.add({
			title: title,
			text: message,
			class_name: 'gritter-error',
		});
	},

	/**
	 * Mostra un GRITTER messaggio di successo
	 */
	success: function (title, message) {
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: title,
			// (string | mandatory) the text inside the notification
			text: message,
			class_name: 'gritter-success'
		});
	},

	blockUI: function (blk, message) {
		if (app.dontBlock)
			return;

		if (blk) {
			// BlockUI
			$.blockUI({
				message: message || "Caricamento in corso",
				css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					'border-radius': '10px',
					opacity: .8,
					color: '#fff'
				}
			});
		} else {
			$.unblockUI();
		}
	},
	dontBlock: false,

	autocomplizer: function (objSelect, idNewObject, funcSelect, funcNothingSelected, funcBeginWithSelected, myClass) {

		var hasOptionSelected = objSelect.find('option:selected').length;
		if (hasOptionSelected != 0) {
			var selectedText = objSelect.find('option:selected').text();
			var selectedValue = objSelect.find('option:selected').val();
		}

		if (!myClass)
			myClass = objSelect.attr("class");

		var autoc = $("<input type='text' class='" + myClass + "' id='" + idNewObject + "'>");
		var aVal = [];
		objSelect.find('option').each(function (index, obj) {
			aVal.push({
				id: $(obj).val(),
				value: $(obj).text()
			});
		})

		objSelect.replaceWith(autoc);

		var hidden_original = $("<input type='hidden' id='" + objSelect.attr('id') + "' name='" + objSelect.attr('name') + "'>");
		autoc.parent().append(hidden_original);

		if (!funcSelect) {
			funcSelect = function (id, value) {
				$("#" + idNewObject).val(value);
				hidden_original.val(id);
			};
		}
		if (!funcNothingSelected) {
			funcNothingSelected = function () {
				hidden_original.val(0);
			};
		}
		if (!funcBeginWithSelected) {
			funcBeginWithSelected = function (text, value) {
				$("#" + idNewObject).val(text);
				hidden_original.val(value);
			};
		}

		if (hasOptionSelected != 0) {
			funcBeginWithSelected(selectedText, selectedValue);
		}

		$('#' + idNewObject).autocomplete({
			source: aVal,
			focus: function () {
				$(this).trigger('keydown.autocomplete');
			},
			select: function (event, ui) {
				funcSelect(ui.item.id, ui.item.value);
				event.preventDefault();
				return false;
			},
			change: function (event, ui) {
				if (ui.item == null)
					funcNothingSelected();
			},
		});
	},
	setLanguage: function (shortCode) {
		$.cookie('app_language', shortCode);
	},
	screenshotPreview: function () {

		xOffset = 10;
		yOffset = 30;

		$("a.imagePreview").hover(function (e) {
				this.t = this.title;
				this.title = "";
				var c = (this.t != "") ? "<br/>" + this.t : "";
				$("body").append("<p id='imagePreview'><img src='" + this.rel + "' alt='Preview' />" + c + "</p>");
				$("#imagePreview")
					.css("top", (e.pageY - xOffset) + "px")
					.css("left", (e.pageX + yOffset) + "px")
					.fadeIn("fast");
			},
			function () {
				this.title = this.t;
				$("#imagePreview").remove();
			});
		$("a.imagePreview").mousemove(function (e) {
			$("#imagePreview")
				.css("top", (e.pageY - xOffset) + "px")
				.css("left", (e.pageX + yOffset) + "px");
		});
	},

	platform: {
		detection: function () {
			if (navigator.platform.indexOf("iPad", 0) >= 0)
				return ("ios");
			else if (navigator.platform.indexOf("iPhone", 0) >= 0)
				return ("ios");
			else if (navigator.userAgent.indexOf("Android", 0) >= 0)
				return ("android");
			else
				return "desktop";
		},
		deviceType: function () {
			if (navigator.platform.indexOf("iPad", 0) >= 0)
				return ("tablet");
			else if (navigator.platform.indexOf("iPhone", 0) >= 0)
				return ("phone");
			else if (navigator.userAgent.indexOf("Android", 0) >= 0) {
				if (navigator.userAgent.indexOf("Mobile", 0) >= 0)
					return ("phone");
				else
					return ("tablet");
			}
			else
				return "tablet";
		},
		isMobile: function () {
			return app.platform.detection() != "desktop";
		}
	},
	
	formSubmit: function(url, form, params, success, error) {
		success = success || function() {};
		error = error || function() {};
		form = form || undefined;
		var $form = form;
		if(!form){
			app.warning("form undefined");
			return;
		}

		if(typeof form == 'string')
			$form = $(form);
		else
			$form = form; //oggetto

		var $method = null;
		if($form.attr("data-id") && $form.attr("data-id") > 0){
			$method = $.put;
			url += "/" + $form.attr("data-id");
		}else{
			$method = $.post;
		}

		$form.find('.error-block').removeClass('show');

		var aParam = lib.formSerialize($form);
		aParam = $.extend({}, aParam, params);

		$method(url, aParam)
			.success(function(data) {
				success(data);
			})
			.error(function(data) {
				if(data.status = 422) {
					var errors = data.responseJSON;
					Object.keys(errors).forEach(function(k) {
						var $error = undefined;
						var name = k;
						if(k.indexOf(".") > -1) {
							// l'elemento è un array
							name = k.replace(".", "[") + "]";
						}
						if($form.find('[data-name="' + name + '"]').length > 0) {
							$error = $form.find('[data-name="' + name + '"]');
							$error.html(errors[k]);
							$error.addClass('show');
						} else {
							// lo spazio per mostrare l'errore non c'è. Lo creo
							var $field = $('[name="' + name + '"]');
							if($field) {
								var $parent = $field.parent();
								$error = $('<span class="error-block show" data-name="' + name + '">' + errors[k] + '</span>');
								$parent.append($error);
							}
						}
					});
				}
				error(data);
			});
	}
};

/**
 * Estensione jquery per metodi put e delete ajax
 */
jQuery.each( [ "put", "delete" ], function( i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {
		if ( jQuery.isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}
		
		return jQuery.ajax({
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		});
	};
});

var lib = {
	dataPrintTrue: "þ",
	dataPrintFalse: "¨",
	/**
	 * Converte un array di parameteri in formato p1=1&p2=2... in un oggetto json
	 */
	convertGetParamInJSON: function (stringParameters) {
		var hash;
		var ret = {};
		var hashes = stringParameters.split('&');
		for (var i = 0; i < hashes.length; i++) {
			hash = hashes[i].split('=');
			if (typeof hash[0] != "undefined") {
				ret[hash[0]] = (typeof hash[1] != "undefined") ? hash[1] : "";
			}

		}
		return ret;
	},

	/**
	 * Da utilizzare sul form - submit
	 */
	formSerialize: function (form, print) {

		var o = {};
		var a = form.serializeArray();
		// fix x aggiungere anche i check deselezionati
		a = a.concat(
			form.find('input[type=checkbox]:not(:checked)').map(
				function () {
					return {"name": this.name, "value": 0}
				}).get()
		);

		$.each(a, function () {

			var value = this.value;

			var procedi = true;

			if (form.find('[name="' + this.name + '"]').attr('type') == 'checkbox') {

				if (this.value == 'on' || parseInt(this.value) == 1) {
					value = 1;
				} else {
					value = 0;
				}

				if (typeof form.find('[name="' + this.name + '"]').attr('data-returnvalue') != "undefined") {
					if (value == 0)
						procedi = false;

					value = form.find('[name="' + this.name + '"]').attr('data-returnvalue');
				}

				if (print) {
					value = form.find('[name="' + this.name + '"]').is(":checked") ? lib.dataPrintTrue : lib.dataPrintFalse;
				}
			}

			if (procedi) {
				if (o[this.name] !== undefined) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}
					o[this.name].push((value == undefined) ? "" : value);
				} else {
					o[this.name] = (value == undefined) ? "" : value;
				}
			}
		});

		return o;
	},

	queryStringSerialize: function (obj) {
		var str = [];
		for (var p in obj)
			if (obj.hasOwnProperty(p)) {
				str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
			}
		return str.join("&");
	},

	/**
	 * Copia gli attributi di un elemento dentro un altro
	 */
	copyAttributesToOtherElement: function (elemOrig, elemDest) {
		var attributes = elemOrig.prop("attributes");

		// loop through <select> attributes and apply them on <div>
		$.each(attributes, function () {
			elemDest.attr(this.name, this.value);
		});
	},

	today: function () {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1; //January is 0!
		var yyyy = today.getFullYear();

		if (dd < 10) {
			dd = '0' + dd;
		}

		if (mm < 10) {
			mm = '0' + mm;
		}

		return mm + '/' + dd + '/' + yyyy;
	}

};

var loader = {
	download: function (show, text) {
		show = show || 0;
		var modalId = "#modalLoader";
		if (show) {
			text = text || "Generazione del documento in corso...";
			text = "<h3 style='text-align:center'><i class='ace-icon fa fa-spinner fa-spin orange bigger-125' ></i> " + text + "</h3>";
			$(modalId + ' h4.modal-title').html('Attendere...');
			$(modalId + ' .modal-body').html(text);
			$(modalId + ' .btn-primary').hide();
			$(modalId + ' .btn-default').text('Chiudi');

			$(modalId + ' .btn-default').unbind("click").bind('click', function () {
				$(modalId + ' .close').trigger('click');
			});

			$(modalId).modal('show');
		} else {
			$(modalId + ' .close').trigger('click');
		}
	}
};
/**
 * TODO Implementare l'error handler per le chiamate ajax
 * @type {{xhr: eh.xhr}}
 */
var errorHandler = {

    init:function(){
        $(document).ajaxComplete(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
            //console.log(xhr);
            switch (xhr.status){
				case 200:
                    break;
				// case 404:
				// 	$("#page-content-section").html(xhr.responseText);
				// 	break;
                case 401:
                    app.href("/login");
                    break;
                default:
                    console.log("ErrorHandler ... error status: " + xhr.status);
            }
        });
    },

}
var grid = {
	init: function(obj, columns, grid_id){
		grid.gridSelector = obj.selector;

		// modello colonne
		var colModel = [];

		// numero di righe
		var rowNum =  obj.attr('data-pager-rowNum') || 20;

		// oggetto paginatore
		var pager = obj.attr('data-pager-selector') || null;

		/**
		 * Attivazione raggruppamenti
		 * @type {*|boolean}
		 */
		var url = obj.attr('data-url') || false;
		var grouping = obj.attr('data-grouping') || false;
		var forceParams = obj.attr("data-forceParams") || "";
		var subGrid = obj.attr('data-subgrid') || false;
		var addRecord = obj.attr('data-add') || false;
		var editRecord = obj.attr('data-edit') || false;
		var deleteRecord = obj.attr('data-delete') || false;
		var refreshRecord = obj.attr('data-refresh') || false;
		var viewRecord = obj.attr('data-view') || false;
		var searchRecord = obj.attr('data-search') || false;
		var multiselect = obj.attr('data-multi-select') || obj.attr('data-multiselect') || obj.attr('data-multiSelect') || false;
		var inlineActions = obj.attr('inline-actions') || obj.attr('data-inline-actions') || false;
		var autoInlineEdit = obj.attr('data-auto-inline-edit') || false;
		var disableInlineDelete = obj.attr('disable-inline-delete') || false;
		var disableInlineEdit = obj.attr('disable-inline-edit') || false;
		var hideFilters = obj.attr('data-hide-filters') || false;

		if (inlineActions) {
			colModel.push({
				label: ' ',
				formatter: 'actions',
				width: '50px',
				formatoptions: {
					delbutton: !disableInlineDelete,
					editbutton: !disableInlineEdit
				},
				editable: false,
				search: false,
				align: 'center'
			});
		}

		// definizione colmodel (json_encode in un array di oggetti)
		$.each(columns, function(index, obj){
			obj.name = index;

			// conversione datepicker
			if(typeof obj.classes != 'undefined' && obj.classes.indexOf('datepicker') != -1){
				grid.elementDatepicker.push(index);
			}

			// conversione datetimepicker
			if(typeof obj.classes != 'undefined' && obj.classes.indexOf('datetimepicker') != -1){
				grid.elementDatetimepicker.push(index);
			}

			// conversione autocomplete
			if(typeof obj.classes != 'undefined' && obj.classes.indexOf('autocomplete') != -1){
				grid.elementAutocomplete.push(index);
			}

			colModel.push(obj);
		});

		var subGridStatus = subGrid != false;

		// gestione grouping
		var groupingStatus = grouping != false;
		var groupField = [];
		var groupColumnShow = [];
		var groupCollapse = false;

		if(groupingStatus){
			groupCollapse = true;	// TODO gestire

			$.each(grouping.split('|'), function(index, obj){
				groupField.push(obj);
				groupColumnShow.push(false);
			});
		}

		grid.resizeArray.push(grid.gridSelector);

		var curGridSelector = grid.gridSelector;
		var curGridLastSelectedRow = grid.lastSelectedRow;

		obj.jqGrid({
			url:				url + '?data=1&grid_id=' + grid_id + forceParams,
			editurl:			url + '/operation/' + grid_id + '?' + forceParams,
			mtype:				'GET',
			datatype: 			'json',
			colModel:			colModel,
			viewrecords:		true,
			add:				addRecord,
			height:             'auto',
			rowNum:             rowNum,
			pager:              pager,
			autowidth:          true,
			shrinkToFit: 		true,
			grouping:           groupingStatus,
			groupingView: {
				groupCollapse:  groupCollapse,
				groupField:     groupField,
				groupColumnShow:groupColumnShow
			},
			multiselect:        multiselect,
			subGrid:            subGridStatus,
			subGridOptions:		{
				plusicon: 'fa fa-plus',
				minusicon: 'fa fa-minus'
			},
			onSelectRow: function(id){
				var saveCurrentRow = function(callback, restore) {
					var bRestore = restore || false;

					$(curGridSelector).saveRow(curGridLastSelectedRow, function(data){

						if (bRestore) {
							//$(curGridSelector).restoreRow(curGridLastSelectedRow);
							$(curGridSelector).triggerHandler("jqGridAfterGridComplete");
						}

						callback();

						return true;
					});
				};

				if (autoInlineEdit == false)
					return;

				if(id && id !== curGridLastSelectedRow) {
					if (curGridLastSelectedRow != null) {
						saveCurrentRow(function(){
							// on success
						});
					}

					$(curGridSelector).editRow(id, true, function(){}, function(){
						return true;
					});

					curGridLastSelectedRow = id;
					grid.lastSelectedRow = id;
				}
			},
			subGridRowExpanded: function(subgrid_id, row_id) {
				$('#' + subgrid_id).html("<i id='commandSpinner' class='ace-icon fa fa-spinner fa-spin black bigger-125'></i>");
				$('#' + subgrid_id).load(obj.attr("data-subgrid") + "&row_id=" + row_id);
			},
			loadComplete: function(data){
				if(groupingStatus){
					grid.bindClickRowGrouped(grid.gridSelector);
				}

				obj.find(".ui-inline-edit").bind("click", function(){

					var riga = $(this).closest("tr");

					$.each(columns, function(index, obj){

						// conversione datepicker
						if(typeof obj.classes != 'undefined' && obj.classes.indexOf('datepicker') != -1){
							//riga.find("[name='" + obj.name + "']").datepicker({format:'dd/mm/yyyy', autoclose: true}); //, language: "it"});
							riga.find("[name='" + obj.name + "']").datetimepicker(grid.datepickerOptions);
						}
						if(typeof obj.classes != 'undefined' && obj.classes.indexOf('datetimepicker') != -1){
							riga.find("[name='" + obj.name + "']").datetimepicker(grid.datetimepickerOptions);
						}

					});

				});

				// autocompletizer
				if(grid.elementAutocomplete.length) {
					$.each(grid.elementAutocomplete, function (index, nome) {
						var cbo = obj.parents("[role=grid]").find(".ui-search-input [name=" + nome + "]");

						// conversione in combobox
						cbo.combobox();
						cbo.bind('change', function () {
							obj.triggerToolbar();
						});
					});
				}

				obj.find(".ui-inline-cancel").bind("click", function() {
					$(grid.gridSelector).trigger("reloadGrid");
				});

				obj.find(".ui-inline-save").bind("click", function() {
					$(grid.gridSelector).trigger("reloadGrid");
				});

				var functionName = obj.attr('data-oncomplete');
				if (typeof functionName == 'undefined')
					return;

				if (typeof window[functionName] == 'function') {
					window[functionName](obj, data);
				} else {
					var error=false;
					if(functionName.indexOf('.')!=-1){
						objArray = functionName.split('.');
						if(typeof window[objArray[0]] == 'object' && typeof window[objArray[0]][objArray[1]] == 'function'){
							window[objArray[0]][objArray[1]](obj, data);
						}else{
							error = true;
						}
					}else{
						error = true;
					}

					if(error){
						console.error('Invalid handler: ' + functioName);
					}
				}
			}
		});

		$('.ui-search-clear').detach();

		if (!hideFilters)
			obj.jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false, defaultSearch: 'cn' });

		obj.navGrid(pager,
			{
				edit: editRecord,
				add: addRecord,
				del: deleteRecord,
				refresh: refreshRecord,
				view: viewRecord,
				search: searchRecord,
				editicon : 'ace-icon fa fa-pencil blue',
				addicon : 'ace-icon fa fa-plus-circle purple',
				delicon : 'ace-icon fa fa-trash-o red',
				searchicon : 'ace-icon fa fa-search orange',
				refreshicon : 'ace-icon fa fa-refresh green',
				viewicon : 'ace-icon fa fa-search-plus grey'
			},
			{
				closeAfterEdit: true,
				afterShowForm: function(form) {
					grid.callbackLoadFormEditComplete();
				},
				afterSubmit: function(response, postData) {
					if (!response.responseJSON.response) {
						return [false, response.responseJSON.message];
					}

					return [true, response.responseJSON.message];
				}
			},
			{
				'url': url + '/operation/' + grid_id,
				closeAfterAdd: true,
				afterShowForm: function(form) {
					grid.callbackLoadFormEditComplete();
				}
			},
			{
				'url': url + '/operation/' + grid_id,
				beforeShowForm: function(form) { }
			},
			{
				afterShowSearch: function(form) { }
			}
		);
	},
	bindClickRowGrouped: function(obj){
		$(obj).bind('click',(function (e) {
			var $target = $(e.target),
				$groupHeader = $target.closest("tr.jqgroup");
			if ($groupHeader.length > 0) {
				if (e.target.nodeName.toLowerCase() !== "span" ||
					(!$target.hasClass(plusIcon) && !$target.hasClass(minusIcon))) {

					$(this).jqGrid("groupingToggle", $groupHeader.attr("id"));
					return false;
				}
			}
		}));
	},
	resizeManager: function() {
		$.each(grid.resizeArray, function(index, item){
			if ($('.page-container').length > 0)
				$(item).setGridWidth($('.page-container').width());
			else if ($('.page-content').length > 0) {
				$(item).setGridWidth($('.page-content').width());
			}
			else
				$(item).setGridWidth($('window').width());
		});
	},
	getSelectedItems: function(gridId){
		return $("#" + gridId).getGridParam('selarrrow');
	},
	callbackLoadFormEditComplete: function(){

		$.each(grid.elementDatepicker, function(index,nome){
			//$("#" + nome).datepicker({format:'dd/mm/yyyy', autoclose: true}); //, language: "it"});
			$("#" + nome).datetimepicker(grid.datepickerOptions);
		});

		$.each(grid.elementDatetimepicker, function(index,nome){
			$("#" + nome).datetimepicker(grid.datetimepickerOptions);
		});

		$.each(grid.elementAutocomplete, function (index, nome) {

			$("#" + nome).chosen({allow_single_deselect:true});

			$(window)
				.off('resize.chosen')
				.on('resize.chosen', function() {
					$("#" + nome).each(function() {
						var $this = $(this);
						$this.next().css({'width': $this.parent().width()});
					})
				}).trigger('resize.chosen');

			//resize chosen on sidebar collapse/expand
			$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
				if(event_name != 'sidebar_collapsed') return;
				$("#" + nome).each(function() {
					var $this = $(this);
					$this.next().css({'width': $this.parent().width()});
				})
			});

		});

	},
	gridSelector: "",
	resizeArray: [],
	elementDatepicker: [],
	elementDatetimepicker: [],
	elementAutocomplete: [],
	datetimepickerOptions: {
		mask: true,
		format: "d/m/Y H:i:s",
		step: 30,
		closeOnTimeSelect: true,
		scrollInput:false
	},
	datepickerOptions: {
		mask: true,
		format: "d/m/Y",
		closeOnDateSelect: true,
		timepicker: false
	},
	lastSelectedRow: null
};

$(window).bind('resize', function() { grid.resizeManager(); }).trigger('resize');
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
var weconsPopupper = {
    /**
     * Aggiunge N scripts alla pagina
     *  es: getMultiScripts(aScripts).done(function(){...});
     * @param arr
     * @param path
     * @returns {*}
     */
    getMultiScripts: function (arr, path) {
        var _arr = jQuery.map(arr, function (scr) {
            return jQuery.getScript((path || "") + scr);
        });

        _arr.push(jQuery.Deferred(function (deferred) {
            jQuery(deferred.resolve);
        }));

        return jQuery.when.apply(jQuery, _arr);
    },

    popupWeconsClick: function(obj) {
        // chiusura popup
        jQuery.unblockUI();

        // invio richiesta google analytics per click
        if (typeof ga != 'undefined')
            ga('send', 'event', 'bannerPopupClick', jQuery(obj).attr('title'), jQuery(obj).attr('href'));
        else
            console.log(['bannerPopupClick', jQuery(obj).attr('title'), jQuery(obj).attr('href')]);

    },

    runPopupWecons: function(testForceOpen) {

        testForceOpen = testForceOpen || 0;

        // verifico di non aver già recuperato il popup nella sessione corrente
        if (!Cookies.get('popupWeconsAlreadyOpened')) {
            jQuery.get(weconsPopupper.sourceUrl + 'popup/last')
                .success(function (data) {

                    if (data) {

                        console.log(testForceOpen);

                        if ((data.id && data.id > 0) || testForceOpen) {

                            Cookies.set('popupWeconsAlreadyOpened', '1');

                            var target = data.blank ? '_blank' : '';
                            var $div = jQuery('<div><a title="' + data.title + '" onclick="weconsPopupper.popupWeconsClick(this);" id="popupWecons" href="' + data.url + '" target="' + target + '"><img src="' + weconsPopupper.sourceUrl + data.image + '" alt="' + data.title + '" style="width: 100%;"></a><button onclick="jQuery.unblockUI();">chiudi</button></div>');
                            jQuery.blockUI({message: $div.html()});
                            $("#popupWecons").parent().css('background-color', 'transparent');
                            $("#popupWecons").parent().css('border', 'none');
                            $("#popupWecons").parent().css('left', '25%');
                            $("#popupWecons").parent().css('width', '50%');
                            $("#popupWecons").parent().css('top', '20%');

                            // invio richiesta google analytics per caricamento popup
                            if (typeof ga != 'undefined')
                                ga('send', 'event', 'bannerPopupView', data.title, data.url);
                            else
                                console.log(['bannerPopupView', data.title, data.url]);

                        } else {
                            console.log("Nessun popup attivo");
                        }
                    }
                })
                .error(function () {
                    console.error("Popup error");
                });
        }else{
            console.log("Popup already showed in session");
        }

    },

    run: function(sourceUrl){

        weconsPopupper.sourceUrl = sourceUrl;

        var aScripts = [];
        if (typeof jQuery.blockUI == 'undefined') {
            aScripts.push("http://weconstudio.it/wecookielaw/jquery.blockUI.js");
        }
        if (typeof Cookies == 'undefined') {
            aScripts.push("http://weconstudio.it/wecookielaw/js.cookie.js");
        }
        if (aScripts.length > 0) {
            weconsPopupper.getMultiScripts(aScripts).done(function () {
                weconsPopupper.runPopupWecons()
            });
        } else {
            weconsPopupper.runPopupWecons();
        }
    },


    // url base da impostare tramite sito 'client'
    sourceUrl: "" // NB deve terminare con '/'
};


//# sourceMappingURL=custom-all.js.map
