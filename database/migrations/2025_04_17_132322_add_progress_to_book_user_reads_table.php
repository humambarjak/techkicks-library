<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('book_user_reads', function (Blueprint $table) {
            $table->integer('last_page')->nullable(); // or progress percentage
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_user_reads', function (Blueprint $table) {
            //
        });
    }
};
