<?php op_include_form('deleteConfirmForm', $form, array(
  'button' => __('Delete'),
  'title'  => __('Do you really delete this thread?'),
  'url'    => url_for('bbs_delete', $bbs),
)) ?>

<?php use_helper('Javascript') ?> 
<?php op_include_line('backLink', link_to_function(__('Back to previous page'), 'history.back()')) ?>
