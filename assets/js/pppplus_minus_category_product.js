window.Pppplus_minus_category_product = function () {
    var $ = jQuery ;
    var self = this ;
    this.__group = 'jshoppingproducts' ;
    this.__plugin = 'pppplus_minus_category_product' ;
    this.__param = Joomla.getOptions( this.__plugin , {} );

    var $elem = $('select#order')
    $elem.find(' :selected').removeAttr('selected') ;
    $elem.find('option[value="'+this.__param.ORDER_BY+'"]').prop('selected'  , true )  ;

}
new window.Pppplus_minus_category_product () ;
