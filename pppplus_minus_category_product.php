<?php

use Joomla\Registry\Registry;

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class plgJshoppingProductsPppplus_Minus_Category_Product extends JPlugin
{

    protected $app;

    /**
     * Affects constructor behavior. If true, language files will be loaded automatically.
     *
     * @var    boolean
     * @since  3.1
     */
    protected $autoloadLanguage = true;
    /**
     * extension_id this plugin
     * @var integer
     * @since 3.9
     */
    protected $_extension_id;
    /**
     * @var string
     * @since version
     */
    private $addQuery = null;


    public function __construct(&$subject, $config = array())
    {
        $params = $config['params'] ;
        parent::__construct($subject, $config = array());

        




        # extension_id this plugin
        $this->_extension_id = $config['id'];

        // Get the parameters.
        if ( !empty( $params ))
        {
            
            if ($config['params'] instanceof Registry)
            {
                $this->params = $config['params'];
            }
            else
            {
                $this->params = new Registry($params);
            }
        }
        
        $app = \JFactory::getApplication() ;
        $currentCategory = $app->input->get('category_id') ;
        $categories_exclude = $this->params->get('categories_exclude') ;

        if ( empty ($categories_exclude) )  return ; #END IF
        if ( in_array( $currentCategory ,  $categories_exclude ))  return ; #END IF

        $categories_exclude_implode = implode(',' , $categories_exclude  ) ;
        $this->addQuery  = " AND pr_cat.category_id NOT IN ( ".$categories_exclude_implode."  ) " ;
    }


    public function onBeforeLoadProductList()
    {
//        die(__FILE__ .' '. __LINE__ );
    }

    public function onBeforeQueryCountProductList($type, &$adv_result, &$adv_from, &$adv_query, &$filters)
    {


        $adv_query  = $adv_query . $this->addQuery ;
        return true ;
        echo'<pre>';print_r( $categories_exclude );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $categories_exclude_implode );echo'</pre>'.__FILE__.' '.__LINE__;
 
        echo'<pre>';print_r( $adv_query );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $addQuery );echo'</pre>'.__FILE__.' '.__LINE__;

        


    }

    public function onBeforeQueryGetProductList($type, &$adv_result, &$adv_from, &$adv_query, &$order_query, &$filters)
    {
        $adv_query  = $adv_query . $this->addQuery ;
        return true ;

    }

    function onBeforeDisplayProductListView(&$view)
    {
//        die(__FILE__ . ' ' . __LINE__);
    }

    function onBeforeDisplayProductView(&$view)
    {
//        die(__FILE__ . ' ' . __LINE__);
    }
}