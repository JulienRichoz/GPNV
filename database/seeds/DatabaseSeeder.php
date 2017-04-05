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
          'mail' => "utilisateur@mail.com",
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
      $this->Project002();
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

      // Tasks
      DB::table('tasks')->insert([
          'id' => "1",
          'name' => "Documentation",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
      ]);

      DB::table('tasks')->insert([
          'id' => "2",
          'name' => "Design",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
      ]);

      DB::table('tasks')->insert([
          'id' => "3",
          'name' => "Test",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
      ]);

      DB::table('tasks')->insert([
          'id' => "4",
          'name' => "Analyse",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
          'parent_id' => "1",
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
        'id' => "2", 'title' => "Faire une documentation",
        'done' => "0", 'checkList_id' => "2",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "3", 'title' => "Documentation",
        'done' => "0", 'checkList_id' => "1",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "4", 'title' => "Site Web",
        'done' => "0", 'checkList_id' => "1",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "5", 'title' => "Manuel d'installation",
        'done' => "0", 'checkList_id' => "1",
      ]);

      DB::table('checkList_Items')->insert([
        'id' => "6", 'title' => "Création d'une procédure d'installation",
        'done' => "0", 'checkList_id' => "2",
      ]);
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

      // Tasks
      DB::table('tasks')->insert([
          'id' => "5",
          'name' => "Documentation",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
      ]);

      DB::table('tasks')->insert([
          'id' => "6",
          'name' => "Design",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
      ]);

      DB::table('tasks')->insert([
          'id' => "7",
          'name' => "Test",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "2",
      ]);

      DB::table('tasks')->insert([
          'id' => "8",
          'name' => "Analyse AD",
          'duration' => "1",
          'status' => "wip",
          'priority' => "0",
          'project_id' => "1",
          'parent_id' => "2",
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
    */
}
