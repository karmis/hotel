<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Slider;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * Slide
 *
 * @ORM\Table()
 * @FileStore\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Slide {

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
     * @ORM\Column(name="color_caption", type="string", length=255)
     */
    private $colorCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="secondCaption", type="string", length=255)
     */
    private $secondCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="color_second_caption", type="string", length=255)
     */
    private $colorSecondCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="color_description", type="string", length=255)
     */
    private $colorDescription;

    /**
     * @Assert\File(maxSize="18M")
     * @FileStore\UploadableField(mapping="avatar")
     * @ORM\Column(type="array", nullable=true)
     **/
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="forMain", type="boolean", nullable=true)
     */
    private $forMain;

    /**
     * @var string
     *
     * @ORM\Column(name="forGallery", type="boolean", nullable=true)
     */
    private $forGallery;

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
     * @return Slide
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
     * Set colorCaption
     *
     * @param string $colorCaption
     * @return Slide
     */
    public function setColorCaption($colorCaption)
    {
        $this->colorCaption = $colorCaption;

        return $this;
    }

    /**
     * Get colorCaption
     *
     * @return string 
     */
    public function getColorCaption()
    {
        return $this->colorCaption;
    }

    /**
     * Set secondCaption
     *
     * @param string $secondCaption
     * @return Slide
     */
    public function setSecondCaption($secondCaption)
    {
        $this->secondCaption = $secondCaption;

        return $this;
    }

    /**
     * Get secondCaption
     *
     * @return string 
     */
    public function getSecondCaption()
    {
        return $this->secondCaption;
    }

    /**
     * Set colorSecondCaption
     *
     * @param string $colorSecondCaption
     * @return Slide
     */
    public function setColorSecondCaption($colorSecondCaption)
    {
        $this->colorSecondCaption = $colorSecondCaption;

        return $this;
    }

    /**
     * Get colorSecondCaption
     *
     * @return string 
     */
    public function getColorSecondCaption()
    {
        return $this->colorSecondCaption;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Slide
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
     * Set colorDescription
     *
     * @param string $colorDescription
     * @return Slide
     */
    public function setColorDescription($colorDescription)
    {
        $this->colorDescription = $colorDescription;

        return $this;
    }

    /**
     * Get colorDescription
     *
     * @return string 
     */
    public function getColorDescription()
    {
        return $this->colorDescription;
    }

    /**
     * Set photo
     *
     * @param array $photo
     * @return Slide
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
     * Set forMain
     *
     * @param boolean $forMain
     * @return Slide
     */
    public function setForMain($forMain)
    {
        $this->forMain = $forMain;

        return $this;
    }

    /**
     * Get forMain
     *
     * @return boolean 
     */
    public function getForMain()
    {
        return $this->forMain;
    }

    /**
     * Set forGallery
     *
     * @param boolean $forGallery
     * @return Slide
     */
    public function setForGallery($forGallery)
    {
        $this->forGallery = $forGallery;

        return $this;
    }

    /**
     * Get forGallery
     *
     * @return boolean 
     */
    public function getForGallery()
    {
        return $this->forGallery;
    }
}
