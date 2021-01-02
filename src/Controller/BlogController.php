<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 *
 * @Route("/blog")
 */

class BlogController extends AbstractController
{
    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods="GET", name="blog_index")
     * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods="GET", name="blog_rss")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods="GET", name="blog_index_paginated")
     */
    public function index(int $page, string $_format, ArticleRepository $repo): Response
    {
        //$repository = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findLastTen($page);

        return $this->render('blog/index.'.$_format.'.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/post/{id}", name="blog_post")
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
