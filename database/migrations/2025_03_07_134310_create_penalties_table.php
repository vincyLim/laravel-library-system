<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('borrow_record_id')->constrained()->cascadeOnDelete();
            $table->float('amount');
            $table->string('status')->default('unpaid');
            $table->date('pay_date')->nullable();
            $table->foreignId('pay_librarian_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string("pay_method")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penalties');
    }
}
