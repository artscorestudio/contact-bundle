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

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Grid;
use APY\DataGridBundle\Grid\Row;

use Doctrine\ORM\QueryBuilder;

use ASF\ContactBundle\Model\Identity\IdentityModel;
use ASF\ContactBundle\Form\Type\PersonType;
use ASF\ContactBundle\Form\Type\OrganizationType;

/**
 * Identity Controller
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityController extends Controller
{
	/**
	 * List all identities
	 *
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	public function listAction()
	{
		// Initialize variables
		$view_options = array();
		
		// Set Datagrid source
		$source = new Entity($this->get('asf_contact.identity.manager')->getClassName());
		$tableAlias = $source->getTableAlias();
		$source->manipulateQuery(function($query) use ($tableAlias){
			$query instanceof QueryBuilder;
			if ( count($query->getDQLPart('orderBy')) == 0) {
				$query->orderBy($tableAlias . '.name', 'ASC');
			}
		});
		
		// Get Grid instance
		$grid = $this->get('grid');
		$grid instanceof Grid;
		
		// Attach the source to the grid
		$grid->setSource($source);
		$grid->setId('asf_contact_identity');
		
		// Columns configuration
		$grid->hideColumns(array('id', 'updatedAt', 'createdAt'));
		
		$nameColumn = $grid->getColumn('name');
		$nameColumn->setTitle($this->get('translator')->trans('Name', array(), 'asf_contact'))
			->setDefaultOperator('like')
			->setOperatorsVisible(false);
		
		$emailColumn = $grid->getColumn('emailCanonical');
		$emailColumn->setTitle($this->get('translator')->trans('E-mail', array(), 'asf_contact'))
			->setDefaultOperator('like')
			->setOperatorsVisible(false);
		
		$stateColumn = $grid->getColumn('state');
		$stateColumn->setTitle($this->get('translator')->trans('State', array(), 'asf_contact'))
			->setSize(100)
			->setFilterType('select')
			->setDefaultOperator('like')
			->setOperatorsVisible(false)
			->setSelectFrom('values')
			->setValues(array(
				IdentityModel::STATE_ENABLED => $this->get('translator')->trans('Activated', array(), 'asf_contact'), 
				IdentityModel::STATE_DISABLED => $this->get('translator')->trans('Deactivated', array(), 'asf_contact')
			));
		
		$editAction = new RowAction('btn_edit', 'asf_contact_identity_edit');
		$editAction->setRouteParameters(array('id'));
		$grid->addRowAction($editAction);
		
		$deleteAction = new RowAction('btn_delete', 'asf_contact_identity_delete', true);
		$deleteAction->setRouteParameters(array('id'))
			->setConfirmMessage($this->get('translator')->trans('Do you want to delete this identity ?', array(), 'asf_contact'));
		$grid->addRowAction($deleteAction);
		
		$typeColumn = $grid->getColumn('type');
		$typeColumn->setTitle($this->get('translator')->trans('Type', array(), 'asf_contact'))
			->setFilterType('select')
			->setDefaultOperator('eq')
			->setOperatorsVisible(false)
			->setSelectFrom('values')
			->setValues(array(
				IdentityModel::TYPE_PERSON => $this->get('translator')->trans('Person', array(), 'asf_contact'),
				IdentityModel::TYPE_ORGANIZATION => $this->get('translator')->trans('Organization', array(), 'asf_contact')
			))->manipulateRenderCell(function($value, $row, $router){
				if ( $value == IdentityModel::TYPE_PERSON )
					return $this->get('translator')->trans('Person', array(), 'asf_contact');
				elseif ( $value == IdentityModel::TYPE_ORGANISATION )
					return $this->get('translator')->trans('Organization', array(), 'asf_contact');
			});
		
		$grid->setNoDataMessage($this->get('translator')->trans('No contact in the address book.', array(), 'asf_contact'));
			
		// Display grid
		return $grid->getGridResponse('ASFContactBundle:Identity:list.html.twig', $view_options);
	}
	
	/**
	 * Add a contact
	 * 
	 * @param string $type Type of Contact
	 */
	public function addAction($type)
	{
		$view_options = array();
		
		if ('person' === $type) {
			$contact = $this->get('asf_contact.person.manager')->createInstance();
			$view_options['view_title'] = $this->get('translator')->trans('Add a person', array(), 'asf_contact');
			$view_options['breadcrumb_route'] = $this->get('router')->generate('asf_contact_identity_add', array('type' => 'person'));
			
			$form = $this->createForm(PersonType::class, $contact);
			
		} elseif ('organisation' === $type) {
			$contact = $this->get('asf_contact.organization.manager')->createInstance();
			$view_options['view_title'] = $this->get('translator')->trans('Add an organization', array(), 'asf_contact');
			$view_options['breadcrumb_route'] = $this->get('router')->generate('asf_contact_identity_add', array('type' => 'organisation'));
			
			$form = $this->createForm(OrganizationType::class, $contact);
		}
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
		    if ( $this->has('asf_layout.flash_message') ) {
                $this->get('asf_layout.flash_message')->success($this->get('translator')->trans('The contact has been added', array(), 'asf_contact'));
		    }
			return $this->redirect($this->generateUrl('asf_contact_identity_edit', array('id' => $contact->getId())));
		}
		
		$view_options['form'] = $form->createView();

		// Display view
		return $this->render('ASFContactBundle:Identity:edit.html.twig', $view_options);
	}
	
	/**
	 * Edit a contact
	 * @param integer $id Contact ID
	 */
	public function editAction($id)
	{
		$view_options = array();
		
		$identity = $this->get('asf_contact.identity.manager')->getRepository()->find($id);
		$personClassName = $this->get('asf_contact.person.manager')->getClassName();
		
		$view_options['view_title'] = $this->get('translator')->trans("Edit contact : %name%", array('%name%' => $identity->getName()), 'asf_contact');
		$view_options['breadcrumb_route'] = $this->get('router')->generate('asf_contact_identity_edit', array('id' => $identity->getId()));
		
		if ( $identity instanceof $personClassName ) {
			$form = $this->createForm(PersonType::class, $contact);
		} else {
			$form = $this->createForm(OrganizationType::class, $contact);
		}
		
		$form->handleRequest($request);
		
		if ( $form->isSubmitted() && $form->isValid() ) {
		    if ( $this->has('asf_layout.flash_message') ) {
                $this->get('asf_layout.flash_message')->success($this->get('translator')->trans('The contact has been updated', array(), 'asf_contact'));
		    }
		}
		
		$view_options['form'] = $form->createView();

		// Display view
		return $this->render('ASFContactBundle:Identity:edit.html.twig', $view_options);
	}
	
	/**
	 * Delete an identity
	 *
	 * @param integer $id Identity ID to delete
	 */ 
	public function deleteAction($id)
	{
		$identity = $this->get('asf_contact.identity.manager')->getRepository()->findOneBy(array('id' => $id));
			
		if ( is_null($identity) && $this->get('asf_layout.flash_message') ) {
			$this->get('asf_layout.flash_message')->danger($this->get('translator')->trans("The contact with the id %id% not found.", array('%id%', $id), 'asf_contact'));
		} else {
		    throw new \Exception($this->get('translator')->trans("The contact with the id %id% not found.", array('%id%', $id), 'asf_contact'));
		}
		
		try {
			$this->get('asf_contact.identity.manager')->getEntityManager()->remove($identity);
			$this->get('asf_contact.identity.manager')->getEntityManager()->flush();
			if ( $this->has('asf_layout.flash_message') ) {
                $this->get('asf_layout.flash_message')->success($this->get('translator')->trans('The contact has been deleted succesfully', array(), 'asf_contact'));
			}
			
		}  catch (\Exception $e) {
		    if ( $this->has('asf_layout.flash_message') ) {
                $this->get('asf_layout.flash_message')->danger(sprintf("An error occured : %s", $e->getMessage()));
		    } else {
		        $e->getMessage();
		    }
		}
		
		return $this->redirect($this->get('router')->generate('asf_contact_identity_list'));
	}
	
	/**
	 * Return list of identities via an ajax request
	 *
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function ajaxRequestOrganizationAction(Request $request)
	{
		$term = $request->get('term');
		$identities = $this->get('asf_contact.identity.manager')->getRepository()->findByNameContains($term, IdentityModel::TYPE_ORGANISATION);
		$search = array();
		 
		foreach($identities as $identity) {
			$search[] = $identity->getName();
		}
		
		$response = new Response();
		$response->setContent(json_encode($search));
		 
		return $response;
	}
}