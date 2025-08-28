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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('phone', 50)->nullable()->after('address');
            $table->string('company_name')->nullable()->after('phone');
            $table->text('social_media')->nullable()->after('company_name'); // JSON string of platforms
            $table->text('competing_brands')->nullable()->after('social_media');
            $table->string('hear_about')->nullable()->after('competing_brands');
            $table->string('payment_method')->nullable()->after('hear_about');
            $table->text('why_join')->nullable()->after('payment_method');
            $table->string('affiliate_experience')->nullable()->after('why_join'); // yes/no
            $table->text('experience_details')->nullable()->after('affiliate_experience');
            $table->longText('about_yourself')->nullable()->after('experience_details');
            $table->string('signature')->nullable()->after('about_yourself');
            $table->date('application_date')->nullable()->after('signature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'company_name',
                'social_media',
                'competing_brands',
                'hear_about',
                'payment_method',
                'why_join',
                'affiliate_experience',
                'experience_details',
                'about_yourself',
                'signature',
                'application_date',
            ]);
        });
    }
};
