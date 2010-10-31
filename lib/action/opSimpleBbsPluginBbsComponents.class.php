<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * bbs components.
 *
 * @package    OpenPNE
 * @subpackage bbs
 * @author     uzura8 <uzuranoie@gmail.com>
 */
class opSimpleBbsPluginBbsComponents extends sfComponents
{
  public function executeBbsList()
  {
    $max = ($this->gadget) ? $this->gadget->getConfig('max') : 5;
    $this->bbsList = Doctrine::getTable('Bbs')->getBbsList($max);
  }

  public function executeMyDiaryList()
  {
    $max = ($this->gadget) ? $this->gadget->getConfig('max') : 5;
    $this->diaryList = Doctrine::getTable('Diary')->getMemberDiaryList($this->getUser()->getMemberId(), $max, $this->getUser()->getMemberId());
  }

/*
  public function executeNoticeUnreadDiaryComment(sfWebRequest $request)
  {
    $memberId = $this->getUser()->getMemberId();
    if ($this->count = Doctrine::getTable('DiaryCommentUnread')->countUnreadDiary($memberId))
    {
      $this->diary = Doctrine::getTable('DiaryCommentUnread')->findOneByMemberId($memberId)->Diary;
    }
  }

  public function executeDailyNews()
  {
    $env = 'mobile_frontend' == sfConfig::get('sf_app') ? 'mobile' : 'pc';
    $twigEnvironment = new Twig_Environment(new Twig_Loader_String());
    $valueTpl = $twigEnvironment->loadTemplate(opDiaryPluginToolkit::getMailTemplate($env, 'diaryGagdet'));
    $diaries = Doctrine::getTable('Diary')->getFriendDiaryList($member['id'], 5);

    if (!count($diaries))
    {
      return sfView::NONE;
    }

    $result = array();
    foreach ($diaries as $key => $diary)
    {
      $result[$key]['Member'] = $diary->Member;
      $result[$key]['title'] = $diary->title;
      $result[$key]['id'] = $diary->id;
    }
    $params = array(
      'diaries'   => $result,
      'count'     => count($diaries),
      'sf_config' => sfConfig::getAll(),
    );

    $this->value = $valueTpl->render($params);
  }
*/
}
