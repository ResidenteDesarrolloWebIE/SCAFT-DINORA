<?php

use Illuminate\Database\Seeder;
use App\Models\Projects\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = new Project();
        $project->folio = 'TB0001';
        $project->name = 'Proyecto 1';
        $project->status = 'Activo';
        $project->product_quotation_id = 1;
        $project->save();

        $project = new Project();
        $project->folio = 'TB0002';
        $project->name = 'Proyecto 2';
        $project->status = 'Activo';
        $project->product_quotation_id = 2;
        $project->save();


        $project = new Project();
        $project->folio = 'TB0003';
        $project->name = 'Proyecto 3';
        $project->status = 'Activo';
        $project->service_quotation_id = 1;
        $project->save();

        $project = new Project();
        $project->folio = 'TB0004';
        $project->name = 'Proyecto 4';
        $project->status = 'Activo';
        $project->service_quotation_id = 2;
        $project->save();
    }
}
