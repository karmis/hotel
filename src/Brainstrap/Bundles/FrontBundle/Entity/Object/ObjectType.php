<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ObjectType
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
     * @ORM\OneToMany(targetEntity="Object", mappedBy="type")
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
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ObjectType
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
     * Add types
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $types
     * @return ObjectType
     */
    public function addType(\Brainstrap\Bundles\FrontBundle\Entity\Object\Object $types)
    {
        $this->types[] = $types;

        return $this;
    }

    /**
     * Remove types
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $types
     */
    public function removeType(\Brainstrap\Bundles\FrontBundle\Entity\Object\Object $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects
     * @return ObjectType
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
