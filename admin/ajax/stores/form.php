<?php
/**
 * 2016 OkadShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@okadshop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade OkadShop to newer
 * versions in the future. If you wish to customize OkadShop for your
 * needs please refer to http://www.okadshop.com for more information.
 *
 * @author    OkadShop <contact@okadshop.com>
 * @copyright 2016 OkadShop
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of OkadShop
 */

include '../../../config/bootstrap.php';


use Core\Cookie;
use Core\Session;
use Core\Database\Database;


//This is an ajax request
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
	die();
}

global $common;
$id_s = intval($_POST['id_s']);
if( $id_s < 1 ) return;


//prepare data
$s_data = $_POST;
if( empty($s_data['ssl_active']) ) $s_data['ssl_active'] = 0;
unset($s_data[id_s]);

$db = Database::getInstance();
$shop_data = $db->select('shop', array('*'), true);
$shop_session = (object) array_merge( (array) $shop_data, $s_data);

$update = $common->update('shop', $s_data, "WHERE id=".$id_s );
if( $update ){
    if( Session::set('shop', $shop_session) ){
		$return['msg']  = l("Les Coordonnées ont été bien mise à jour.", "core");
		echo json_encode( $return );
    }       
}