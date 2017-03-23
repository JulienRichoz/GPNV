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
      DB::table('users')->insert([
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

      DB::table('users')->insert([
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
    }
}
