<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Project\Controller\Project' => 'Project\Controller\ProjectController',
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'Project' => __DIR__ . '/../view',
         ),
     ),

     'router' => array(
        'routes' => array(
            'Project' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/project[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9][0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Project\Controller\Project',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Project' => __DIR__ . '/../view',
        ),
    ),
 );
