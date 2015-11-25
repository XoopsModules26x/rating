<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Request;

/**
 * rating module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         rating
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 */
include('../../../mainfile.php');

//if (!defined('XOOPS_ROOT_PATH')) {
//    die();
//}

if (isset($_POST['action'])) {
    if (htmlentities(Request::getString('action', '', 'POST'), ENT_QUOTES, 'UTF-8') === 'rating') {
        $xoops  = Xoops::getInstance();
        $helper = Rating::getInstance();

        if (!$xoops->isUser()) {
            exit(XoopsLocale::E_NO_ACCESS_PERMISSION);
        }
        $xoops->disableErrorReporting();
        $helper = Xoops\Module\Helper::getHelper('rating');
        $obj    = $helper->getHandlerRatingUser()->create();
        echo $idBox;
        $obj->setVar('rating_id', Request::getInt('idBox'));
        $obj->setVar('item_id', Request::getInt('pageId'));
        $obj->setVar('uid', $helper->getUserId());
        $obj->setVar('rate', Request::getFloat('rate'));
        $obj->setVar('date', time());
        $obj->setVar('ip', $helper->xoops()->getenv('REMOTE_ADDR'));

        $success = ($helper->getHandlerRatingUser()->insert($obj) === true);
        if ($success) {
            echo Request::getInt('pageId');
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
