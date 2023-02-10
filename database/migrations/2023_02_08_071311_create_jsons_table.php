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
        Schema::create('jsons', function (Blueprint $table) {
            $table->id();
            $table->text('country');
            $table->text('city');
            $table->text('address_1');
            $table->text('reason_for_recall');
            $table->text('address_2');
            $table->text('product_quantity');
            $table->text('code_info');
            $table->date('center_classification_date');
            $table->text('distribution_pattern');
            $table->text('state');
            $table->text('product_description');
            $table->date('report_date');
            $table->text('classification');
            $table->string('openfda')->nullable();
            $table->text('recalling_firm');
            $table->text('recall_number');
            $table->text('initial_firm_notification');
            $table->text('product_type');
            $table->text('event_id');
            $table->text('more_code_info');
            $table->text('recall_initiation_date');
            $table->text('postal_code');
            $table->text('voluntary_mandated');
            $table->text('status');
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
        Schema::dropIfExists('jsons');
    }
};
