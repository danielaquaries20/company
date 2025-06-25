<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnInvestasiIdrToContactTable extends Migration
{
    public function up()
    {
         $this->forge->addColumn('contacts', [
            'investasi_idr' => [
                'type' => 'DOUBLE',
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
         $this->forge->dropColumn('contacts', 'investasi_jdr');
    }
}
