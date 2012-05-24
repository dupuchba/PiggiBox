<?php

namespace PiggyBox\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PiggyBox\TicketBundle\Entity\Account
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Account
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
     * @var float $balance
     *
     * @ORM\Column(name="balance", type="float")
     */
    private $balance;

    /**
     * @var float $ticket_value
     *
     * @ORM\Column(name="ticket_value", type="float", nullable=true)
     */
    private $ticket_value;

    /**
     * @var datetime $createdat
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdat", type="datetime")
     */
    private $createdat;

    /**
     * @var datetime $modifiedat
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifiedat", type="datetime")
     */
    private $modifiedat;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="accounts",cascade={"persist"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="\PiggyBox\UserBundle\Entity\Merchant", inversedBy="accounts")
     * @ORM\JoinColumn(name="merchant_id", referencedColumnName="id")
     */
    private $merchant;

    /**
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="account")
     */
    private $operations;

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
     * Set balance
     *
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set ticket_value
     *
     * @param float $ticketValue
     */
    public function setTicketValue($ticketValue)
    {
        $this->ticket_value = $ticketValue;
    }

    /**
     * Get ticket_value
     *
     * @return float
     */
    public function getTicketValue()
    {
        return $this->ticket_value;
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
     * Get modifiedat
     *
     * @return datetime
     */
    public function getModifiedat()
    {
        return $this->modifiedat;
    }

    /**
     * Set customer
     *
     * @param PiggyBox\TicketBundle\Entity\Customer $customer
     */
    public function setCustomer(\PiggyBox\TicketBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get customer
     *
     * @return PiggyBox\TicketBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
    public function __construct()
    {
        $this->operations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add operations
     *
     * @param PiggyBox\TicketBundle\Entity\Operation $operations
     */
    public function addOperation(\PiggyBox\TicketBundle\Entity\Operation $operations)
    {
        $this->operations[] = $operations;
    }

    /**
     * Get operations
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * Set merchant
     *
     * @param PiggyBox\UserBundle\Entity\Merchant $merchant
     */
    public function setMerchant(\PiggyBox\UserBundle\Entity\Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Get merchant
     *
     * @return PiggyBox\UserBundle\Entity\Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }
}
