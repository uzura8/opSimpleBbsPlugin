<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opSimpleBbsPluginBbsCommentActions
 *
 * @package    OpenPNE
 * @subpackage simpleBbs
 * @author     uzura8 <uzuranoie@gmail.com>
 */
abstract class opSimpleBbsPluginBbsCommentActions extends sfActions
{
  /**
   * preExecute
   */
  public function preExecute()
  {
    $object = $this->getRoute()->getObject();

    if ($object instanceof Bbs)
    {
      $this->bbs = $object;
    }
    elseif ($object instanceof BbsComment)
    {
      $this->bbsComment = $object;
      $this->bbs = $this->bbsComment->getBbs();
    }
  }

  /**
   * Executes create action
   *
   * @param sfRequest $request A request object
   */
  public function executeCreate($request)
  {
    $this->form = new BbsCommentForm();
    $this->form->getObject()->setMemberId($this->getUser()->getMemberId());
    $this->form->getObject()->setBbs($this->bbs);
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    
    if ($this->form->isValid())
    {
      $this->form->save();
      $this->redirect('@bbs_show?id='.$this->bbs->getId());
    }

    $this->setTemplate('../../bbs/templates/show');

    return sfView::SUCCESS;
  }

  /**
   * Executes delete confirm action
   *
   * @param sfRequest $request A redirect object
   */
  public function executeDeleteConfirm($request)
  {
    $this->forward404Unless($this->bbsComment->isDeletable($this->getUser()->getMemberId()));

    $this->form = new sfForm();

    return sfView::SUCCESS;
  }

  /**
   * Executes delete action
   *
   * @param sfRequest $request A redirect object
   */
  public function executeDelete($request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($this->bbsComment->isDeletable($this->getUser()->getMemberId()));

    $this->bbsComment->delete();

    $this->getUser()->setFlash('notice', 'The comment was deleted successfully.');

    $this->redirect('@bbs_show?id='.$this->bbs->getId());
  }
}
