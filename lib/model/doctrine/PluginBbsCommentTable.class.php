<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginBbsCommentTable
 *
 * @package    OpenPNE
 * @subpackage action
 * @author     Uzura8 <uzuranoie@gmail.com>
 */
class PluginBbsCommentTable extends Doctrine_Table
{
  public function retrieveByBbsId($bbsId)
  {
    return $this->createQuery()
      ->where('bbs_id = ?', $bbsId)
      ->execute();
  }

  public function getBbsCommentListPager($bbsId, $page = 1, $size = 20, $order = 'DESC')
  {
    $q = $this->createQuery()
      ->where('bbs_id = ?', $bbsId);

    $pager = new sfReversibleDoctrinePager('BbsComment', $size);
    $pager->setQuery($q);
    $pager->setPage($page);
    $pager->setSqlOrderColumn('id');
    $pager->setSqlOrder($order);
    $pager->setListOrder(sfReversibleDoctrinePager::ASC);
    $pager->setMaxPerPage($size);
    $pager->init();

    return $pager;
  }

  public function getMaxNumber($bbsId)
  {
    $result = $this->createQuery()
      ->select('number')
      ->where('bbs_id = ?', $bbsId)
      ->orderBy('number DESC')
      ->fetchOne();

    if ($result)
    {
      return (int)$result->getNumber();
    }

    return 0;
  }
}
