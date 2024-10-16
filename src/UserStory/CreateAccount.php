<?php

namespace App\UserStory;

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
    public function execute(string $pseudo ,string $email, string $password){

            // verif donnée présente
            // Si tel n'est pas le cas, lancer une exeption

            // verifier email valide
            // Si tel n'est pas le cas, lancer une exeption

            // verifier pseudo entre 2-50 var
            // Si tel n'est pas le cas, lancer une exeption

            // verifier mdp sécu
            // Si tel n'est pas le cas, lancer une exeption

            // verifier email UNIQUE
            // Si tel n'est pas le cas, lancer une exeption

            //Insert into bdd les données
            // 1. haché le mdp
            // 2. créer une instance de la classe user avec mail pseudo et mdp haché
            $user = new User(); //setters
            // 3. persiste() en utilisant l'entityManager
        $this->entityManager->persist($user);
            // 4. flush
        $this->entityManager->flush();
            // 5. envoie mail de confirmation
        echo "Un mail a été envoyer à l'utilisateur";

    return $user;

    }
    //create account mdp que la longueur au moins 8
    //login


}