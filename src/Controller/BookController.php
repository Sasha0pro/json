<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class BookController extends AbstractController
{

    /**
     * @throws ExceptionInterface
     */
    #[Route('/books', name: 'user_book', methods: ['GET'])]
    public function Books(BookRepository $bookRepository, Request $request): Response
    {
        /** @var  $user User*/

        $user = $this->getUser();
        $page = $request->get('page', 1);
        $books = $bookRepository->getByUser($page, $user)->getResult();

        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $normalizedData = $serializer->serialize($books, 'json', [AbstractNormalizer::ATTRIBUTES => ['title','users' => ['username']]]);

        return $this->json([
            'data' => $normalizedData
        ]);

    }
    #[Route('/create', name: 'create_book', methods:['POST','GET'] )]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        /** @var  $user User */

        $user = $this->getUser();
        $book = new Book();
        $form = $this->createForm(BookType::class,$book)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($book->addUser($user));
            $manager->flush();

            $this->addFlash('success','Create book');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/book/{book_id}/content', name: 'content_book', methods: ['GET'])]
    public function content(#[MapEntity(expr: 'repository.find(book_id)')] Book $book): Response
    {
        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $normalizedData = $serializer->serialize($book, 'json', [AbstractNormalizer::ATTRIBUTES => ['title','users' => ['username']]]);

        return $this->json([
            'data' => $normalizedData
        ]);
    }

    #[Route('/book/{book_id}/update', name: 'update_book', methods: ['POST','GET'])]
    #[IsGranted('EDIT','book')]
    public function update(#[MapEntity(expr: 'repository.find(book_id)')] Book $book,Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(BookType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($book);
            $manager->flush();

            return $this->json([],201);
        }

        return $this->json([]);
    }

    #[Route('/book/{book_id}/delete', name: 'delete_book', methods: ['GET'])] // DELETE почему-то не работает
    #[IsGranted('DELETE','book')]
    public function delete(#[MapEntity(mapping: ['id' => 'book_id'])] Book $book, EntityManagerInterface $manager ): Response
    {
        $manager->remove($book);
        $manager->flush();

        return $this->json([]);
    }

    #[Route('/book/repository', name: 'repository', methods: ['GET'])]
    public function repository(ManagerRegistry $managerRegistry, Request $request): Response
    {
        $page = $request->get('page', 1);
        $books = $managerRegistry->getRepository(Book::class)->findBookTwoAuthorAndN($page)->getResult();

        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $normalizedData = $serializer->serialize($books, 'json', [AbstractNormalizer::ATTRIBUTES => ['title','users' => ['username']]]);

        return $this->json([
            'data' => $normalizedData
        ]);
    }

    #[Route('/authors', name: 'authors')]
    public function authors(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $normalizedData = $serializer->serialize($users, 'json', [AbstractNormalizer::ATTRIBUTES => ['id','username']]);

        return $this->json([
            'data' => $normalizedData,
        ]);
    }
}