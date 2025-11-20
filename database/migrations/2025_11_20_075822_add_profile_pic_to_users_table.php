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
        // Check if the 'users' table exists before attempting to modify it
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Add the new column 'profile_pic' after 'email' for organization
                // It is set as nullable so existing users don't break.
                $table->string('profile_pic')->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Check if the 'users' table exists and the column 'profile_pic' exists
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'profile_pic')) {
            Schema::table('users', function (Blueprint $table) {
                // Drop the column if the migration is rolled back
                $table->dropColumn('profile_pic');
            });
        }
    }
};