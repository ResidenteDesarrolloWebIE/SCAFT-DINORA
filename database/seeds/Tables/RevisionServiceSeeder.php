<?php

use Illuminate\Database\Seeder;
use App\Models\Revisions\RevisionService;

class RevisionServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $revision = new RevisionService();
        $revision->revision = 1;
        $revision->utility_percentage = 60;
        $revision->exchange_rate = 18.1;
        $revision->overhead = 1.0;
        $revision->sales_cost = 100;
        $revision->financial_cost = 3000;
        $revision->months = 5;
        $revision->final_amount = 15000000;
        $revision->total_amount = 12000000;
        $revision->duration = 10;
        $revision->cat_coin_id = 2;
        $revision->service_quotation_id = 1;
        $revision->save();

        $revision = new RevisionService();
        $revision->revision = 1;
        $revision->utility_percentage = 1;
        $revision->exchange_rate = 1;
        $revision->overhead = 1.0;
        $revision->sales_cost = 100;
        $revision->financial_cost = 3000;
        $revision->months = 5;
        $revision->final_amount = 15000000;
        $revision->total_amount = 12000000;
        $revision->duration = 10;
        $revision->cat_coin_id = 1;
        $revision->service_quotation_id = 2;
        $revision->save();
    }
}
