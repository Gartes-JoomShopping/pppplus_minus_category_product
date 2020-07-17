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
    private $Sub_Categories;
    /**
     * @var mixed|null
     * @since version
     */
    private $currentCategory;



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
        
        $this->app = \JFactory::getApplication() ;
        $Table_Category = JTable::getInstance("Category", "JShop");

        $this->currentCategory = $this->app->input->get('category_id') ;
        $this->Sub_Categories = $Table_Category->getSubCategories( $this->currentCategory , "id", "asc", 1 );







/*

        $categories_exclude = $this->params->get('categories_exclude') ;

        if ( empty ($categories_exclude) )  return ; #END IF
        if ( in_array( $currentCategory ,  $categories_exclude ))  return ; #END IF

        $categories_exclude_implode = implode(',' , $categories_exclude  ) ;
        $this->addQuery  = " AND pr_cat.category_id NOT IN ( ".$categories_exclude_implode."  ) " ;*/
    }


    public function onBeforeLoadProductList()
    {
//        die(__FILE__ .' '. __LINE__ );
    }

    public function onBeforeQueryCountProductList($type, &$adv_result, &$adv_from, &$adv_query, &$filters)
    {
        /* $adv_query  = $adv_query . $this->addQuery ;
        return true ;
        echo'<pre>';print_r( $categories_exclude );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $categories_exclude_implode );echo'</pre>'.__FILE__.' '.__LINE__;
 
        echo'<pre>';print_r( $adv_query );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $addQuery );echo'</pre>'.__FILE__.' '.__LINE__;*/
    }

    /**
     * @var string
     * @since version
     */
    private $order = [ '' ,
        'name',
        'prod.product_price/cr.currency_value' ,
        'prod.product_date_added',
        'prod.average_rating',
        'prod.hits',
        'pr_cat.product_ordering',
        ] ;



    public function onBuildQueryOrderListProduct($order, $orderby, &$adv_from, &$order_query, $order_original)
    {

       $session = JFactory::getSession();

        # Если прилетело смена сортировки
        $orderIndex = $this->app->input->get('order' , false ) ;
        if ( $orderIndex  ) {
            $session->set( 'orderIndex' , $orderIndex  , 'pppplus_minus_category_product' );
            $session->set( 'sortingOn' , true  , 'pppplus_minus_category_product' );
            return ;
        }#END IF


        # Если сортировка уже включена
        $sortingOn = $session->get( 'sortingOn' , false  , 'pppplus_minus_category_product' );
        if ( $sortingOn )  return ; #END IF



        # Если не на нижнем уровне категорий
        if ( count( $this->Sub_Categories ) )  {
            $sortingOn = $session->get('sortingOn', false , 'pppplus_minus_category_product' );
            if ( !$sortingOn ) {
                // SET DEFAULT SORTING ON
            }#END IF
            return ;
        } #END IF

        # Если уже установлена сортировка по прайсу
        if ( $order == 'prod.product_price/cr.currency_value' ) return ;  #END IF


        $sortingOn = $session->get('sortingOn', false , 'pppplus_minus_category_product' );
        # если соритровка уже влкючена
        if ($sortingOn) {
            return ;
        }#END IF



        // $orderIndex = $session->get('orderIndex', false , 'pppplus_minus_category_product' );






        $orderby = ' ASC ' ;
        $adv_from .= " LEFT JOIN `#__jshopping_currencies` AS cr USING (currency_id) ";
        $order_query = 'ORDER BY qflag DESC,  prod.product_price/cr.currency_value ' . $orderby ;
        $this->app->input->set('order' , 2 ) ;

        /**
         * Загрузка ядра JS !!!!
         */
//        JLoader::registerNamespace( 'GNZ11' , JPATH_LIBRARIES . '/GNZ11' , $reset = false , $prepend = false , $type = 'psr4' );
//        $GNZ11_js =  \GNZ11\Core\Js::instance();
        
        $doc = \Joomla\CMS\Factory::getDocument();
        $Jpro = $doc->getScriptOptions('Jpro') ;
        $Jpro['load'][] = [
            'u' => \Joomla\CMS\Uri\Uri::base(true) .'/plugins/jshoppingproducts/pppplus_minus_category_product/assets/js/pppplus_minus_category_product.js' , // Путь к файлу
            't' => 'js' ,                                       // Тип загружаемого ресурса
            'c' => '' ,                             // метод после завершения загрузки
        ];
        $doc->addScriptOptions('Jpro' , $Jpro ) ;
        $doc->addScriptOptions('pppplus_minus_category_product' , [
            'ORDER_BY' => 2 ,

        ] ) ;




//        $this->app->input->set('orderby' , 1 ) ;



//        $productlist = JSFactory::getModel('productList', 'jshop');
//        $productlist->setOrder(1) ;
//        $productlist->setModel($category);
//        $productlist->load();

       /* echo'<pre>';print_r( $category_id );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $productlist );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $category );echo'</pre>'.__FILE__.' '.__LINE__;
die(__FILE__ .' '. __LINE__ );



        echo'<pre>';print_r( '$order--  '.$order );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( '$orderby--  ' . $orderby );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r('$adv_from --'.  $adv_from );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r('$order_query --'.  $order_query );echo'</pre>'.__FILE__.' '.__LINE__;*/







    }

    public function onBeforeQueryGetProductList($type, &$adv_result, &$adv_from, &$adv_query, &$order_query, &$filters)
    {



//        die(__FILE__ .' '. __LINE__ );


//        $category = JSFactory::getTable('category', 'jshop');
//        $category->load($this->currentCategory);
//        $productlist = JSFactory::getModel('productList', 'jshop');

      /*  echo'<pre>';print_r( $category );echo'</pre>'.__FILE__.' '.__LINE__;
        die(__FILE__ .' '. __LINE__ );*/




       try
       {
           // Code that may throw an Exception or Error.
//           $productlist->setModel($category);
//           $productlist->load();
//           $orderBy = $productlist->getOrderBy();
           // throw new Exception('Code Exception '.__FILE__.':'.__LINE__) ;
       }
       catch (Exception $e)
       {
           // Executed only in PHP 5, will not be reached in PHP 7
           echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
           echo'<pre>';print_r( $e );echo'</pre>'.__FILE__.' '.__LINE__;
           die(__FILE__ .' '. __LINE__ );
       }


//        echo'<pre>';print_r( $orderBy );echo'</pre>'.__FILE__.' '.__LINE__;
//        echo'<pre>';print_r( $this->Sub_Categories );echo'</pre>'.__FILE__.' '.__LINE__;


       


        /*$adv_query  = $adv_query . $this->addQuery ;
        return true ;*/

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