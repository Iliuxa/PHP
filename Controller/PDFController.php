<?php

namespace App\Controller;

use App\Service\BenefitService;
use App\Service\PDFService;

require_once "bootstrap.php";

class PDFController
{
    private PDFService $service;

    public function __construct()
    {
        $this->service = new PDFService();
    }

    /**
     * Вывод всех льгот в PDF
     * @return void
     * @throws \MpdfException
     */
    public function getAllPDF()
    {
        $this->service->outputPDf((new BenefitService())->getAll());
    }

    /**
     * Вывод льгот в PDF, действительных в определённый год
     * @param array $request
     * @return void
     * @throws \MpdfException
     */
    public function getValidInYearPDF(array $request)
    {
        $this->service->outputPDf((new BenefitService())->getValidInYear($request));
    }
}