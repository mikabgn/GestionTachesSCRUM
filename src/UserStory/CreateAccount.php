<?php

namespace App\UserStory;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class CreateAccount
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        //l'entitymanager est injecter par dependance
        $this->entityManager = $entityManager;
    }
    //execute la userstory
    public function execute(string $pseudo, string $email, string $password)
    {
        // Verif donnée présente
        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new \Exception("Les données fournies sont incomplètes.");
        }

        // Verifier email valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("L'email fourni n'est pas valide.");
        }

        // Verifier pseudo entre 2-50 var
        if (strlen($pseudo) < 2 || strlen($pseudo) > 50) {
            throw new \Exception("Le pseudo doit être compris entre 2 et 50 caractères.");
        }

        // Verifier mdp sécu
        if (strlen($password) < 8 ) {
            throw new \Exception("Le mot de passe doit contenir au moins 8 caractères.");
        }

        // Verifier email UNIQUE
        $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existingUser) {
            throw new \Exception("L'email fourni est déjà utilisé.");
        }

        // Insert into bdd les données
        // 1. haché le mdp
        $password = password_hash($password, PASSWORD_BCRYPT);

        // 2. créer une instance de la classe user avec mail pseudo et mdp haché
        $user = new User();
        $user->setPseudo($pseudo);
        $user->setEmail($email);
        $user->setPassword($password);

        // 3. persiste() en utilisant l'entityManager
        $this->entityManager->persist($user);

        // 4. flush
        $this->entityManager->flush();

        // 5. envoie mail de confirmation
        echo "Un mail a été envoyé à l'utilisateur";

        return $user;
    }
}