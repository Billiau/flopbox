<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToFiles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    // Terminal -> $ php artisan migrate
    
    public function up() {
        Schema::table('files', function($table) {
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
      // Terminal -> $ php artisan migrate:rollback
    
    public function down() {
         Schema::table('files', function($table) {
            $table->dropColumn('user_id');
        });
    }

}
