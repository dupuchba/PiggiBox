<?php

namespace PiggyBox\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PiggyBox\UserBundle\Entity\Merchant;

/**
 * Merchant controller.
 *
 * @Route("/")
 */
class MerchantController extends Controller
{
    /**
     * Lists all Merchant entities.
     *
     * @Route("/", name="login_index_page")
     * @Template()
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getEntityManager();

        //$entities = $em->getRepository('PiggyBoxUserBundle:Merchant')->findAll();


        //TODO: Si user est loggé rediriger vers page recherche

        return null;
    }

}
