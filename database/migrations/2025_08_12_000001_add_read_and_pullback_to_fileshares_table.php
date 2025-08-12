<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('fileshares', function (Blueprint $table) {
            if (!Schema::hasColumn('fileshares', 'is_read')) {
                $table->boolean('is_read')->default(false)->after('priority');
            }
            if (!Schema::hasColumn('fileshares', 'read_at')) {
                $table->timestamp('read_at')->nullable()->after('is_read');
            }
            if (!Schema::hasColumn('fileshares', 'is_pulled_back')) {
                $table->boolean('is_pulled_back')->default(false)->after('is_read');
            }
            if (!Schema::hasColumn('fileshares', 'pull_back_remark')) {
                $table->string('pull_back_remark')->nullable()->after('is_pulled_back');
            }
        });
    }

    public function down(): void
    {
        Schema::table('fileshares', function (Blueprint $table) {
            if (Schema::hasColumn('fileshares', 'pull_back_remark')) {
                $table->dropColumn('pull_back_remark');
            }
            if (Schema::hasColumn('fileshares', 'is_pulled_back')) {
                $table->dropColumn('is_pulled_back');
            }
            if (Schema::hasColumn('fileshares', 'read_at')) {
                $table->dropColumn('read_at');
            }
            if (Schema::hasColumn('fileshares', 'is_read')) {
                $table->dropColumn('is_read');
            }
        });
    }
};


