<?php

use Illuminate\Database\Seeder;
use App\Models\Coins\Coin;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coin = new Coin();
        $coin->code = 'MXN';
        $coin->coin = 'PESOS';
        $coin->save();

        $coin = new Coin();
        $coin->code = 'USD';
        $coin->coin = 'DOLARES';
        $coin->save();
    }
}
