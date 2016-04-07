<?php
use Illuminate\Database\Seeder;
use Siged\Infraestructura\Documentos\DAO\FoliosDAO;

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
        FoliosDAO::create([
            'numero'       => '1',
            'documento'    => 'Papeleta',
            'fecha_creado' => date('d/m/Y')
        ]);
    }
}
