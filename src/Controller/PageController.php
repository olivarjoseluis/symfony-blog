<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(PostRepository $posts): Response
    {
        return $this->render('page/home.html.twig', [
            'controller_name' => 'Home',
            'posts' => $posts->findLatest(),
        ]);
    }

    #[Route('/blog/{slug}', name: 'app_post')]
    public function post(Post $post): Response
    {
        //dd($post);
        return $this->render('page/post.html.twig', ['post' => $post]);
    }
}
