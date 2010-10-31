<?php use_helper('opSimpleBbs') ?>

<div id="homeRecentList_<?php echo $gadget->id ?>" class="dparts homeRecentList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Recently Posted Threads of All') ?></h3></div>
<div class="block">

<?php if (count($bbsList)): ?>
<ul class="articleList">
<?php foreach ($bbsList as $bbs): ?>
<li><span class="date"><?php echo op_format_date($bbs->updated_at, 'XShortDateJa') ?></span><?php echo op_bbs_link_to_show($bbs) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<div class="moreInfo">
<ul class="moreInfo">
<?php if (count($bbsList)): ?>
<li><?php echo link_to(__('More'), '@bbs_list') ?></li>
<?php endif; ?>
<li><?php echo link_to(__('Post a threads'), 'bbs_new') ?></li>
</ul>
</div>

</div>
</div></div>
