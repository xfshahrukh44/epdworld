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
        Schema::create('affiliate_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // which user submitted
            $table->string('full_name');
            $table->string('business_name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // Bank info
            $table->string('account_holder_name');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('routing_swift_bic_code');
            $table->string('account_type')->nullable();
            $table->string('bank_location')->nullable();
            $table->string('currency')->nullable();

            // Authorization info
            $table->string('printed_name');
            $table->string('signature')->nullable();
            $table->date('date')->nullable();

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
        Schema::dropIfExists('affiliate_user');
    }
};
