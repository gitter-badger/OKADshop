<?php
/**
 * 2016 OkadShop
 * Open source ecommerce software
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade OkadShop to newer
 * versions in the future. If you wish to customize OkadShop for your
 * needs please refer to http://www.okadshop.com for more information.
 *
 * @author    OKADshop <contact@okadshop.com>
 * @copyright 2016 OKADshop
 */

namespace Core\Controllers\Front;

use Core\Database\Database;
use Core\Session;
use Core\Cookie;

class ShopController extends FrontController
{

	/**
     * Table string
     * @var Table $table
     */
    protected $table = "shop";  


    /**
     *=============================================================
     * GET SHOP DATA
     *=============================================================
     * @return shop_data object
     */
    public static function getData(){
       // Cookie::destroy('shop');

        $cookie_shop = Session::get('shop');
        if($cookie_shop != false)
        {
            if( $cookie_shop->id_lang == get_lang('id'))
            {
                return $cookie_shop;
            }else{
                //get shop data from database
                $id_lang = get_lang('id');
                $shop_data = get_trans('shop', 'shop_trans', 'id_shop', null, $id_lang, true);
                // $shop_data = Database::getInstance()->select('shop', array('*'), true);
                if( $shop_data ){
                    unset($shop_data->cdate, $shop_data->udate);
                    if( Session::set('shop', $shop_data) ){
                        return $shop_data;
                    }
                }
            }
        }else{
            $db = getDB();
            $shop_data = get_trans('shop', 'shop_trans', 'id_shop', null, 1, true);
            // $shop_data = Database::getInstance()->select('shop', array('*'), true);
            if( $shop_data ){
                unset($shop_data->cdate, $shop_data->udate);
                if( Session::set('shop', $shop_data) ){
                    return $shop_data;
                }
            }
        }
    }


    /**
     *=============================================================
     * GET SHOP DATA BY KEY
     *=============================================================
     * @return data object
     */
    public static function get($key=null){
        
        //get shop data from db and store it in session
        $shop_data = self::getData();
        if( $shop_data && !is_null($key) ){
            if(isset($shop_data->$key))
            {
                return $shop_data->$key;    
            }
        } else {
            return $shop_data;
        }
        return false;
    }



//END CLASS
}