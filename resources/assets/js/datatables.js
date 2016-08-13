var sel2 = null;

/**
 * This plug-in for DataTables represents the ultimate option in extensibility
 * for sorting date / time strings correctly. It uses
 * [Moment.js](http://momentjs.com) to create automatic type detection and
 * sorting plug-ins for DataTables based on a given format. This way, DataTables
 * will automatically detect your temporal information and sort it correctly.
 *
 * For usage instructions, please see the DataTables blog
 * post that [introduces it](//datatables.net/blog/2014-12-18).
 *
 * @name Ultimate Date / Time sorting
 * @summary Sort date and time in any format using Moment.js
 * @author [Allan Jardine](//datatables.net)
 * @depends DataTables 1.10+, Moment.js 1.7+
 *
 * @example
 *    $.fn.dataTable.moment( 'HH:mm MMM D, YY' );
 *    $.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
 *
 *    $('#example').DataTable();
 */

(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery", "moment", "datatables"], factory);
    } else {
        factory(jQuery, moment);
    }
}(function ($, moment) {

    $.fn.dataTable.moment = function (format, locale) {
        var types = $.fn.dataTable.ext.type;

        // Add type detection
        types.detect.unshift(function (d) {
            // Strip HTML tags if possible
            if (d && d.replace) {
                d = d.replace(/<.*?>/g, '');
            }

            // Null and empty values are acceptable
            if (d === '' || d === null) {
                return 'moment-' + format;
            }

            return moment(d, format, locale, true).isValid() ?
            'moment-' + format :
                null;
        });

        // Add sorting method - use an integer for the sorting
        types.order['moment-' + format + '-pre'] = function (d) {
            if (d && d.replace) {
                d = d.replace(/<.*?>/g, '');
            }
            return d === '' || d === null ?
                -Infinity :
                parseInt(moment(d, format, locale, true).format('x'), 10);
        };
    };

}));

