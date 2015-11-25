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

//if (!defined('XOOPS_ROOT_PATH') || !is_object($GLOBALS["xoopsModule"])) {
//    die();
//}

/**
 * @param  int    $pageId
 * @param  string $pageName
 * @return mixed
 */
function rating($pageId = 0, $pageName = '')
{
    $xoops = Xoops::getInstance();

    if (!is_object($GLOBALS['xoopsModule']) || 'rating' !== $GLOBALS['xoopsModule']->getVar('dirname')) {
        $xoops->loadLanguage('main', 'rating');
    }

    if (is_numeric($pageId)) {
        $moduleId = $GLOBALS['xoopsModule']->getVar('mid');

        $script_name = explode('/', $_SERVER['SCRIPT_NAME']);
        $pageName    = end($script_name);

        $helper = Xoops\Module\Helper::getHelper('rating');
        $ratings = $helper->getHandlerRatingModules()->getRatingDisplay($pageId, $pageName, $moduleId);
    }
    $script = '(function($){
                    $(document).ready(function(){';
    foreach ($ratings as $rating) {
        $script .= '$(".rating-' . $rating['id'] . '").jRating({
                        url: "' . XOOPS_URL . '",
                        length : ' . $rating['nb_stars'] . ',
                        rateMax : ' . $rating['nb_stars'] . ',
                        pageId : ' . $rating['pageId'] . ',
                        isDisabled : ' . $rating['hasVoted'] . '
                    });';
    }
    $script .= '    });
               })(jQuery)';
    $xoops->theme()->addScript('', array('type' => 'text/javascript'), $script);

    return $ratings;
}
