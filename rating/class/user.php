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

class RatingUser extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar("id", XOBJ_DTYPE_INT, null, false);
		$this->initVar("rating_id", XOBJ_DTYPE_INT, null, false);
        $this->initVar("item_id", XOBJ_DTYPE_INT, null, false);
        $this->initVar("uid", XOBJ_DTYPE_INT, null, false);
        $this->initVar("rate", XOBJ_DTYPE_INT, null, false);
        $this->initVar("date", XOBJ_DTYPE_INT, null, false);
		$this->initVar("ip", XOBJ_DTYPE_TXTAREA, null, false);
    }
}

class RatingUserHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param XoopsDatabase|null $db {@link XoopsDatabase}
     */
    public function __construct(XoopsDatabase $db = null)
    {
        parent::__construct($db, 'rating_user', 'RatingUser', 'id', '');
    }

    public function getRatingUser($asobject=true)
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
        return parent::getall($criteria, false, $asobject);
    }	
	
	public function getCountRating($Id, $pageId)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('rating_id', $Id, '='));
		$criteria->add(new Criteria('item_id', $pageId, '='));
        return parent::getCount($criteria);
    }
	
	public function getAverage($id, $pageId)
    {
		$sql = 'SELECT ROUND(AVG(rate),1) FROM '.$this->db->prefix('rating_user');
        $sql .= ' WHERE item_id = ' . intval($pageId);
        $sql .= ' AND rating_id = ' . intval($id);
        $result = $this->db->query($sql);
        list($average) = $this->db->fetchRow($result);
		return $average;
	}
	
	public function getHasVoted($id, $pageId)
    {
        $helper = Rating::getInstance();
        $uid = $helper->getUserId();
        $ip  = $helper->xoops()->getenv('REMOTE_ADDR');

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('uid', $uid), 'OR');
        $criteria->add(new Criteria('ip', $ip), 'OR');
        $criteria->add(new Criteria('item_id', $pageId), 'AND');
		$criteria->add(new Criteria('rating_id', $id), 'AND');
		return parent::getCount($criteria);
	}
}