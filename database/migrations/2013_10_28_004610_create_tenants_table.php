<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->uuid('uuid');
            $table->string('cnpj_cpf')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('url')->unique();
            $table->string('logo')->nullable();

            /*
             * Status do tenant
             */
            $table->enum('active',['Y','N'])->default('Y');

            /*
             * Subscription
             */

            $table->date('subscription')->nullable()->comment('Data que se inscreveu');
            $table->date('expires_at')->nullable()->comment('Data de expiração');
            $table->string('subscription_id',255)->nullable()->comment('Identificação do gateway de pagamento');
            $table->boolean('subscription_active')->default(false);
            $table->boolean('subscription_suspended')->default(false);

            $table->timestamps();

            /*
             * chave estrangeira
             */

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
