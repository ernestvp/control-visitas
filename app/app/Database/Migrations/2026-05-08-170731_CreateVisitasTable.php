<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitasTable extends Migration
{
    public function up()
    {
        // Creamos la tabla de visitantes
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'apellidos' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'dni' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'motivo' => [
                'type' => 'TEXT',
            ],
            'persona_visitada' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'entrada' => [
                'type' => 'DATETIME',
            ],
            'salida' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('visitas');

        // Creamos la tabla de usuarios para el login
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        // Borramos las tablas si se revierten las migraciones
        $this->forge->dropTable('visitas');
        $this->forge->dropTable('usuarios');
    }
}