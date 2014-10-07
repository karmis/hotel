<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Holiday;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;
/**
 * Р:Holiday
 *
 * @ORM\Table()
 * @FileStore\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Holiday
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @Assert\File(maxSize="20M")
     * @FileStore\UploadableField(mapping="avatar")
     * @ORM\Column(type="array", nullable=true)
     **/
    private $avatar;


    /**
     * @ORM\ManyToMany(targetEntity="HolidayGallery", orphanRemoval=false, cascade={"persist", "remove"}, inversedBy="holidays")
     * @ORM\JoinTable(
     *      name="Holiday_Gallery",
     *      joinColumns={
     *          @ORM\JoinColumn(name="holiday_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={@ORM\JoinColumn(name="gallery_id", referencedColumnName="id")}
     * )
     */
    private $gallery;

    public function __toString()
    {
        return $this->caption;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gallery = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Holiday
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
     * Set description
     *
     * @param string $description
     * @return Holiday
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
     * @return Holiday
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
     * Add gallery
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Holiday\HolidayGallery $gallery
     * @return Holiday
     */
    public function addGallery(\Brainstrap\Bundles\FrontBundle\Entity\Holiday\HolidayGallery $gallery)
    {
        $this->gallery[] = $gallery;

        return $this;
    }

    /**
     * Remove gallery
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Holiday\HolidayGallery $gallery
     */
    public function removeGallery(\Brainstrap\Bundles\FrontBundle\Entity\Holiday\HolidayGallery $gallery)
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
}
