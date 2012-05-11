<?php
namespace PiggyBox\TicketBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use PiggyBox\TicketBundle\Entity\Account;
use PiggyBox\TicketBundle\Entity\Operation;

class AccountListener
{
    public function postUpdate(LifecycleEventArgs $args)
    {
        $account = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($account instanceof Account && $args->hasChangedField('balance')) {
        	$account->setBalance($args->getNewValue('balance')-2);
        	$operation = new Operation();
        	$operation->setAccount($account);
        	$operation->setNewBalance($args->getNewValue('balance'));
        	$operation->setPreviousBalance($args->getOldValue('balance'));

                $entityManager->persist($operation);
                $entityManager->flush();
        	//var_dump($operation);die();
        	/*var_dump($operation);die();*/


                $historicalStatus = new HistoricalStatus();
                $historicalStatus->setOrder($entity);
                $historicalStatus->setComment($entity-&gt;getComment());
                $historicalStatus->setStatus($entity-&gt;getStatus());
                $entityManager->persist($historicalStatus);
                $entityManager->flush();
        }
    }
}