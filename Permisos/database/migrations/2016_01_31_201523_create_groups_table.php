<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acls', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('perm_create');
            $table->boolean('perm_read');
            $table->boolean('perm_update');
            $table->boolean('perm_delete');
            $table->timestamps();
        });

        $now = date('Y-m-d H:i:s');
        \DB::table('acls')->insert([
            [ //PostManager
                'perm_create' => true,
                'perm_read' => true,
                'perm_update' => true,
                'perm_delete' => true,
                'created_at' => $now
            ],
            [ //PostUser
                'perm_create' => false,
                'perm_read' => true,
                'perm_update' => false,
                'perm_delete' => false,
                'created_at' => $now
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acls');
    }
}
