<?php

use App\Models\Optometrist;
use App\Models\Otica;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('idade');
            $table->string('od_esferico')->default(' 0 ');
            $table->string('od_cilindrico')->default(' 0 ');
            $table->string('od_eixo')->default(' 0 ');
            $table->string('oe_esferico')->default(' 0 ');
            $table->string('oe_cilindrico')->default(' 0 ');
            $table->string('oe_eixo')->default(' 0 ');
            $table->text('obs')->nullable();
            $table->foreignIdFor(Optometrist::class)->references('id')->on('optometristas');
            $table->foreignIdFor(Otica::class)->references('id')->on('oticas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receitas');
    }
};
