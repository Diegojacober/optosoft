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
        Schema::create('exames', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('idade');
            $table->string('telefone');
            $table->text('anotacao')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color');
            $table->integer('confirmado')->default(0);
            $table->dateTime('data_confirmacao')->nullable();
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
        Schema::dropIfExists('exames');
    }
};
