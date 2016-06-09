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