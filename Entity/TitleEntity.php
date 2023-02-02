<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="title")
 */
class TitleEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="id_title")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(name="full_name", type="string")
     */
    private $fullName;

    /**
     * @ORM\Column(name="short_name", type="string")
     */
    private $shortName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return TitleEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     * @return TitleEntity
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param mixed $shortName
     * @return TitleEntity
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
        return $this;
    }


    public function toDto()
    {
        return [
            'name' => $this->getFullName(),
            'short' => $this->getShortName()
        ];
    }
}