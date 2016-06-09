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