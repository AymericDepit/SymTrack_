<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Produits;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function categories(Categories $categories, ProduitsRepository
    $produitsRepository, Request $request): Response
    {
        // On va chercher le numero de page dans l'url
        $page = $request->query->getInt('page', 1);


        //On va chercher la liste des produits de la catégorie
        $produits = $produitsRepository->findProduitsPaginated($page,
            $categories->getSlug(), 6);

        return $this->render('boutique/categories.html.twig', compact('categories', 'produits'));
    }
}
