<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::create('appointments', function (Blueprint $table) {
               $table->id();
               $table->unsignedBigInteger('client_id');
               $table->unsignedBigInteger('service_id');
               $table->unsignedBigInteger('employee_id');
               $table->dateTime('start_time');
               $table->dateTime('end_time');
               $table->string('status')->default('pending');
               $table->timestamps();

               $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
               $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
               $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
           });
       }

       public function down(): void
       {
           Schema::dropIfExists('appointments');
       }
   };
