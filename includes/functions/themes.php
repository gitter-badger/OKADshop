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
 *
 * ------------------------------------------------------------------
 * THEMES FUNCTIONS
 * ------------------------------------------------------------------
 *
 *
 */

use Core\Session;
use Core\Theme;


/**
 * Get installed themes
 *
 * @return array $themes
 */
function get_themes(){
	$themes = array();
	foreach(glob( site_base('themes/*/config.xml'), GLOB_BRACE) as $path) {
        $config = Core\Models\Admin\Module::xml2Array( $path );
        $themes[$config['name']] = $config;
    }
    return $themes;	
}



/**
 * Get front theme name
 *
 * @return uri string
 */
function get_theme_name(){
	return Theme::getTheme();
}


/**
 * Get theme directory path
 *
 * @return directory
 */
function get_theme_directory(){
    return site_base() .'themes/'. get_theme_name() .'/';
}


/**
 * Get theme url
 *
 * @return uri
 */
function get_theme_url($path=''){
    return site_url() .'themes/'. get_theme_name() .'/'. $path;
}



/**
 * Get theme preview image
 *
 * @param $name string
 */
function get_theme_icon($name){
	$path = 'themes/'. $name .'/preview.png';
	if( file_exists( site_base() . $path ) ){
		return site_url() . $path;
	}
	return site_url() .'assets/img/icons/preview.png';
}



/**
 *
 * GET HOME PAGE URL
 *
 * @return URL string
 **/
function get_template_view($view, $variables=[]){
	$tpl_view = Theme::getViewPath('front/'.$view);
	if( $tpl_view ){
		extract($variables);
		include( $tpl_view );
	}
}


/**
 * Custom theme styles
 */
function get_theme_option($name) {
	$options = unserialize( get_meta_value('theme_options') );
	if( isset($options[$name]) ){
		return $options[$name];
	}
	return false;
}

/**
 * Get logo
 *
 * @return url
 */
function get_logo(){
    $logo = get_theme_option('logo');
    if( $logo ){
        return site_url($logo);
    }
    return site_url('assets/img/logo.png');
}