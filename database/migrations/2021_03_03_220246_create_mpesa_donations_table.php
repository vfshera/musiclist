<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_donations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->string('trans_id');
            $table->string('trans_time');
            $table->decimal('trans_amount',8,2);
            $table->string('business_short_code');
            $table->string('bill_ref_number');
            $table->decimal('org_account_balance', 8,2);
            $table->string('msisdn');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
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
        Schema::dropIfExists('mpesa_donations');
    }
}
