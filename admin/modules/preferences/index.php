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

if (!defined('_OS_VERSION_'))
  exit;

/**
 * Register translation domain
 */
add_domain(__FILE__, 'pref');

include_once 'includes/functions.php';
include_once 'includes/tabs/shop.php';


/**
 * Add menu links
 */
global $os_admin_menu;

	
	

	$p_cms = $os_admin_menu->add( l("Pages", "core"), '#');
		$p_cms->link->prepend('<span class="fa fa-columns"></span>');
	    $p_cms->add( l("Pages", "core"), '?module=cms');
	    $p_cms->add( l("Catégories", "core"), '?module=cms_categories');

	$p_blog = $os_admin_menu->add( l("Blog", "core"), '#');
		$p_blog->link->prepend('<span class="fa fa-rss"></span>');
	    $p_blog->add( l("Blog", "core"), '?module=blog');
	    $p_blog->add( l("Catégories", "core"), '?module=blog_categories');


	$preferences = $os_admin_menu->add( trans('Preferences', 'pref'), get_page_url('shop', __FILE__));
	$preferences->link->prepend('<span class="fa fa-wrench"></span>');



/**
 * Register CSS and JS
 */
if( get_url_param('module') == 'preferences' ){
	add_js('preferences-js', [
		'src' => admin_url('modules/preferences/assets/js/preferences.js'), 
		'admin' => true,
		'front' => false
	]);
}



/**
 * Shop admin page
 */
function pref_shop_page(){
	$data = array();
	get_view(__FILE__, 'admin/shop', $data); 
}
add_admin_page(__FILE__, [
    'name' => 'shop',
    'title' => 'Coordinates and stores',
    'function' => 'pref_shop_page'
]);