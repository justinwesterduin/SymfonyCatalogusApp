<?php

namespace App\Products;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Unsplash\Collection;
use Unsplash\HttpClient;
use Unsplash\Photo;
use Unsplash\Search;
use Unsplash\User;

class CallToUnsplashApi
{
    /**
     * @throws TransportExceptionInterface
     */
    public function callUnsplashApi()
    {
        $client = \Symfony\Component\HttpClient\HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.unsplash.com/photos?client_id=FkBPbPwV4yEowJZxsRPBN0klgBi9omTVvAyCld4w6Qw&query=office&per_page=20',
        );

        $content = $response->toArray();
        $test = [];

        foreach ($content as $key) {
            $test[] = $key['urls']['thumb'];
        }

        HttpClient::init([
            'applicationId' => 'FkBPbPwV4yEowJZxsRPBN0klgBi9omTVvAyCld4w6Qw',
            'secret' => 'eNbpEb9AGlNgKNPDgD8lzWcr5vsXi42NU3p5V1x60sY',
            'callbackUrl' => 'localhost:8868',
            'utmSource' => 'w4_project',
        ]);

        return $test;

        //        echo HttpClient::$connection->();exit;

        //        $data = json_decode($response->getBody(), true);
        //
        //        echo '<pre>';
        //        print_r($data);
        //        echo '</pre>'; die;
    }

    public function test()
    {
        // Fetch a collection of 20 product photos
        // Make a loop-able array from the selection
        // return the collection
        // Loop in ListProducts through the collection and add one photo per api array item

        $search = 'products';
        $page = 1;
        $per_page = 20;
        $orientation = 'landscape';

        $response = Search::photos($search, $page, $per_page, $orientation);

        $photos = Photo::all($page, $per_page);

        $test = User::find('justinwesterduin');

        $collection = Collection::all($page, $per_page);

        $filters = [
            'query' => 'product',
        ];

        $rand = [];

        for ($i = 0; $i < 2; ++$i) {
            $rand[] = Photo::random($filters)->toArray();
        }

# Donderdag verder afmaken => rate limit
        foreach ($rand as $k) {
            echo '<pre>';
            print_r($k);
            echo '</pre>';
        }
        exit;
    }
}
