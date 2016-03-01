<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default Contact Controller
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class DefaultController extends Controller
{
	/**
	 * Contact Homepage
	 */
	public function indexAction()
	{
		return $this->render('ASFContactBundle:Default:index.html.twig');
	}
}