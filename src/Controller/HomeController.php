<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'last6articles' => $articleRepository->findBy([], ['createdAt' => 'DESC'], 6),
            'title' => 'Accueil',
            'myRoute' => $request->attributes->get('_route'),
            "page" => "Accueil",
            "subtitle" => "Bienvenue sur notre site"
        ]);
    }
}
