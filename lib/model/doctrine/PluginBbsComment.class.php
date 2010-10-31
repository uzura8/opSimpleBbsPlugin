<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginBbsComment
 *
 * @package    OpenPNE
 * @subpackage action
 * @author     Uzura8 <uzuranoie@gmail.com>
 */
abstract class PluginBbsComment extends BaseBbsComment
{
  public function isDeletable($memberId)
  {
    return ($this->getMemberId() === $memberId);
  }

  public function preSave($event)
  {
    $modified = $this->getModified();
    if ($this->isNew() && empty($modified['number']))
    {
//      $this->getBbs()->setBbsUpdatedAt(date('Y-m-d H:i:s', time()));
      $this->getBbs()->setUpdatedAt(date('Y-m-d H:i:s', time()));
      $this->setNumber(Doctrine::getTable('BbsComment')->getMaxNumber($this->getBbsId()) + 1);
    }
  }
}
