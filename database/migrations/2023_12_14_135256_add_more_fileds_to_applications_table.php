<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('affiliation_type')->nullable()->after('author');
            $table->string('title_or_position')->nullable()->after('affiliation_type');
            $table->text('link')->nullable()->after('title_or_position');
            $table->string('conference')->nullable()->after('link');
            $table->string('oral')->nullable()->after('conference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('affiliation_type');
            $table->dropColumn('title_or_position');
            $table->dropColumn('link');
            $table->dropColumn('conference');
            $table->dropColumn('oral');
        });
    }
};
