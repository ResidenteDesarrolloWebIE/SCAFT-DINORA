<?php

use Illuminate\Database\Seeder;
use App\Models\Quotes\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->folio = 'SR0001';
        $service->service_type = 'SR0001';
        $service->description = 'Servicio1';
        $service->service_location = 'Primer servicio';
        $service->estimated_time = '2020-03-24 14:36:28';
        $service->status = 'Activo';
        $service->notes = 'Primer servicio';
        $service->bidding = 1;
        $service->user_id = 1;
        $service->save();

        $service = new Service();
        $service->folio = 'SR0002';
        $service->service_type = 'SR0002';
        $service->description = 'Servicio2';
        $service->service_location = 'Segundo servicio';
        $service->estimated_time = '2020-04-24 14:36:28';
        $service->status = 'Activo';
        $service->notes = 'Segundo servicio';
        $service->bidding = 1;
        $service->user_id = 1;
        $service->save();
    }
}
