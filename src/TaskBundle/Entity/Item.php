<?php

namespace TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="TaskBundle\Repository\ItemRepository")
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=125)
     * @Assert\Length(max=125)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     * @Assert\DateTime()
     */
    private $endDate;

    /**
     * @var array
     *
     * @ORM\Column(name="labels", type="simple_array", nullable=true)
     */
    private $labels;

    /**
     * @var bool
     *
     * @ORM\Column(name="achieved", type="boolean")
     */
    private $achieved;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Item
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
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Item
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set labels
     *
     * @param array $labels
     *
     * @return Item
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Get labels
     *
     * @return array
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Set achieved
     *
     * @param boolean $achieved
     *
     * @return Item
     */
    public function setAchieved($achieved)
    {
        $this->achieved = $achieved;

        return $this;
    }

    /**
     * Get achieved
     *
     * @return bool
     */
    public function getAchieved()
    {
        return $this->achieved;
    }
}
