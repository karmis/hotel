<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Holiday;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * HolidayGallery
 *
 * @ORM\Table()
 * @FileStore\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class HolidayGallery
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
     * @ORM\Column(name="caption", type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\File(maxSize="5M")
     * @FileStore\UploadableField(mapping="photo")
     * @ORM\Column(type="array")
     **/
    private $photo;


    /**
     * @ORM\ManyToMany(targetEntity="Holiday", mappedBy="gallery")
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
     * @return HolidayGallery
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
     * Add objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Holiday\Holiday $objects
     * @return HolidayGallery
     */
    public function addObject(\Brainstrap\Bundles\FrontBundle\Entity\Holiday\Holiday $objects)
    {
        $this->objects[] = $objects;

        return $this;
    }

    /**
     * Remove objects
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Holiday\Holiday $objects
     */
    public function removeObject(\Brainstrap\Bundles\FrontBundle\Entity\Holiday\Holiday $objects)
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
     * Set photo
     *
     * @param array $photo
     * @return HolidayGallery
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
     * @return HolidayGallery
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
}
