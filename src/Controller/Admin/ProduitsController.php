<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Entity\Produits;
use App\Form\ProduitsFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/admin/produits', name: 'admin_produits_')]
class ProduitsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/produits/index.html.twig');
    }

    /**
     * @throws \Exception
     */
    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface
    $entityManager, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On creer un nouveau produit
        $produit = new Produits();

        // On creer le formulaire
        $produitForm = $this->createForm(ProduitsFormType::class, $produit);

        // On traite la requete du formulaire
        $produitForm->handleRequest($request);

        // On verifie si le formulaire est soumis et valide
        if ($produitForm->isSubmitted() && $produitForm->isValid()){
            // On recupere les images
            $image = $produitForm->get('images')->getData();

            foreach ($image as $image){
                // On defini le dossier de destination
                $folder = 'products';

                // On appel le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setNom($fichier);
                $produit->addImage($img);
            }

            // On genere le slug
            $slug = $slugger->slug($produit->getNom());
            $produit->setSlug($slug);

            // On arrondi le prix
            $prix = $produit->getPrix() * 100;
            $produit->setPrix($prix);

            // On stock en BDD
            $entityManager->persist($produit);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès');

            // On redirige
            return $this->redirectToRoute('admin_produits_index');
        }

        return $this->render('admin/produits/add.html.twig', [
            'produitForm' => $produitForm->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Produits $produits, Request $request, EntityManagerInterface
                                                     $entityManager,
                         SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $produits);

        // On divise le prix par 100
        $prix = $produits->getPrix() / 100;
        $produits->setPrix($prix);

        // On creer le formulaire
        $produitForm = $this->createForm(ProduitsFormType::class, $produits);

        // On traite la requete du formulaire
        $produitForm->handleRequest($request);

        // On verifie si le formulaire est soumis et valide
        if ($produitForm->isSubmitted() && $produitForm->isValid()){

            // On recupere les images
            $image = $produitForm->get('images')->getData();

            foreach ($image as $image){
                // On defini le dossier de destination
                $folder = 'products';

                // On appel le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setNom($fichier);
                $produits->addImage($img);
            }

            // On genere le slug
            $slug = $slugger->slug($produits->getNom());
            $produits->setSlug($slug);

            // On arrondi le prix
            $prix = $produits->getPrix() * 100;
            $produits->setPrix($prix);

            // On stock en BDD
            $entityManager->persist($produits);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès');

            // On redirige
            return $this->redirectToRoute('admin_produits_index');
        }

        return $this->render('admin/produits/edit.html.twig', [
            'produitForm' => $produitForm->createView(),
            'produit' => $produits
        ]);
        return $this->render('admin/produits/index.html.twig');
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Produits $produits): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $produits);
        return $this->render('admin/produits/index.html.twig');
    }

    #[Route('/suppression/image/{id}', name: 'delete_image', methods: ['DELETE'])]
    public function deleteImage(Images $image, Request $request,
                                EntityManagerInterface $entityManager,
                                PictureService $pictureService):
    JsonResponse
    {
        //On recupere le contenu de la requete
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])){
            // Le token est valide
            // On récupere le nom de l'image
            $nom = $image->getNom();

            if ($pictureService->delete($nom, 'products', 300, 300)){
                $entityManager->remove($image);
                $entityManager->flush();

                return new JsonResponse(['success' => true], 200);
            }
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}