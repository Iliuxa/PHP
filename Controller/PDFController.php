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
        $this->service->outputPDf((new BenefitService())->getAll());
    }

    /**
     * Вывод льгот в PDF, действительных в определённый год
     * @param array $request
     * @return void
     * @throws \MpdfException
     */
    function getValidInYearPDF(array $request)
    {
        $this->service->outputPDf((new BenefitService())->getValidInYear($request));
    }
}