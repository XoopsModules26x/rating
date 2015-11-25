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


require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/include/cp_header.php';

XoopsLoad::load('system', 'system');

$xoops = Xoops::getInstance();
$system = System::getInstance();
$helper = Xoops_Module_Helper::getHelper('rating');
$request = Xoops_Request::getInstance();