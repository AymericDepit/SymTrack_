<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $panier = $session->get('panier', []);

        // On initialise des variables
        $data = [];
        $total = 0;

        foreach ($panier as $id => $quantite){
            $produits = $produitsRepository->find($id);

            $data[] = [
                'produits' => $produits,
                'quantite' => $quantite
            ];
            $total += $produits->getPrix() * $quantite;
        }

        return $this->render('panier/index.html.twig', compact('data', 'total'));
    }

    #[Route('/add/{id}', name: 'add')]
   public function add(Produits $produits, SessionInterface $session)
    {
        // On recupere l'ID du produit
        $id = $produits->getId();

        // On recupere le panier existant
        $panier = $session->get('panier', []);

        // On ajoute le produit dans le panier
        if (empty($panier[$id])){
            $panier[$id] = 1;
        }else{
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        // On redirige vers la page du panier
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produits $produits, SessionInterface $session)
    {
        // On recupere l'ID du produit
        $id = $produits->getId();

        // On recupere le panier existant
        $panier = $session->get('panier', []);

        // On ajoute le produit dans le panier
        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        // On redirige vers la page du panier
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produits $produits, SessionInterface $session)
    {
        // On recupere l'ID du produit
        $id = $produits->getId();

        // On recupere le panier existant
        $panier = $session->get('panier', []);

        // On ajoute le produit dans le panier
        if (!empty($panier[$id])) {
                unset($panier[$id]);
            }

        $session->set('panier', $panier);

        // On redirige vers la page du panier
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/vider', name: 'vider')]
    public function vider(SessionInterface $session)
    {
       $session->remove('panier');

       return $this->redirectToRoute('panier_index');
    }
}