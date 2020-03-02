<?php

use Illuminate\Database\Seeder;
use App\Models\Quotes\Progress;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $progress = new Progress();
        $progress->etapa1 = 100;
        $progress->etapa2 = 100;
        $progress->etapa3 = 0;
        $progress->etapa4 = 0;
        $progress->etapa5 = 0;
        $progress->etapa6 = 0;
        $progress->date_etapa3 = '2020-02-26 14:36:28';
        $progress->date_etapa4 = '2020-02-27 14:36:28';
        $progress->date_etapa5 = '2020-02-27 14:36:28';
        $progress->date_etapa6 = '2020-03-01 14:36:28';
        $progress->payment_one = 20000;
        $progress->payment_two = 0;
        $progress->liquidez = 1;
        $progress->final_date = '2020-03-03 14:36:28';
        $progress->product_quotation_id = 1;
        $progress->save();


        $progress = new Progress();
        $progress->etapa1 = 100;
        $progress->etapa2 = 100;
        $progress->etapa3 = 100;
        $progress->etapa4 = 100;
        $progress->etapa5 = 0;
        $progress->etapa6 = 0;
        $progress->date_etapa3 = '2020-02-26 14:36:28';
        $progress->date_etapa4 = '2020-02-27 14:36:28';
        $progress->date_etapa5 = '2020-02-27 14:36:28';
        $progress->date_etapa6 = '2020-03-01 14:36:28';
        $progress->payment_one = 20000;
        $progress->payment_two = 0;
        $progress->liquidez = 1;
        $progress->final_date = '2020-03-03 14:36:28';
        $progress->product_quotation_id = 2;
        $progress->save();


        $progress = new Progress();
        $progress->etapa1 = 100;
        $progress->etapa2 = 100;
        $progress->etapa3 = 0;
        $progress->etapa4 = 0;
        $progress->etapa5 = 0;
        $progress->etapa6 = 0;
        $progress->date_etapa3 = '2020-02-26 14:36:28';
        $progress->date_etapa4 = '2020-02-27 14:36:28';
        $progress->date_etapa5 = '2020-02-27 14:36:28';
        $progress->date_etapa6 = '2020-03-01 14:36:28';
        $progress->payment_one = 20000;
        $progress->payment_two = 0;
        $progress->liquidez = 1;
        $progress->final_date = '2020-03-03 14:36:28';
        $progress->service_quotation_id = 1;
        $progress->save();

        $progress = new Progress();
        $progress->etapa1 = 100;
        $progress->etapa2 = 100;
        $progress->etapa3 = 100;
        $progress->etapa4 = 100;
        $progress->etapa5 = 0;
        $progress->etapa6 = 0;
        $progress->date_etapa3 = '2020-02-26 14:36:28';
        $progress->date_etapa4 = '2020-02-27 14:36:28';
        $progress->date_etapa5 = '2020-02-27 14:36:28';
        $progress->date_etapa6 = '2020-03-01 14:36:28';
        $progress->payment_one = 20000;
        $progress->payment_two = 0;
        $progress->liquidez = 1;
        $progress->final_date = '2020-03-03 14:36:28';
        $progress->service_quotation_id = 2;
        $progress->save();
    }
}
