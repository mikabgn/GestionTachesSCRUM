<?php
use App\UserStory\CreateAccount;
use Doctrine\ORM\EntityManager;

require_once __DIR__.'/../vendor/autoload.php';
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

$user = new CreateAccount($entityManager);
//Pseudo marche pas
try {
    $user->execute('A', 'unMailCOOl@gmail.com', 'UnMotDePasseCOOL');
    echo ' 💌';
} catch(Exception $e) {
    echo $e->getMessage();
}
echo PHP_EOL;
//Mail marche pas
try {
    $user->execute('unPseudoCOOL', 'unMailCOOl.com', 'UnMotDePasseCOOL');
    echo ' 💌';
} catch(Exception $e) {
    echo $e->getMessage();
}
echo PHP_EOL;
//MDP marche pas
try {
    $user->execute('unPseudoCOOL', 'unMailCOOl@gmail.com', 'mdplong');
    echo ' 💌';
} catch(Exception $e) {
    echo $e->getMessage();
}
echo PHP_EOL;
//Mail déja utilisé faut il encore ne faire un copier-coller de mon code sinon l'erreur marcheras la deuxième fois quand il l'auras crée a la première fois
try {
    $user->execute('unPseudoCOOL', 'unMailCOOl@gmail.com', 'UnMotDePasseCOOL');
    echo ' 💌';
} catch(Exception $e) {
    echo $e->getMessage();
}
echo PHP_EOL;
//Sa Marche 👍, mais faut le changer à chaque fois ou alors aller suppr le nouveau compte crée dans la BDD
try {
    $user->execute('unPseudoCOOL', 'UnMailQuiMarcheMaisPasAPiedsJusteIlEstValide2@gmail.com', 'UnMotDePasseCOOL');
    echo ' 💌';
} catch(Exception $e) {
    echo $e->getMessage();
}


