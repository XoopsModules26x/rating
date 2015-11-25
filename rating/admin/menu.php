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
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         rating
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 */

$adminmenu = array();

$i = 1;
$adminmenu[$i]['title'] = _MI_RATING_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$adminmenu[$i]['icon'] = 'home.png';

$i++;
$adminmenu[$i]['title'] = _MI_RATING_MANAGE;
$adminmenu[$i]['link'] = "admin/rating.php";
$adminmenu[$i]['icon'] = 'manage.png';

$i++;
$adminmenu[$i]['title'] = _MI_RATING_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['icon'] = 'about.png';