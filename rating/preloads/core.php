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

defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Class RatingCorePreload
 */
class RatingCorePreload extends XoopsPreloadItem
{
    /**
     * @param $args
     */
    public static function eventCoreIncludeCommonEnd($args)
    {
        $path = dirname(__DIR__);
        XoopsLoad::addMap(array('rating' => $path . '/class/helper.php'));
    }

    /**
     * @param $args
     */
    public static function eventCoreHeaderAddmeta($args)
    {
        $path  = dirname(__DIR__);
        $xoops = Xoops::getInstance();
        $xoops->theme()->addStylesheet('/modules/rating/assets/css/jRating.jquery.css');
        $xoops->theme()->addScript('media/jquery/jquery.js');
        $xoops->theme()->addScript('/modules/rating/assets/js/jRating.jquery.js');
    }
}
