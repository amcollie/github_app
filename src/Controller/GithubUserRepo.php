<?php declare(strict_types=1);

namespace App\Controller;

use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Dotenv::createImmutable(__DIR__ . '/../..')->safeLoad();

class GithubUserRepo
{
    public function __construct(private ContainerInterface $container)
    {

    }

    public function edit(ResponseInterface $response, string $owner, string $name):  ResponseInterface 
    {
        $smarty = $this->container->get('smarty');

        $repository = $this->readData("https://api.github.com/repos/$owner/$name");
        $smarty->assign('repository', $repository);

        $response->getBody()->write($smarty->fetch('edit.tpl'));
        return $response;
    }

    public function save(ResponseInterface $response): ResponseInterface
    {
        $full_name = $_POST['full_name'];
        $data = $this->updateData("https://api.github.com/repos/$full_name");
        $smarty = $this->container->get('smarty');
        $smarty->assign('repository', $data);

        $response->getBody()->write($smarty->fetch('save.tpl'));
        return $response;
    }

    public function delete(ResponseInterface $response, string $owner, string $name): ResponseInterface
    {
        $this->deleteData("https://api.github.com/repos/$owner/$name");
        $smarty = $this->container->get('smarty');

        $response->getBody()->write($smarty->fetch('delete.tpl'));
        return $response;
    }

    public function index(ResponseInterface $response): ResponseInterface
    {
        $smarty = $this->container->get('smarty');

        $repositories = $this->readData('https://api.github.com/user/repos');
        $smarty->assign('repositories', $repositories);
    
        $response->getBody()->write($smarty->fetch('index.tpl'));
        return $response;
    }

    public function show(ResponseInterface $response, string $owner, string $name): ResponseInterface
    {
        $smarty = $this->container->get('smarty');
        
        $repository = $this->readData("https://api.github.com/repos/$owner/$name");
        $smarty->assign('repository', $repository);
        
        $response->getBody()->write($smarty->fetch('show.tpl'));
        return $response;
    }

    public function new(ResponseInterface $response): ResponseInterface
    {
        $smarty = $this->container->get('smarty');
        $response->getBody()->write($smarty->fetch('new.tpl'));
        return $response;
    }

    public function create(ResponseInterface $response): ResponseInterface
    {
        $data = $this->writeData('https://api.github.com/user/repos');
        var_dump($data);
        $smarty = $this->container->get('smarty');
        $smarty->assign('repository', $data);
        $response->getBody()->write($smarty->fetch('create.tpl'));
        return $response;
    }

    private function readData(string $uri): array
    {
        $headers = [
            "User-Agent: Example REST API Client",
            "Authorization: token {$_ENV['GITHUB_TOKEN']}"
        ];

        $ch = curl_init();
        curl_setopt_array( 
            $ch, 
            [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => $uri,
            ]
        );

        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $data;
    }

    private function writeData(string $uri): array
    {
        $headers = [
            "User-Agent: Example REST API Client",
            "Authorization: token {$_ENV['GITHUB_TOKEN']}"
        ];

        $ch = curl_init();
        curl_setopt_array( 
            $ch, 
            [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($_POST),
                CURLOPT_URL => $uri,
            ]
        );

        $data = json_decode(curl_exec($ch), true);
        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        if ($statusCode === 422) {
            return [
                "message" => "Invalid data",
                "errors" => $data['errors']
            ];

        }
        return $data;
    }

    private function updateData(string $uri): array
    {
        $headers = [
            "User-Agent: Example REST API Client",
            "Authorization: token {$_ENV['GITHUB_TOKEN']}"
        ];

        $ch = curl_init();
        curl_setopt_array( 
            $ch, 
            [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'PATCH',
                CURLOPT_POSTFIELDS => json_encode($_POST),
                CURLOPT_URL => $uri,
            ]
        );

        $data = json_decode(curl_exec($ch), true);
        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        if ($statusCode === 422) {
            return [
                "message" => "Invalid data",
                "errors" => $data['errors']
            ];

        }
        return $data;
    }
    private function deleteData(string $uri): void
    {
        $headers = [
            "User-Agent: Example REST API Client",
            "Authorization: token {$_ENV['GITHUB_TOKEN']}"
        ];

        $ch = curl_init();
        curl_setopt_array( 
            $ch, 
            [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_URL => $uri,
            ]
        );

        curl_exec($ch);
        curl_close($ch);
    }
}