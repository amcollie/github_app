<?php declare(strict_types=1);

use App\Controller\GithubUserRepo;
use Slim\App;

return function (App $app) {
    $app->get('/', GithubUserRepo::class . ':index');
    $app->get('/delete/{owner}/{name}', GithubUserRepo::class. ':delete');
    $app->get('/edit/{owner}/{name}', GithubUserRepo::class. ':edit');
    $app->get('/new', GithubUserRepo::class . ':new');
    $app->get('/show/{owner}/{name}', GithubUserRepo::class . ':show');
    $app->post('/create', GithubUserRepo::class. ':create');
    $app->post('/save', GithubUserRepo::class. ':save');
};