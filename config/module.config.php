<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmessage
 */

/**
 * @return array
 */
return [
	'dragonjsonserveravatarmessage' => [
	    'clientmessages' => true,
	],
	'dragonjsonserver' => [
	    'apiclasses' => [
	        '\DragonJsonServerAvatarmessage\Api\Avatarmessage' => 'Avatarmessage',
	    ],
	],
	'service_manager' => [
		'invokables' => [
            '\DragonJsonServerAvatarmessage\Service\Avatarmessage' => '\DragonJsonServerAvatarmessage\Service\Avatarmessage',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAvatarmessage_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAvatarmessage/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAvatarmessage\Entity' => 'DragonJsonServerAvatarmessage_driver'
				],
			],
		],
	],
];
