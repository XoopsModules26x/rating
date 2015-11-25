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

class RatingModules extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('mid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('page', XOBJ_DTYPE_OTHER, null, false, 255);
		$this->initVar('default', XOBJ_DTYPE_INT, null, false);
		$this->initVar('title', XOBJ_DTYPE_OTHER, null, false, 255);
		$this->initVar('status', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('display', XOBJ_DTYPE_INT, 1, false);
		$this->initVar("nb_stars", XOBJ_DTYPE_INT, null, false);
    }
	
	public function getValues($keys = null, $format = null, $maxDepth = null)
    {
		$xoops = Xoops::getInstance();
		$module_handler = $xoops->getHandlerModule();
        $ret = parent::getValues($keys, $format, $maxDepth);
		$module = $module_handler->getById($this->getVar('mid'));
        $ret['module'] = $module->getVar('name');
		$delete = ($this->getVar('default') == 1) ? false : true;
		$ret['delete'] = $delete;
		return $ret;
    }
}

class RatingModulesHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param XoopsDatabase|null $db {@link XoopsDatabase}
     */
    public function __construct(XoopsDatabase $db = null)
    {
        parent::__construct($db, 'rating_modules', 'RatingModules', 'id', '');
    }

    public function getRatingModules($start=0, $limit=0, $asobject=true)
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getall($criteria, false, $asobject);
    }
	
    public function getRatingDisplay($pageId, $pageName, $moduleId)
    {
        $xoops = Xoops::getInstance();
		
		$criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
		$criteria->add(new Criteria('display', 1));
		$criteria->add(new Criteria('status', 1));
		$criteria->add(new Criteria('mid', $moduleId, '='));
		$criteria->add(new Criteria('page', $pageName, '='));
		$modulesCount = $this->getCount($criteria, true);
		if($modulesCount > 0) {
			$modulesArray = $this->getObjects($criteria, true);
			$ret = array();
			$helper = Xoops_Module_Helper::getHelper('rating');
			foreach (array_keys($modulesArray) as $i) {
				$ret[$i]['id'] = $modulesArray[$i]->getVar('id');
				$ret[$i]['title'] = $modulesArray[$i]->getVar('title');
				$ret[$i]['nb_stars'] = $modulesArray[$i]->getVar('nb_stars');
				$ret[$i]['total_rating'] = $helper->getHandlerRatingUser()->getCountRating($modulesArray[$i]->getVar('id'), $pageId);
				$average_rating = $helper->getHandlerRatingUser()->getAverage($modulesArray[$i]->getVar('id'), $pageId);
				$ret[$i]['average_rating'] = ($average_rating > 0) ? $average_rating : 0; 
				$ret[$i]['hasVoted'] = ($helper->getHandlerRatingUser()->getHasVoted($modulesArray[$i]->getVar('id'), $pageId) > 0) ? 'true' : 'false';
				$ret[$i]['pageId'] = $pageId;
			}
		}
		//var_dump($ret);
        return $ret;
    }	 
}