<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model',30);
            $table->string('name',30);
            $table->integer('acl_id')->unsigned();
            $table->timestamps();
            $table->foreign('acl_id')->references('id')
                ->on('acls')->onDelete('cascade')->onUpdate('cascade');
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('groups')->insert([
            [
                'model' => 'post',
                'name' => 'PostManager',
                'acl_id' => 1,
                'created_at' => $now
            ],
            [
                'model' => 'post',
                'name' => 'PostUser',
                'acl_id' => 2,
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
        Schema::drop('groups');
    }
}
