<?php use_helper('opSimpleBbs'); ?>

<?php if ($sf_user->getMemberId() === $member->id): ?>
<?php op_include_box('newBbsLink', link_to(__('Post a bbs'), 'bbs_new'), array('title' => __('Post a bbs'))) ?>
<?php endif; ?>

<div id="bbsSearchFormLine" class="parts searchFormLine">
<form action="<?php echo url_for('@bbs_search') ?>" method="get">
<p class="form">
<input id="keyword" type="text" class="input_text" name="keyword" size="30" value="<?php if (isset($keyword)) echo $keyword ?>" />
<input type="submit" value="<?php echo __('Search') ?>" />
</p>
</form>
</div>

<?php
if (!isset($keyword))
{
  $title = __('Recently Posted threads');
  $pagerLink = '@bbs_list?page=%d';
}
else
{
  $title = __('Search Results');
  $pagerLink = '@bbs_search?keyword='.$keyword.'&page=%d';
}
?>
<?php if ($pager->getNbResults()): ?>
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3><?php echo $title ?></h3></div>
<?php echo op_include_pager_navigation($pager, $pagerLink); ?>
<div class="block">
<?php foreach ($pager->getResults() as $bbs): ?>
<div class="ditem"><div class="item"><table><tbody><tr>
<!--
<td rowspan="4" class="photo"><a href="<?php echo url_for('bbs_show', $bbs) ?>"><?php echo image_tag_sf_image($bbs->Member->getImageFilename(), array('size' => '76x76')) ?></a></td>
-->
<th><?php echo __('%Nickname%') ?></th><td><?php echo $bbs->Member->name ?></td>
</tr><tr>
<th><?php echo __('Title') ?></th><td><?php echo op_bbs_get_title_and_count($bbs) ?><?php echo op_bbs_image_icon($bbs) ?></td>
</tr><tr>
<th><?php echo __('Body') ?></th><td><?php echo op_truncate(op_decoration($bbs->body, true), 36, '', 3) ?></td>
</tr><tr class="operation">
<th><?php echo __('Updated at') ?></th><td><span class="text"><?php echo op_format_date($bbs->updated_at, 'XDateTimeJa') ?></span> <span class="moreInfo"><?php echo link_to(__('View this bbs'), 'bbs_show', $bbs) ?></span></td>
</tr></tbody></table></div></div>
<?php endforeach; ?>
</div>
<?php echo op_include_pager_navigation($pager, $pagerLink); ?>
</div></div>
<?php else: ?>
<?php op_include_box('bbsList', (!isset($keyword)) ? __('There are no threads.') : __('Your search "%1%" did not match any threads.', array('%1%' => $keyword)), array('title' => $title)) ?>
<?php endif; ?>
