<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 32)->nullable()->after('email');
            }

            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 32)->nullable()->after('gender');
            }

            if (! Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        if (! Schema::hasTable('user_login_activities')) {
            Schema::create('user_login_activities', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('event_type', 20)->default('login');
                $table->string('session_hash', 64)->unique();
                $table->string('ip_address', 45)->nullable();
                $table->string('device', 255)->nullable();
                $table->dateTime('logged_in_at')->index();
                $table->dateTime('last_seen_at')->index();
                $table->dateTime('logged_out_at')->nullable()->index();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_login_activities');

        $columns = array_values(array_filter(
            ['gender', 'phone', 'deleted_at'],
            fn (string $column): bool => Schema::hasColumn('users', $column)
        ));

        if ($columns !== []) {
            Schema::table('users', function (Blueprint $table) use ($columns): void {
                $table->dropColumn($columns);
            });
        }
    }
};
