
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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->json('details')->default('{}');
            $table->integer('totalPemasukan');
            $table->integer('hargaModal');
            $table->integer('keuntungan');
            $table->boolean('isPemasukan'); // 1 == PEMASUKAN | 2 == PENGELUARAN
            $table->boolean('status')->default(1); // 1 == LUNAS | 0 == TIDAK LUNAS
            $table->text('description')->default('');
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
        Schema::dropIfExists('entries');
    }
};
