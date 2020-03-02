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
        
/*         DB::table('adm_database_syncs')->insert([
            'name' => 'Customer',
        	'child_table' => 'users',
            'parent_table' => 'customer',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);
        DB::table('adm_database_syncs')->insert([
            'name' => 'CatCoins',
        	'child_table' => 'cat_coins',
            'parent_table' => 'cat_coins',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);

        DB::table('adm_database_syncs')->insert([
            'name' => 'Contacts',
        	'child_table' => 'contacts',
            'parent_table' => 'contacts',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);
        DB::table('adm_database_syncs')->insert([
            'name' => 'Products',
        	'child_table' => 'products_quotations',
            'parent_table' => 'products_quotations',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);

        DB::table('adm_database_syncs')->insert([
            'name' => 'Projects',
        	'child_table' => 'projets',
            'parent_table' => 'projects',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);
        DB::table('adm_database_syncs')->insert([
            'name' => 'Payments',
        	'child_table' => 'quotations_payments',
            'parent_table' => 'quotations_payments',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);

        DB::table('adm_database_syncs')->insert([
            'name' => 'Progress',
        	'child_table' => 'quotations_progress',
            'parent_table' => 'quotations_progress',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);
        DB::table('adm_database_syncs')->insert([
            'name' => 'Revisions',
        	'child_table' => 'revisions_quotations',
            'parent_table' => 'revisions_quotations',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]);
        DB::table('adm_database_syncs')->insert([
            'name' => 'Services',
        	'child_table' => 'services_quotations',
            'parent_table' => 'services_quotations',
            'updated_at' => '2020-01-09 16:32:33',
            'database' => 'agate',
            'active' => 1,
        ]); */
    }
}