<?php

declare(strict_types=1);

namespace App\Controller;

use App\Products\CallToUnsplashApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $apiCall = new CallToUnsplashApi();
        $apiCall->callUnsplashApi();
        $apiCall->test();
//        echo '<pre>';
//        print_r($test);
//        echo '</pre>';


        return $this->render('homepage.html.twig');
    }
}
