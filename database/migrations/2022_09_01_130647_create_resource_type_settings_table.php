<?php

use App\Utils\Common\ResourceTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceTypeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_type_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
            $table->string('type')->comment(implode(' | ',ResourceTypes::All)); //file // image // video 
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
        Schema::dropIfExists('resource_type_settings');
    }
}
