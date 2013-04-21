<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmessage
 */

namespace DragonJsonServerAvatarmessage\Service;

/**
 * Serviceklasse zur Verwaltung von Avatarnachrichten
 */
class Avatarmessage
{
	use \DragonJsonServer\ServiceManagerTrait;
	use \DragonJsonServer\EventManagerTrait;
	use \DragonJsonServerDoctrine\EntityManagerTrait;
	
	/**
	 * Erstellt eine Avatarnachricht zu einem anderen Avatar
	 * @param integer $from_avatar_id
	 * @param integer $to_avatar_id
	 * @param string $subject
	 * @param string $content
	 * @return Avatarmessage
	 */
	public function createAvatarmessage($from_avatar_id, $to_avatar_id, $subject, $content)
	{
		$avatarmessage = (new \DragonJsonServerAvatarmessage\Entity\Avatarmessage())
			->setFromAvatarId($from_avatar_id)
			->setToAvatarId($to_avatar_id)
			->setSubject($subject)
			->setContent($content);
		$this->getServiceManager()->get('Doctrine')->transactional(function ($entityManager) use ($avatarmessage) {
			$entityManager->persist($avatarmessage);
			$entityManager->flush();
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAvatarmessage\Event\CreateAvatarmessage())
					->setTarget($this)
					->setAvatarmessage($avatarmessage)
			);
		});
		return $this;
	}
	
	/**
	 * Gibt alle Avatarnachrichten zum aktuellen Avatar zurück
	 * @param integer $avatar_id
	 * @return array
	 */
	public function getInbox($avatar_id)
	{
		$entityManager = $this->getEntityManager();
		
		return $entityManager
			->createQuery("
				SELECT avatarmessage FROM \DragonJsonServerAvatarmessage\Entity\Avatarmessage avatarmessage
				WHERE 
					avatarmessage.to_avatar_id = :to_avatar_id
					AND
					avatarmessage.to_state IN ('new', 'read')
			")
			->execute(['to_avatar_id' => $avatar_id]);
	}
	
	/**
	 * Gibt alle Avatarnachrichten vom aktuellen Avatar zurück
	 * @param integer $avatar_id
	 * @return array
	 */
	public function getOutbox($avatar_id)
	{
		$entityManager = $this->getEntityManager();
		
		return $entityManager
			->getRepository('\DragonJsonServerAvatarmessage\Entity\Avatarmessage')
		    ->findBy(['from_avatar_id' => $avatar_id, 'from_state' => 'read']);
	}
	
	/**
	 * Gibt die Avatarnachricht mit der übergebenen AvatarmessageID zurück
	 * @param integer $avatarmessage_id
	 * @return \DragonJsonServerAvatarmessage\Entity\Avatarmessage
	 */
	public function getAvatarmessageByAvatarmessageId($avatarmessage_id)
	{
		$entityManager = $this->getEntityManager();

		$conditions = ['avatarmessage_id' => $avatarmessage_id];
		$avatarmessage = $entityManager
			->getRepository('\DragonJsonServerAvatarmessage\Entity\Avatarmessage')
			->findOneBy($conditions);
		if (null === $avatarmessage) {
			throw new \DragonJsonServer\Exception('invalid avatarmessage_id', $conditions);
		}
		return $avatarmessage;
	}
	
	/**
	 * Setzt den Status der Avatarnachricht auf gelesen 
	 * @param integer $avatar_id
	 * @param integer $avatarmessage_id
	 * @return Avatarmessage
	 */
	public function readAvatarmessage($avatar_id, $avatarmessage_id)
	{
		$avatarmessage = $this->getAvatarmessageByAvatarmessageId($avatarmessage_id);
		if ($avatarmessage->getToAvatarId() == $avatar_id) {
			if ('new' != $avatarmessage->getToState()) {
				throw new \DragonJsonServer\Exception(
	    			'state already read or delete',
	    			['avatarmessage_id' => $avatarmessage_id]
	    		);
			}
			$avatarmessage->setToState('read');
		} else {
			throw new \DragonJsonServer\Exception(
    			'avatar_id not match',
    			['avatar_id' => $avatar_id, 'avatarmessage_id' => $avatarmessage_id]
    		);
		}
		$this->updateAvatarmessage($avatarmessage);
		return $this;
	}
	
	/**
	 * Setzt den Status der Avatarnachricht auf gelöscht 
	 * @param integer $avatar_id
	 * @param integer $avatarmessage_id
	 * @return Avatarmessage
	 */
	public function deleteAvatarmessage($avatar_id, $avatarmessage_id)
	{
		$avatarmessage = $this->getAvatarmessageByAvatarmessageId($avatarmessage_id);
		if ($avatarmessage->getFromAvatarId() == $avatar_id) {
			if ('delete' == $avatarmessage->getFromState()) {
				throw new \DragonJsonServer\Exception(
	    			'state already delete',
	    			['avatarmessage_id' => $avatarmessage_id]
	    		);
			}
			$avatarmessage->setFromState('delete');
		} elseif ($avatarmessage->getToAvatarId() == $avatar_id) {
			if ('delete' == $avatarmessage->getToState()) {
				throw new \DragonJsonServer\Exception(
	    			'state already delete',
	    			['avatarmessage_id' => $avatarmessage_id]
	    		);
			}
			$avatarmessage->setToState('delete');
		} else {
			throw new \DragonJsonServer\Exception(
    			'avatar_id not match',
    			['avatar_id' => $avatar_id, 'avatarmessage_id' => $avatarmessage_id]
    		);
		}
		$this->updateAvatarmessage($avatarmessage);
		return $this;
	}
	
	/**
	 * Aktualisiert die übergebene Avatarnachricht in der Datenbank
	 * @param \DragonJsonServerAvatarmessage\Entity\Avatarmessage $avatarmessage
	 * @return Avatarmessage
	 */
	public function updateAvatarmessage(\DragonJsonServerAvatarmessage\Entity\Avatarmessage $avatarmessage)
	{
		$entityManager = $this->getEntityManager();
	
		$entityManager->persist($avatarmessage);
		$entityManager->flush();
		return $this;
	}
}
