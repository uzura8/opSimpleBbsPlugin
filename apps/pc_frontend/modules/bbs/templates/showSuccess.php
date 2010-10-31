<?php //use_helper('opDiary', 'Text') ?>

<?php decorate_with('layoutC') ?>

<?php /* {{{ bbsDetailBox */ ?>
<div class="dparts bbsDetailBox"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Thread') ?></h3>

<?php if ($bbs->getPrevious() || $bbs->getNext()): ?>
<div class="block prevNextLinkLine">
<?php if ($bbs->getPrevious()): ?>
<p class="prev"><?php echo link_to(__('Previous Thread'), 'bbs_show', $bbs->getPrevious()) ?></p>
<?php endif; ?>
<?php if ($bbs->getNext()): ?>
<p class="next"><?php echo link_to(__('Next Thread'), 'bbs_show', $bbs->getNext()) ?></p>
<?php endif; ?>
</div>
<?php endif; ?>
</div>

<dl>
<dt><?php echo nl2br(op_format_date($bbs->getCreatedAt(), 'XDateTimeJaBr')) ?></dt>
<dd>
<div class="title">
<p class="heading"><?php echo $bbs->title; ?></p>
</div>
<div class="name">
<p><?php if ($_member = $bbs->getMember()) : ?><?php echo link_to($_member->getName(), 'member/profile?id='.$_member->getId()) ?><?php endif; ?></p>
</div>
<div class="body">
<?php if ($bbs->has_images): ?>
<?php// $images = $bbs->getDiaryImagesJoinFile() ?>
<ul class="photo">
<?php foreach ($images as $image): ?>
<li><a href="<?php// echo sf_image_path($image->File) ?>" target="_blank"><?php// echo image_tag_sf_image($image->File, array('size' => '120x120')) ?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<p class="text">
<?php echo op_url_cmd(op_decoration(nl2br($bbs->body))) ?>
</p>
</div>
</dd>
</dl>
<?php if ($bbs->member_id === $sf_user->getMemberId()): ?>
<div class="operation">
<form action="<?php echo url_for('bbs_edit', $bbs) ?>">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="<?php echo __('Edit this thread') ?>" /></li>
</ul>
</form>
</div>
<?php endif; ?>
</div></div>
<?php /* }}} */ ?>

<?php include_component('bbsComment', 'list', array('bbs' => $bbs)) ?>

<?php if ($sf_user->getMemberId()): ?>
<?php
$form->getWidget('body')->setAttribute('rows', 8);
$form->getWidget('body')->setAttribute('cols', 30);

op_include_form('formBbsComment', $form, array(
  'title' => __('Post a bbs comment'),
  'url' => url_for('@bbs_comment_create?id='.$bbs->id),
  'button' => __('Save'),
  'isMultipart' => true,
//  'body' => $bbs->is_open ? __('Your comment is visible to all users on the Web.') : null,
));
?>
<?php endif; ?>

<?php op_include_line('linkLine', link_to('Threads list', '@bbs_list')) ?>
</div>
