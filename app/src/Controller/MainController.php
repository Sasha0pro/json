<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;


class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main',methods: ['GET'])]
    public function main(BookRepository $bookRepository, SerializerInterface $serializer, Request $request): Response
    {
        $title = $request->query->get('title');
        $author = $request->query->get('author');

        if ($title != null || $author != null) {
            $books = $bookRepository->findBookForAuthorOrTitle($title,$author);
        }

        else {
            $books = $bookRepository->findAll();
        }

        $normalizedData = $serializer->normalize($books, 'json', [AbstractNormalizer::ATTRIBUTES => ['id','title','content','users' => ['username']]]);

        return $this->json([
            'data' => $normalizedData
        ]);
    }
}
