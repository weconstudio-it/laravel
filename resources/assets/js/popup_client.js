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

