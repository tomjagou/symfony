<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, HttpFoundationRequest $request)
    {
        $articles = $articleRepository->findAll();
        
        return $this->render('article/index.html.twig', [
            'articles'   => $articles
        ]);
    }
    
    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show($id,ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        if (!$article)
        {
            throw $this->createNotFoundException('The article does not exist');
        }
        
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
