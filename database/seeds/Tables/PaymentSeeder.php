<?php

use Illuminate\Database\Seeder;
use App\Models\Quotes\Payments;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment = new Payments();
        $payment->amount = 20000;
        $payment->date_amount = '2020-02-24 14:36:28';
        $payment->approval = 1;
        $payment->exchange = 1;
        $payment->product_quotation_id = 1;
        $payment->cat_coin_id = 1;
        $payment->save();

        $payment = new Payments();
        $payment->amount = 2000;
        $payment->date_amount = '2020-02-24 14:36:28';
        $payment->approval = 1;
        $payment->exchange = 18.99;
        $payment->service_quotation_id = 1;
        $payment->cat_coin_id = 2;
        $payment->save();
    }
}
