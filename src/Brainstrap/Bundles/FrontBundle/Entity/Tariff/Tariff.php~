<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Tariff;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tariff
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tariff
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup
     *
     * @ORM\ManyToOne(targetEntity="TariffGroup", inversedBy="tariffs")
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
     * @return Tariff
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
     * @return Tariff
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
     * Set price
     *
     * @param string $price
     * @return Tariff
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
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $group
     * @return Tariff
     */
    public function setGroup(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set type
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffType $type
     * @return Tariff
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

    /**
     * Set description
     *
     * @param string $description
     * @return Tariff
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
