<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectService
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ObjectService
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
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="Object", mappedBy="services")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $objects;

    public function __toString()
    {
        return $this->caption;
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
     * @return ObjectService
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
     * Set price
     *
     * @param string $price
     * @return ObjectService
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects
     * @return ObjectService
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
