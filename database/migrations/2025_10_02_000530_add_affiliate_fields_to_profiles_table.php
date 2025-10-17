<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'instagram_yesno')) {
                $table->enum('instagram_yesno', ['yes', 'no'])->nullable();
            }
            if (!Schema::hasColumn('profiles', 'instagram_handle')) {
                $table->string('instagram_handle')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'facebook_yesno')) {
                $table->enum('facebook_yesno', ['yes', 'no'])->nullable();
            }
            if (!Schema::hasColumn('profiles', 'facebook_name')) {
                $table->string('facebook_name')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'youtube_yesno')) {
                $table->enum('youtube_yesno', ['yes', 'no'])->nullable();
            }
            if (!Schema::hasColumn('profiles', 'youtube_page')) {
                $table->string('youtube_page')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'tiktok_yesno')) {
                $table->enum('tiktok_yesno', ['yes', 'no'])->nullable();
            }
            if (!Schema::hasColumn('profiles', 'tiktok_channel')) {
                $table->string('tiktok_channel')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'other_yesno')) {
                $table->enum('other_yesno', ['yes', 'no'])->nullable();
            }
            if (!Schema::hasColumn('profiles', 'other_social')) {
                $table->string('other_social')->nullable();
            }

            // Additional Fields
            if (!Schema::hasColumn('profiles', 'competing_brands_yesno')) {
                $table->enum('competing_brands_yesno', ['yes', 'no'])->nullable();
            }
            if (!Schema::hasColumn('profiles', 'competing_brands_details')) {
                $table->string('competing_brands_details')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'commission_transfer')) {
                $table->enum('commission_transfer', ['yes', 'no'])->nullable();
            }

            // Legal & Compliance
            if (!Schema::hasColumn('profiles', 'agree_terms')) {
                $table->boolean('agree_terms')->default(false);
            }
            if (!Schema::hasColumn('profiles', 'agree_noncompete')) {
                $table->boolean('agree_noncompete')->default(false);
            }
            if (!Schema::hasColumn('profiles', 'agree_disclosure')) {
                $table->boolean('agree_disclosure')->default(false);
            }
            if (!Schema::hasColumn('profiles', 'agree_promote')) {
                $table->boolean('agree_promote')->default(false);
            }

            // Review and Submission
            if (!Schema::hasColumn('profiles', 'printed_name')) {
                $table->string('printed_name')->nullable();
            }
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
            $columnsToDrop = [
                'instagram_yesno',
                'instagram_handle',
                'facebook_yesno',
                'facebook_name',
                'youtube_yesno',
                'youtube_page',
                'tiktok_yesno',
                'tiktok_channel',
                'other_yesno',
                'other_social',
                'competing_brands_yesno',
                'competing_brands_details',
                'commission_transfer',
                'agree_terms',
                'agree_noncompete',
                'agree_disclosure',
                'agree_promote',
                'printed_name',
            ];
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
