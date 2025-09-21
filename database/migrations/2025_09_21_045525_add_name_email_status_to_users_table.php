<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('email')->nullable()->after('name'); // Make nullable first
            $table->string('status')->default('pending')->after('isVerified');
        });

        // Update existing users with placeholder emails
        User::whereNull('email')->orWhere('email', '')->update([
            'email' => DB::raw("CONCAT('user_', id, '@placeholder.com')"),
            'name' => DB::raw("CONCAT('User ', id)")
        ]);

        // Now add the unique constraint
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->change();
            $table->string('name')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'status']);
        });
    }
};
