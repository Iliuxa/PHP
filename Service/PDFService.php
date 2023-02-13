<?php

namespace App\Service;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require_once "bootstrap.php";

class PDFService
{

    /**
     * @throws \MpdfException
     */
    function outputPDf($response)
    {
        $loader = new FilesystemLoader(__DIR__ . '/templates');
        $twig = new Environment($loader, ['debug' => true]);
        $twig->addExtension(new DebugExtension());

        $template = $twig->load('twig.html.twig');

        $html = $template->render([
            'index' => $response,
        ]);

        $mpdf = new \mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }
}