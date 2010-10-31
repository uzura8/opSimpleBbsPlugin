<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginBbsTable
 *
 * @package    OpenPNE
 * @subpackage action
 * @author     Uzura8 <uzuranoie@gmail.com>
 */
class PluginBbsTable extends Doctrine_Table
{
  public function getBbsList($limit = 5)
  {
    $q = $this->getOrderdQuery();
    $q->limit($limit);

    return $q->execute();
  }

  public function getPreviousBbs(Bbs $bbs)
  {
    $q = $this->createQuery()
      ->andWhere('id < ?', $bbs->id)
      ->orderBy('id DESC');

    return $q->fetchOne();
  }

  public function getNextBbs(Bbs $bbs)
  {
    $q = $this->createQuery()
      ->andWhere('id > ?', $bbs->id)
      ->orderBy('id ASC');

    return $q->fetchOne();
  }

  public function getBbsPager($page = 1, $size = 20)
  {
    $q = $this->getOrderdQuery();

    return $this->getPager($q, $page, $size);
  }

  protected function getPager(Doctrine_Query $q, $page, $size)
  {
    $pager = new sfDoctrinePager('Bbs', $size);
    $pager->setQuery($q);
    $pager->setPage($page);

    return $pager;
  }

  protected function getOrderdQuery()
  {
    return $this->createQuery()->orderBy('updated_at DESC');
  }

  /**
   * Search keywords for bbses in the title and body
   */
  public function getBbsSearchPager($keywords, $page = 1, $size = 20)
  {
    $q = $this->getOrderdQuery();
    $this->addSearchKeywordQuery($q, $keywords);

    $pager = new opNonCountQueryPager('Bbs', $size);
    $pager->setQuery($q);
    $pager->setPage($page);

    return $pager;
  }

  protected function addSearchKeywordQuery(Doctrine_Query $q, $keywords)
  {
    foreach ($keywords as $keyword)
    {
      $q->andWhere('title LIKE ? OR body LIKE ?', array('%'.$keyword.'%', '%'.$keyword.'%'));
    }
  }
}
