<?php

namespace PiggyBox\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var float $previous_balance
     *
     * @ORM\Column(name="previous_balance", type="float")
     */
    private $previous_balance;

    /**
     * @var float $new_balance
     *
     * @ORM\Column(name="new_balance", type="float")
     */
    private $new_balance;

    /**
     * @var datetime $createdat
     *
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
     * Set previous_balance
     *
     * @param float $previousBalance
     */
    public function setPreviousBalance($previousBalance)
    {
        $this->previous_balance = $previousBalance;
    }

    /**
     * Get previous_balance
     *
     * @return float 
     */
    public function getPreviousBalance()
    {
        return $this->previous_balance;
    }

    /**
     * Set new_balance
     *
     * @param float $newBalance
     */
    public function setNewBalance($newBalance)
    {
        $this->new_balance = $newBalance;
    }

    /**
     * Get new_balance
     *
     * @return float 
     */
    public function getNewBalance()
    {
        return $this->new_balance;
    }

    /**
     * Set createdat
     *
     * @param datetime $createdat
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
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