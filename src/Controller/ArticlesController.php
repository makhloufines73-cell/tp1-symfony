<?php
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

// ... dans la classe ArticlesController

#[Route('/articles/nouveau', name: 'app_article_nouveau')]
function nouveau(EntityManagerInterface $em): Response
{
    $article = new Article();
    $article->setTitre('Mon premier article');
    $article->setContenu('Ceci est le contenu de mon premier article créé avec Doctrine.');
    $article->setAuteur('Étudiant');
    $article->setDateCreation(new \DateTime());
    $article->setPublie(true);

    $em->persist($article);
    $em->flush();

    return new Response("Article créé avec l'id : " . $article->getId());
}
use App\Repository\ArticleRepository;


#[Route('/articles', name: 'app_articles')]
function index(ArticleRepository $articleRepository): Response
{
    $articles = $articleRepository->findAll();

    return $this->render('articles/index.html.twig', [
        'articles' => $articles,
    ]);
}
#[Route('/articles/{id}', name: 'app_article_detail', requirements: ['id' => '\d+'])]
function detail(Article $article): Response
{
    return $this->render('articles/detail.html.twig', [
        'article' => $article,
    ]);
}