<?php

namespace App\Security\Voter;

use App\Entity\Produits;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ProduitsVoter extends Voter
{
    const EDIT = 'PRODUCT_EDIT';
    const DELETE = 'PRODUCT_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $produit): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])){
            return false;
        }
        if (!$produit instanceof Produits){
            return false;
        }
        return true;
    }

    protected function voteOnAttribute(string $attribute, $produit,
                                       TokenInterface $token): bool
    {
        // On recupere l'utilisateur a partir du token
        $user = $token->getUser();

        if (!$user instanceof UserInterface) return false;

        // On verifie si il est admin
        if ($this->security->isGranted('ROLE_ADMIN')) return true;

        // On verifie les permissions
        switch ($attribute){
            case self::EDIT:
                return $this->canEdit();
                break;
            case self::DELETE:
                return $this->canDelete();
                break;
        }
    }

    private function canEdit(){
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }

    private function canDelete(){
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }
}