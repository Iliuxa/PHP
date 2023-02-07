<?php
namespace App\DTO;
use DateTime;
class BenefitDTO
{

    /**
     * Идентификатор льготы
     * @var int
     */
    public int $id;
    /**
     * Идентификатор, название и сокращённое название льготы
     * @var IdNameShortDTO
     */
    public IdNameShortDTO $title;
    /**
     * Иденитификатор и название категории льготы
     * @var IdNameDTO
     */
    public IdNameDTO $category;
    /**
     * Идентификатор и название группы льготы
     * @var IdNameDTO
     */
    public IdNameDTO $group;
    /**
     * Дата начала действия льготы
     * @var string
     */
    public string $startDate;
    /**
     * Дата окончания действия льготы
     * @var string
     */
    public string $endDate;
    /**
     * Особое право
     * @var bool
     */
    public bool $specialRight;
    /**
     * Преимущественное право
     * @var bool
     */
    public bool $advantageRight;
    /**
     * Основани для допуска к ВИ
     * @var bool
     */
    public bool $baseVI;
    /**
     * Основание для допуска к Ви Спецю квота
     * @var bool
     */
    public bool $specialBaseVI;
    /**
     * БВИ
     * @var bool
     */
    public bool $bvi;
    /**
     * Активность льготы
     * @var bool
     */
    public bool $active;


}