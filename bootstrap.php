<?php

use App\Constants\Constants;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once "vendor/autoload.php";

function getEntityManagerSec(): EntityManager
{
    $paths = [__DIR__ . './Entity'];
    $isDevMode = true;

    $dbParams = array(
        'driver' => 'pdo_pgsql',
        'user' => 'postgres',
        'password' => 'root',
        'host' => 'localhost',
        'dbname' => 'postgres',
    );

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    try {
        return EntityManager::create($dbParams, $config);
    } catch (\Doctrine\ORM\ORMException $e) {
        var_dump($e->getMessage());
        die();
    }
}

function getEntityManager(): EntityManager
{
    $config = new Configuration;

    $queryCache = new ArrayAdapter();
    $metadataCache = new ArrayAdapter();

    $config->setMetadataCache($metadataCache);
    $config->setQueryCache($queryCache);

    //annotations driver
    $driver = new AnnotationDriver(new AnnotationReader(), [__DIR__ . '/Entity']);
    $config->setMetadataDriverImpl($driver);

    //proxy config
    $config->setProxyDir(__DIR__ . '/var/cache');
    $config->setProxyNamespace('Cache\Proxies');
    $config->setAutoGenerateProxyClasses(false);


    $connectionOptions = $dbParams = array(
        'driver' => 'pdo_pgsql',
        'user' => 'postgres',
        'password' => 'root',
        'host' => 'localhost',
        'dbname' => 'postgres',
    );

    return EntityManager::create($connectionOptions, $config);
}

function outputJson($success, $message, $responseCode = Constants::HTTP_BAD_REQUEST)
{
    header("Content-Type: application\json");
    if ($success) {
        echo json_encode(['success' => $success, 'rows' => $message]);
    } else {
        echo json_encode(['success' => $success, 'reason' => $message]);
        http_response_code($responseCode);
    }

}