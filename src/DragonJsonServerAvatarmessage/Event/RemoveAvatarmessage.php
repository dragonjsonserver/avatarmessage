<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmessage
 */

namespace DragonJsonServerAvatarmessage\Event;

/**
 * Eventklasse für die Entfernung einer Avatarnachricht
 */
class RemoveAvatarmessage extends \Zend\EventManager\Event
{
	/**
	 * @var string
	 */
	protected $name = 'RemoveAvatarmessage';

    /**
     * Setzt die Avatarnachricht die entfernt wird
     * @param \DragonJsonServerAvatarmessage\Entity\Avatarmessage $avatarmessage
     * @return RemoveAvatarmessage
     */
    public function setAvatarmessage(\DragonJsonServerAvatarmessage\Entity\Avatarmessage $avatarmessage)
    {
        $this->setParam('avatarmessage', $avatarmessage);
        return $this;
    }

    /**
     * Gibt die Avatarnachricht die entfernt wird zurück
     * @return \DragonJsonServerAvatarmessage\Entity\Avatarmessage
     */
    public function getAvatarmessage()
    {
        return $this->getParam('avatarmessage');
    }
}
