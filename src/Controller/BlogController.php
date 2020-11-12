<?php

namespace App\Controller;

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
        return $this->render('blog/index.html.twig', [
            'message' => 'Page d\'accueil'
        ]);
    }

    /**
     * @Route("/post/{id}", name="post")
     * @param $id
     * @return Response
     */
    public function post($id): Response
    {
        return $this->render('blog/post.html.twig', [
            'id' => $id
        ]);
    }
}
