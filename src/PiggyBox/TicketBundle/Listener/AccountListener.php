<?php
namespace PiggyBox\TicketBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use PiggyBox\TicketBundle\Entity\Account;
use PiggyBox\TicketBundle\Entity\Operation;

class AccountListener
{

        private $em = null;
        private $uow = null;
        private $attachedEvents;


        public function onFlush(OnFlushEventArgs $args) {

                $this->em = $args->getEntityManager();
                $eventManager = $this->em->getEventManager();

                $eventManager->removeEventListener('onFlush', $this);

                $this->uow= $this->em->getUnitOfWork();

                //Iterate through Update:
                foreach ($this->uow->getScheduledEntityUpdates() as $entity) {
                        
                        if ($entity instanceof Account ) {

                                $meta = $this->em->getClassMetadata('PiggyBox\TicketBundle\Entity\Account');                        
                                $balance = $meta->getReflectionProperty('balance')->getValue($entity);

                                $operation = new Operation();
                                $operation->setAccount($entity);
                                $operation->setNewBalance($balance);
                                $operation->setPreviousBalance($entity->getBalance());                                

                                $this->em->persist($operation);
                                $this->em->flush();
                                
                        // recalculate changeset, since we might messed up the relations
                        $this -> em -> getUnitOfWork() -> recomputeSingleEntityChangeSet($meta, $entity);
                        }
                }

                //Re-attach since we're done
                $eventManager -> addEventListener('onFlush', $this);
        }

}