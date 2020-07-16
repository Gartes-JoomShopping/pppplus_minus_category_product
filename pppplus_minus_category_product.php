<?php
/**
 * @package Joomla.JoomShopping.Products
 * @version 1.7.0
 * @author Linfuby (Meling Vadim)
 * @website http://dell3r.ru/
 * @email support@dell3r.ru
 * @copyright Copyright by Linfuby. All rights reserved.
 * @license The MIT License (MIT); See \components\com_jshopping\addons\jshopping_plus_minus_count_product\license.txt
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class plgJshoppingProductsPppplus_Minus_Category_Product extends JPlugin{

    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config = array());
//        die(__FILE__ .' '. __LINE__ );
    }

    /**
     * onAfterInitialise.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterInitialise()
    {


    }

    /**
     * onAfterRoute.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterRoute()
    {

    }

    /**
     * onAfterDispatch.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterDispatch()
    {

    }

    /**
     * onAfterRender.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterRender()
    {
        // Access to plugin parameters
        $sample = $this->params->get('sample', '42');
    }

    /**
     * onAfterCompileHead.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterCompileHead()
    {

    }

    /**
     * OnAfterCompress.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterCompress()
    {

    }

    /**
     * onAfterRespond.
     *
     * @return  void
     *
     * @since   1.0
     */
    public function onAfterRespond()
    {

    }


    public function onBeforeLoadProductList(){
//        die(__FILE__ .' '. __LINE__ );
    }

    public function onBeforeQueryCountProductList($type,  &$adv_result, &$adv_from, &$adv_query, &$filters)
    {
        echo'<pre>';print_r( $this->params );echo'</pre>'.__FILE__.' '.__LINE__;
        die(__FILE__ .' '. __LINE__ );


        echo'<pre>';print_r( $adv_query );echo'</pre>'.__FILE__.' '.__LINE__;
        
        die(__FILE__ .' '. __LINE__ );
    }

    public function onBeforeQueryGetProductList($type, &$adv_result, &$adv_from, &$adv_query, &$order_query, &$filters)
    {
        die(__FILE__ .' '. __LINE__ );
    }

	function onBeforeDisplayProductListView(&$view){
		die(__FILE__ .' '. __LINE__ );
    }

	function onBeforeDisplayProductView(&$view){
		die(__FILE__ .' '. __LINE__ );
    }
}