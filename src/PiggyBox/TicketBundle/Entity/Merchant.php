<?php

namespace PiggyBox\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PiggyBox\TicketBundle\Entity\Merchant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Merchant
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
     * @var string $merchant_type
     *
     * @ORM\Column(name="merchant_type", type="string", length=255)
     */
    private $merchant_type;

    /**
     * @var string $merchant_name
     *
     * @ORM\Column(name="merchant_name", type="string", length=255)
     */
    private $merchant_name;

    /**
     * @var string $street_address
     *
     * @ORM\Column(name="street_address", type="string", length=255)
     */
    private $street_address;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string $postal_code
     *
     * @ORM\Column(name="postal_code", type="string", length=255)
     */
    private $postal_code;

    /**
     * @var integer $steet_number
     *
     * @ORM\Column(name="steet_number", type="integer")
     */
    private $steet_number;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=24)
     */
    private $phone;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string $user_name
     *
     * @ORM\Column(name="user_name", type="string", length=255)
     */
    private $user_name;

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
     * Set merchant_type
     *
     * @param string $merchantType
     */
    public function setMerchantType($merchantType)
    {
        $this->merchant_type = $merchantType;
    }

    /**
     * Get merchant_type
     *
     * @return string 
     */
    public function getMerchantType()
    {
        return $this->merchant_type;
    }

    /**
     * Set merchant_name
     *
     * @param string $merchantName
     */
    public function setMerchantName($merchantName)
    {
        $this->merchant_name = $merchantName;
    }

    /**
     * Get merchant_name
     *
     * @return string 
     */
    public function getMerchantName()
    {
        return $this->merchant_name;
    }

    /**
     * Set street_address
     *
     * @param string $streetAddress
     */
    public function setStreetAddress($streetAddress)
    {
        $this->street_address = $streetAddress;
    }

    /**
     * Get street_address
     *
     * @return string 
     */
    public function getStreetAddress()
    {
        return $this->street_address;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set postal_code
     *
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;
    }

    /**
     * Get postal_code
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set steet_number
     *
     * @param integer $steetNumber
     */
    public function setSteetNumber($steetNumber)
    {
        $this->steet_number = $steetNumber;
    }

    /**
     * Get steet_number
     *
     * @return integer 
     */
    public function getSteetNumber()
    {
        return $this->steet_number;
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
     * Set user_name
     *
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->user_name = $userName;
    }

    /**
     * Get user_name
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->user_name;
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