<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectParameter
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ObjectParameter
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToMany(targetEntity="Object", mappedBy="parameters")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $objects;
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
     * @return ObjectParameter
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
     * Set value
     *
     * @param string $value
     * @return ObjectParameter
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects
     * @return ObjectParameter
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
