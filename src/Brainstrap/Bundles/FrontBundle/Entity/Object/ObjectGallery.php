<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Object;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * ObjectGallery
 *
 * @ORM\Table()
 * @FileStore\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class ObjectGallery
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
     * @Assert\File(maxSize="20M")
     * @FileStore\UploadableField(mapping="photo")
     * @ORM\Column(type="array")
     **/
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="string", nullable=true)
     */
    private $caption;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Object", mappedBy="gallery")
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
     * Set photo
     *
     * @param array $photo
     * @return ObjectGallery
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return array 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ObjectGallery
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
     * Add objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Object\Object $objects
     * @return ObjectGallery
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

    /**
     * Set caption
     *
     * @param string $caption
     * @return ObjectGallery
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
}
