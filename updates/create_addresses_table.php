<?php namespace Dmrch\UserExtension\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('dmrch_userextension_addresses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->string('zip',50)->nullable();
            $table->string('street',500)->nullable();
            $table->string('number',50)->nullable();
            $table->string('district',250)->nullable();
            $table->string('city',250)->nullable();
            $table->string('state',250)->nullable();
            $table->string('complement',250)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dmrch_userextension_addresses');
    }
}
