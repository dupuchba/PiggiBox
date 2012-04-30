<?php

namespace PiggyBox\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="ticket_value", type="float")
     */
    private $ticket_value;

    /**
     * @var datetime $createdat
     *
     * @ORM\Column(name="createdat", type="datetime")
     */
    private $createdat;

    /**
     * @var datetime $modifiedat
     *
     * @ORM\Column(name="modifiedat", type="datetime")
     */
    private $modifiedat;


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
     * Set modifiedat
     *
     * @param datetime $modifiedat
     */
    public function setModifiedat($modifiedat)
    {
        $this->modifiedat = $modifiedat;
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
}