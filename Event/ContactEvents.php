<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\ContactBundle\Event;

/**
 * Contains all events thrown in the Contact Bundle.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
final class ContactEvents
{
    /**
     * The LIST_IDENTITIES event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const LIST_IDENTITIES = 'asf.contact.event.list_identities';
    
    /**
     * The ADD_IDENTITY event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const ADD_IDENTITY = 'asf.contact.event.add_identity';
    
    /**
     * The EDIT_IDENTITY event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const EDIT_IDENTITY = 'asf.contact.event.edit_identity';
    
    /**
     * The DELETE_IDENTITY event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const DELETE_IDENTITY = 'asf.contact.event.delete_identity';
    
    /**
     * The AJAX_LIST_IDENTITIES event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const AJAX_LIST_IDENTITIES = 'asf.contact.event.ajax.list_identities';
}