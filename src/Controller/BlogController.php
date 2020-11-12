<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repository->findLastTen();

        return $this->render('blog/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/post/{id}", name="post")
     * @param $id
     * @return Response
     */
    public function post($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repository->findOneBy(['url_alias' => $id]);

        return $this->render('blog/post.html.twig', [
            'titre' => $articles->getTitre(),
            'content' => $articles->getContent(),
            'published' => $articles->getPublished()->format('Y-m-d H:i:s')
        ]);
    }
}
