<?php

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
        Schema::create('ribs', function (Blueprint $table) {
            $table->id();
            $table->string('CodeBanque')->nullable();
            $table->string('CodeGuichet')->nullable();
            $table->string('NumerodeCompte')->nullable();
            $table->string('CleRIB')->nullable();
            $table->string('IBAN')->nullable();
            $table->string('BIC')->nullable();
            $table->string('NomBank')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ribs');
    }
};
