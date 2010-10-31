<?php

/**
 * PluginBbs form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginBbsForm extends BaseBbsForm
{
  public function setup()
  {
    parent::setup();

    unset($this['id']);
    $this->useFields(array('title', 'body'));

    $this->widgetSchema['title'] = new sfWidgetFormInput(array(),array('maxlength'=>150));
    $this->widgetSchema['title']->setLabel('タイトル');
    $this->widgetSchema['body']  = new opWidgetFormRichTextareaOpenPNE();
    $this->widgetSchema['body']->setLabel('本文');

    $this->validatorSchema['title'] = new opValidatorString(array('max_length' => 150, 'trim' => true));
    $this->validatorSchema['body']  = new opValidatorString(array('rtrim' => true));

/*
    if (sfConfig::get('app_diary_is_upload_images', true))
    {
      $images = array();
      if (!$this->isNew())
      {
        $images = $this->getObject()->getDiaryImages();
      }

      $max = (int)sfConfig::get('app_diary_max_image_file_num', 3);
      for ($i = 1; $i <= $max; $i++)
      {
        $key = 'photo_'.$i;

        if (isset($images[$i]))
        {
          $image = $images[$i];
        }
        else
        {
          $image = new DiaryImage();
          $image->setDiary($this->getObject());
          $image->setNumber($i);
        }

        $imageForm = new DiaryImageForm($image);
        $imageForm->getWidgetSchema()->setFormFormatterName('list');
        $this->embedForm($key, $imageForm, '<ul id="diary_'.$key.'">%content%</ul>');
      }
    }
*/
  }

  public function save()
  {
/*
    if ($this->isNew())
    {
      $this->getObject()->setLastCommentedAt(date('Y-m-d H:i:s', time()));
      $this->getObject()->setMemberId($this->getOption('member_id'));
    }
*/
    return parent::save();
  }
}
