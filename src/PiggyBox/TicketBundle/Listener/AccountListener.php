<?php
namespace PiggyBox\TicketBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use PiggyBox\TicketBundle\Entity\Account;

class AccountListener
{
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Account && $args->hasChangedField('balance')) {

        }
    }
}