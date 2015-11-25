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

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class RatingModulesForm extends XoopsThemeForm
{
    /**
     * @param RatingModules|XoopsObject $obj
     */
    public function __construct(RatingModules $obj)
    {
        $xoops = Xoops::getInstance();

        $title = $obj->isNew() ? sprintf(_AM_RATING_ADD) : sprintf(_AM_RATING_EDIT);
		$nb_stars = $obj->isNew() ? 5 : $obj->getVar('nb_stars');

        parent::__construct($title, 'form', $xoops->getEnv('PHP_SELF'), 'post', true);
		$modules = new XoopsFormSelect(_AM_RATING_MODULES, "mid", $obj->getVar('mid'));
		$modules_array = array();
		$module_handler = $xoops->getHandlerModule();
		$criteria = new CriteriaCompo(new Criteria('hasmain', 1));
        $criteria->add(new Criteria('isactive', 1));		
		$options = $module_handler->getNameList($criteria);       
        $modules->addOptionArray($options);
        $this->addElement($modules, true);
        $this->addElement(new XoopsFormText(_AM_RATING_PAGE, 'page', 2, 25, $obj->getVar('page'), '', '', '', true), true);
        $this->addElement(new XoopsFormText(_AM_RATING_TITLE, 'title', 2, 25, $obj->getVar('title'), '', '', '', true), false);
		$this->addElement(new XoopsFormText(_AM_RATING_NBSTARS, 'nb_stars', 1, 25, $nb_stars, '', '', '', true), true);
		
        $this->addElement(new XoopsFormHidden('id', $obj->getVar('id')));

        /**
         * Buttons
         */
        $button_tray = new XoopsFormElementTray('', '');
        $button_tray->addElement(new XoopsFormHidden('op', 'save'));

        $button = new XoopsFormButton('', 'submit', XoopsLocale::A_SUBMIT, 'submit');
        $button->setClass('btn btn-success');
        $button_tray->addElement($button);

        $button_2 = new XoopsFormButton('', 'reset', XoopsLocale::A_RESET, 'reset');
        $button_2->setClass('btn btn-warning');
        $button_tray->addElement($button_2);

        $this->addElement($button_tray);
    }
}