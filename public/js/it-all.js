!function(a){"function"==typeof define&&define.amd?define(["jquery","moment"],a):"object"==typeof exports?module.exports=a(require("jquery"),require("moment")):a(jQuery,moment)}(function(a,b){!function(){"use strict";var a=(b.defineLocale||b.lang).call(b,"it",{months:"gennaio_febbraio_marzo_aprile_maggio_giugno_luglio_agosto_settembre_ottobre_novembre_dicembre".split("_"),monthsShort:"gen_feb_mar_apr_mag_giu_lug_ago_set_ott_nov_dic".split("_"),weekdays:"Domenica_Lunedì_Martedì_Mercoledì_Giovedì_Venerdì_Sabato".split("_"),weekdaysShort:"Dom_Lun_Mar_Mer_Gio_Ven_Sab".split("_"),weekdaysMin:"Do_Lu_Ma_Me_Gi_Ve_Sa".split("_"),longDateFormat:{LT:"HH:mm",LTS:"HH:mm:ss",L:"DD/MM/YYYY",LL:"D MMMM YYYY",LLL:"D MMMM YYYY HH:mm",LLLL:"dddd, D MMMM YYYY HH:mm"},calendar:{sameDay:"[Oggi alle] LT",nextDay:"[Domani alle] LT",nextWeek:"dddd [alle] LT",lastDay:"[Ieri alle] LT",lastWeek:function(){switch(this.day()){case 0:return"[la scorsa] dddd [alle] LT";default:return"[lo scorso] dddd [alle] LT"}},sameElse:"L"},relativeTime:{future:function(a){return(/^[0-9].+$/.test(a)?"tra":"in")+" "+a},past:"%s fa",s:"alcuni secondi",m:"un minuto",mm:"%d minuti",h:"un'ora",hh:"%d ore",d:"un giorno",dd:"%d giorni",M:"un mese",MM:"%d mesi",y:"un anno",yy:"%d anni"},ordinalParse:/\d{1,2}º/,ordinal:"%dº",week:{dow:1,doy:4}});return a}(),a.fullCalendar.datepickerLang("it","it",{closeText:"Chiudi",prevText:"&#x3C;Prec",nextText:"Succ&#x3E;",currentText:"Oggi",monthNames:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],monthNamesShort:["Gen","Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic"],dayNames:["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"],dayNamesShort:["Dom","Lun","Mar","Mer","Gio","Ven","Sab"],dayNamesMin:["Do","Lu","Ma","Me","Gi","Ve","Sa"],weekHeader:"Sm",dateFormat:"dd/mm/yy",firstDay:1,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""}),a.fullCalendar.lang("it",{buttonText:{month:"Mese",week:"Settimana",day:"Giorno",list:"Agenda"},allDayHtml:"Tutto il<br/>giorno",eventLimitText:function(a){return"+altri "+a}})});
/*global jQuery, define */
(function( factory ) {
	"use strict";
	if ( typeof define === "function" && define.amd ) {
		// AMD. Register as an anonymous module.
		define([
			"jquery",
			"../grid.base"
		], factory );
	} else {
		// Browser globals
		factory( jQuery );
	}
}(function( $ ) {

$.jgrid = $.jgrid || {};
if(!$.jgrid.hasOwnProperty("regional")) {
	$.jgrid.regional = [];
}
$.jgrid.regional["it"] = {
	defaults : {
		recordtext: "Mostra {0} - {1} di {2}",
		emptyrecords: "Non ci sono record da mostrare",
		loadtext: "Caricamento...",
		savetext: "Salvataggio...",
		pgtext : "Pagina {0} di {1}",
		pgfirst : "Prima Pagina",
		pglast : "Ultima Pagina",
		pgnext : "Pagina Successiva",
		pgprev : "Pagina Precedente",
		pgrecs : "Records per Pagina",
		showhide: "Espandi o collassa griglia",
		// mobile
		pagerCaption : "Griglia::Impostaioni della pagina",
		pageText : "Pagina:",
		recordPage : "Records per Pagina",
		nomorerecs : "Non ci sono altri record...",
		scrollPullup: "Trascina verso l'alto per altri...",
		scrollPulldown : "Trascina verso il basso per aggiornare...",
		scrollRefresh : "Rilascia per aggiornare..."
	},
	search : {
		caption: "Cerca...",
		Find: "Trova",
		Reset: "Reset",
		odata: [{ oper:'eq', text:'uguale'},{ oper:'ne', text:'diverso'},{ oper:'lt', text:'minore'},{ oper:'le', text:'minore o uguale'},{ oper:'gt', text:'maggiore'},{ oper:'ge', text:'maggiore o uguale'},{ oper:'bw', text:'inizia per'},{ oper:'bn', text:'non inizia per'},{ oper:'in', text:'è in'},{ oper:'ni', text:'non è in'},{ oper:'ew', text:'finisce per'},{ oper:'en', text:'non finisce per'},{ oper:'cn', text:'contiene'},{ oper:'nc', text:'non contiene'},{ oper:'nu', text:'è null'},{ oper:'nn', text:'non è null'}, {oper:'bt', text:'between'}],
		groupOps: [{ op: "AND", text: "tutti" },{ op: "OR",  text: "ciascuno" }],
		operandTitle : "Clicca sull'opzione di ricerca scelta.",
		resetTitle : "Resetta valori di ricerca"
	},
	edit : {
		addCaption: "Aggiungi Record",
		editCaption: "Modifica Record",
		bSubmit: "Invia",
		bCancel: "Annulla",
		bClose: "Chiudi",
		saveData: "I dati sono stati modificati! Salvare le modifiche?",
		bYes : "Si",
		bNo : "No",
		bExit : "Annulla",
		msg: {
			required:"Campo obbligatorio",
			number:"Per favore, inserisci un numero valido",
			minValue:"il valore deve essere maggiore o uguale a ",
			maxValue:"il valore deve essere minore o uguale a ",
			email: "non è una e-mail valida",
			integer: "Per favore, inserisci un intero valido",
			date: "Per favore, inserisci una data valida",
			url: "non è un URL valido. Prefissi richiesti ('http://' o 'https://')",
			nodefined : " non è definito!",
			novalue : " valore di ritorno richiesto!",
			customarray : "La funzione personalizzata deve restituire un array!",
			customfcheck : "La funzione personalizzata deve essere presente in caso di controlli personalizzati!"
			
		}
	},
	view : {
		caption: "Visualizza Record",
		bClose: "Chiudi"
	},
	del : {
		caption: "Cancella",
		msg: "Cancellare i record selezionati?",
		bSubmit: "Canella",
		bCancel: "Annulla"
	},
	nav : {
		edittext: "",
		edittitle: "Modifica riga selezionata",
		addtext:"",
		addtitle: "Aggiungi riga",
		deltext: "",
		deltitle: "Cancella riga",
		searchtext: "",
		searchtitle: "Trova record",
		refreshtext: "",
		refreshtitle: "Ricarica tabella",
		alertcap: "Attenzione",
		alerttext: "Per favore, seleziona un record",
		viewtext: "",
		viewtitle: "Visualizza riga selezionata",
		savetext: "",
		savetitle: "Salva riga",
		canceltext: "",
		canceltitle : "Annulla modifica riga",
		selectcaption : "Actions..."
	},
	col : {
		caption: "Seleziona colonne",
		bSubmit: "Ok",
		bCancel: "Annulla"
	},
	errors : {
		errcap : "Errore",
		nourl : "Nessun url impostato",
		norecords: "Non ci sono record da elaborare",
		model : "Lunghezza dei colNames <> colModel!"
	},
	formatter:{
		integer:{ 
			thousandsSeparator:".",
			defaultValue:"0"
		},
		number:{
			decimalSeparator:",",
			thousandsSeparator:".",
			decimalPlaces:2,
			defaultValue:"0,00"
		},
		currency:{
			decimalSeparator:",",
			thousandsSeparator:".",
			decimalPlaces:2,
			prefix:"€ ",
			suffix:"",
			defaultValue:"0,00"
		},
		date:{
			dayNames:["Dom","Lun","Mar","Mer","Gio","Ven","Sab","Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"],
			monthNames:["Gen","Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic","Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],
			AmPm:["am","pm","AM","PM"],
			S:function(b){return b<11||b>13?["st","nd","rd","th"][Math.min((b-1)%10,3)]:"th"},
			srcformat:"Y-m-d",
			newformat:"d/m/Y",
			parseRe : /[#%\\\/:_;.,\t\s-]/,
			masks:{
				ISO8601Long:"Y-m-d H:i:s",
				ISO8601Short:"Y-m-d", 
				ShortDate:"d/m/Y", 
				LongDate:"l d F Y",
				FullDateTime:"l d F Y G:i:s",
				MonthDay:"F d",
				ShortTime:"H:i",
				LongTime:"H:i:s",
				SortableDateTime:"Y-m-d\\TH:i:s",
				UniversalSortableDateTime:"Y-m-d H:i:sO",
				YearMonth:"F, Y"
			},
			reformatAfterEdit:false,
			userLocalTime : false
		},
		baseLinkUrl:"",
		showAction:"",
		target:"",
		checkbox:{ disabled:true},
		idName:"id"
	},
	colmenu : {
		sortasc : "Sort Ascending",
		sortdesc : "Sort Descending",
		columns : "Columns",
		filter : "Filter",
		grouping : "Group By",
		ungrouping : "Ungroup",
		searchTitle : "Get items with value that:",
		freeze : "Freeze",
		unfreeze : "Unfreeze",
		reorder : "Move to reorder"
	}
};
}));

//# sourceMappingURL=it-all.js.map
