<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmessage
 */

namespace DragonJsonServerAvatarmessage\Api;

/**
 * API Klasse zur Verwaltung von Avatarnachrichten
 */
class Avatarmessage
{
	use \DragonJsonServer\ServiceManagerTrait;
	
	/**
	 * Erstellt eine Avatarnachricht zu einem anderen Avatar
	 * @param integer $to_avatar_id
	 * @param string $subject
	 * @param string $content
	 * @session
	 * @avatar
	 */
	public function createAvatarmessage($to_avatar_id, $subject, $content)
	{
		$serviceManager = $this->getServiceManager();

		$avatar = $serviceManager->get('Avatar')->getAvatar();
		$serviceManager->get('Avatarmessage')->createAvatarmessage($avatar->getAvatarId(), $to_avatar_id, $subject, $content);
	}
	
	/**
	 * Gibt alle Avatarnachrichten zum aktuellen Avatar zurück
	 * @return array
	 * @session
	 * @avatar
	 */
	public function getInbox()
	{
		$serviceManager = $this->getServiceManager();

		$avatar = $serviceManager->get('Avatar')->getAvatar();
		$avatarmessages = $serviceManager->get('Avatarmessage')->getInbox($avatar->getAvatarId());
		return $serviceManager->get('Doctrine')->toArray($avatarmessages);
	}
	
	/**
	 * Gibt alle Avatarnachrichten vom aktuellen Avatar zurück
	 * @return array
	 * @session
	 * @avatar
	 */
	public function getOutbox()
	{
		$serviceManager = $this->getServiceManager();

		$avatar = $serviceManager->get('Avatar')->getAvatar();
		$avatarmessages = $serviceManager->get('Avatarmessage')->getOutbox($avatar->getAvatarId());
		return $serviceManager->get('Doctrine')->toArray($avatarmessages);
	}
	
	/**
	 * Setzt den Status der Avatarnachricht auf gelesen 
	 * @param integer $avatarmessage_id
	 * @session
	 * @avatar
	 */
	public function readAvatarmessage($avatarmessage_id)
	{
		$serviceManager = $this->getServiceManager();

		$avatar = $serviceManager->get('Avatar')->getAvatar();
		$serviceManager->get('Avatarmessage')->readAvatarmessage($avatar->getAvatarId(), $avatarmessage_id);
	}
	
	/**
	 * Setzt den Status der Avatarnachricht auf gelöscht 
	 * @param integer $avatarmessage_id
	 * @session
	 * @avatar
	 */
	public function deleteAvatarmessage($avatarmessage_id)
	{
		$serviceManager = $this->getServiceManager();

		$avatar = $serviceManager->get('Avatar')->getAvatar();
		$serviceManager->get('Avatarmessage')->deleteAvatarmessage($avatar->getAvatarId(), $avatarmessage_id);
	}
}

