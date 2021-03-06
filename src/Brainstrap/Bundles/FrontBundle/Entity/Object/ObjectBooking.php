<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectBooking
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Brainstrap\Bundles\FrontBundle\Repository\ObjectBookingRepository")
 */
class ObjectBooking
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="sname", type="string", length=255)
     */
    private $sname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="countAdult", type="integer")
     */
    private $countAdult;

    /**
     * @var integer
     *
     * @ORM\Column(name="countChild", type="integer", nullable=true)
     */
    private $countChild;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Object\Object
     *
     * @ORM\ManyToOne(targetEntity="Object", inversedBy="booked")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $object;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", nullable=true)
     */
    private $approved;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted;

    public function __construct()
    {
        $this->approved = 0;
        $this->deleted = 0;
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
     * Set name
     *
     * @param string $name
     * @return ObjectBooking
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set sname
     *
     * @param string $sname
     * @return ObjectBooking
     */
    public function setSname($sname)
    {
        $this->sname = $sname;

        return $this;
    }

    /**
     * Get sname
     *
     * @return string 
     */
    public function getSname()
    {
        return $this->sname;
    }

    /**
     * Set countAdult
     *
     * @param integer $countAdult
     * @return ObjectBooking
     */
    public function setCountAdult($countAdult)
    {
        $this->countAdult = $countAdult;

        return $this;
    }

    /**
     * Get countAdult
     *
     * @return integer 
     */
    public function getCountAdult()
    {
        return $this->countAdult;
    }

    /**
     * Set countChild
     *
     * @param integer $countChild
     * @return ObjectBooking
     */
    public function setCountChild($countChild)
    {
        $this->countChild = $countChild;

        return $this;
    }

    /**
     * Get countChild
     *
     * @return integer 
     */
    public function getCountChild()
    {
        return $this->countChild;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return ObjectBooking
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param string $endDate
     * @return ObjectBooking
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return string 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set object
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $object
     * @return ObjectBooking
     */
    public function setObject(\Brainstrap\Bundles\FrontBundle\Entity\Object\Object $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Object\Object 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return ObjectBooking
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return ObjectBooking
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
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
     * @return ObjectBooking
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     * Set deleted
     *
     * @param boolean $deleted
     * @return ObjectBooking
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
