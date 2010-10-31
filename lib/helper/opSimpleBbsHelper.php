<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

function op_bbs_link_to_show($bbs, $withName = true, $withIcon = true)
{
  $html = '';

  $html .= link_to(op_bbs_get_title_and_count($bbs), op_bbs_url_for_show($bbs));

  if ($withName)
  {
    $html .= ' ('.$bbs->getMember()->getName().')';
  }

  if ($withIcon)
  {
    $html .= op_bbs_image_icon($bbs);
  }

  return $html;

}

function op_bbs_get_title_and_count($bbs, $space = true, $width = 36)
{
  return sprintf('%s%s(%d)',
           op_truncate($bbs->getTitle(), $width),
           $space ? ' ' : '',
           $bbs->countBbsComments());
}

function op_bbs_image_icon($bbs)
{
  $html = '';
  if ($bbs->has_images)
  {
    $html = ' '.image_tag('icon_camera.gif', array('alt' => 'photo'));
  }

  return $html;
}

function op_bbs_url_for_show($bbs)
{
  $internalUri = '@bbs_show?id='.$bbs->getId();

  if ($count = $bbs->countBbsComments())
  {
    $internalUri .= '&comment_count='.$count;
  }

  return $internalUri;
}
