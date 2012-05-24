<?php

namespace PiggyBox\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PiggyBox\TicketBundle\Entity\Customer;
use PiggyBox\TicketBundle\Form\CustomerSearchType;
use PiggyBox\TicketBundle\Entity\Account;
use PiggyBox\TicketBundle\Form\AccountType;
use PiggyBox\TicketBundle\Entity\Merchant;
use FOS\RestBundle\View\View;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer controller.
 *
 * @Route("/customer")
 */
class CustomerController extends Controller
{
    /**
     * Lists all Customer entities.
     *
     * @Route("/search.{_format}", name="customer_search", defaults={"_format" = "~"},options={"expose"=true})
     * @Template()
     */
    public function indexAction()
    {

    $form = $this->container->get('form.factory')->create(new CustomerSearchType());

    $searchresult = new ArrayCollection();
    $keyword = '';

    $request = $this->container->get('request');

    if ($request->isXmlHttpRequest()) {

    $keyword = $request->request->get('keyword');
    $keyword = rtrim($keyword);

        if ($keyword != '') {
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $this->getDoctrine()->getRepository('PiggyBoxTicketBundle:Customer');

                $query = $repository->createQueryBuilder('a')
                    ->where('a.firstname LIKE :keyword OR a.lastname LIKE :keyword')
                    ->orderBy('a.lastname', 'ASC')
                    ->setParameter('keyword', '%'.$keyword.'%')
                    ->getQuery();

               $searchresult = $query->getResult();
        } else {
            $searchresult = '[]';
        }
    }

    $view = View::create();
    $handler = $this->get('fos_rest.view_handler');

    if ('html' === $this->getRequest()->getRequestFormat()) {
        $view->setData(array('form'=> $form,
                             'searchresult' => $searchresult));
        var_dump('HTML');
    } else {
        $view->setData($searchresult);
        var_dump('json');
    }
    $view->setTemplate('PiggyBoxTicketBundle:Customer:index.html.twig');

    return $view;

    }

    /**
     * Make an operation with a Customer entity.
     *
     * @Route("/operation/{id}", name="customer_operation")
     * @Template()
     */
    public function operationAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

        if (!$account) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        return array('account'=> $account);
    }

    /**
     * Finds and displays a Customer entity.
     *
     * @Route("/list", name="customer_list")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $customers = $em->getRepository('PiggyBoxTicketBundle:Customer')->findAll();
        //TODO: findMyCustomer() pour obtenir la liste des SES clients
        //TODO: recuperer seulement l'account du marchant en cours

        if (!$customers) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        return array(
            'customers'      => $customers,
            'letters'       => $letters        );
    }

    /**
     * Finds and displays a Customer entity.
     *
     * @Route("/{id}/show", name="customer_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiggyBoxTicketBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Customer entity.
     *
     * @Route("/new", name="customer_new")
     * @Template()
     */
    public function newAction()
    {
        $account = new Account();

        $form   = $this->createForm(new AccountType(), $account);

        return array(
            'entity' => $account,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Customer entity.
     *
     * @Route("/create", name="customer_create")
     * @Method("post")
     * @Template("PiggyBoxTicketBundle:Customer:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Account();
        $em = $this->getDoctrine()->getEntityManager();
        $merchant = $em->getRepository('PiggyBoxUserBundle:Merchant')->find(2);


        $request = $this->getRequest();
        $form    = $this->createForm(new AccountType(), $entity);
        $form->bindRequest($request);

        $entity->getCustomer()->addMerchant($merchant);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('customer_show', array('id' => $entity->getId())));

        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Customer entity.
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

        if (!$account) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $editForm = $this->createForm(new AccountType(), $account);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'account'      => $account,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Customer entity.
     *
     * @Route("/{id}/update", name="customer_update",options={"expose"=true})
     * @Method("post")
     * @Template("PiggyBoxTicketBundle:Customer:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

        if (!$account) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $editForm   = $this->createForm(new AccountType(), $account);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($account);
            $em->flush();

            return $this->redirect($this->generateUrl('customer_edit', array('id' => $id)));
        }

        return array(
            'account'      => $account,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Customer entity.
     *
     * @Route("/{id}/delete", name="customer_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiggyBoxTicketBundle:Customer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('customer'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Edits an existing Customer entity.
     *
     * @Route("/{id}/{balance}/setbalance", name="customer_setbalance",options={"expose"=true})
     * @Method("post")
     */
    public function setBalanceAction($id,$balance)
    {
         $request = $this->container->get('request');

        if ($request->isXmlHttpRequest()) {
           $em = $this->getDoctrine()->getEntityManager();

            $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

            if (!$account) {
                throw $this->createNotFoundException('Unable to find Account entity.');
            }

            $account->setBalance($balance);
            $em->persist($account);
            $em->flush();
        }

    return $this->redirect($this->generateUrl('customer_operation', array('id' => $id)));
    }
}
