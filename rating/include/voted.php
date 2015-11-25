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
include('../../../mainfile.php');

if (!defined('XOOPS_ROOT_PATH')) {
    die();
}

if(isset($_POST['action']))
{
	if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'rating')
	{
		$xoops = Xoops::getInstance();
		$helper = Rating::getInstance();

		if (!$xoops->isUser()) {
			exit(XoopsLocale::E_NO_ACCESS_PERMISSION);
		}
		$xoops->disableErrorReporting();
		$helper = Xoops_Module_Helper::getHelper('rating');
		$obj = $helper->getHandlerRatingUser()->create();
		echo $idBox;
		$obj->setVar('rating_id', intval($_REQUEST['idBox']));
		$obj->setVar('item_id', intval($_REQUEST['pageId']));
		$obj->setVar('uid', $helper->getUserId());
		$obj->setVar('rate', floatval($_REQUEST['rate']));
		$obj->setVar('date', time());
		$obj->setVar('ip', $helper->xoops()->getenv('REMOTE_ADDR'));
		
		$success = ($helper->getHandlerRatingUser()->insert($obj) == true) ? true : false;
		if($success) {
			echo $_REQUEST['pageId'];
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}
} else {
	echo 0;
}
