<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'article_index', methods: ['GET'])]
    public function index(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {

        // $allArticles = $articleRepository->findAll();
        $allArticles = $articleRepository->findBy([], ['createdAt' => 'DESC']);
        $all = count($allArticles) . ' Articles';
        $per_page = 4;
        $totalPages = ceil(count($allArticles) / $per_page);
        $nPage = !empty($request->query->get("page")) ? $request->query->get("page") : 1;

        $articles = $paginator->paginate(
            $allArticles, // on passe les données
            $request->query->getInt('page', 1), //récupération page en cours,sinon 1 par défaut
            $per_page //nombre d'articles par page
        );


        return $this->render('article/index.html.twig', [
            'title' => 'Articles',
            'myRoute' => $request->attributes->get('_route'),
            'page' => 'Articles',
            'subtitle' => $all . ' Articles',
            'articles' => $articles,
            'nPage' => $nPage,
            'totalPages' => $totalPages

        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    #[Route('/new', name: 'article_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('green', 'Article créé avec succès !');

            return $this->redirectToRoute('article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
            'title' => 'Créer un article',
            'myRoute' => $request->attributes->get('_route'),
            "page" => "Créer",
            "subtitle" => "Ajouter un nouvel article",
        ]);
    }

    #[Route('/{id}', name: 'article_show', methods: ['GET'])]
    public function show(Article $article, Request $request): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'title' => 'Détail de l\'article',
            'myRoute' => $request->attributes->get('_route'),
            "page" => "Détail",
            "subtitle" => $article->getTitle(),
        ]);
    }

    #[Route('/{id}/edit', name: 'article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('green', 'Article mis à jour avec succès !');

            return $this->redirectToRoute('article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
            'title' => 'Editer un article',
            'myRoute' => $request->attributes->get('_route'),
            "page" => "Editer",
            "subtitle" => "Mettre à jour article",
        ]);
    }

    #[Route('/{id}', name: 'article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article): Response
    {

        $title = $article->getTitle();

        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        $this->addFlash('green', $title . ' supprimé avec succès !');

        return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
    }
}
