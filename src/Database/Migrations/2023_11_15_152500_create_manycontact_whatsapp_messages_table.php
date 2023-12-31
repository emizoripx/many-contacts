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
        Schema::create('manycontact_whatsapp_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_key')->index();
            $table->string('message_id')->nullable()->index();
            $table->text('message')->nullable();
            $table->string('number_phone')->nullable()->index();
            $table->string('status')->nullable();
            $table->string('state')->nullable();
            $table->string('status_description')->nullable();
            $table->dateTime('send_date')->nullable();
            $table->dateTime('delivered_date')->nullable();
            $table->dateTime('read_date')->nullable();
            $table->dateTime('dispatched_date')->nullable();
            $table->text('errors')->nullable();
            $table->text('error_details')->nullable();
            $table->boolean('billable')->default(true);
            $table->text('last_callback_reponse')->nullable();
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
        Schema::dropIfExists('manycontact_whatsapp_messages');
    }
};