var dataTable = function (options) {

    if (!options) {
        console.error("Specify options!");
        return;
    }

    var dataTable = this;

    /**
     * Oggetto contenente le Traduzioni
     * @type {{}}
     */
    this.T = {
        askDelete: undefined
    };

    this.idTable = "";
    this.subTableTemplate = "subTableTemplate";
    this.subBodyTemplate = "subBodyTemplate";
    this.table = undefined;

    this.fixedHeader = options.fixedHeader || false;
    this.csv = options.csv || false;
    this.pdf = options.pdf || false;
    this.idTable = options.idTable || "";
    this.columns = options.columns || undefined;
    this.searchCols = options.searchCols || undefined;
    this.filterColumns = options.filterColumns || undefined;
    this.lenghtMenu = options.lenghtMenu || [[10, 50, 100, -1], ["10", "50", "100", "---"]];
    this.footerCallback = options.footerCallback || function () {};

    this.$table = $("#" + dataTable.idTable);

    // titolo stampato
    this.title = this.$table.attr("data-dt-title");
    if (!this.title) this.title = "";

    // ajax Url per server processing
    this.ajaxUrl = this.$table.attr("data-dt-url");

    this.ajaxUrlParameters = this.$table.attr("data-dt-url-parameters");


    // funzione per customizzare la stampa pdf
    this.printCallback = function (doc) {
        var colCount = [];
        dataTable.$table.find('tbody tr:first-child td').each(function () {
            if ($(this).attr('colspan')) {
                for (var i = 1; i <= $(this).attr('colspan'); i++) {
                    colCount.push('*');
                }
            } else {
                colCount.push('*');
            }
        });
        if (doc.content[1].table) {
            doc.content[1].table.widths = colCount;
        }
    };
    // override funzione stampa
    if(window[this.$table.attr("data-dt-print")] == 'function') this.printCallback = this.$table.attr("data-dt-print");

    // funzione per customizzare l'export
    this.exportCallback = this.$table.attr("data-dt-export");

    // funzione che crea l'array di colonne per la dataTable
    this.makeColumns = function () {
        var doSort = (dataTable.columns === undefined || dataTable.columns == undefined);
        var doFilter = (dataTable.filterColumns === undefined || dataTable.filterColumns == undefined);
        if (doSort) dataTable.columns = [];
        if (doSort) dataTable.searchCols = [];
        if (doFilter) dataTable.filterColumns = [];
        var sort = undefined;
        var filter = undefined;
        var type = undefined;
        var preload = undefined;
        var initValue = undefined;
        var initText = undefined;
        var baseType = undefined;
        var field = undefined;

        dataTable.$table.find("thead").find("tr").find("th").each(function (index) {
            type = $(this).attr("data-dt-type");
            preload = $(this).attr("data-dt-preload");
            sort = $(this).attr("data-dt-sort");
            filter = $(this).attr("data-dt-filter");
            baseType = $(this).attr("data-dt-baseType");
            initValue = $(this).attr("data-dt-init-value");
            initText = $(this).attr("data-dt-init-text");
            field = $(this).attr("data-dt-field");


            if (typeof $(this).attr("data-dt-inline-button") != 'undefined') {
                var colBtnVisible = false;
                var subgridParam = $(this).attr("data-dt-subgrid") || undefined;
                var buttons = "";
                if (typeof subgridParam != 'undefined') {
                    var subPar = JSON.parse(subgridParam);
                    colBtnVisible = true;
                    $.each(subPar, function(index, obj){
                        buttons = buttons + '<button data-interaction="subgrid" data-url="' + obj.url + '" class="btn btn-xs btn-warning"><i data-class-close="' + (obj.icon||'fa fa-minus') + '" data-class-open="' + (obj.icon||'fa fa-plus') + '" class="' + (obj.icon||'fa fa-plus') + '"></i></button>';
                    });
                }
                if ($(this).attr("data-dt-inline-button") == "1") {
                    // colonna bottoni inline
                    colBtnVisible = true;
                    var buttonsConfig = $(this).attr("data-dt-button") || 'edit|delete';
                    var editUrl = $(this).attr("data-dt-edit-url") || dataTable.ajaxUrl;
                    var deleteUrl = $(this).attr("data-dt-delete-url") || dataTable.ajaxUrl;
                    $.each(buttonsConfig.split("|"), function (index, obj) {
                        switch (obj) {
                            case "edit":
                                buttons = buttons + '<a data-dt-inline-button="1" data-interaction="edit" href="' + editUrl + '" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>';
                                break;
                            case "delete":
                                buttons = buttons + '<button data-dt-inline-button="1" data-reload="true" data-interaction="delete" data-url="' + deleteUrl + '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
                                break;
                        }
                    });
                }

                dataTable.columns.push({
                    data: null,
                    defaultContent: buttons,
                    className: 'btn-inline-edit',
                    orderable: false,
                    visible: colBtnVisible,
                    createdCell: function (td, cellData) {
                        $(td).find('[data-interaction=subgrid]').attr("data-url", $(td).find('[data-interaction=subgrid]').attr("data-url") + "/" + cellData[0]);
                        $(td).find('[data-interaction=delete]').attr("data-url", deleteUrl + "/" + cellData[0]);
                        $(td).find('[data-interaction=edit]').attr("href", editUrl + "/" + cellData[0] + "/edit");
                    }
                });
                dataTable.searchCols.push(null);
            } else {
                // colonne dati
                var formatterFunction = $(this).attr("data-dt-formatterjs") || undefined;
                var align = $(this).attr("data-dt-align") || undefined;
                if (!baseType) baseType = 'string';
                if (doSort) {
                    var objColumn = {};

                    if (sort !== undefined && sort != undefined && typeof sort != "undefined" && sort != "false" && sort != "0") {
                        if (type) {
                            objColumn = {"bSortable": true, "orderDataType": type, "type": baseType};
                        } else {
                            objColumn = {"bSortable": true};
                        }
                    } else {
                        objColumn = {"bSortable": false};
                    }

                    if (align) {
                        objColumn.sClass = "text-" + align
                    }

                    objColumn.field = field;

                    if (formatterFunction) {
                        var formatterFunctionCallback = null;

                        try {
                            // il formatter è parte del set base dei formatter
                            if (typeof(window['formatter']) == 'object')
                                if (typeof(window['formatter'][formatterFunction]) == 'function')
                                    formatterFunctionCallback = window['formatter'][formatterFunction];

                            // il formatter è una funzione custom nella forma 'nomeFunzione' o 'oggetto.nomeFunzione'
                            if (formatterFunctionCallback == null) {
                                if (typeof(window[formatterFunction]) == 'function') {
                                    formatterFunctionCallback = window[formatterFunction];
                                } else if (formatterFunction.indexOf('.') > 0) {
                                    var fnObj = formatterFunction.split('.')[0];
                                    var fnFunction = formatterFunction.split('.')[1];

                                    if (typeof(window[fnObj][fnFunction]) == 'function') {
                                        formatterFunctionCallback = window[fnObj][fnFunction];
                                    }
                                }
                            }

                            if (typeof formatterFunctionCallback == 'function') {
                                objColumn.createdCell = function (td, cell_data, row_data, row_index, col_index) {
                                    $(td).html(formatterFunctionCallback(dataTable.table, td, cell_data, row_data, row_index, col_index));
                                };
                            } else {
                                console.warn("Callback '" + formatterFunction + "' not found (column index: " + index + ")");
                            }
                        }
                        catch (err) {
                            console.warn("Callback '" + formatterFunction + "' not found (column index: " + index + ")");
                        }
                    }


                    dataTable.columns.push(objColumn);
                    if($.trim(initValue) != "") {
                        dataTable.searchCols.push({
                            search: "" + initValue
                        });
                    } else {
                        dataTable.searchCols.push(null);
                    }
                }

                if (doFilter) {
                    if (typeof filter != "undefined" && filter != "false" && filter != "0") {
                        dataTable.filterColumns[index] = {index: index, type: type, preload: preload, initValue: initValue, initText: initText};
                    }
                }
            }
        });
    };

    this.makeFilters = function () {
        var filter = dataTable.$table.find('thead').attr("data-dt-enable-filter");
        if (filter !== undefined && filter != undefined && typeof filter != "undefined" && filter != "false" && filter != "0") {
            /**
             * Ho abilitato i filtri.
             * Creo una nuova tr dove ci saranno i filtri
             */
            var n = dataTable.$table.find("thead").find("tr").find("th").length;
            var $tr = $('<tr></tr>');
            for (var i = 0; i < n; i++) {
                var $th = $('<th data-filter="' + i + '"></th>');
                $tr.append($th);
            }
            var content = dataTable.$table.find("thead").html();
            dataTable.$table.find("thead").html($tr);
            dataTable.$table.find("thead").append(content);
        }
    };

    this.makeSorting = function () {
        // date
        $.fn.dataTable.moment('DD/MM/YYYY');

        // numeric
        $.fn.dataTable.ext.order['numeric'] = function (settings, col) {
            return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
                var value = $(td).html().trim();
                value = value.split(",").join("");
                value = value.split("--").join("0");
                return parseFloat(value);
            });
        };

        // numeric comma
        $.fn.dataTable.ext.order['numeric-comma'] = function (settings, col) {
            return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
                var value = $(td).html().trim();
                value = value.split(".").join("");
                value = value.split(",").join(".");
                value = value.split("--").join("0");
                return parseFloat(value);
            });
        };
    };

    this.DTfnBeforeDrawCallback = function (settings) {};
    this.DTfnDrawCallback = function (settings) {
        dataTable.DTfnBeforeDrawCallback(settings);
        dataTable.bindEvents();
        dataTable.DTfnAfterDrawCallback(settings);
    };
    this.DTfnAfterDrawCallback = function (settings) {};

    /**
     * Funzione da overridare
     * @constructor
     */
    this.DTbeforeInitComplete = function(){

    };
    /**
     * Funzione da overridare
     * @constructor
     */
    this.DTafterInitComplete = function(){

    };

    this.DTinitComplete = function () {

        dataTable.DTbeforeInitComplete();

        this.api().columns().every(function (i) {
            if (dataTable.filterColumns[i]) {
                var column = this;
                var $search = undefined;
                if (dataTable.filterColumns[i].type) {
                    if (dataTable.filterColumns[i].type == "date") {
                        // TODO datepicker
                    }
                } else {
                    // Select 2
                    $search = $('<select class="select2" style="width: 100%;" data-placeholder=" "><option value=""></option></select>')
                        .appendTo($("[data-filter='" + i + "']").empty())
                        .on('change', function () {
                            // var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            var val = $(this).val();
                            column.search(val ? val : '', true, false).draw();
                        });

                    column.data().unique().sort().each(function (d) {
                        if(dataTable.filterColumns[i].initValue && dataTable.filterColumns[i].initText) {
                            $search.append('<option value="' + dataTable.filterColumns[i].initValue + '">' + dataTable.filterColumns[i].initText + '</option>')
                        } else {
                            $search.append('<option value="' + d + '">' + d + '</option>')
                        }
                    });

                    var $field = $(column.header()).attr("data-dt-field") || undefined;

                    var $fieldUrl = $(column.header()).attr("data-dt-field-url") || dataTable.ajaxUrl + "?dt=1";

                    if (typeof $field != 'undefined') {
                        $search.select2({
                            ajax: {
                                url: $fieldUrl + "&op=autocomplete&autocomplete=" + $field + (dataTable.ajaxUrlParameters? "&" + dataTable.ajaxUrlParameters : ''),
                                dataType: 'json',
                                delay: 250,

                                data: function (params) {
                                    return {
                                        search: params.term, // search term
                                        page: params.page
                                    };
                                },
                                processResults: function (data, params) {
                                    // parse the results into the format expected by Select2
                                    // since we are using custom formatting functions we do not need to
                                    // alter the remote JSON data, except to indicate that infinite
                                    // scrolling can be used
                                    params.page = params.page || 1;

                                    return {
                                        results: data.items
                                        /*pagination: {
                                         more: (params.page * 30) < data.total_count
                                         }*/
                                    };
                                },
                                // cache: true
                            },
                            escapeMarkup: function (markup) {
                                return markup;
                            }, // let our custom formatter work
                            minimumInputLength: 1,
                            allowClear: true,
                            // cache: true,
                            templateResult: formatData,
                            templateSelection: formatDataSelection
                        }).on("select2:unselecting", function (e) {
                            $(this).data('state', 'unselected');
                        }).on("select2:open", function (e) {
                            if ($(this).data('state') === 'unselected') {
                                $(this).removeData('state');

                                var self = $(this);
                                setTimeout(function () {
                                    self.select2('close');
                                }, 1);
                            } else {
                                if(dataTable.filterColumns[i].preload) {
                                    $search.data('select2').trigger('query', {term:"%"});
                                }
                            }
                        });

                        if(dataTable.filterColumns[i].initValue) {
                            sel2 = $search;
                            $search.val(dataTable.filterColumns[i].initValue).trigger("change");

                        }

                        function formatData(data) {
                            return data.text;
                        }

                        function formatDataSelection(data) {
                            return data.text;
                        }

                    } else {
                        $search.chosen({allow_single_deselect: true});
                    }
                }


                // if (!dataTable.fixedHeader) {
                // 	$search.each(function () {
                // 		$(this).next().css({'width': '100%'});
                // 	});
                // }
            }
        });



        dataTable.DTafterInitComplete();

    };

    this.DTfnCreatedRow = function (nRow, aData) {
        $(nRow).attr('data-id', aData[0]);
    };

    this.bindEvents = function () {
        dataTable.$table.find('thead').find('select').on('change', function () {
            dataTable.bindEvents();
        });

        dataTable.$table.find('select[name="ordersTable_length"]').on('change', function () {
            dataTable.bindEvents();
        });

        dataTable.$table.find(".paginate_button").click(function () {
            dataTable.bindEvents();
        });

        dataTable.$table.find('[data-interaction="subgrid"]').unbind("click").bind("click", function () {

            var objI = $(this).find('i');
            if(objI.hasClass(objI.attr('data-class-open'))){
                objI.removeClass(objI.attr('data-class-open'));
                objI.addClass(objI.attr('data-class-close'));
            }else{
                objI.removeClass(objI.attr('data-class-close'));
                objI.addClass(objI.attr('data-class-open'));
            }

            var $tr = $(this).closest('tr');
            var id = $(this).attr("data-id");
            var url = $(this).attr("data-url");
            var callbackName = $(this).attr("data-callback");
            var row = dataTable.table.row($tr);

            // verifico se la callback esiste
            var callback = false;
            if (typeof callbackName != 'undefined') {
                if (jQuery.isFunction(callbackName))
                    callback = true;
                if (jQuery.isFunction(eval(callbackName)))
                    callback = true;
            }

            if (row.child.isShown()) {
                row.child.hide();
                $tr.removeClass('shown');
            } else {
                app.blockUI(1, "Loading...");
                $.post(url, {id: id})
                    .success(function (data) {
                        if (data) {
                            if (callback) {
                                eval(callbackName)(row, data);
                            } else {
                                row.child(data).show();
                                $tr.addClass('shown');
                            }
                        }
                        app.blockUI(0);
                    })
                    .error(function () {
                        app.blockUI(0);
                    });
            }
        });

        dataTable.$table.find('[data-dt-inline-button="1"][data-interaction=delete]').unbind('click').bind('click', function () {
            var url = $(this).attr('data-url');
            var conferma = dataTable.T.askDelete || 'Eliminare la riga selezionata?';

            var objButton = $(this);

            // formattazione stringa richiesta parsando le {}
            $.each(dataTable.columns, function(index, obj){
                if (typeof obj.field != 'undefined') {
                    if (conferma.indexOf("{" + obj.field + "}") != -1){

                        var idRiga = objButton.parents("tr[data-id]").attr("data-id");
                        var valInCell = dataTable.table.cell("[data-id=" + idRiga + "] td:eq(" + index + ")").data();

                        // recupero il campo nella colonna alla riga attuale
                        conferma = conferma.replace("{" + obj.field + "}", valInCell);
                    }
                }
            });

            if(confirm(conferma)) {
                app.block(1);
                $.delete(url)
                    .success(function (data) {
                        if (data.response) {
                            dataTable.table.draw('page');
                        } else {
                            app.warning("", data.message);
                        }
                        app.block(0);
                    })
                    .error(function () {
                        app.block(0);
                        app.error('', 'Delete error!');
                    });
            }
        });
    };

    this.makeDT = function () {
        var language = typeof datatable_lang != 'undefined' ? datatable_lang : {
            "sEmptyTable":     "Nessun dato presente nella tabella",
            "sInfo":           "Vista da _START_ a _END_ di _TOTAL_ elementi",
            "sInfoEmpty":      "Vista da 0 a 0 di 0 elementi",
            "sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     "Visualizza _MENU_ elementi",
            "sLoadingRecords": "Caricamento...",
            "sProcessing":     "Elaborazione...",
            "sSearch":         "Cerca:",
            "sZeroRecords":    "La ricerca non ha portato alcun risultato.",
            "oPaginate": {
                "sFirst":      "Inizio",
                "sPrevious":   "Precedente",
                "sNext":       "Successivo",
                "sLast":       "Fine"
            },
            "oAria": {
                "sSortAscending":  ": attiva per ordinare la colonna in ordine crescente",
                "sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
            }
        };

        dataTable.table = dataTable.$table.DataTable({
            bAutoWidth: false,
            aoColumns: dataTable.columns,
            searchCols: dataTable.searchCols,
            aaSorting: [],
            aLengthMenu: dataTable.lenghtMenu,
            bLengthChange: true,
            bPaginate: true,
            select: true,
            responsive: true,

            // language: prende la variabile globale datatable_lang oppure valori di default
            language: language,

            // gestione server side ajax
            processing: (typeof dataTable.ajaxUrl != 'undefined'),
            serverSide: (typeof dataTable.ajaxUrl != 'undefined'),
            ajax: (typeof dataTable.ajaxUrl != 'undefined') ? dataTable.ajaxUrl + "?dt=1" + (this.ajaxUrlParameters? "&" + this.ajaxUrlParameters : '') : false,

            footerCallback: dataTable.footerCallback,
            fnDrawCallback: dataTable.DTfnDrawCallback,
            initComplete: dataTable.DTinitComplete,
            fnCreatedRow: dataTable.DTfnCreatedRow
        });

        if (dataTable.fixedHeader) {
            new $.fn.dataTable.FixedHeader(dataTable.table);
        }

        var buttons = [];

        if (dataTable.csv) {
            if(typeof dataTable.ajaxUrl != 'undefined') {
                buttons.push({
                    text: "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    className: "btn btn-white btn-primary btn-bold",
                    action: function() {
                        var url = dataTable.ajaxUrl + "?dt=1&op=export&type=csv";
                        var params = dataTable.table.ajax.params();
                        params.start = 0;
                        params.length = -1;

                        app.block(1);
                        $.ajax({
                            url: url,
                            async: false,
                            data: params
                        })
                            .success(function(data) {
                                app.block(0);
                                if(data.response) {
                                    app.locationHref(data.message, true);
                                } else {
                                    app.warning("", data.message);
                                }
                            })
                            .error(function() {
                                app.block(0);
                                app.error("", "Errore esportazione CSV!");
                            });
                    }
                });
            } else {
                buttons.push({
                    extend: "csvHtml5",
                    text: "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    className: "btn btn-white btn-primary btn-bold",
                    fieldBoundary: "",
                    charset: false,
                    footer: true,
                    fieldSeparator: ";",
                    customize: eval(dataTable.exportCallback)
                });
            }
        }

        if (dataTable.pdf) {
            if(typeof dataTable.ajaxUrl != 'undefined') {

            } else {
                buttons.push({
                    extend: "pdf",
                    text: "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    className: "btn btn-white btn-primary btn-bold",
                    autoPrint: false,
                    footer: true,
                    orientation: 'landscape',
                    title: title,
                    customize: eval(dataTable.printCallback)
                });
            }
        }

        if (dataTable.csv || dataTable.pdf) {
            new $.fn.dataTable.Buttons(dataTable.table, {
                buttons: buttons
            });
            dataTable.table.buttons().container().appendTo($("#" + dataTable.idTable + "_wrapper").find('.dataTables_filter'));
        }

        if (typeof dataTable.ajaxUrl != 'undefined') {
            $("#" + dataTable.idTable + "_wrapper").find('.dataTables_filter').find('label').hide();
        }

        dataTable.bindEvents();
    };

    this.make = function () {
        dataTable.makeColumns();
        dataTable.makeFilters();
        dataTable.makeSorting();
        dataTable.makeDT();
    };
};