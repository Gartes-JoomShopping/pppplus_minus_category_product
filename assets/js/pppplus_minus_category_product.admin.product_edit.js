window.pppplus_minus_category_productAdminProductEdit = function () {
    var $ = jQuery ;
    var self = this ;
    this.__group = 'jshoppingproducts' ;
    this.__plugin = 'pppplus_minus_category_product' ;
    this.__param = Joomla.getOptions( this.__plugin , {} );

    /**
     * Параметры запроса для плагина
     * @type {{task: null, plugin: string, format: string, group: string, option: string}}
     */
    this.AjaxDefaultData = {
        group : this.__group,
        plugin : this.__plugin ,
        option : 'com_ajax' ,
        format : 'json' ,
        task : null ,
    }

    this.onToTop = function (event) {
        event.preventDefault();
        var Data = this.__param ;
        var data = $.extend( true , this.AjaxDefaultData , Data );
        data.task = 'getOnToTop';
        self.getModul( "Ajax" ).then( function ( Ajax )
        {
            // Не обрабатывать сообщения
            Ajax.ReturnRespond = true;
            // Отправить запрос
            Ajax.send( data ).then( function ( r )
            {
                $('[name="hits"]').val(+r.data.maxHit + 1 ) ;
                console.log( r.data.maxHit )
            } , function ( err )
            {
                console.error( err )
            })
        });



        console.log( this.__param  )

    }


}
window.pppplus_minus_category_productAdminProductEdit.prototype = new GNZ11() ;
window.pppplusAdminProductEdit = new window.pppplus_minus_category_productAdminProductEdit() ;