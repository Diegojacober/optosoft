<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('receitas', function (Blueprint $table) {
            $table->string('ac')->default('-');
            $table->string('acd')->default('-');
            $table->string('ace')->default('-');
        });
    }

    public function down()
    {
        Schema::table('receitas', function (Blueprint $table) {
            $table->dropColumn('ac');
            $table->dropColumn('acd');
            $table->dropColumn('ace');
        });
    }
};
