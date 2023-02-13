<?php

namespace App\Controller;

use App\Service\BenefitService;
use App\Service\PDFService;

require_once "bootstrap.php";

class PDFController
{
    public PDFService $service;

    public function __construct()
    {
        $this->service = new PDFService();
    }

    /**
     * Вывод всех льгот в PDF
     * @return void
     * @throws \MpdfException
     */
    function getAllPDF()
    {
        $this->service->outputPDf((new BenefitController)->getAll());
    }

    /**
     * Вывод льгот в PDF, действительных в определённый год
     * @return void
     * @throws \MpdfException
     */
    function getValidInYearPDF()
    {
        $this->service->outputPDf((new BenefitController)->getValidInYear());
    }
}