<?php

class opSimpleBbsPluginBbsActions extends opSimpleBbsPluginActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('bbs', 'list');
  }

  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Bbs')->getBbsPager($request['page'], 20);
  }

  public function executeSearch(sfWebRequest $request)
  {
    $this->keyword = $request['keyword'];

    $keywords = opDiaryPluginToolkit::parseKeyword($this->keyword);
    $this->forwardUnless($keywords, 'bbs', 'list');

    $this->pager = Doctrine::getTable('Bbs')->getBbsSearchPager($keywords, $request['page'], 20);
    $this->setTemplate('list');
  }

  public function executeShow(sfWebRequest $request)
  {
/*
    if ($this->isDiaryAuthor())
    {
      Doctrine::getTable('DiaryCommentUnread')->unregister($this->diary);
    }
*/

//    $this->pager = Doctrine::getTable('bbsComment')
//      ->getCommentListPager($this->thread->getId(), $request->getParameter('page', 1));
 
    $this->form = new BbsCommentForm();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BbsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new BbsForm();
    $this->form->getObject()->member_id = $this->getUser()->getMemberId();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->isBbsAuthor());

    $this->form = new BbsForm($this->bbs);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($this->isBbsAuthor());

    $this->form = new bbsForm($this->bbs);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDeleteConfirm(sfWebRequest $request)
  {
    $this->forward404Unless($this->isBbsAuthor());

    $this->form = new BaseForm();
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($this->isBbsAuthor());
    $request->checkCSRFProtection();

    $this->bbs->delete();

    $this->getUser()->setFlash('notice', 'The thread was deleted successfully.');

    $this->redirect('@bbs_list');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    if ($form->isValid())
    {
      $bbs = $form->save();

      $this->redirect('@bbs_show?id='.$bbs->id);
    }
  }
}
