<?php

namespace PiggyBox\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PiggyBox\TicketBundle\Entity\Operation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Operation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float $previousBalance
     *
     * @ORM\Column(name="previousBalance", type="float")
     */
    private $previousBalance;

    /**
     * @var float $newBalance
     *
     * @ORM\Column(name="newBalance", type="float")
     */
    private $newBalance;

    /**
     * @var datetime $createdat
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdat", type="datetime")
     */
    private $createdat;

    /**
    * @ORM\ManyToOne(targetEntity="Account", inversedBy="operations", cascade={"remove"})
    * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
    */
    private $account;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set previousBalance
     *
     * @param float $previousBalance
     */
    public function setPreviousBalance($previousBalance)
    {
        $this->previousBalance = $previousBalance;
    }

    /**
     * Get previousBalance
     *
     * @return float
     */
    public function getPreviousBalance()
    {
        return $this->previousBalance;
    }

    /**
     * Set newBalance
     *
     * @param float $newBalance
     */
    public function setNewBalance($newBalance)
    {
        $this->newBalance = $newBalance;
    }

    /**
     * Get newBalance
     *
     * @return float
     */
    public function getNewBalance()
    {
        return $this->newBalance;
    }

    /**
     * Get createdat
     *
     * @return datetime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set account
     *
     * @param PiggyBox\TicketBundle\Entity\Account $account
     */
    public function setAccount(\PiggyBox\TicketBundle\Entity\Account $account)
    {
        $this->account = $account;
    }

    /**
     * Get account
     *
     * @return PiggyBox\TicketBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
