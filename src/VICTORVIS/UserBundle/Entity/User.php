<?php
namespace VICTORVIS\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @Expose
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Expose
     * @Groups({"name"})
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstName;

    /**
     * @Expose
     * @Groups({"name"})
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please enter your surname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The surname is too short.",
     *     maxMessage="The surname is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $surname;

    /**
     * @Expose
     * @Groups({"name"})
     * @var string
     */
    protected $fullName;

    /**
     * @Expose
     * @Groups({"email"})
     */
    protected $email;

    /**
     * @Expose
     * @Groups({"birthdate"})
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthdate;

    /**
     * @Expose
     * @Groups({"cep"})
     * @ORM\Column(type="string", nullable=true)
     */
    protected $cep;

    /**
     * @Expose
     * @Groups({"city"})
     * @ORM\ManyToOne(targetEntity="VICTORVIS\UserBundle\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255)
     */
    protected $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookUsername", type="string", length=255, nullable=true)
     */
    protected $facebookUsername;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($suname)
    {
        $this->surname = $suname;

        return $this;
    }

    public function getFullName()
    {
        return $this->getFirstname() . ' ' . $this->getSurname();
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        $this->cep = $cep;
    }
    
    /**
     * @param \VICTORVIS\UserBundle\Entity\City $city
     * @return City
     */
    public function setCity(\VICTORVIS\UserBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return \VICTORVIS\UserBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setSurname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }    
}