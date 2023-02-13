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
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;
    /**
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;
    /**
     * @ORM\Column(name="special_right", type="boolean")
     */
    private $specialRight;
    /**
     * @ORM\Column(name="advantage_right", type="boolean")
     */
    private $advantageRight;
    /**
     * @ORM\Column(name="base_VI", type="boolean")
     */
    private $baseVI;
    /**
     * @ORM\Column(name="special_base_VI", type="boolean")
     */
    private $specialBaseVI;
    /**
     * @ORM\Column(name="bvi", type="boolean")
     */
    private $bvi;
    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return BenefitEntity
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param mixed $startDate
     * @return BenefitEntity
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return BenefitEntity
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecialRight()
    {
        return $this->specialRight;
    }

    /**
     * @param mixed $specialRight
     * @return BenefitEntity
     */
    public function setSpecialRight($specialRight)
    {
        $this->specialRight = $specialRight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdvantageRight()
    {
        return $this->advantageRight;
    }

    /**
     * @param mixed $advantageRight
     * @return BenefitEntity
     */
    public function setAdvantageRight($advantageRight)
    {
        $this->advantageRight = $advantageRight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBaseVI()
    {
        return $this->baseVI;
    }

    /**
     * @param mixed $baseVI
     * @return BenefitEntity
     */
    public function setBaseVI($baseVI)
    {
        $this->baseVI = $baseVI;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecialBaseVI()
    {
        return $this->specialBaseVI;
    }

    /**
     * @param mixed $specialBaseVI
     * @return BenefitEntity
     */
    public function setSpecialBaseVI($specialBaseVI)
    {
        $this->specialBaseVI = $specialBaseVI;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBvi()
    {
        return $this->bvi;
    }

    /**
     * @param mixed $bvi
     * @return BenefitEntity
     */
    public function setBvi($bvi)
    {
        $this->bvi = $bvi;
        return $this;
    }

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