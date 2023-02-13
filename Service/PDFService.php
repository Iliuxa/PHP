<?php

namespace App\Service;
use Twig\Extension\DebugExtension;

require_once "bootstrap.php";

class PDFService
{

    function outputPDf($response)
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
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