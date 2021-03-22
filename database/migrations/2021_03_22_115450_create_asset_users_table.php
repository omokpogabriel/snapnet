<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_users', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name')->nullable(false);
            $table->bigInteger('asset_id')->nullable(true);
            $table->timestamps();

            $table->foreign('asset_id')->references('id')
                ->on('assets')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_users');
    }
}
