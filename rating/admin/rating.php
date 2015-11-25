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

include dirname(__FILE__) . '/header.php';

// Call Header & ...
$xoops->header('rating.html');
$admin_page = new XoopsModuleAdmin();
$admin_page->renderNavigation('rating.php');
$xoops->theme()->addScript('media/xoops/xoops.js');
$xoops->theme()->addStylesheet('modules/system/css/admin.css');

// Parameters
$nb_rating = $helper->getConfig('rating_pager');

// Get $_GET, $_POST, ...
$op = $request->asStr('op', 'list');
$start = $request->asInt('start', 0);

switch ($op) {
    case 'list':
    default:
        $admin_page->addTips(_AM_RATING_TIPS);
        $admin_page->addItemButton(_AM_RATING_ADD, 'rating.php?op=add', 'add');
        $admin_page->renderTips();
        $admin_page->renderButton();

        $rating_count = $helper->getHandlerRatingModules()->getCount();
        $rating = $helper->getHandlerRatingModules()->getRatingModules($start, $nb_rating, false);

        $xoops->tpl()->assign('rating', $rating);
        $xoops->tpl()->assign('rating_count', $rating_count);

        // Display Page Navigation
        if ($rating_count > $nb_rating) {
            $nav = new XoopsPageNav($rating_count, $nb_rating, $start, 'start', 'op=list');
            $xoops->tpl()->assign('nav_menu', $nav->renderNav(2));
        }
        break;

    // New rating
    case 'add':
        $admin_page->addItemButton(_AM_RATING_LIST, 'rating.php', 'application-view-detail');
        $admin_page->renderButton();
        $xoops->tpl()->assign('info_msg', $xoops->alert('info', $info_msg, _AM_RATING_ALERT_INFO_TITLE));
        // Create form
        $obj = $helper->getHandlerRatingModules()->create();
        $form = $helper->getForm($obj, 'modules');
        $xoops->tpl()->assign('form', $form->render());
        break;

    // Edit smilie
    case 'edit':
        $admin_page->addItemButton(_AM_RATING_LIST, 'rating.php', 'application-view-detail');
        $admin_page->renderButton();
        $xoops->tpl()->assign('info_msg', $xoops->alert('info', $info_msg, _AM_RATING_ALERT_INFO_TITLE));
        // Create form
        $id = $request->asInt('id', 0);
        $obj = $helper->getHandlerRatingModules()->get($id);
        $form = $helper->getForm($obj, 'modules');
        $xoops->tpl()->assign('form', $form->render());
        break;

    // Save smilie
    case 'save':
        if (!$xoops->security()->check()) {
            $xoops->redirect('rating.php', 3, implode('<br />', $xoops->security()->getErrors()));
        }

        $id = $request->asInt('id', 0);
        if (isset($id) && $id !=0) {
            $obj = $helper->getHandlerRatingModules()->get($id);
        } else {
            $obj = $helper->getHandlerRatingModules()->create();
			
        }
		$obj->setVar('mid', $request->asInt('mid', 0));
        $obj->setVar('page', $request->asStr('page', ''));
        $obj->setVar('title', $request->asStr('title', ''));
		$obj->setVar('status', $request->asBool('status', 1));
        $obj->setVar('display', $request->asBool('display', 1));
		$obj->setVar('nb_stars', $request->asInt('nb_stars', 5));

        $error_msg = '';
        if ($error_msg == ''){
            if ($helper->getHandlerRatingModules()->insert($obj)) {
                $xoops->redirect('rating.php', 2, _AM_RATING_SAVE);
            }
            $error_msg .= $obj->getHtmlErrors();
        }
        $admin_page->addItemButton(_AM_RATING_LIST, 'rating.php', 'application-view-detail');
        $admin_page->renderButton();
        $xoops->tpl()->assign('info_msg', $xoops->alert('info', $info_msg, _AM_RATING_ALERT_INFO_TITLE));
        $xoops->tpl()->assign('error_msg', $xoops->alert('error', $error_msg, _AM_RATING_ALERT_ERROR_TITLE));
        $form = $helper->getForm($obj, 'rating');
        $xoops->tpl()->assign('form', $form->render());
        break;

    //Del a rating
    case 'del':
        $id = $request->asInt('id', 0);
        $ok = $request->asInt('ok', 0);
        $obj = $helper->getHandlerRatingModules()->get($id);

        if ($ok == 1) {
            if (!$xoops->security()->check()) {
                $xoops->redirect('rating.php', 3, implode(',', $xoops->security()->getErrors()));
            }
            if ($helper->getHandlerRatingModules()->delete($obj)) {
                $xoops->redirect('rating.php', 2, _AM_RATING_DELETED);
            } else {
                echo $xoops->alert('error', $obj->getHtmlErrors());
            }
        } else {
            $xoops->confirm(array(
                                 'ok' => 1, 'id' => $id, 'op' => 'del'
                            ), XOOPS_URL . '/modules/rating/admin/rating.php', sprintf(_AM_RATING_SUREDEL) . '<br />');
        }
        break;

    case 'rating_update_display':
        $id = $request->asInt('id', 0);
        if ($id > 0) {
            $obj = $helper->getHandlerRatingModules()->get($id);
            $old = $obj->getVar('display');
            $obj->setVar('display', !$old);
            if ($helper->getHandlerRatingModules()->insert($obj)) {
                exit;
            }
            echo $obj->getHtmlErrors();
        }
    break;
	
    /*case 'rating_update_status':
        $id = $request->asInt('id', 0);
        if ($id > 0) {
            $obj = $helper->getHandlerRatingModules()->get($id);
            $old = $obj->getVar('status');
            $obj->setVar('status', !$old);
            if ($helper->getHandlerRatingModules()->insert($obj)) {
                exit;
            }
            echo $obj->getHtmlErrors();
        }
    break;*/
}
$xoops->footer();