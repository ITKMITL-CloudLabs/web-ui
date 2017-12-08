<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAllBooleanFieldsNameInLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->renameColumn('publish', 'is_published');
            $table->renameColumn('predefined_lab', 'is_predefined_lab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->renameColumn('is_published', 'publish');
            $table->renameColumn('is_predefined_lab', 'predefined_lab');
        });
    }
}
