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

defined('XOOPS_ROOT_PATH') or die('XOOPS root path not defined');

class Rating extends Xoops_Module_Helper_Abstract
{
    /**
     * Init the module
     *
     * @return null|void
     */
    public function init()
    {
        $this->setDirname('rating');
    }

    /**
     * @return Rating
     */
    static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * @return RatingRatingModulesHandler
     */
    public function getHandlerRatingModules()
    {
        return $this->getHandler('modules');
    }
	
	/**
     * @return RatingRatingUserHandler
     */
    public function getHandlerRatingUser()
    {
        return $this->getHandler('user');
    }
	
	public function getUserId()
    {
        if ($this->xoops()->isUser()) {
            return $this->xoops()->user->getVar('uid');
        }
        return 0;
    }
}