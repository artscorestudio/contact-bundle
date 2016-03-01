<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\RouteVoter;

use ASF\BackendBundle\Event\BackendEvents;
use ASF\BackendBundle\Event\NavbarMenuEvent;
use ASF\BackendBundle\Event\SidebarMenuEvent;

/**
 * Backend Menu Subscriber
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class MenuSubscriber implements EventSubscriberInterface
{
	/**
	 * @var RequestStack
	 */
	protected $request;
	
	/**
	 * @param RequestStack $request
	 */
	public function __construct(RequestStack $request)
	{
		$this->request = $request;
	}
	
	/**
	 * Subscribed Events
	 */
	public static function getSubscribedEvents()
	{
		return array(
			BackendEvents::NAVBAR_MENU_INIT => array('onNavbarMenuInit', 0),
			BackendEvents::SIDEBAR_MENU_INIT => array('onSidebarMenuInit', 0),
		);
	}

	/**
	 * @param NavbarMenuEvent $event
	 */
	public function onNavbarMenuInit(NavbarMenuEvent $event)
	{
		$menu = $event->getMenu();
		$factory = $event->getFactory();
		
		// Home link
		$item = $factory->createItem('Calendar', array('route' => 'asf_backend_calendar'));
		$menu->addChild($item);
		
		$matcher = new Matcher();
		$matcher->addVoter(new RouteVoter($this->request->getCurrentRequest()));
		$item->setCurrent($matcher->isCurrent($item));
	}
	
	/**
	 * @param SidebarMenuEvent $event
	 */
	public function onSidebarMenuInit(SidebarMenuEvent $event)
	{
		$menu = $event->getMenu();
		$factory = $event->getFactory();
		$matcher = new Matcher();
		$matcher->addVoter(new RouteVoter($this->request->getCurrentRequest()));
	
		// Contact link
		$item = $factory->createItem('Structures et agents', array('route' => 'asf_contact_identity_list'));
		$menu->addChild($item);
		$item->setCurrent($matcher->isCurrent($item));
	}
}