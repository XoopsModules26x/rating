<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Database\Connection;
use Xoops\Core\Kernel\Criteria;
use Xoops\Core\Kernel\CriteriaCompo;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;

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
 * Class RatingUser
 */
class RatingUser extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('rating_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('item_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('rate', XOBJ_DTYPE_INT, null, false);
        $this->initVar('date', XOBJ_DTYPE_INT, null, false);
        $this->initVar('ip', XOBJ_DTYPE_TXTAREA, null, false);
    }
}

/**
 * Class RatingUserHandler
 */
class RatingUserHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param Connection|null $db {@link XoopsDatabase}
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'rating_user', 'RatingUser', 'id', '');
    }

    /**
     * @param  bool|true $asobject
     * @return array
     */
    public function getRatingUser($asobject = true)
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');

        return parent::getAll($criteria, false, $asobject);
    }

    /**
     * @param $Id
     * @param $pageId
     * @return int
     */
    public function getCountRating($Id, $pageId)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('rating_id', $Id, '='));
        $criteria->add(new Criteria('item_id', $pageId, '='));

        return parent::getCount($criteria);
    }

    /**
     * @param $id
     * @param $pageId
     * @return mixed
     */
    public function getAverage($id, $pageId)
    {
        global $xoopsDB;
        $sql = 'SELECT ROUND(AVG(rate),1) FROM ' . $xoopsDB->prefix('rating_user');
        $sql .= ' WHERE item_id = ' . (int)($pageId);
        $sql .= ' AND rating_id = ' . (int)($id);
        $result = $xoopsDB->query($sql);
        list($average) = $xoopsDB->fetchRow($result);

        return $average;
    }

    /**
     * @param $id
     * @param $pageId
     * @return int
     */
    public function getHasVoted($id, $pageId)
    {
        $helper = Rating::getInstance();
        $uid    = $helper->getUserId();
        $ip     = $helper->xoops()->getEnv('REMOTE_ADDR');

        $criteriaUser = new CriteriaCompo();
        $criteriaUser->add(new Criteria('uid', $uid), 'OR');
        $criteriaUser->add(new Criteria('ip', $ip));

        $criteriaModule = new CriteriaCompo();
        $criteriaModule->add(new Criteria('item_id', $pageId), 'AND');
        $criteriaModule->add(new Criteria('rating_id', $id));
        $criteriaUser->add($criteriaModule, 'AND');

        return parent::getCount($criteriaUser);
    }
}
