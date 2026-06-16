<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->string('user_id',20)->primary();

            $table->string('name',100);

            $table->string('email',100);

            $table->enum('status',[
                'NEW CUSTOMER',
                'LOYAL CUSTOMER'
            ])->default('NEW CUSTOMER');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};