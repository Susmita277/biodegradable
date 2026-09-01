<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
                    if (!Schema::hasColumn('order_items', 'stock_at_order')) {
                $table->integer('stock_at_order')->nullable()->after('subtotal');
            }
            
            if (!Schema::hasColumn('order_items', 'current_stock')) {
                $table->integer('current_stock')->nullable()->after('stock_at_order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'stock_at_order')) {
                $table->dropColumn('stock_at_order');
            }
            if (Schema::hasColumn('order_items', 'current_stock')) {
                $table->dropColumn('current_stock');
            }
        });
    }
};
