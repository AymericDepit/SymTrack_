<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\DetailsCommandes;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandesController extends AbstractController
{
    #[Route('/commandes', name: 'commandes_')]
    public function add(SessionInterface $session, ProduitsRepository
    $produitsRepository, EntityManagerInterface $entityManager):
    Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);

        if ($panier === []){
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_main');
        }

        //Le panier n'est pas vide on creer la commande
        $commande = new Commandes();

        // On remplit la commande
        $commande->setUtilisateurs($this->getUser());
        $commande->setReference(uniqid());

        // On parcourt la panier pour creer les details de la commande
        foreach ($panier as $item => $quantite){
            $detailsCommande = new DetailsCommandes();

            // On va chercher le produit
            $produits = $produitsRepository->find($item);

            $prix = $produits->getPrix();

            // On creer le detail de commande
            $detailsCommande->setProduits($produits);
            $detailsCommande->setPrix($prix);
            $detailsCommande->setQuantite($quantite);

            $commande->addDetailsCommande($detailsCommande);
        }

        // On persist et on flush
        $entityManager->persist($commande);
        $entityManager->flush();

        $session->remove('panier');

        $this->addFlash('message', 'Commande créée avec succès');
        $this->redirectToRoute('app_main');


        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }
}
