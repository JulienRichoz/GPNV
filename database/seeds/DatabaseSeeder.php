<?php

/*
  Last update : 2017.01.19
  Last Update by : Thomas Marcoup
*/

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addDefaultTypes();

        $this->addDefaultClasses();
        $this->addDefaultStates();
        $this->addDefaultRoles();
        $this->addDefaultUsers();

        $this->addProjects();

    }

    public function addDefaultClasses(){
      DB::table('classes')->insert([
        'name' => "DefaultClass",
        'friendlyId' => "1"
      ]);
    }

    public function addDefaultTypes(){
      DB::table('taskTypes')->insert(['name' => "Programmation",]);
      DB::table('taskTypes')->insert(['name' => "Système",]);
      DB::table('taskTypes')->insert(['name' => "Documentation",]);
    }

    public function addDefaultStates()
    {
      DB::table('states')->insert(['name' => "Au CPNV",]);
      DB::table('states')->insert(['name' => "Hors-CPNV",]);
    }

    public function addDefaultRoles()
    {
      DB::table('roles')->insert(['name' => "Eleve",]);
      DB::table('roles')->insert(['name' => "Prof",]);
    }

    public function addDefaultUsers()
    {
      // Student
      DB::table('users')->insert([
          'id' => '1',
          'firstname' => "John",
          'lastname' => "Doe",
          'mail' => "utilisateur@mail.com",
          'friendlyid' => "1",
          'role_id' => "1",
          'class_id' => "1",
          'state_id' => "1",
          'password' => bcrypt('secret'),
          'avatar'=> 'default.png',
      ]);

      // Teachers
      DB::table('users')->insert([
          'id' => '2',
          'firstname' => "Professeur",
          'lastname' => "Tournesol",
          'mail' => "tournesol@mail.com",
          'role_id' => "2",
          'friendlyid' => "2",
          'class_id' => "1",
          'state_id' => "1",
          'password' => bcrypt('secret'),
          'avatar'=> 'default.png',
      ]);

      DB::table('users')->insert([
          'id' => '3',
          'firstname' => "Anno",
          'lastname' => "Nimme",
          'mail' => "anno@nimme.com",
          'friendlyid' => "3",
          'role_id' => "1",
          'class_id' => "1",
          'state_id' => "1",
          'password' => bcrypt('secret'),
          'avatar'=> 'default.png',
      ]);
    }

    public function addProjects()
    {
      // Basic Data
      DB::table('checkList_Tables')->insert(['id' => "1", 'name' => "Project",]);

      $this->Project001();
      //$this->Project002();
    }

    public function Project001()
    {
      // Project N°001
      DB::table('projects')->insert([
          'id' => "1",
          'name' => "Galerie Images",
          'description' => '<p>Dans ce module, nous serons des mandataires ayant reçu un mandat. Nous
              devrons créer un site web qui a pour but d’être une galerie photo. Nous
              utiliserons nos compétences acquises au cours des modules suivants : ICT-133
              pour le PHP, <span style="background-color: rgb(255, 255, 0);">ICT-133</span>
              pour la gestion de projet et ICT-120 pour l’interface graphique du site.
              <br/>
              Le site s’adresserai à des personnes recherchant un site d’hébergement simple
              et facile d’utilisation, les utilisateurs pourront gérer leur photo comme ils le
              veulent, créer des albums, des galeries importer des images sont les
              fonctionnalités de notre site.</p>',
          'startDate' => "2016-04-25 08:05:00",
          'endDate' => "2016-06-27 16:55:00",
      ]);

      // Memberships
      DB::table('memberships')->insert(['user_id' => "2", 'project_id' => "1",]);
      DB::table('memberships')->insert(['user_id' => "1", 'project_id' => "1",]);

      DB::table('checkList_Types')->insert(['id' => "1", 'name' => "Livrables",]);
      DB::table('checkList_Types')->insert(['id' => "2", 'name' => "Objectifs",]);

      // CheckLists (Objectives and Deliveries)
      DB::table('checkLists')->insert([
        'id' => "1", 'recordId' => "1",
        'checkListTable_id' => "1", 'checkListType_id' => "1",
      ]);

      DB::table('checkLists')->insert([
        'id' => "2", 'recordId' => "1",
        'checkListTable_id' => "1", 'checkListType_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "1", 'title' => "Intérêt Général",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "2", 'title' => "Connexion",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "3", 'title' => "Profil",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "4", 'title' => "Inscription",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "5", 'title' => "Galerie",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "6", 'title' => "Accueil",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "7", 'title' => "Mes albums",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "8", 'title' => "Manuel d'installation",
        'done' => "0", 'checkList_id' => "1",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "9", 'title' => "Procédure d'installation",
        'done' => "0", 'checkList_id' => "1",
      ]);

      // Tasks
      DB::table('tasks')->insert([
          'id' => "1",
          'name' => "Documentation",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
          'objective_id' => '1',
      ]);

      DB::table('tasks')->insert([
          'id' => "2",
          'name' => "Design",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
          'objective_id' => '1',
      ]);

      DB::table('tasks')->insert([
          'id' => "3",
          'name' => "Test",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
          'objective_id' => '1',
      ]);

      $this->Project001Scenario();
    }

    public function Project002()
    {
      // Project N°001
      DB::table('projects')->insert([
          'id' => "2",
          'name' => "Système d’annuaire",
          'description' => '<p>Le projet système consiste à prendre un sujet,
            ici le système d’annuaire, afin de l’analyser, de le présenter et
            de lui trouver une utilisation au sein du CPNV.
            <br/>
            Cette documentation sera accompagnée d’une présentation PowerPoint
            ainsi qu’une analyse plus précise de deux systèmes d’annuaire :
            l’Active Directory qui est le payant et le OpenLDAP qui est le gratuit.
          </p>',
          'startDate' => "2016-11-16 08:05:00",
          'endDate' => "2017-01-17 16:55:00",
      ]);

      // Memberships
      DB::table('memberships')->insert(['user_id' => "2", 'project_id' => "2",]);
      DB::table('memberships')->insert(['user_id' => "1", 'project_id' => "2",]);
      DB::table('memberships')->insert(['user_id' => "3", 'project_id' => "2",]);

      DB::table('checkList_Types')->insert(['id' => "3", 'name' => "Livrables",]);
      DB::table('checkList_Types')->insert(['id' => "4", 'name' => "Objectifs",]);

      // CheckLists (Objectives and Deliveries)
      DB::table('checkLists')->insert([
        'id' => "3", 'recordId' => "2",
        'checkListTable_id' => "1", 'checkListType_id' => "1",
      ]);

      DB::table('checkLists')->insert([
        'id' => "4", 'recordId' => "2",
        'checkListTable_id' => "1", 'checkListType_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "7", 'title' => "Intérêt Général",
        'done' => "0", 'checkList_id' => "4",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "8", 'title' => "Faire une documentation",
        'done' => "0", 'checkList_id' => "4",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "9", 'title' => "Documentation",
        'done' => "0", 'checkList_id' => "4",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "10", 'title' => "Manuel d'installation",
        'done' => "0", 'checkList_id' => "3",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "11", 'title' => "Création d'une procédure d'installation",
        'done' => "0", 'checkList_id' => "4",
      ]);

      // Tasks
      DB::table('tasks')->insert([
          'id' => "5",
          'name' => "Documentation",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
          'objective_id' => '9',
      ]);

      DB::table('tasks')->insert([
          'id' => "6",
          'name' => "Design",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
          'objective_id' => '7',
      ]);

      DB::table('tasks')->insert([
          'id' => "7",
          'name' => "Test",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
          'objective_id' => '7',
      ]);

      DB::table('tasks')->insert([
          'id' => "8",
          'name' => "Analyse",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
      ]);

      DB::table('tasks')->insert([
          'id' => "9",
          'name' => "Analyse AD",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
          'parent_id' => "8",
      ]);

      DB::table('tasks')->insert([
          'id' => "10",
          'name' => "Analyse OpenLDAP",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
          'parent_id' => "8",
      ]);
    }

    public function Project001Scenario(){
      // Scenarios
      DB::table('scenarios')->insert([ 'id' => 1,'name' => 'Connexion Valide ', 'description' => 'Description du scénario: Connexion Valide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 2, ]);
      DB::table('scenarios')->insert([ 'id' => 2,'name' => 'Nom Utilisateur invalide ', 'description' => 'Description du scénario: Nom Utilisateur invalide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 2, ]);
      DB::table('scenarios')->insert([ 'id' => 3,'name' => 'Mot de passe invalide ', 'description' => 'Description du scénario: Mot de passe invalide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 2, ]);
      DB::table('scenarios')->insert([ 'id' => 4,'name' => 'Mot de passe oublié ', 'description' => 'Description du scénario: Mot de passe oublié ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 2, ]);
      DB::table('scenarios')->insert([ 'id' => 5,'name' => 'Pas de compte ', 'description' => 'Description du scénario: Pas de compte ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 6,'name' => 'Connexion Valide ', 'description' => 'Description du scénario: Connexion Valide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 7,'name' => 'Changer l\'e-mail : valide ', 'description' => 'Description du scénario: Changer l\'e-mail : valide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 8,'name' => 'Changer l\'e-mail : Invalide ', 'description' => 'Description du scénario: Changer l\'e-mail : Invalide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 9,'name' => 'Changer le mot de passe : valide ', 'description' => 'Description du scénario: Changer le mot de passe : valide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 10,'name' => 'Changer le mot de passe : mot de passe invalide ', 'description' => 'Description du scénario: Changer le mot de passe : mot de passe invalide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 11,'name' => 'Changer le mot de passe : Confirmation mot de passe invalide ', 'description' => 'Description du scénario: Changer le mot de passe : Confirmation mot de passe invalide ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 3, ]);
      DB::table('scenarios')->insert([ 'id' => 12,'name' => 'Inscription (tous les champs sont valides) ', 'description' => 'Description du scénario: Inscription (tous les champs sont valides) ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 13,'name' => 'Inscription (le champ utilisateur n\'est pas valide) ', 'description' => 'Description du scénario: Inscription (le champ utilisateur n\'est pas valide) ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 14,'name' => 'Inscription (le champ email n\'est pas valide) ', 'description' => 'Description du scénario: Inscription (le champ email n\'est pas valide) ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 15,'name' => 'Inscription (les champs mots de passe ne sont pas identiques) ', 'description' => 'Description du scénario: Inscription (les champs mots de passe ne sont pas identiques) ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 16,'name' => 'Inscription (le champ mot de passe ne contient pas au minimum un chiffre et une lettre) ', 'description' => 'Description du scénario: Inscription (le champ mot de passe ne contient pas au minimum un chiffre et une lettre) ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 17,'name' => 'Inscription (le champ mot de passe ne contient pas au minimum 6 caractères) ', 'description' => 'Description du scénario: Inscription (le champ mot de passe ne contient pas au minimum 6 caractères) ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 18,'name' => 'Inscription via le lien Pas de compte ? Inscrivez-vous sur la page de connexion ', 'description' => 'Description du scénario: Inscription via le lien Pas de compte ? Inscrivez-vous sur la page de connexion ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 4, ]);
      DB::table('scenarios')->insert([ 'id' => 19,'name' => 'Ajouter une image ', 'description' => 'Description du scénario: Ajouter une image ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 5, ]);
      DB::table('scenarios')->insert([ 'id' => 20,'name' => 'Ajouter une image ', 'description' => 'Description du scénario: Ajouter une image ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 5, ]);
      DB::table('scenarios')->insert([ 'id' => 21,'name' => 'Supprimer une image ', 'description' => 'Description du scénario: Supprimer une image ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 5, ]);
      DB::table('scenarios')->insert([ 'id' => 22,'name' => 'Mettre une image en privé : 1er fois ', 'description' => 'Description du scénario: Mettre une image en privé : 1er fois ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 5, ]);
      DB::table('scenarios')->insert([ 'id' => 23,'name' => 'Mettre une image en privé ', 'description' => 'Description du scénario: Mettre une image en privé ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 5, ]);
      DB::table('scenarios')->insert([ 'id' => 24,'name' => 'Bouton Connexion ', 'description' => 'Description du scénario: Bouton Connexion ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 6, ]);
      DB::table('scenarios')->insert([ 'id' => 25,'name' => 'Bouton Accueil ', 'description' => 'Description du scénario: Bouton Accueil ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 6, ]);
      DB::table('scenarios')->insert([ 'id' => 26,'name' => 'Aperçu ', 'description' => 'Description du scénario: Aperçu ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 6, ]);
      DB::table('scenarios')->insert([ 'id' => 27,'name' => 'Création d\'un album ', 'description' => 'Description du scénario: Création d\'un album ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 7, ]);
      DB::table('scenarios')->insert([ 'id' => 28,'name' => 'Supprimer des images d\'un album ', 'description' => 'Description du scénario: Supprimer des images d\'un album ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 7, ]);
      DB::table('scenarios')->insert([ 'id' => 29,'name' => 'Ajouter des images d\'un album ', 'description' => 'Description du scénario: Ajouter des images d\'un album ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 7, ]);
      DB::table('scenarios')->insert([ 'id' => 30,'name' => 'Mettre un album en privé ', 'description' => 'Description du scénario: Mettre un album en privé ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 7, ]);
      DB::table('scenarios')->insert([ 'id' => 31,'name' => 'Supprimer un album ', 'description' => 'Description du scénario: Supprimer un album ' , 'actif' => 0, 'test_validated'=> 0, 'checkList_item_id' => 7, ]);

      // Mockups
      DB::table('mockups')->insert(['id' =>1 , 'project_id' =>1 , 'url' => '01-Home_disconnected.png']);
      DB::table('mockups')->insert(['id' =>2 , 'project_id' =>1 , 'url' => '02-Home_connected.png']);
      DB::table('mockups')->insert(['id' =>3 , 'project_id' =>1 , 'url' => '03-Connection.png']);
      DB::table('mockups')->insert(['id' =>4 , 'project_id' =>1 , 'url' => '04-Forgotten_password.png']);
      DB::table('mockups')->insert(['id' =>5 , 'project_id' =>1 , 'url' => '05-Profile_view.png']);
      DB::table('mockups')->insert(['id' =>6 , 'project_id' =>1 , 'url' => '06-Profile_edition.png']);
      DB::table('mockups')->insert(['id' =>7 , 'project_id' =>1 , 'url' => '07-Sign_up.png']);
      DB::table('mockups')->insert(['id' =>8 , 'project_id' =>1 , 'url' => '08-Gallery.png']);
      DB::table('mockups')->insert(['id' =>9 , 'project_id' =>1 , 'url' => '09-Pick_a_file.png']);
      DB::table('mockups')->insert(['id' =>10 , 'project_id' =>1 , 'url' => '10-Edit_album.png']);
      DB::table('mockups')->insert(['id' =>11 , 'project_id' =>1 , 'url' => '11-Edit_album_2.png']);

      // Scenarios Steps
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>1 , 'scenario_id'=>1, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>2 , 'scenario_id'=>1, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>1, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Les 2 champs sont corrects._User se connecte à son compte et il est redirigé vers la page d\'accueil. ', 'order'=>4 , 'scenario_id'=>1, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>1 , 'scenario_id'=>2, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean8115 ', 'result' => '', 'order'=>2 , 'scenario_id'=>2, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>2, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Le compte de Jean8115_n\'existe pas. Affiche \' Utilisateur inexistant » et reset les 2 champs. ', 'order'=>4 , 'scenario_id'=>2, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>5 , 'scenario_id'=>2, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>6 , 'scenario_id'=>2, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Les 2 champs sont corrects._User se connecte à son compte et il est redirigé vers la page d\'accueil. ', 'order'=>7 , 'scenario_id'=>2, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>1 , 'scenario_id'=>3, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>2 , 'scenario_id'=>3, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password111\'', 'result' => '', 'order'=>3 , 'scenario_id'=>3, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Affiche \' Mot de passe Incorrecte» et reset le champ \' Mot de passe ». ', 'order'=>4 , 'scenario_id'=>3, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>5 , 'scenario_id'=>3, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>6 , 'scenario_id'=>3, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Les 2 champs sont corrects._User se connecte à son compte et il est redirigé vers la page d\'accueil. ', 'order'=>7 , 'scenario_id'=>3, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>1 , 'scenario_id'=>4, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User clique sur Mot de passe oublie', 'result' => 'User est redirigé vers la page de récupération de mot de passe ', 'order'=>2 , 'scenario_id'=>4, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>3 , 'scenario_id'=>4, 'mockup_id'=>4]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ E-mail Jean81@gmail.com ', 'result' => '', 'order'=>4 , 'scenario_id'=>4, 'mockup_id'=>4]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Envoyer ', 'result' => 'Un nouveau mot de passe est attribué aléatoirement à l\'utilisateur. Ce mot de passe est envoyé par mail à l\'adresse mail donnée. ', 'order'=>5 , 'scenario_id'=>4, 'mockup_id'=>4]);
      DB::table('steps')->insert(['action' => 'User va dans sa boite mail et clique sur le lien du mail. ', 'result' => 'User est redirigé vers la page de connexion. ', 'order'=>6 , 'scenario_id'=>4, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>7 , 'scenario_id'=>4, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'CHAT123\'', 'result' => '', 'order'=>8 , 'scenario_id'=>4, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Les 2 champs sont corrects._User se connecte à son compte et il est redirigé vers la page d\'accueil. ', 'order'=>9 , 'scenario_id'=>4, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>1 , 'scenario_id'=>5, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User clique sur Pas de compte? Inscrivez-vous', 'result' => 'User est redirigé vers la page d\'inscription ', 'order'=>2 , 'scenario_id'=>5, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean81\'', 'result' => '', 'order'=>3 , 'scenario_id'=>5, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean81@gmail.com\'', 'result' => '', 'order'=>4 , 'scenario_id'=>5, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>5 , 'scenario_id'=>5, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Password1\'', 'result' => '', 'order'=>6 , 'scenario_id'=>5, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'L\'utilisateur est redirigé sur la page d\'accueil et sont compte est créer et stocker dans la base de donnée ', 'order'=>7 , 'scenario_id'=>5, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>8 , 'scenario_id'=>5, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>9 , 'scenario_id'=>5, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>10 , 'scenario_id'=>5, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Les 2 champs sont corrects._User se connecte à son compte et il est redirigé vers la page d\'accueil. ', 'order'=>11 , 'scenario_id'=>5, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique surConnexion ', 'result' => 'User est redirigé vers la page de connexion ', 'order'=>1 , 'scenario_id'=>6, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nom utilisateurJean81 ', 'result' => '', 'order'=>2 , 'scenario_id'=>6, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>6, 'mockup_id'=>3]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Connexion ', 'result' => 'Les 2 champs sont corrects._User se connecte à son compte et il est redirigé vers la page d\'accueil. ', 'order'=>4 , 'scenario_id'=>6, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique surMon Profil ', 'result' => 'User est redirigé vers la page de son profil. ', 'order'=>1 , 'scenario_id'=>7, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique sur modifier à côté de l\'E-mail ', 'result' => 'Transforme le label Jean81@gmail.com en champ texte vide ', 'order'=>2 , 'scenario_id'=>7, 'mockup_id'=>5]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ E-mailJeanJacque81@gmail.com ', 'result' => '', 'order'=>3 , 'scenario_id'=>7, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'L\'E-mail est correct, il est validé._Le champ texte est remplacé par un label ', 'order'=>4 , 'scenario_id'=>7, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique surMon Profil ', 'result' => 'User est redirigé vers la page de son profil. ', 'order'=>1 , 'scenario_id'=>8, 'mockup_id'=>5]);
      DB::table('steps')->insert(['action' => 'User clique sur modifier à côté de l\'E-mail ', 'result' => 'Transforme le label Jean81@gmail.com en champ texte vide ', 'order'=>2 , 'scenario_id'=>8, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ E-mailJeanJacque81gmail.com ', 'result' => '', 'order'=>3 , 'scenario_id'=>8, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'L\'E-mail est incorrect. Affiche \' E-mail incorrect ». ', 'order'=>4 , 'scenario_id'=>8, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ E-mailJeanJacque81@gmail.com ', 'result' => '', 'order'=>5 , 'scenario_id'=>8, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'L\'E-mail est correct, il est validé._Le champ texte est remplacé par un label ', 'order'=>6 , 'scenario_id'=>8, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique surMon Profil ', 'result' => 'User est redirigé vers la page de son profil. ', 'order'=>1 , 'scenario_id'=>9, 'mockup_id'=>5]);
      DB::table('steps')->insert(['action' => 'User clique sur modifier à côté du mot de passe ', 'result' => 'Transforme le label ******** en champ texte vide et ajoute 2 champs textes supplémentaires. ', 'order'=>2 , 'scenario_id'=>9, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Ancien mot de passePassword1 ', 'result' => '', 'order'=>3 , 'scenario_id'=>9, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nouveau mot de passePassword2 ', 'result' => '', 'order'=>4 , 'scenario_id'=>9, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ_Confirmation nouveau mot de passePassword2 ', 'result' => '', 'order'=>5 , 'scenario_id'=>9, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'Les 3 champs sont corrects. Le mot de passe est changé._Les champs textes sont remplacés par un label ', 'order'=>6 , 'scenario_id'=>9, 'mockup_id'=>5]);
      DB::table('steps')->insert(['action' => 'User clique surMon Profil ', 'result' => 'User est redirigé vers la page de son profil. ', 'order'=>1 , 'scenario_id'=>10, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique sur modifier à côté du mot de passe ', 'result' => 'Transforme le label ******** en champ texte vide et ajoute 2 champs textes supplémentaires. ', 'order'=>2 , 'scenario_id'=>10, 'mockup_id'=>5]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Ancien mot de passePassword111 ', 'result' => '', 'order'=>3 , 'scenario_id'=>10, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nouveau mot de passePassword2 ', 'result' => '', 'order'=>4 , 'scenario_id'=>10, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ_Confirmation nouveau mot de passePassword2 ', 'result' => '', 'order'=>5 , 'scenario_id'=>10, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'Le mot de passe est incorrect. Affiche \' Mot de passe incorrect ». ', 'order'=>6 , 'scenario_id'=>10, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Ancien mot de passePassword1 ', 'result' => '', 'order'=>7 , 'scenario_id'=>10, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'Les 3 champs sont corrects. Le mot de passe est changé._Les champs textes sont remplacés par un label ', 'order'=>8 , 'scenario_id'=>10, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique surMon Profil ', 'result' => 'User est redirigé vers la page de son profil. ', 'order'=>1 , 'scenario_id'=>11, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'User clique sur modifier à côté du mot de passe ', 'result' => 'Transforme le label ******** en champ texte vide et ajoute 2 champs textes supplémentaires. ', 'order'=>2 , 'scenario_id'=>11, 'mockup_id'=>5]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Ancien mot de passePassword1 ', 'result' => '', 'order'=>3 , 'scenario_id'=>11, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ Nouveau mot de passePassword2 ', 'result' => '', 'order'=>4 , 'scenario_id'=>11, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ_Confirmation nouveau mot de passePassword3 ', 'result' => '', 'order'=>5 , 'scenario_id'=>11, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'La confirmation du nouveau mot de passe est incorrecte. Affiche_\' Confirmation ^nouveau mot de passe incorrect ». ', 'order'=>6 , 'scenario_id'=>11, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User insère dans le champ_Confirmation nouveau mot de passePassword2 ', 'result' => '', 'order'=>7 , 'scenario_id'=>11, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'User clique sur le bouton Valider ', 'result' => 'Les 3 champs sont corrects. Le mot de passe est changé. Les champs textes sont remplacés par un label ', 'order'=>8 , 'scenario_id'=>11, 'mockup_id'=>6]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean81\'', 'result' => '', 'order'=>1 , 'scenario_id'=>12, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean81@gmail.com\'', 'result' => '', 'order'=>2 , 'scenario_id'=>12, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>12, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Password1\'', 'result' => '', 'order'=>4 , 'scenario_id'=>12, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'L\'utilisateur est redirigé sur la page d\'accueil et sont compte est créer et stocker dans la base de donnée ', 'order'=>5 , 'scenario_id'=>12, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean99\'', 'result' => '', 'order'=>1 , 'scenario_id'=>13, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean99@gmail.com\'', 'result' => '', 'order'=>2 , 'scenario_id'=>13, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>13, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Password1\'', 'result' => '', 'order'=>4 , 'scenario_id'=>13, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'message d\'erreur, \' nom d\'utilisateur déjà utilisé ». Et vide le champ. ', 'order'=>5 , 'scenario_id'=>13, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean99\'', 'result' => '', 'order'=>1 , 'scenario_id'=>14, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean99 gmail.com\'', 'result' => '', 'order'=>2 , 'scenario_id'=>14, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>14, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Password1\'', 'result' => '', 'order'=>4 , 'scenario_id'=>14, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'Le site affiche un message d\'erreur, \' l\'email ne contient pas de \'\'@\'\' ». Et vide le champ. ', 'order'=>5 , 'scenario_id'=>14, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean99\'', 'result' => '', 'order'=>1 , 'scenario_id'=>15, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean99@ gmail.com\'', 'result' => '', 'order'=>2 , 'scenario_id'=>15, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Password1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>15, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Pa$$w0rd\'', 'result' => '', 'order'=>4 , 'scenario_id'=>15, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'Le site affiche un message d\'erreur, \' les champs mot de passe doivent être identiques »._Et vide les champs \' mot de passe » et \' confirmation du pot de passe ». ', 'order'=>5 , 'scenario_id'=>15, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean81\'', 'result' => '', 'order'=>1 , 'scenario_id'=>16, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean81@gmail.com\'', 'result' => '', 'order'=>2 , 'scenario_id'=>16, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Pa$$Word\'', 'result' => '', 'order'=>3 , 'scenario_id'=>16, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Pa$$Word\'', 'result' => '', 'order'=>4 , 'scenario_id'=>16, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'Le site affiche un message d\'erreur,_\' mot de passe invalide, veuillez entrer au minimum un chiffre et une lettre ». Et vide les champs \' mot de passe » et \' confirmation du pot de passe ». ', 'order'=>5 , 'scenario_id'=>16, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean81\'', 'result' => '', 'order'=>1 , 'scenario_id'=>17, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean81@gmail.com\'', 'result' => '', 'order'=>2 , 'scenario_id'=>17, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Pass1\'', 'result' => '', 'order'=>3 , 'scenario_id'=>17, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ Confirmation mot de passe\'Pass1\'', 'result' => '', 'order'=>4 , 'scenario_id'=>17, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'Le site affiche un message d\'erreur,_\' mot de passe invalide, veuillez entrer au minimum 6 caractères »._Et vide les champs \' mot de passe » et \' confirmation du pot de passe ». ', 'order'=>5 , 'scenario_id'=>17, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur le lien Pas de compte ? Inscrivez-vous ', 'result' => 'L\'utilisateur est rediriger sur la page d\'inscription ', 'order'=>1 , 'scenario_id'=>18, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ nom d\'utilisateur\'Jean81\'', 'result' => '', 'order'=>2 , 'scenario_id'=>18, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ E- mail\'Jean81@gmail.com\'', 'result' => '', 'order'=>3 , 'scenario_id'=>18, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ mot de passe\'Pass\'', 'result' => '', 'order'=>4 , 'scenario_id'=>18, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur insère dans le champ_Confirmation mot de passe\'Pass\'', 'result' => '', 'order'=>5 , 'scenario_id'=>18, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur envoyé ', 'result' => 'Le site affiche un message d\'erreur,_\' mot de passe invalide, veuillez entrer au minimum entrer 6 caractères, un chiffre et une lettre »._Et vide les champs \' mot de passe » et \' confirmation du pot de passe ». ', 'order'=>6 , 'scenario_id'=>18, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ma galerie ', 'result' => 'L\'utilisateur est redirigé sur la page de sa galerie ', 'order'=>1 , 'scenario_id'=>19, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ajouter une image ', 'result' => 'L\'explorateur de fichier Windows s\'ouvre ', 'order'=>2 , 'scenario_id'=>19, 'mockup_id'=>9]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur l\'image qu\'il a sélectionné et clic sur Ouvrir ', 'result' => 'La photo se redimensionne automatiquement et s\'ajoute au début de la galerie ', 'order'=>3 , 'scenario_id'=>19, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ma galerie ', 'result' => 'L\'utilisateur est redirigé sur la page de sa galerie ', 'order'=>1 , 'scenario_id'=>20, 'mockup_id'=>7]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ajouter une image ', 'result' => 'L\'explorateur de fichier Windows s\'ouvre ', 'order'=>2 , 'scenario_id'=>20, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur l\'image qu\'il a sélectionné et clic sur Annuler ', 'result' => 'Aucune photo n\'est ajoutée et l\'explorateur de fichier se ferme ', 'order'=>3 , 'scenario_id'=>20, 'mockup_id'=>9]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ma galerie ', 'result' => 'L\'utilisateur est redirigé sur la page de sa galerie ', 'order'=>1 , 'scenario_id'=>21, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Supprimer ', 'result' => 'Une fenêtre s\'ouvre et affiche le message \' êtes-vous sur de vouloir supprimer cette image » ', 'order'=>2 , 'scenario_id'=>21, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Oui ', 'result' => 'Le message disparait et la photo se supprime de la galerie. ', 'order'=>3 , 'scenario_id'=>21, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ma galerie ', 'result' => 'L\'utilisateur est redirigé sur la page de sa galerie ', 'order'=>1 , 'scenario_id'=>22, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur coche la case Privé ', 'result' => 'Une fenêtre s\'ouvre et affiche le message informatif de ce que fait le mode privé. ', 'order'=>2 , 'scenario_id'=>22, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ok ', 'result' => 'Le message disparait, la case privée se coche et l\'image passe en mode privé. ', 'order'=>3 , 'scenario_id'=>22, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ma galerie ', 'result' => 'L\'utilisateur est redirigé sur la page de sa galerie ', 'order'=>1 , 'scenario_id'=>23, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur coche la case Privé ', 'result' => 'la case privée se coche et l\'image passe en mode privé. ', 'order'=>2 , 'scenario_id'=>23, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Connexion ', 'result' => 'L\'utilisateur est redirigé sur la page de connexion ', 'order'=>1 , 'scenario_id'=>24, 'mockup_id'=>1]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Accueil ', 'result' => 'La page s\'actualise ', 'order'=>1 , 'scenario_id'=>25, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur image ', 'result' => 'Un zoom de l\'image s\'affiche ', 'order'=>1 , 'scenario_id'=>26, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur la croix ', 'result' => 'Le zoom se ferme. ', 'order'=>2 , 'scenario_id'=>26, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Mes albums ', 'result' => 'L\'utilisateur est redirigé sur la page de ses albums ', 'order'=>1 , 'scenario_id'=>27, 'mockup_id'=>2]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur un emplacement d\'album encore pas utilisé. ', 'result' => 'L\'utilisateur est redirigé sur la page de modification d\'albums ', 'order'=>2 , 'scenario_id'=>27, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur plusieurs images ', 'result' => '', 'order'=>3 , 'scenario_id'=>27, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ajouter ', 'result' => 'Les images sont ajoutées à l\'album ', 'order'=>4 , 'scenario_id'=>27, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur entre Vacances été 2016 dans Nom de l\'album ', 'result' => '', 'order'=>5 , 'scenario_id'=>27, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Sauvegarder ', 'result' => 'L\'album se crée et son nom s\'affiche avec une image aléatoire de l\'album en arrière-plan à la place de \' Aperçu image : Album 1 ». ', 'order'=>6 , 'scenario_id'=>27, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Mes albums ', 'result' => 'L\'utilisateur est redirigé sur la page de sa galerie ', 'order'=>1 , 'scenario_id'=>28, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Modifier un album ', 'result' => 'L\'utilisateur est redirigé sur la page de modification d\'albums ', 'order'=>2 , 'scenario_id'=>28, 'mockup_id'=>11]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur plusieurs images (qui sont déjà intégrée à l\'album). ', 'result' => '', 'order'=>3 , 'scenario_id'=>28, 'mockup_id'=>11]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Supprimer ', 'result' => 'Les images sont supprimées de l\'album. ', 'order'=>4 , 'scenario_id'=>28, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Sauvegarder ', 'result' => 'Toutes les modifications sont sauvegardées ', 'order'=>5 , 'scenario_id'=>28, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Mes albums ', 'result' => 'L\'utilisateur est redirigé sur la page de ses albums ', 'order'=>1 , 'scenario_id'=>29, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Modifier un album ', 'result' => 'L\'utilisateur est redirigé sur la page de modification d\'albums ', 'order'=>2 , 'scenario_id'=>29, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur plusieurs images (qui sont ne sont pas intégrée à l\'album). ', 'result' => '', 'order'=>3 , 'scenario_id'=>29, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Ajouter ', 'result' => 'Les images sont ajoutées à l\'album. ', 'order'=>4 , 'scenario_id'=>29, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Sauvegarder ', 'result' => 'Toutes les modifications sont sauvegardées ', 'order'=>5 , 'scenario_id'=>29, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Mes albums ', 'result' => 'L\'utilisateur est redirigé sur la page de ses albums ', 'order'=>1 , 'scenario_id'=>30, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur coche la case Privé ', 'result' => 'L\'album ne devient visible que par l\'utilisateur. ', 'order'=>2 , 'scenario_id'=>30, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Mes albums ', 'result' => 'L\'utilisateur est redirigé sur la page de ses albums ', 'order'=>1 , 'scenario_id'=>31, 'mockup_id'=>8]);
      DB::table('steps')->insert(['action' => 'L\'utilisateur clic sur Supprimer ', 'result' => 'L\'album est supprimé. ', 'order'=>2 , 'scenario_id'=>31, 'mockup_id'=>8]);

    }
    /*
      Default Seeder Template :
      Note -> 'id' field is optional
      Project :
        DB::table('projects')->insert([
            'id' => "",
            'name' => "",
            'description' => "",
            'startDate' => "",
            'endDate' => "",
        ]);

      User :
        DB::table('users')->insert([
            'firstname' => "",
            'lastname' => "",
            'mail' => "",
            'friendlyid' => "",
            'role_id' => "",
            'class_id' => "",
            'state_id' => "",
            'password' => bcrypt(''),
            'avatar'=> '',
        ]);

      Memberships :
        DB::table('memberships')->insert([
            'id' => "",
            'user_id' => "",
            'project_id' => "",
        ]);

      Task :
        DB::table('tasks')->insert([
            'id' => "",
            'name' => "",
            'duration' => "",
            'status' => "",
            'priority' => "",
            'project_id' => "",
            'parent_id' => "",
        ]);

      Class :
        DB::table('classes')->insert([
            'name' => "DefaultClass",
            'friendlyId' => "1"
        ]);

      State :
        DB::table('states')->insert(['id' => "", 'name' => "",]);

      Role :
        DB::table('roles')->insert(['id' => "", 'name' => "",]);

      Mockup :
        DB::table('mockups')->insert(['id' => , 'project_id' => , 'url' => ""]);

      Scenario :
        DB::table('Scenario')->insert([
          'id' => "",
          'description' => "",
          'name' => '',
          'actif' => ,
          'checkList_item_id' => "",
        ]);

      Step :
        DB::table('steps')->insert(['id' => , 'action' => , 'result' => "", 'order'=> , 'scenario_id'=>, 'mockup_id'=>]);
    */
}
