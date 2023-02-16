<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once(__DIR__ . '/../vendor/autoload.php');

$container = new ContainerBuilder();
$container->addDefinitions(__DIR__ . '/container.php');
$container = $container->build();

$app = $container->get(App::class);

(require_once(__DIR__ . '/routes.php'))($app);
(require_once(__DIR__ . '/middleware.php'))($app);

return $app;