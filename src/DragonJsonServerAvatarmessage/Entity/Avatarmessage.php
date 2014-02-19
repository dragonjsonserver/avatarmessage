<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
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
	 * @Doctrine\ORM\Mapping\OneToOne(targetEntity="\DragonJsonServerAvatar\Entity\Avatar")
	 * @Doctrine\ORM\Mapping\JoinColumn(name="from_avatar_id", referencedColumnName="avatar_id")
	 **/
	protected $from_avatar;
	
	/**
	 * @Doctrine\ORM\Mapping\OneToOne(targetEntity="\DragonJsonServerAvatar\Entity\Avatar")
	 * @Doctrine\ORM\Mapping\JoinColumn(name="to_avatar_id", referencedColumnName="avatar_id")
	 **/
	protected $to_avatar;
	
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
	 * Setzt die ID der Avatarnachricht
	 * @param integer $avatarmessage_id
	 * @return Avatarmessage
	 */
	protected function setAvatarmessageId($avatarmessage_id)
	{
		$this->avatarmessage_id = $avatarmessage_id;
		return $this;
	}
	
	/**
	 * Gibt die ID der Avatarnachricht zurück
	 * @return integer
	 */
	public function getAvatarmessageId()
	{
		return $this->avatarmessage_id;
	}
	
	/**
	 * Setzt den Avatar des Absenders der Avatarnachricht
	 * @param \DragonJsonServerAvatar\Entity\Avatar $from_avatar
	 * @return Avatarmessage
	 */
	public function setFromAvatar(\DragonJsonServerAvatar\Entity\Avatar $from_avatar)
	{
		$this->from_avatar = $from_avatar;
		return $this;
	}
	
	/**
	 * Gibt den Avatar des Absenders der Avatarnachricht zurück
	 * @return \DragonJsonServerAvatar\Entity\Avatar|null
	 */
	public function getFromAvatar()
	{
		return $this->from_avatar;
	}
	
	/**
	 * Gibt die Avatardaten des Absenders der Avatarnachricht zurück
	 * @return array|null
	 */
	public function getFromAvatarArray()
	{
		$from_avatar = $this->getFromAvatar();
		if (null !== $from_avatar) {
			$from_avatar = $from_avatar->toArray();
		}
		return $from_avatar;
	}
	
	/**
	 * Setzt den Avatar des Empfängers der Avatarnachricht
	 * @param \DragonJsonServerAvatar\Entity\Avatar $to_avatar
	 * @return Avatarmessage
	 */
	public function setToAvatar($to_avatar)
	{
		$this->to_avatar = $to_avatar;
		return $this;
	}
	
	/**
	 * Gibt den Avatar des Empfängers der Avatarnachricht zurück
	 * @return \DragonJsonServerAvatar\Entity\Avatar
	 */
	public function getToAvatar()
	{
		return $this->to_avatar;
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
	 * Setzt die Attribute der Avatarnachricht aus dem Array
	 * @param array $array
	 * @return Avatarmessage
	 */
	public function fromArray(array $array)
	{
		if (null !== $array['from_avatar']) {
			$this->setFromAvatar((new \DragonJsonServerAvatar\Entity\Avatar())->fromArray($array['from_avatar']));
		}
		return $this
			->setAvatarmessageId($array['avatarmessage_id'])
			->setModifiedTimestamp($array['modified'])
			->setCreatedTimestamp($array['created'])
			->setToAvatar((new \DragonJsonServerAvatar\Entity\Avatar())->fromArray($array['to_avatar']))
			->setSubject($array['subject'])
			->setContent($array['content'])
			->setFromState($array['from_state'])
			->setToState($array['to_state']);
	}
	
	/**
	 * Gibt die Attribute der Avatarnachricht als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'__className' => __CLASS__,
			'avatarmessage_id' => $this->getAvatarmessageId(),
			'modified' => $this->getModifiedTimestamp(),
			'created' => $this->getCreatedTimestamp(),
			'from_avatar' => $this->getFromAvatarArray(),
			'to_avatar' => $this->getToAvatar()->toArray(),
			'subject' => $this->getSubject(),
			'content' => $this->getContent(),
			'from_state' => $this->getFromState(),
			'to_state' => $this->getToState(),
		];
	}
}
