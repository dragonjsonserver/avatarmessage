<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmessage
 */

namespace DragonJsonServerAvatarmessage\Entity;

/**
 * Entityklasse einer Avatarnachricht
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="avatarmessages")
 */
class Avatarmessage
{
	use \DragonJsonServerDoctrine\Entity\ModifiedTrait;
	use \DragonJsonServerDoctrine\Entity\CreatedTrait;
	
	/**
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $avatarmessage_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 **/
	protected $from_avatar_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 **/
	protected $to_avatar_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="string")
	 **/
	protected $subject;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="string")
	 **/
	protected $content;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="string")
	 **/
	protected $from_state = 'read';
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="string")
	 **/
	protected $to_state = 'new';
	
	/**
	 * Gibt die ID der Avatarnachricht zurück
	 * @return integer
	 */
	public function getAvatarmessageId()
	{
		return $this->avatarmessage_id;
	}
	
	/**
	 * Setzt die AvatarID des Absenders der Avatarnachricht
	 * @param integer $from_avatar_id
	 * @return Avatarmessage
	 */
	public function setFromAvatarId($from_avatar_id)
	{
		$this->from_avatar_id = $from_avatar_id;
		return $this;
	}
	
	/**
	 * Gibt die AvatarID des Absenders der Avatarnachricht zurück
	 * @return integer
	 */
	public function getFromAvatarId()
	{
		return $this->from_avatar_id;
	}
	
	/**
	 * Setzt die AvatarID des Empfängers der Avatarnachricht
	 * @param integer $to_avatar_id
	 * @return Avatarmessage
	 */
	public function setToAvatarId($to_avatar_id)
	{
		$this->to_avatar_id = $to_avatar_id;
		return $this;
	}
	
	/**
	 * Gibt die AvatarID des Empfängers der Avatarnachricht zurück
	 * @return integer
	 */
	public function getToAvatarId()
	{
		return $this->to_avatar_id;
	}
	
	/**
	 * Setzt den Betreff der Avatarnachricht
	 * @param string $subject
	 * @return Avatarmessage
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
		return $this;
	}
	
	/**
	 * Gibt den Betreff der Avatarnachricht zurück
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}
	
	/**
	 * Setzt den Inhalt der Avatarnachricht
	 * @param string $content
	 * @return Avatarmessage
	 */
	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}
	
	/**
	 * Gibt den Inhalt der Avatarnachricht zurück
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * Setzt den Status des Absenders der Avatarnachricht
	 * @param string $from_state
	 * @return Avatarmessage
	 */
	public function setFromState($from_state)
	{
		$this->from_state = $from_state;
		return $this;
	}
	
	/**
	 * Gibt den Status des Absenders der Avatarnachricht zurück
	 * @return string
	 */
	public function getFromState()
	{
		return $this->from_state;
	}
	
	/**
	 * Setzt den Status des Empfänger der Avatarnachricht
	 * @param string $to_state
	 * @return Avatarmessage
	 */
	public function setToState($to_state)
	{
		$this->to_state = $to_state;
		return $this;
	}
	
	/**
	 * Gibt den Status des Empfänger der Avatarnachricht zurück
	 * @return string
	 */
	public function getToState()
	{
		return $this->to_state;
	}
	
	/**
	 * Gibt die Attribute der Avatarnachricht als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'avatarmessage_id' => $this->getAvatarmessageId(),
			'modified' => $this->getModifiedTimestamp(),
			'created' => $this->getCreatedTimestamp(),
			'from_avatar_id' => $this->getFromAvatarId(),
			'to_avatar_id' => $this->getToAvatarId(),
			'subject' => $this->getSubject(),
			'content' => $this->getContent(),
			'from_state' => $this->getFromState(),
			'to_state' => $this->getToState(),
		];
	}
}
