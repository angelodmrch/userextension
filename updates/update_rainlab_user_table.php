<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\User\Models\User;

class UsersAddLastSeen extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('cpf',50)->nullable();
            $table->string('phone',50)->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'cpf')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('cpf');
            });
        }

        if (Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('phone');
            });
        }
    }
}
