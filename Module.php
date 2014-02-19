<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmessage
 */

namespace DragonJsonServerAvatarmessage;

/**
 * Klasse zur Initialisierung des Moduls
 */
class Module
{
    use \DragonJsonServer\ServiceManagerTrait;
    
    /**
     * Gibt die Konfiguration des Moduls zurück
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /**
     * Gibt die Autoloaderkonfiguration des Moduls zurück
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
    
    /**
     * Wird bei der Initialisierung des Moduls aufgerufen
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
    	$sharedManager = $moduleManager->getEventManager()->getSharedManager();
    	$sharedManager->attach('DragonJsonServer\Service\Clientmessages', 'Clientmessages', 
	    	function (\DragonJsonServer\Event\Clientmessages $eventClientmessages) {
	    		$serviceManager = $this->getServiceManager();
	    		if (!$serviceManager->get('Config')['dragonjsonserveravatarmessage']['clientmessages']) {
	    			return;
	    		}
	    		$avatar = $serviceManager->get('\DragonJsonServerAvatar\Service\Avatar')->getAvatar();
	    		if (null === $avatar) {
	    			return;
	    		}
	    		$serviceAvatarmessage = $serviceManager->get('\DragonJsonServerAvatarmessage\Service\Avatarmessage');
	    		$avatarmessages = $serviceAvatarmessage->getAvatarmessagesByEventClientmessages($avatar, $eventClientmessages);
	    		if (0 == count($avatarmessages)) {
	    			return;
	    		}
	    		$avatarmessages = $serviceManager->get('\DragonJsonServerDoctrine\Service\Doctrine')->toArray($avatarmessages);
	    		$serviceManager->get('\DragonJsonServer\Service\Clientmessages')->addClientmessage('avatarmassages', $avatarmessages);
	    	}
    	);
    	$sharedManager->attach('DragonJsonServerAvatar\Service\Avatar', 'RemoveAvatar', 
	    	function (\DragonJsonServerAvatar\Event\RemoveAvatar $eventRemoveAvatar) {
	    		$serviceAvatarmessage = $this->getServiceManager()->get('\DragonJsonServerAvatarmessage\Service\Avatarmessage');
	    		$serviceAvatarmessage->removeAvatarmessagesByAvatarId($eventRemoveAvatar->getAvatar()->getAvatarId());
	    	}
    	);
    }
}
