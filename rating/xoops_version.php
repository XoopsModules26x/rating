<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * rating module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         rating
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 */

$modversion                = array();
$modversion['name']        = _MI_RATING_NAME;
$modversion['description'] = _MI_RATING_DSC;
$modversion['version']     = 0.2;
$modversion['author']      = 'Kraven30';
$modversion['nickname']    = 'Cointin Maxime';
$modversion['credits']     = 'The XOOPS Project, Mamba';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']    = 1;
$modversion['help']        = 'page=help';
$modversion['image']       = 'assets/images/module_logo.png';
$modversion['dirname']     = 'rating';

//about
$modversion['release_date']        = '2015/11/23';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'ALPHA 1';
$modversion['min_php']             = '5.4';
$modversion['min_xoops']           = '2.6.0';
$modversion['min_db']              = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');

// paypal
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'cointin.maxime@gmail.com';
$modversion['paypal']['item_name']     = '';
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'EUR';

// Admin things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

//Menus
$modversion['hasMain'] = 0;

// Manage extension
$modversion['extension']          = 1;
$modversion['extension_module'][] = 'system';

// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// JQuery
$modversion['jquery'] = 1;

// Tables created by sql file (without prefix!)
$modversion['tables'][1] = 'rating_modules';
$modversion['tables'][2] = 'rating_user';
// Preferences
$i                                       = 0;
$modversion['config'][$i]['name']        = 'rating_pager';
$modversion['config'][$i]['title']       = '_MI_RATING_PAGER';
$modversion['config'][$i]['description'] = '_MI_RATING_PAGERDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 20;
