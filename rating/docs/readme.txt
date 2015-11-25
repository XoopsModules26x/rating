Read Me First
-------------------

This modules provides Rating feature to other modules.

Requirements
_____________________________________________________________________

- PHP version >= 5.4.0
- XOOPS 2.6.0+

Install/uninstall
------------------
No special measures necessary, follow the standard installation process & extract the /page folder into the ../modules directory. Install the module through Admin -> System Module -> Modules.

Detailed instructions on installing modules are available in the XOOPS Operations Manual (http://goo.gl/adT2i)

Operating instructions
------------------------

In order to get other modules to utilize the "Ratings module", you need to do following:

1) In your PHP file add:

a) XOOPS >= 2.6:

       ($helper->getConfig('useRating') == 1)

b) XOOPS < 2.6:

XOOPS ($xoopsModuleConfig['useRating'] == 1)

2) $content_id: ID your php page

3) if 'useRating' is defined in your xoopsversion.php then:

       if (($helper->getConfig('useRating') == 1) and (is_dir('../rating'))){

4) if "useRating" is not defined in your xoopsversion.php, then don't use 'useRating':

       if ((is_dir('../rating'))){
           require_once XOOPS_ROOT_PATH.'/modules/rating/include/rating.php';
           $xoopsTpl->assign('ratingPerm', true);
           $xoopsTpl->assign('rating', rating($content_id));
       } else {
           $xoopsTpl->assign('ratingPerm', false);
       }


2) In your template file add:

       ‹{if $ratingPerm}›
           ‹{includeq file="module:rating/rating.tpl"}›
       ‹{/if}›

