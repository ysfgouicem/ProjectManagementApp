<?php
return array(
    'router' => array(
        'routes' => array(
              'user' => array(
                  'type' => 'Literal',
                  'options' => array(
                      'route' => '/user',
                      'defaults' => array(
                          'controller'    => 'User\Controller\Auth',
                          'action'        => 'login'
                      ),
                  ),
              ),
              'user_login' => array(
                  'type' => 'Literal',
                  'options' => array(
                      'route' => '/user/login',
                      'defaults' => array(
                          'controller'    => 'User\Controller\Auth',
                          'action'        => 'login'
                      ),
                  ),
              ),
              'user_logout' => array(
                  'type' => 'Literal',
                  'options' => array(
                      'route' => '/user/logout',
                      'defaults' => array(
                          'controller'    => 'User\Controller\Auth',
                          'action'        => 'logout'
                      ),
                  ),
              ),
        ),
    ),
    'service_manager' => array(
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Auth' => 'User\Controller\AuthController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'user/auth/login'    => __DIR__ . '/../view/user/auth/login.phtml',
            'user/auth/logout'    => __DIR__ . '/../view/user/auth/logout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    )
);
