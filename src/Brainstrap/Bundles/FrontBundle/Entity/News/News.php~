<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\News;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class News
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
     * @ORM\Column(name="smallContent", type="text")
     */
    private $smallContent;

    /**
     * @var string
     *
     * @ORM\Column(name="fullContent", type="text")
     */
    private $fullContent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;


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
     * @return News
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
     * Set smallContent
     *
     * @param string $smallContent
     * @return News
     */
    public function setSmallContent($smallContent)
    {
        $this->smallContent = $smallContent;

        return $this;
    }

    /**
     * Get smallContent
     *
     * @return string 
     */
    public function getSmallContent()
    {
        return $this->smallContent;
    }

    /**
     * Set fullContent
     *
     * @param string $fullContent
     * @return News
     */
    public function setFullContent($fullContent)
    {
        $this->fullContent = $fullContent;

        return $this;
    }

    /**
     * Get fullContent
     *
     * @return string 
     */
    public function getFullContent()
    {
        return $this->fullContent;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return News
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }
}
