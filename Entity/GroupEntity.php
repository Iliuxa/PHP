<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="group_")
 */
class GroupEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="id_group")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="group_name", type="string")
     */
    private $groupName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return GroupEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     * @return GroupEntity
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
        return $this;
    }

}