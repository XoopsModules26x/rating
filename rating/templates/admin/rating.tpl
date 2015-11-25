<script type="text/javascript">
    Xoops.setStatusImg('accept', '<{xoAdminIcons 'success.png'}>');
    Xoops.setStatusImg('cancel', '<{xoAdminIcons 'cancel.png'}>');
    Xoops.setStatusText('accept', '<{$smarty.const._AM_RATING_OFF}>');
    Xoops.setStatusText('cancel', '<{$smarty.const._AM_RATING_ON}>');
</script>
<{include file="admin:system/admin_navigation.tpl"}>
<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>

<{if isset($info_msg)}>
    <{$info_msg}>
<{/if}>
<{if isset($error_msg)}>
    <{$error_msg}>
<{/if}>

<{if $rating_count > 0}>
    <table id="xo-smilies-sorter" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtcenter"><{$smarty.const._AM_RATING_MODULE}></th>
            <th class="txtcenter"><{$smarty.const._AM_RATING_PAGE}></th>
            <th class="txtleft"><{$smarty.const._AM_RATING_TITLE}></th>
            <th class="txtleft"><{$smarty.const._AM_RATING_NBSTARS}></th>
            <{*<th class="txtcenter"><{$smarty.const._AM_RATING_STATUS}></th>*}>
            <th class="txtcenter"><{$smarty.const._AM_RATING_DISPLAY}></th>
            <th class="txtcenter"><{$smarty.const._AM_RATING_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=rating from=$ratings}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtcenter width10"><{$rating.module}></td>
                <td class="txtcenter width10"><{$rating.page}></td>
                <td class="txtcenter width10"><{$rating.title}></td>
                <td class="txtcenter width10"><{$rating.nb_stars}></td>
                <{*<td class="xo-actions txtcenter width5">*}>
                <{*<img id="loading_status<{$rating.id}>" src="<{xoAppUrl media/xoops/images/spinner.gif}>" style="display:none;" alt="<{translate key='LOADING'}>" />*}>
                <{*<img class="cursorpointer" id="status<{$rating.id}>" onclick="Xoops.changeStatus( 'rating.php', { op: 'rating_update_status', id: <{$rating.id}> }, 'status<{$rating.id}>', 'rating.php' )" src="<{if $rating.status}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $rating.status}><{$smarty.const._AM_RATING_OFF}><{else}><{$smarty.const._AM_RATING_ON}><{/if}>" title="<{if $rating.status}><{$smarty.const._AM_RATING_OFF}><{else}><{$smarty.const._AM_RATING_ON}><{/if}>" />*}>
                <{*</td>*}>
                <td class="xo-actions txtcenter width5">
                    <img id="loading_display<{$rating.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;"
                         alt="<{translate key='LOADING'}>"/>
                    <img class="cursorpointer" id="display<{$rating.id}>"
                         onclick="Xoops.changeStatus( 'rating.php', { op: 'rating_update_display', id: <{$rating.id}> }, 'display<{$rating.id}>', 'rating.php' )"
                         src="<{if $rating.display}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>"
                         alt="<{if $rating.display}><{$smarty.const._AM_RATING_OFF}><{else}><{$smarty.const._AM_RATING_ON}><{/if}>"
                         title="<{if $rating.display}><{$smarty.const._AM_RATING_OFF}><{else}><{$smarty.const._AM_RATING_ON}><{/if}>"/>
                </td>
                <td class="xo-actions txtcenter width10">
                    <a href="rating.php?op=edit&amp;id=<{$rating.id}>" title="<{$smarty.const._AM_RATING_EDIT}>"><img
                                src="<{xoAdminIcons 'edit.png'}>" alt="<{$smarty.const._AM_RATING_EDIT}>"></a><a
                            href="rating.php?op=del&amp;id=<{$rating.id}>" title="<{$smarty.const._AM_RATING_DELETE}>"><img
                                src="<{xoAdminIcons 'delete.png'}>" alt="<{$smarty.const._AM_RATING_DELETE}>"></a>
                </td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <{*Display rating navigation *}>
    <div class="clear spacer"></div>
    <{if isset($nav_menu)}>
        <div class="xo-rating-pagenav floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>

<!-- Display rating form (add,edit) -->
<{if isset($form)}>
    <{$form}>
<{/if}>
