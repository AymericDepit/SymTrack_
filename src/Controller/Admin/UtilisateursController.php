<?php

namespace App\Controller\Admin;

use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/utilisateurs', name: 'admin_utilisateurs_')]
class UtilisateursController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UtilisateursRepository $utilisateursRepository): Response
    {
        $users = $utilisateursRepository->findBy([], ['prenom' => 'asc']);

        return $this->render('admin/utilisateurs/index.html.twig', compact('users'));
    }
}