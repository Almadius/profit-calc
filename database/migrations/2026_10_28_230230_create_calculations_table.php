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
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(); // Привязка к юзеру (если добавишь авторизацию)
            $table->string('product_name');
            $table->decimal('cost_price', 12, 2); // Себестоимость
            $table->decimal('selling_price', 12, 2); // Цена продажи
            $table->decimal('commission_percent', 5, 2); // % комиссии площадки
            $table->decimal('logistics_cost', 12, 2)->default(0); // Логистика
            $table->decimal('ad_cost', 12, 2)->default(0); // Реклама
            $table->decimal('tax_percent', 5, 2)->default(4); // Налог (4% или 8% в РК)
            $table->decimal('net_profit', 12, 2); // Итоговая чистая прибыль
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
