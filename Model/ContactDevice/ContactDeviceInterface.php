<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\ContactDevice;

/**
 * Contact Device Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface ContactDeviceInterface
{
	/**
	 * Return identities linked to this contact device
	 * 
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getIdentities();
}