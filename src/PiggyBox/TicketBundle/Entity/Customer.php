<?php

namespace PiggyBox\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PiggyBox\TicketBundle\Entity\Customer
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("email")
 */
class Customer
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
     * @var string $firstname
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string $email
     *
     * @Assert\Email()
     * @ORM\Column(name="email", type="string", length=255,unique=true)
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=24)
     */
    private $phone;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

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
     * @ORM\OneToMany(targetEntity="Account", mappedBy="Customer")
     */
    private $accounts;

    public function __construct()
    {
        $this->accounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
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
     * Add accounts
     *
     * @param PiggyBox\TicketBundle\Entity\Account $accounts
     */
    public function addAccount(\PiggyBox\TicketBundle\Entity\Account $accounts)
    {
        $this->accounts[] = $accounts;
    }

    /**
     * Get accounts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    public function __toString()
    {
        return $this->getLastname();
    }
}