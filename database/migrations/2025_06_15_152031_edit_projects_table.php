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
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('image', 'desktop_image');
            $table->string('mobile_image',50)->nullable()->after('desktop_image');
            $table->string('image_alt_tag', 50)->nullable()->after('mobile_image');
            $table->string('meta_title',100)->nullable()->after('image_alt_tag');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('desktop_image', 'image');
            $table->dropColumn('mobile_image');    
            $table->dropColumn('image_alt_tag');    
            $table->dropColumn('meta_title');   
            $table->dropColumn('meta_description');      
        });
    }
};
