<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_id');
            $table->integer('bill_id')->nullable();
            $table->enum('type', ['purchase', 'deposit', 'transfer', 'bill']);
            $table->string('name');
            $table->decimal('amount', 8, 2);
            $table->integer('from_account');
            $table->integer('to_account')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
