<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailController extends AbstractController
{
    #[Route('/detail', name: 'app_detail')]
    public function index(Request $request): Response
    {
        return $this->render('detail/index.html.twig', [
            'title' => 'Detail',
            'myRoute' => $request->attributes->get('_route'),
            "page" => "En détail",
            "subtitle" => "Titre de l'article"
        ]);
    }
}
