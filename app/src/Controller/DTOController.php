<?php

namespace App\Controller;

use App\DTO\TestRequestBodyDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class DTOController extends AbstractController
{
    #[Route('/dto', name: 'app_d_t_o')]
    public function index(TestRequestBodyDTO $requestBodyDTO): Response
    {
        return $this->render('dto/index.html.twig', [
            'controller_name' => 'DTOController',
        ]);
    }
}
