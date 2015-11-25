<div style="float:right;">
    <table style="width:100%;">
        <{foreach item=rating from=$ratings}>
            <tr>
                <{if $rating.title != ''}>
                    <td style="width:70%;"><strong><{$rating.title}> :</strong></td><{/if}>
                <td style="width:30%;" id="rating-td-<{$rating.id}>">
                    <div class="rating-<{$rating.id}>" data-average="<{$rating.average_rating}>" data-id="<{$rating.id}>"></div>
                </td>
                <td style="width:10%;">(<{$rating.total_rating}>)</td>
            </tr>
        <{/foreach}>
    </table>
</div>
</div class="clear"></div>
