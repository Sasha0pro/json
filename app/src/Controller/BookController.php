<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
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
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\ArrayCollection;

class BookController extends AbstractController
{
    public function __construct(private readonly SerializerInterface $serializer){}

    /**
     * @throws ExceptionInterface
     */
    #[Route('/books', name: 'user_book', methods: ['GET'])]
    public function Books(BookRepository $bookRepository, Request $request, UserRepository $userRepository): Response
    {
        /** @var  $user User*/
        $user = $this->getUser();

        $page = $request->get('page', 1);
        $numPages = $bookRepository->getByUser($page, $user)->getNumPages();
        $books = $bookRepository->getByUser($page, $user)->getResult();
        $normalizedData = $this->serializer->normalize($books, 'json', [AbstractNormalizer::ATTRIBUTES => ['title','id','users' => ['username']]]);
        return $this->json([
            'data' => $normalizedData,
            'numPages' => $numPages
        ]);

    }
    #[Route('/create', name: 'create_book', methods:['POST','GET'] )]
    public function create(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $book = new Book();

        $title = $request->request->get('title');
        $content = $request->request->get('content');
        $usersId = $request->request->get('id');

        if ($title !== null && $content !== null && $usersId !== null){
            $ids = json_decode($usersId);

            $users = $userRepository->findByIDs($ids);
            $arrayCollectionUsers = new ArrayCollection($users);

            $book->setContent($content);
            $book->setTitle($title);
            $book->addUser($arrayCollectionUsers);

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->json([],Response::HTTP_CREATED);
        }

        return $this->json([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/book/{book_id}/content', name: 'content_book', methods: ['GET'])]
    public function content(#[MapEntity(expr: 'repository.find(book_id)')] Book $book): Response
    {
        $normalizedData = $this->serializer->normalize($book, 'json', [AbstractNormalizer::ATTRIBUTES => ['title','content','users' => ['username']]]);

        return $this->json([
            'data' => $normalizedData
        ]);
    }

    #[Route('/book/{book_id}/update', name: 'update_book', methods: ['POST','GET'])]
    public function update(#[MapEntity(expr: 'repository.find(book_id)')] Book $book,Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $title = $request->request->get('title');
        $content = $request->request->get('content');
        $usersId = $request->request->get('id');

        if ($title !== null && $content !== null && $usersId !== null){
           $ids = json_decode($usersId);

            $users = $userRepository->findByIDs($ids);
            $arrayCollectionUsers = new ArrayCollection($users);

            $book->setContent($content);
            $book->setTitle($title);
            $book->addUser($arrayCollectionUsers);

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->json([],Response::HTTP_CREATED);
        }

        return $this->json([]);
    }

    #[Route('/book/{book_id}/delete', name: 'delete_book', methods: ['DELETE', 'GET'])]
    #[IsGranted('DELETE','book')]
    public function delete(#[MapEntity(expr: 'repository.find(book_id)')] Book $book, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->json([]);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/book/repository', name: 'repository', methods: ['GET'])]
    public function repository(ManagerRegistry $managerRegistry, Request $request): Response
    {
        $page = $request->get('page', 1);
        $books = $managerRegistry->getRepository(Book::class)->findBookTwoAuthorAndN($page)->getResult();

        $normalizedData = $this->serializer->normalize($books, 'json', [AbstractNormalizer::ATTRIBUTES => ['title','users' => ['username']]]);

        return $this->json([
            'data' => $normalizedData
        ]);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/authors', name: 'authors')]
    public function authors(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $normalizedData = $this->serializer->normalize($users, 'json', [AbstractNormalizer::ATTRIBUTES => ['id','username']]);

        return $this->json([
            'data' => $normalizedData,
        ]);
    }
}
