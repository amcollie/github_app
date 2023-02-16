<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use DI\Bridge\Slim\Bridge;

return [
    'settings' => fn () => require_once(__DIR__ . '/settings.php'),
    App::class => fn (ContainerInterface $container) => Bridge::create($container),
    'smarty' => function () {
        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../views');
        $smarty->setCompileDir(__DIR__. '/../views/compiled');
        $smarty->setCacheDir(__DIR__. '/../storage/cache');
        $smarty->setConfigDir(__DIR__ . '/../config');

        return $smarty;
    }
];