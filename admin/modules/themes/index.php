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

use Core\Models\Admin\Theme;

include_once 'includes/tabs/customize.php';

/**
 * Module install
 */
function themes_install(){
	$params = array(
		'title' => 'OKADshop CMS',
		'tagline' => 'Awesome shop using OKADshop',
		'logo' => '',
		'favicon' => '',
		'bgcolor' => '#1a1a1a',
		'link_color' => '#007acc',
		'text_colo' => '#686868',
		'top_color' => '',
		'css' => ''
	);
	save_meta_value('theme_options', serialize($params));
}


/**
 * Add menu links
 */
global $os_admin_menu;
$themes = $os_admin_menu->add( trans('Themes', 'themes'), get_page_url('index', __FILE__));
	$themes->link->prepend('<span class="fa fa-desktop"></span>');
	$themes->add( trans('Themes', 'themes'), get_page_url('index', __FILE__));
	$themes->add( trans('Install', 'themes'), get_page_url('install', __FILE__) );
	$themes->add( trans('Customize', 'themes'), get_page_url('customize', __FILE__) );


/**
 * Register javascripts and css
 */

if( get_url_param('module') == 'themes' ){
	add_css('themes-css', [
		'src' => admin_url('modules/themes/assets/css/themes.css'), 
		'admin' => true,
		'front' => false
	]);

	add_js('themes-js', [
		'src' => admin_url('modules/themes/assets/js/themes.js'), 
		'admin' => true,
		'front' => false
	]);
}



/**
 * get customize tabs
 *
 */


function get_customize_tabs(){
	get_view(__FILE__, 'admin/navigation', array('name' => 'Customize', 'icon' => 'magic')); 
	get_tabs(__FILE__, 'customize');
}
add_admin_page(__FILE__, [
    'name' => 'customize',
    'title' => 'Customize',
    'function' => 'get_customize_tabs'
]);



/**
 * get themes
 *
 */
function get_themes_list(){
	$data['themes'] = Theme::all(); 
	get_view(__FILE__, 'admin/index', $data);
}
add_admin_page(__FILE__, [
    'name' => 'index',
    'title' => 'Themes',
    'function' => 'get_themes_list'
]);



/**
 * Install page
 */


function themes_install_page(){
	get_view(__FILE__, 'admin/install');
}
add_admin_page(__FILE__, [
    'name' => 'install',
    'title' => 'Themes install',
    'function' => 'themes_install_page'
]);


/**
 * Custom theme styles
 */

function custom_theme_styles(){
	$params =  (object) unserialize( get_meta_value('theme_options') );

	if( isset($params->css) && !is_empty($params->css) ){
		$style = '<style>';
		foreach ($params->css as $key => $value) {
			if (!is_empty($value->value)) {
				if(isset($value->selector) ){
					$style .= $value->selector." {\n";
					$style .= "\t".$value->attribute." : ". $value->value ." ;\n";
					$style .= "}\n";
				}
			}
		}
		$style .= '</style>';
		print $style;
	}
}
add_action('os_head', 'custom_theme_styles', 99);