<?php
namespace PiggyBox\TicketBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use PiggyBox\TicketBundle\Entity\Account;
use PiggyBox\TicketBundle\Entity\Operation;

class AccountListener
{

        private $em = null;
        private $uow = null;
        private $attachedEvents;


        public function onFlush(OnFlushEventArgs $args) {
                //var_dump($this->getPreviousBalance());die();
                $this->em = $args->getEntityManager();
                $eventManager = $this->em->getEventManager();

                $eventManager->removeEventListener('onFlush', $this);

                $this->uow= $this->em->getUnitOfWork();

                //Iterate through Update:
                foreach ($this->uow->getScheduledEntityUpdates() as $account) {
                        
                        if ($account instanceof Account ) {

                                $meta = $this->em->getClassMetadata('PiggyBox\TicketBundle\Entity\Account');                        
                                $balance = $meta->getReflectionProperty('balance')->getValue($account);
                                $previous_balance = 0;


                                if (!$account->getOperations()->isEmpty()) {
                                        $previous_balance =  $account->getOperations()->last()->getNewBalance();
                                }

                                $operation = new Operation();
                                $operation->setAccount($account);
                                $operation->setNewBalance($balance);
                                $operation->setPreviousBalance($previous_balance);                                

                                $this->em->persist($operation);
                                $this->em->flush();

                        // recalculate changeset, since we might messed up the relations
                        $this -> em -> getUnitOfWork() -> recomputeSingleEntityChangeSet($meta, $account);
                        }
                }

                //Re-attach since we're done
                $eventManager -> addEventListener('onFlush', $this);
        }

}