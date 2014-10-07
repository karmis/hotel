<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Tariff;

use Doctrine\ORM\Mapping as ORM;

/**
 * TariffHourly
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TariffHourly
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
     * @ORM\Column(name="price_first_hourly", type="decimal")
     */
    private $priceFirstHourly;

    /**
     * @var string
     *
     * @ORM\Column(name="price_next_hourly", type="decimal")
     */
    private $priceNextHourly;

    /**
     * @var \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffGroup
     *
     * @ORM\ManyToOne(targetEntity="TariffHourlyGroup", inversedBy="tariffs")
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
     * @return TariffHourly
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
     * Set priceFirstHourly
     *
     * @param string $priceFirstHourly
     * @return TariffHourly
     */
    public function setPriceFirstHourly($priceFirstHourly)
    {
        $this->priceFirstHourly = $priceFirstHourly;

        return $this;
    }

    /**
     * Get priceFirstHourly
     *
     * @return string 
     */
    public function getPriceFirstHourly()
    {
        return $this->priceFirstHourly;
    }

    /**
     * Set priceNextHourly
     *
     * @param string $priceNextHourly
     * @return TariffHourly
     */
    public function setPriceNextHourly($priceNextHourly)
    {
        $this->priceNextHourly = $priceNextHourly;

        return $this;
    }

    /**
     * Get priceNextHourly
     *
     * @return string 
     */
    public function getPriceNextHourly()
    {
        return $this->priceNextHourly;
    }

    /**
     * Set group
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup $group
     * @return TariffHourly
     */
    public function setGroup(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set type
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffType $type
     * @return TariffHourly
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
