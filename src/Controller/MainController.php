<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main',methods: ['GET'])]
    public function main(BookRepository $bookRepository, Request $request): Response
    {
        $title = $request->query->get('title');
        $author = $request->query->get('author');

        if ($title != null || $author != null) {
            $books = $bookRepository->findBookForAuthorOrTitle($title,$author);
        }

        else {
            $books = $bookRepository->findAll();
        }

        return $this->render('main/index.html.twig', [
            'books' => $books,
        ]);
    }
}
