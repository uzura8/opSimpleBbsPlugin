<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * base actions class for the opSimpleBbsPlugin.
 *
 * @package    OpenPNE
 * @subpackage simpleBbs
 * @author     uzura8  <uzuranoie@gmail.com>
 */
class opSimpleBbsPluginActions extends sfActions
{
  public function initialize($context, $moduleName, $actionName)
  {
    parent::initialize($context, $moduleName, $actionName);

    $this->security['all'] = array('is_secure' => true, 'credentials' => 'SNSMember');
  }

  public function preExecute()
  {
    if (is_callable(array($this->getRoute(), 'getObject')))
    {
      $object = $this->getRoute()->getObject();
      if ($object instanceof Bbs)
      {
        $this->bbs = $object;
        $this->member = $this->bbs->Member;
      }
      elseif ($object instanceof BbsComment)
      {
        $this->bbsComment = $object;
        $this->bbs = $this->bbsComment->Bbs;
        $this->member = $this->bbs->Member;
      }
      elseif ($object instanceof Member)
      {
        $this->member = $object;
      }
    }

    if (empty($this->member))
    {
      $this->member = $this->getUser()->getMember();
    }
/*
    elseif ($this->member->id !== $this->getUser()->getMemberId())
    {
      $relation = Doctrine::getTable('MemberRelationship')->retrieveByFromAndTo($this->member->id, $this->getUser()->getMemberId());
      $this->forwardIf($relation && $relation->is_access_block, 'default', 'error');
    }
*/
  }

  public function postExecute()
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->setNavigation($this->member);

      // to display header navigations
      $this->setIsSecure();
    }

    if ($this->pager instanceof sfPager)
    {
      $this->pager->init();
    }
  }

  protected function setNavigation(Member $member)
  {
    if ($member->id !== $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_nav_type', 'friend');
      sfConfig::set('sf_nav_id', $member->id);
    }
  }

  protected function setIsSecure()
  {
    if (!$this->isSecure())
    {
      $security = $this->getSecurityConfiguration();

      $actionName = strtolower($this->getActionName());

      $security[$actionName]['is_secure'] = true;

      $this->setSecurityConfiguration($security);
    }
  }

  protected function isBbsAuthor()
  {
    return $this->bbs->isEditable($this->getUser()->getMemberId());
  }

  protected function isBbsViewable()
  {
    return $this->bbs->isViewable($this->getUser()->getMemberId());
  }
}
