<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Identity;

/**
 * IdentityAccount  Interface
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface IdentityAccountInterface
{
	/**
	 * Get the account username
	 * 
	 * @return string
	 */
	public function getUsername();
	
	/**
	 * Get Account e-mail
	 * 
	 * @return string
	 */
	public function getEmail();
}