<?php
$form->getWidget('title')->setAttribute('size', 40);
$form->getWidget('body')->setAttribute('rows', 20);
$form->getWidget('body')->setAttribute('cols', 50);

$options = array(
  'button' => __('Save'),
  'isMultipart' => true,
);

if ($form->isNew())
{
  $options['title'] = __('Post a bbs');
  $options['url'] = url_for('bbs_create');
}
else
{
  $options['title'] = __('Edit the bbs');
  $options['url'] = url_for('bbs_update', $diary);
}

op_include_form('bbsForm', $form, $options);
?>
