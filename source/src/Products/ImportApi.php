<?php
declare(strict_types=1);

namespace App\Products;

use App\Kernel;
use JsonException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ImportApi
{
    public function __construct(
        protected HttpClientInterface $client,
        protected Kernel $kernel
    )
    {
    }

    public function fetchApiInformation(): array
    {
        $response = $this -> client -> request(
            'GET',
            'https://fakestoreapi.com/products'
        );

        $statusCode = $response -> getStatusCode();
        // $statusCode = 200
        $contentType = $response -> getHeaders()[ 'content-type' ][ 0 ];
        // $contentType = 'application/json'
        $content = $response -> getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        return $content;
    }

    /**
     * @throws JsonException
     */
    public function createJson($content)
    {
        $projectDir = $this->kernel->getProjectDir();
        $apiResult = json_encode($content, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        file_put_contents($projectDir . '/resources/products.inc.json', $apiResult);
//        $this->fetchJson();
    }

//    public function fetchJson()
//    {
//        $projectDir = $this->kernel->getProjectDir();
//        $contentResult = file_get_contents($projectDir . '/resources/products.inc.json');
//        $productInfo = json_decode($contentResult, true, 512,);
//        return $productInfo;
//    }
}