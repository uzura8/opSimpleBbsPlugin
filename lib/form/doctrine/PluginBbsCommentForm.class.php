<?php

/**
 * PluginBbsComment form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginBbsCommentForm extends BaseBbsCommentForm
{
  public function setup()
  {
    parent::setup();

    unset($this['id']);
    $this->useFields(array('body'));

    $this->validatorSchema['body'] = new opValidatorString(array('rtrim' => true));
/*
    if (sfConfig::get('app_diary_comment_is_upload_images', true))
    {
      $max = (int)sfConfig::get('app_diary_comment_max_image_file_num', 3);
      for ($i = 1; $i <= $max; $i++)
      {
        $key = 'photo_'.$i;

        $image = new DiaryCommentImage();
        $image->setDiaryComment($this->getObject());

        $imageForm = new DiaryCommentImageForm($image);
        $imageForm->getWidgetSchema()->setFormFormatterName('list');
        $this->embedForm($key, $imageForm, '<ul id="diary_comment_'.$key.'">%content%</ul>');
      }
    }
*/
  }
/*
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);

    foreach ($this->embeddedForms as $key => $form)
    {
      if (!($form->getObject() && $form->getObject()->getFile()))
      {
        unset($this->embeddedForms[$key]);
      }
    }

    return $object;
  }
*/
}
