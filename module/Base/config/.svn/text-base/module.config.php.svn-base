<?php 
return array(
'controllers' => array(
    'invokables' => array(
        'Base\Controller\Start' 			=> 'Base\Controller\IndexController',
    	
    ),
),
'router' => array(
    'routes' => array(
        'base' => array(
            'type'    => 'Segment',
            'options' => array(
                // Change this to something specific to your module
                'route'    => '/base[/:controller[/:action[/:id]]]',
            	'constraints' => array(
            		'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            	),
                'defaults' => array(
                    // Change this value to reflect the namespace in which
                    // the controllers for your module are found
                    '__NAMESPACE__' => 'Base\Controller',
                    'controller'    => 'start',
                    'action'        => 'index',
                ),
            ),
        ),
    ),
),
'view_manager' => array(
		'template_path_stack' => array(
				'base' => __DIR__ . '/../view',
		),
),
		
		
);