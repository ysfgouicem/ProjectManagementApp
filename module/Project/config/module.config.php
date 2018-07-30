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
                    'route'    => '/project[/:action[/:name]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
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
