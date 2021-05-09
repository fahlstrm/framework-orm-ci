<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class BookController extends AbstractController
{

    public function __invoke(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        // $bookRepository = $entityManager->getRepository(Book::class);
        $bookRepository = $this->getDoctrine()->getRepository(Book::class);

        $books = $bookRepository->findAll();

        return $this->render('book.twig', [
            'title' => 'Tillgängliga böcker',
            'nav' => Functions::$nav,
            'message' => $message ?? "Nedan böcker finns tillgängliga",
            'books' => $books
        ]);
    }

    
    public function createBook(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $book = new Book();
        $book->setTitle($request->request->get("title"));
        $book->setIsbn($request->request->get("isbn"));
        $book->setAuthor($request->request->get("author"));
        $book->setImage($request->request->get("image") ?? null);

        $entityManager->persist($book);
        $entityManager->flush();

        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        $books = $bookRepository->findAll();

        return $this->redirectToRoute('book');
    }

    public function removeBook(Request $request, $id): Response
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book');
    }

}