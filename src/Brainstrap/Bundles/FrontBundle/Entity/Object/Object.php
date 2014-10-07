<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * Object
 *
 * @ORM\Table()
 * @FileStore\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Brainstrap\Bundles\FrontBundle\Repository\ObjectRepository")
 */
class Object
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=255)
     */
    private $caption;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recommended", type="boolean", nullable=true)
     */
    private $recommended;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\File(maxSize="10M")
     * @FileStore\UploadableField(mapping="avatar")
     * @ORM\Column(type="array", nullable=true)
     **/
    private $avatar;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\Tariff
     *
     * @ORM\ManyToOne(targetEntity="\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup", inversedBy="objects")
     * @ORM\JoinColumn(name="tariff_weekly_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tariffWeekly;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\Tariff
     *
     * @ORM\ManyToOne(targetEntity="\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup", inversedBy="objects")
     * @ORM\JoinColumn(name="tariff_holiday_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tariffHoliday;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLate
     *
     * @ORM\ManyToOne(targetEntity="\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup", inversedBy="objects")
     * @ORM\JoinColumn(name="tariff_late_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tariffLate;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\Tariff
     *
     * @ORM\ManyToOne(targetEntity="\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup", inversedBy="objects")
     * @ORM\JoinColumn(name="tariff_weekend_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tariffWeekend;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourly
     *
     * @ORM\ManyToOne(targetEntity="\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup", inversedBy="objects")
     * @ORM\JoinColumn(name="tariff_hourly_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tariffHourly;

    /**
     * @ORM\ManyToMany(targetEntity="ObjectGallery", orphanRemoval=false, cascade={"persist", "remove"}, inversedBy="objects")
     * @ORM\JoinTable(
     *      name="Object_Gallery",
     *      joinColumns={
     *          @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={@ORM\JoinColumn(name="gallery_id", referencedColumnName="id")}
     * )
     */
    public $gallery;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectType
     *
     * @ORM\ManyToOne(targetEntity="ObjectType", inversedBy="objects")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $type;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBerth
     *
     * @ORM\ManyToOne(targetEntity="ObjectBerth", inversedBy="objects")
     * @ORM\JoinColumn(name="berth_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $berth;

    /**
     * @ORM\ManyToMany(targetEntity="ObjectAddition", orphanRemoval=false, cascade={"persist"}, inversedBy="objects")
     * @ORM\JoinTable(
     *      name="Object_Addition",
     *      joinColumns={
     *          @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={@ORM\JoinColumn(name="addition_id", referencedColumnName="id")}
     * )
     */
    private $additions;

    /**
     * @ORM\ManyToMany(targetEntity="ObjectService", orphanRemoval=false, cascade={"persist"}, inversedBy="objects")
     * @ORM\JoinTable(
     *      name="Object_Service",
     *      joinColumns={
     *          @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id")}
     * )
     */
    private $services;

    /**
     * @ORM\ManyToMany(targetEntity="ObjectParameter", orphanRemoval=false, cascade={"persist"}, inversedBy="objects")
     * @ORM\JoinTable(
     *      name="Object_Parameter",
     *      joinColumns={
     *          @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={@ORM\JoinColumn(name="parameter_id", referencedColumnName="id")}
     * )
     */
    private $parameters;

    /**
     *  @var \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking
     *
     * @ORM\OneToMany(targetEntity="ObjectBooking", mappedBy="object", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $booked;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted;

    public function __toString()
    {
        return $this->caption;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->deleted = 0;
        $this->gallery = new \Doctrine\Common\Collections\ArrayCollection();
        $this->additions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parameters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->booked = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set caption
     *
     * @param string $caption
     * @return Object
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string 
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set recommended
     *
     * @param boolean $recommended
     * @return Object
     */
    public function setRecommended($recommended)
    {
        $this->recommended = $recommended;

        return $this;
    }

    /**
     * Get recommended
     *
     * @return boolean 
     */
    public function getRecommended()
    {
        return $this->recommended;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Object
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set avatar
     *
     * @param array $avatar
     * @return Object
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return array 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set tariffWeekly
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $tariffWeekly
     * @return Object
     */
    public function setTariffWeekly(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $tariffWeekly = null)
    {
        $this->tariffWeekly = $tariffWeekly;

        return $this;
    }

    /**
     * Get tariffWeekly
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup 
     */
    public function getTariffWeekly()
    {
        return $this->tariffWeekly;
    }

    /**
     * Set tariffHoliday
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $tariffHoliday
     * @return Object
     */
    public function setTariffHoliday(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $tariffHoliday = null)
    {
        $this->tariffHoliday = $tariffHoliday;

        return $this;
    }

    /**
     * Get tariffHoliday
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup 
     */
    public function getTariffHoliday()
    {
        return $this->tariffHoliday;
    }

    /**
     * Set tariffLate
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup $tariffLate
     * @return Object
     */
    public function setTariffLate(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup $tariffLate = null)
    {
        $this->tariffLate = $tariffLate;

        return $this;
    }

    /**
     * Get tariffLate
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup 
     */
    public function getTariffLate()
    {
        return $this->tariffLate;
    }

    /**
     * Set tariffWeekend
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $tariffWeekend
     * @return Object
     */
    public function setTariffWeekend(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $tariffWeekend = null)
    {
        $this->tariffWeekend = $tariffWeekend;

        return $this;
    }

    /**
     * Get tariffWeekend
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup 
     */
    public function getTariffWeekend()
    {
        return $this->tariffWeekend;
    }

    /**
     * Set tariffHourly
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup $tariffHourly
     * @return Object
     */
    public function setTariffHourly(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup $tariffHourly = null)
    {
        $this->tariffHourly = $tariffHourly;

        return $this;
    }

    /**
     * Get tariffHourly
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup 
     */
    public function getTariffHourly()
    {
        return $this->tariffHourly;
    }

    /**
     * Add gallery
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectGallery $gallery
     * @return Object
     */
    public function addGallery(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectGallery $gallery)
    {
        $this->gallery[] = $gallery;

        return $this;
    }

    /**
     * Remove gallery
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectGallery $gallery
     */
    public function removeGallery(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectGallery $gallery)
    {
        $this->gallery->removeElement($gallery);
    }

    /**
     * Get gallery
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set type
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectType $type
     * @return Object
     */
    public function setType(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set berth
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBerth $berth
     * @return Object
     */
    public function setBerth(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBerth $berth = null)
    {
        $this->berth = $berth;

        return $this;
    }

    /**
     * Get berth
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBerth 
     */
    public function getBerth()
    {
        return $this->berth;
    }

    /**
     * Add additions
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectAddition $additions
     * @return Object
     */
    public function addAddition(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectAddition $additions)
    {
        $this->additions[] = $additions;

        return $this;
    }

    /**
     * Remove additions
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectAddition $additions
     */
    public function removeAddition(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectAddition $additions)
    {
        $this->additions->removeElement($additions);
    }

    /**
     * Get additions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdditions()
    {
        return $this->additions;
    }

    /**
     * Add services
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectService $services
     * @return Object
     */
    public function addService(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectService $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectService $services
     */
    public function removeService(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectService $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add parameters
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectParameter $parameters
     * @return Object
     */
    public function addParameter(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectParameter $parameters)
    {
        $this->parameters[] = $parameters;

        return $this;
    }

    /**
     * Remove parameters
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectParameter $parameters
     */
    public function removeParameter(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectParameter $parameters)
    {
        $this->parameters->removeElement($parameters);
    }

    /**
     * Get parameters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Add booked
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking $booked
     * @return Object
     */
    public function addBooked(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking $booked)
    {
        $this->booked[] = $booked;

        return $this;
    }

    /**
     * Remove booked
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking $booked
     */
    public function removeBooked(\Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking $booked)
    {
        $this->booked->removeElement($booked);
    }

    /**
     * Get booked
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBooked()
    {
        return $this->booked;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Object
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
