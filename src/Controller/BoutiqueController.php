<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Produits;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boutique', name: 'boutique_')]
class BoutiqueController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('boutique/index.html.twig', [
            'categories' => $categoriesRepository->findBy([], ['categorieCommande' => 'asc'])
        ]);
    }

    #[Route('/{slug}', name: 'categories')]
    public function categories(Categories $categories): Response
    {
        //On va chercher la liste des produits de la catégorie
        $produits = $categories->getProduits();

        return $this->render('boutique/categories.html.twig', compact('categories', 'produits'));
    }

    #[Route('/{slug}', name: 'produits')]
    public function produits(Produits $produits): Response
    {
        return $this->render('boutique/produits.html.twig', compact('produits'));
    }
}
