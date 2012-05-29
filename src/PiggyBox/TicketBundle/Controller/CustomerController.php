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
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
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
     * @Secure(roles="ROLE_MERCHANT")
     * @Template()
     */
    public function indexAction()
    {
    $securityContext = $this->get('security.context');
    $merchant = $securityContext->getToken()->getUser();

    $form = $this->container->get('form.factory')->create(new CustomerSearchType());

    $searchresult = '';
    $keyword = '';

    $request = $this->container->get('request');

    if ($request->isXmlHttpRequest()) {

    $keyword = $request->request->get('keyword');
    $keyword = rtrim($keyword);

        if ($keyword != '') {
            $repository = $this->getDoctrine()->getRepository('PiggyBoxTicketBundle:Account')->findBy(array('merchant' => $merchant->getId()));

                $customer = new ArrayCollection();

                foreach ($repository as $account) {
                    if (!is_bool(stripos($account->getCustomer()->getFirstnamelastname(),$keyword))) {
                        //NOTE: methode interne permettant de bien rediriger la requete
                        //TODO: trouver un moyen de faire ca plus joliment...
                        $account->getCustomer()->setId($account->getId());
                        $customer->add($account->getCustomer());
                    }
                }
               $searchresult = $customer->toArray();
        } else {
            $searchresult = '[]';
        }
    }

    $view = View::create();
    $handler = $this->get('fos_rest.view_handler');

    if ('html' === $this->getRequest()->getRequestFormat()) {
        $view->setData(array('form'=> $form,
                             'searchresult' => $searchresult));
    } else {
        $view->setData($searchresult);
    }
    $view->setTemplate('PiggyBoxTicketBundle:Customer:index.html.twig');

    return $view;

    }

    /**
     * Make an operation with a Customer entity.
     *
     * @Route("/operation/{id}", name="customer_operation",options={"expose"=true})
     * @Secure(roles="ROLE_MERCHANT")
     * @Template()
     */
    public function operationAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $account)) {
            throw new AccessDeniedException();
        }

        if (!$account) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        //TODO: demander a julien ce qui lui est passer par la tete
        if ( ! $account->getTicketValue() ) {
            $account->setTicketValue(1);
        }

        if ($account->getBalance() > 0) {
            $class = 'positive';
        } else {
            $class = 'negative';
        }

        return array('account'=> $account, 'class' => $class);
    }

    /**
     * Finds and displays a Customer entity.
     *
     * @Route("/list", name="customer_list")
     * @Secure(roles="ROLE_MERCHANT")
     * @Template()
     */
    public function listAction()
    {
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();

        $accounts = $user->getAccounts();

        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        return array(
            'accounts'      => $accounts->toArray(),
            'letters'       => $letters        );
    }

    /**
     * Displays a form to create a new Customer entity.
     *
     * @Route("/new", name="customer_new")
     * @Secure(roles="ROLE_MERCHANT")
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
     * @Secure(roles="ROLE_MERCHANT")
     * @Method("post")
     * @Template("PiggyBoxTicketBundle:Customer:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Account();

        $securityContext = $this->get('security.context');
        $merchant = $securityContext->getToken()->getUser();

        $request = $this->getRequest();
        $form    = $this->createForm(new AccountType(), $entity);
        $form->bindRequest($request);

        //NOTE: set firsname lastname pour la recherche
        $entity->getCustomer()->setFirstnamelastname($entity->getCustomer()->getFirstname()." ".$entity->getCustomer()->getLastname());
        $entity->setMerchant($merchant);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $eventManager = $em->getEventManager();

            $eventManager->removeEventListener('onFlush', $this->get('piggybox.account_listener'));

            $em->persist($entity);
            $em->flush();

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityIdentity = UserSecurityIdentity::fromAccount($merchant);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            $eventManager->addEventListener('onFlush', $this->get('piggybox.account_listener'));

            return $this->redirect($this->generateUrl('customer_operation', array('id' => $entity->getId())));

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
     * @Secure(roles="ROLE_MERCHANT")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $account)) {
            throw new AccessDeniedException();
        }

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
     * @Secure(roles="ROLE_MERCHANT")
     * @Method("post")
     * @Template("PiggyBoxTicketBundle:Customer:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $eventManager = $em->getEventManager();

        $account = $em->getRepository('PiggyBoxTicketBundle:Account')->find($id);

        if (!$account) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $editForm   = $this->createForm(new AccountType(), $account);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();
        $editForm->bindRequest($request);

        //NOTE: set firsname lastname pour le champ de recherche
        $account->getCustomer()->setFirstnamelastname($account->getCustomer()->getFirstname()." ".$account->getCustomer()->getLastname());

        if ($editForm->isValid()) {

            $eventManager->removeEventListener('onFlush', $this->get('piggybox.account_listener'));

            $em->persist($account);
            $em->flush();

            $eventManager->addEventListener('onFlush', $this->get('piggybox.account_listener'));

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
     * @Secure(roles="ROLE_MERCHANT")
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiggyBoxTicketBundle:Customer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customer entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('customer_list'));
    }
    /**
    * @Secure(roles="ROLE_MERCHANT")
    */
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
     * @Secure(roles="ROLE_MERCHANT")
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

    /**
     * Display stats.
     *
     * @Route("/statistiques", name="customer_stats")
     * @Secure(roles="ROLE_MERCHANT")
     * @Template()
     */
    public function statsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $accounts = $em->getRepository('PiggyBoxTicketBundle:Account')->findAll();

        /*
        $query = $em->createQuery('SELECT SUM(p.balance) FROM PiggyBoxTicketBundle:Account p');
        $sum_balance = $query->getResult();
        var_dump($sum_balance[0][1]);
        $sum_balance = round(floatval($sum_balance[0][1]), 2);
        var_dump($sum_balance);

        $query = $em->createQuery('SELECT MAX(p.balance) FROM PiggyBoxTicketBundle:Account p');
        $max_balance = $query->getResult();
        var_dump($max_balance[0][1]);
        echo "string"; intval($sum_balance[0][1]);
        var_dump($max_balance); die();

        $stats = array( 'sum_balance' => $sum_balance,
                        'max_balance' => $max_balance
                        );

        var_dump($stats); die();

        */

    }
}
