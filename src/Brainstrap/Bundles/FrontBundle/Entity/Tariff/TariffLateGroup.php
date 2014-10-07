<?php

namespace Brainstrap\Bundles\FrontBundle\Entity\Tariff;

use Doctrine\ORM\Mapping as ORM;

/**
 * TariffLateGroup
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TariffLateGroup
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
     * @ORM\OneToMany(targetEntity="TariffLate", mappedBy="group")
     */
    private $tariffs;

    public function __toString()
    {
        return $this->caption;
    }

    public function getMinPriceForThisTariffGroup()
    {
        $minPrice = null;
        foreach($this->getTariffs() as $key => $tariff)
        {
            if($minPrice == null){
                $minPrice = $tariff->getPrice();
            } else {
                if($tariff->getPrice() < $minPrice)
                {
                    $minPrice = $tariff->getPrice();
                }
            }

        }

        return $minPrice;
    }

    public function getIdWithMinPriceForThisTariffGroup()
    {
        $minPrice = null;
        $minId = null;
        foreach($this->getTariffs() as $key => $tariff)
        {
            if($minPrice == null){
                $minPrice = $tariff->getPrice();
                $minId = $key;
            } else {
                if($tariff->getPrice() < $minPrice)
                {
                    $minPrice = $tariff->getPrice();
                    $minId = $key;
                }
            }

        }

        return $minId;
    }

    public function getTest()
    {
        return $this->getCaption();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tariffs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return TariffLateGroup
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
     * Add tariffs
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLate $tariffs
     * @return TariffLateGroup
     */
    public function addTariff(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLate $tariffs)
    {
        $this->tariffs[] = $tariffs;

        return $this;
    }

    /**
     * Remove tariffs
     *
     * @param \Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLate $tariffs
     */
    public function removeTariff(\Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLate $tariffs)
    {
        $this->tariffs->removeElement($tariffs);
    }

    /**
     * Get tariffs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTariffs()
    {
        return $this->tariffs;
    }
}
