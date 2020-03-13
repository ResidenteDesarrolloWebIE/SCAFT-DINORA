<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CoinSeeder::class); 
        $this->call(AdmDatabaseSyncSeeder::class);  
        $this->call(ProductSeeder::class); 
        $this->call(ServiceSeeder::class); 
        $this->call(ProjectSeeder::class); 
        $this->call(PaymentSeeder::class); 
        $this->call(ProgressSeeder::class);
        $this->call(RevisionServiceSeeder::class);
        $this->call(RevisionSupplySeeder::class); 
    }
}