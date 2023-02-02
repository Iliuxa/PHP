<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="benefits")
 */
class BenefitEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer" , name="id_benefits")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TitleEntity")
     * @ORM\JoinColumn(name="id_title", referencedColumnName="id_title")
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryEntity")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="GroupEntity")
     * @ORM\JoinColumn(name="id_group", referencedColumnName="id_group")
     */
    private $group;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return BenefitEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return BenefitEntity
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return BenefitEntity
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     * @return BenefitEntity
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }


}