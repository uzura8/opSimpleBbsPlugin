<?php

class opSimpleBbsPluginFrontendRouteCollection extends sfRouteCollection
{
  public function __construct(array $options)
  {
    parent::__construct($options);

    $this->routes = array(
      'bbs_index' => new sfRoute(
        '/bbs',
        array('module' => 'bbs', 'action' => 'index')
      ),

      'bbs_search' => new sfRoute(
        '/bbs/search',
        array('module' => 'bbs', 'action' => 'search'),
        array(),
        array('extra_parameters_as_query_string' => true)
      ),
      'bbs_list' => new sfRoute(
        '/bbs/list',
        array('module' => 'bbs', 'action' => 'list'),
        array(),
        array('extra_parameters_as_query_string' => true)
      ),
      'bbs_show' => new sfDoctrineRoute(
        '/bbs/:id',
        array('module' => 'bbs', 'action' => 'show'),
        array('id' => '\d+'),
        array('model' => 'Bbs', 'type' => 'object')
      ),
      'bbs_comment_history' => new sfRoute(
        '/bbs/comment/history',
        array('module' => 'bbsComment', 'action' => 'history'),
        array(),
        array('extra_parameters_as_query_string' => true)
      ),

      'bbs_new' => new sfRoute(
        '/bbs/new',
        array('module' => 'bbs', 'action' => 'new')
      ),
      'bbs_create' => new sfRequestRoute(
        '/bbs/create',
        array('module' => 'bbs', 'action' => 'create'),
        array('sf_method' => array('post'))
      ),
      'bbs_edit' => new sfDoctrineRoute(
        '/bbs/edit/:id',
        array('module' => 'bbs', 'action' => 'edit'),
        array('id' => '\d+'),
        array('model' => 'Bbs', 'type' => 'object')
      ),
      'bbs_update' => new sfDoctrineRoute(
        '/bbs/update/:id',
        array('module' => 'bbs', 'action' => 'update'),
        array('id' => '\d+', 'sf_method' => array('post')),
        array('model' => 'Bbs', 'type' => 'object')
      ),
      'bbs_delete_confirm' => new sfDoctrineRoute(
        '/bbs/deleteConfirm/:id',
        array('module' => 'bbs', 'action' => 'deleteConfirm'),
        array('id' => '\d+'),
        array('model' => 'Bbs', 'type' => 'object')
      ),
      'bbs_delete' => new sfDoctrineRoute(
        '/bbs/delete/:id',
        array('module' => 'bbs', 'action' => 'delete'),
        array('id' => '\d+', 'sf_method' => array('post')),
        array('model' => 'Bbs', 'type' => 'object')
      ),

      'bbs_comment_create' => new sfDoctrineRoute(
        '/bbs/:id/comment/create',
        array('module' => 'bbsComment', 'action' => 'create'),
        array('id' => '\d+', 'sf_method' => array('post')),
        array('model' => 'Bbs', 'type' => 'object')
      ),
      'bbs_comment_delete_confirm' => new sfDoctrineRoute(
        '/bbs/comment/deleteConfirm/:id',
        array('module' => 'bbsComment', 'action' => 'deleteConfirm'),
        array('id' => '\d+'),
        array('model' => 'BbsComment', 'type' => 'object')
      ),
      'bbs_comment_delete' => new sfDoctrineRoute(
        '/bbs/comment/delete/:id',
        array('module' => 'bbsComment', 'action' => 'delete'),
        array('id' => '\d+', 'sf_method' => array('post')),
        array('model' => 'BbsComment', 'type' => 'object')
      ),
      // no default
      'bbs_nodefaults' => new sfRoute(
        '/bbs/*',
        array('module' => 'default', 'action' => 'error')
      ),
    );
  }
}
