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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('TransactionType')->default('pay');
            $table->string('TransID')->default('pay');
            $table->string('TransTime')->default('pay');
            $table->decimal('TransAmount',8,2)->default(200);
            $table->string('BusinessShortCode')->default('pay');
            $table->string('BillRefNumber')->default('pay');
            $table->string('InvoiceNumber')->default('pay');
            $table->decimal('OrgAccountBalance',8,2)->default(200);
            $table->string('ThirdPartyTransId')->default('pay');
            $table->string('MSISON')->default('pay');
            $table->string('FirstName')->default('pay');
            $table->string('MiddleName')->default('pay');
            $table->string('LastName')->default('pay');
            $table->text('response');
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
};
