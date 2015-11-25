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
 
if (!defined('XOOPS_ROOT_PATH') || !is_object($GLOBALS["xoopsModule"])) {
    die();
}

function rating($pageId = 0, $pageName = '')
{
	$xoops = Xoops::getInstance();
	
    if (!is_object($GLOBALS["xoopsModule"]) || "rating" != $GLOBALS["xoopsModule"]->getVar("dirname")) {
		$xoops->loadLanguage('main', 'rating');
    }
    
    if (is_numeric($pageId)) {
        $moduleId = $GLOBALS["xoopsModule"]->getVar("mid");
		
		$script_name = explode('/', $_SERVER['SCRIPT_NAME']);
		$pageName = end($script_name);
		
		$helper = Xoops_Module_Helper::getHelper('rating');
		$rating = $helper->getHandlerRatingModules()->getRatingDisplay($pageId, $pageName, $moduleId);
    }
	$script = '(function($){
					$(document).ready(function(){';
	foreach($rating as $ratings) {
					$script .= '$(".rating-'.$ratings['id'].'").jRating({
						url: "'.XOOPS_URL.'",
						length : '.$ratings['nb_stars'].',
						rateMax : '.$ratings['nb_stars'].',
						pageId : '.$ratings['pageId'].',
						isDisabled : '.$ratings['hasVoted'].'
					});';
	}
	$script .= '	});
			   })(jQuery)';
	$xoops->theme()->addScript('', array('type' => 'text/javascript'), $script);
	
    return $rating;
}
?>