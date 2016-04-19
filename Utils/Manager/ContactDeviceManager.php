<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Utils\Manager;

use ASF\ContactBundle\Model\ContactDevice\ContactDeviceModel;

/**
 * Contact Device Entity Manager for this bundle
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ContactDeviceManager extends DefaultManager implements DefaultManagerInterface
{
	/**
	 * @var DefaultManagerInterface
	 */
	protected $emailAddressManager;
	
	/**
	 * @var DefaultManagerInterface
	 */
	protected $phoneNumberManager;
	
	/**
	 * @var DefaultManagerInterface
	 */
	protected $websiteAddressManager;
	
	/**
	 * @param DefaultManagerInterface $emailAddressManager
	 * @param DefaultManagerInterface $phoneNumberManager
	 * @param DefaultManagerInterface $websiteAddressManager
	 */
	public function __construct(DefaultManagerInterface $emailAddressManager, DefaultManagerInterface $phoneNumberManager, DefaultManagerInterface $websiteAddressManager)
	{
		$this->emailAddressManager = $emailAddressManager;
		$this->phoneNumberManager = $phoneNumberManager;
		$this->websiteAddressManager = $websiteAddressManager;
	}
	
	/**
	 * Create new typed Instance of entity
	 *
	 * @param string $type Type of instance
	 */
	public function createTypedInstance($type)
	{
		if ( $type == ContactDeviceModel::TYPE_EMAIL )
			$entityName = $this->emailAddressManager->getClassName();
		elseif ( $type == ContactDeviceModel::TYPE_PHONE )
			$entityName = $this->phoneNumberManager->getClassName();
		elseif ( $type == ContactDeviceModel::TYPE_WEBSITE )
			$entityName = $this->websiteAddressManager->getClassName();
		else
			throw new \Exception(sprintf('The type "%s" is not a valid ContactDevice inheritance entity', $type));
	
		$entity = new $entityName();
		return $entity;
	}
}