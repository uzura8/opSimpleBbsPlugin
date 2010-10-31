<?php
$options = array();
$options['title'] = __('Edit the thread');
$options['url'] = url_for('bbs_update', $bbs);
$options['isMultipart'] = true;
op_include_form('formBbs', $form, $options);
?>

<?php
op_include_parts('buttonBox', 'toDelete', array(
  'title'  => __('Delete the thread and comments'),
  'button' => __('Delete'),
  'url' => url_for('bbs_delete_confirm', $bbs),
  'method' => 'get',
));
?>
