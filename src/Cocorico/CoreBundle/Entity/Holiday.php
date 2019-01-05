<?php

namespace Cocorico\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cocorico\CoreBundle\Repository\HolidayRepository")

 * @ORM\Table(name="holiday")
 */
class Holiday
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Cocorico\CoreBundle\Model\CustomIdGenerator")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(name="date", type="datetime")
     * @var \DateTime
     */
    private $date;

    /**
     * @ManyToMany(targetEntity="Listing", inversedBy="holidays")
     * @JoinTable(name="listing_holiday")
     */
    private $listings;

    public function __construct()
    {
        $this->listings = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return ArrayCollection
     */
    public function getListing()
    {
        return $this->listings;
    }

    /**
     * @param mixed $listing
     * @return $this
     */
    public function addListing($listing)
    {
        $this->listings->add($listing);

        return $this;
    }

    /**
     * @param $listing
     * @return $this
     */
    public function remove($listing)
    {
        $this->listings->remove($listing);

        return $this;
    }
}
