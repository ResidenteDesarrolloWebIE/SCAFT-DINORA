<?php

use Illuminate\Database\Seeder;
use App\Models\Revisions\RevisionSupply;

/* Productos */
class RevisionSupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $revision = new RevisionSupply();
        $revision->revision_number = 1;
        $revision->utility_percentage = 50;
        $revision->exchange_rate = 1;
        $revision->final_amount = 5000000;
        $revision->revision_date = '2020-02-24 14:36:28';
        $revision->notes = "Primera revision";
        $revision->cat_coin_id = 1;
        $revision->product_quotation_id = 1;
        $revision->save();

        $revision = new RevisionSupply();
        $revision->revision_number = 1;
        $revision->utility_percentage = 50;
        $revision->exchange_rate = 17.98;
        $revision->final_amount = 5000000;
        $revision->revision_date = '2020-02-24 14:36:28';
        $revision->notes = "Primera revision";
        $revision->cat_coin_id = 2;
        $revision->product_quotation_id = 2;
        $revision->save();
    }
}
