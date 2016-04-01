<?php
use Illuminate\Database\Seeder;
use Siged\Infraestructura\Documentos\Folios;

class TablaFolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folio')->delete();
        Folios::create([
            'numero'       => '1',
            'documento'    => 'Papeleta',
            'fecha_creado' => date('d/m/Y')
        ]);
    }
}
