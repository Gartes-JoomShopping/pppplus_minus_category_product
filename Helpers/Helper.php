<?php

namespace Pppplus\Helpers;

use JLoader;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;
use JResponseJson;


/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 * @since 3.9
 */
class Helper
{
    /**
     * @var \Joomla\CMS\Application\CMSApplication|null
     * @since 3.9
     */
    private $app;
    /**
     * @var \JDatabaseDriver|null
     * @since 3.9
     */
    private $db;
    public static $instance;

    /**
     * helper constructor.
     * @throws Exception
     * @since 3.9
     */
    private function __construct($options = array())
    {
        $this->app = Factory::getApplication();
        $this->db = Factory::getDbo();
        return $this;
    }#END FN

    /**
     * @param array $options
     *
     * @return Helper
     * @throws Exception
     * @since 3.9
     */
    public static function instance($options = array())
    {
        if (self::$instance === null) {
            self::$instance = new self($options);
        }
        return self::$instance;
    }#END FN


    public  function  getOnToTop(){
        $product_id = $this->app->input->get('product_id' , 0 , 'INT') ;


        $Query = $this->db->getQuery(true) ;
        $Query->select( $this->db->quoteName('hits')) ;
        $Query->from( $this->db->quoteName('#__jshopping_products') );
        $Query->order( $this->db->quoteName('hits' ) . ' DESC ' ) ;

//        echo $Query->dump() ;

        $this->db->setQuery($Query , 0 , 1) ;
        $result['maxHit'] = $this->db->loadResult();

        echo new JResponseJson($result);
        die();

    }

}




















