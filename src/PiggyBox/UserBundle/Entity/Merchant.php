<?php

namespace PiggyBox\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * PiggyBox\UserBundle\Entity\Merchant
 *
 * @ORM\Table(name="piggybox_user")
 * @ORM\Entity
 */
class Merchant extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $merchant_lastname
     *
     * @ORM\Column(name="merchant_lastname", type="string", length=255)
     */
    private $merchant_lastname;

    /**
     * @var string $merchant_firstname
     *
     * @ORM\Column(name="merchant_firstname", type="string", length=255)
     */
    private $merchant_firstname;

    /**
     * @var string $shop_name
     *
     * @ORM\Column(name="shop_name", type="string", length=255)
     */
    private $shop_name;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=16)
     */
    private $phone;

    /**
     * @var string $street_number
     *
     * @ORM\Column(name="street_number", type="string", length=12)
     */
    private $street_number;

    /**
     * @var string $street_name
     *
     * @ORM\Column(name="street_name", type="string", length=255)
     */
    private $street_name;

    /**
     * @var string $zipcode
     *
     * @ORM\Column(name="zipcode", type="string", length=10)
     */
    private $zipcode;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string $shop_type
     *
     * @ORM\Column(name="shop_type", type="string", length=255)
     */
    private $shop_type;

    /**
     * @ORM\OneToMany(targetEntity="\PiggyBox\TicketBundle\Entity\Account", mappedBy="merchant")
     */
    private $accounts;

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
     * Set merchant_lastname
     *
     * @param string $merchantLastname
     */
    public function setMerchantLastname($merchantLastname)
    {
        $this->merchant_lastname = $merchantLastname;
    }

    /**
     * Get merchant_lastname
     *
     * @return string
     */
    public function getMerchantLastname()
    {
        return $this->merchant_lastname;
    }

    /**
     * Set merchant_firstname
     *
     * @param string $merchantFirstname
     */
    public function setMerchantFirstname($merchantFirstname)
    {
        $this->merchant_firstname = $merchantFirstname;
    }

    /**
     * Get merchant_firstname
     *
     * @return string
     */
    public function getMerchantFirstname()
    {
        return $this->merchant_firstname;
    }

    /**
     * Set shop_name
     *
     * @param string $shopName
     */
    public function setShopName($shopName)
    {
        $this->shop_name = $shopName;
    }

    /**
     * Get shop_name
     *
     * @return string
     */
    public function getShopName()
    {
        return $this->shop_name;
    }

    /**
     * Set street_number
     *
     * @param string $streetNumber
     */
    public function setStreetNumber($streetNumber)
    {
        $this->street_number = $streetNumber;
    }

    /**
     * Get street_number
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->street_number;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set shop_type
     *
     * @param string $shopType
     */
    public function setShopType($shopType)
    {
        $this->shop_type = $shopType;
    }

    /**
     * Get shop_type
     *
     * @return string
     */
    public function getShopType()
    {
        return $this->shop_type;
    }

    public function __construct()
    {
        parent::__construct();
        $this->accounts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addRole('role_merchant');
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
     * Set street_name
     *
     * @param string $streetName
     */
    public function setStreetName($streetName)
    {
        $this->street_name = $streetName;
    }

    /**
     * Get street_name
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->street_name;
    }
}
