<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(Request $request): Response
    {
        return $this->render('about/index.html.twig', [
            'title' => 'A propos',
            'myRoute' => $request->attributes->get('_route'),
            "page" => "A propos de moi",
            "subtitle" => "Qui suis-je?",
            "justify_center" => "justify-content-center"
        ]);
    }
}
