<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectBerth
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ObjectBerth
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
     * @ORM\Column(name="caption", type="string", length=255)
     */
    private $caption;

    /**
     * @var integer
     *
     * @ORM\Column(name="countPeople", type="integer")
     */
    private $countPeople;

    /**
     * @ORM\Column(name="countChild", type="integer", nullable=true)
     */
    private $countChild;

    /**
     * @ORM\OneToMany(targetEntity="Object", mappedBy="berth")
     */
    private $objects;

    public function __toString()
    {
        return $this->caption;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ObjectBerth
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
     * Set countPeople
     *
     * @param integer $countPeople
     * @return ObjectBerth
     */
    public function setCountPeople($countPeople)
    {
        $this->countPeople = $countPeople;

        return $this;
    }

    /**
     * Get countPeople
     *
     * @return integer 
     */
    public function getCountPeople()
    {
        return $this->countPeople;
    }

    /**
     * Set countChild
     *
     * @param integer $countChild
     * @return ObjectBerth
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
     * Add objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects
     * @return ObjectBerth
     */
    public function addObject(\Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects)
    {
        $this->objects[] = $objects;

        return $this;
    }

    /**
     * Remove objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects
     */
    public function removeObject(\Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects)
    {
        $this->objects->removeElement($objects);
    }

    /**
     * Get objects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObjects()
    {
        return $this->objects;
    }
}
