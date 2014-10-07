<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Tariff;

use Doctrine\ORM\Mapping as ORM;

/**
 * TariffLate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TariffLate
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
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup
     *
     * @ORM\ManyToOne(targetEntity="TariffLateGroup", inversedBy="tariffs")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffType
     *
     * @ORM\ManyToOne(targetEntity="TariffType", inversedBy="tariffs")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $type;

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
     * @return TariffLate
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
     * @return TariffLate
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
     * Set group
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup $group
     * @return TariffLate
     */
    public function setGroup(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set type
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffType $type
     * @return TariffLate
     */
    public function setType(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffType 
     */
    public function getType()
    {
        return $this->type;
    }
}
