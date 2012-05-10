<?php
namespace PiggyBox\TicketBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use PiggyBox\TicketBundle\Entity\Account;
use PiggyBox\TicketBundle\Entity\Operation;

class AccountListener
{
    public function preUpdate(LifecycleEventArgs $args)
    {
        $account = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($account instanceof Account && $args->hasChangedField('balance')) {
        	$operation = new Operation();
        	$operation->setAccount($operation);
        	$operation->setNewBalance($args->getNewValue('balance'));
        	$operation->setPreviousBalance($args->getNewValue('balance'));
        	/*addOperation*/
        }
    }
}