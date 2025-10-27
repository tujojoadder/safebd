<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->string('phone', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('post_code')->nullable();
            $table->integer('division_id')->contrained('divisions')->onDelete('cascade')->nullable();
            $table->integer('district_id')->contrained('districts')->onDelete('cascade')->nullable();
            $table->integer('upazilla_id')->contrained('upazilas')->onDelete('cascade')->nullable();
            $table->integer('union_id')->contrained('unions')->onDelete('cascade')->nullable();
            $table->text('address')->nullable();
            $table->string('payment_method', 25)->default('cash');
            $table->unsignedBigInteger('payment_status')->default(0)->comment('1=>paid, 0=>Unpaid');
            $table->text('payment_details')->nullable();
            $table->float('grand_total')->default(0.00);
            $table->float('coupon_discount')->default(0.00);
            $table->string('order_number')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            $table->string('viewed')->default(0);
            $table->string('delivery_viewed')->default(1);
            $table->string('payment_status_viewed')->default(1);
            $table->string('commission_calculated')->default(0);
            $table->text('comment')->nullable();
            $table->string('delivery_status')->default('pending')->nullable();
            $table->string('tracking_code', 100)->nullable();
            $table->string('confirmed_date', 30)->nullable();
            $table->string('processing_date', 30)->nullable();
            $table->string('picked_date', 30)->nullable();
            $table->string('shipped_date', 30)->nullable();
            $table->string('delivered_date', 30)->nullable();
            $table->string('cancel_date', 30)->nullable();
            $table->string('return_date', 30)->nullable();
            $table->text('return_reason')->nullable();
            $table->unsignedTinyInteger('type')->default(1)->comment('1=>Not guest order, 2=>Guest Order');
            $table->unsignedTinyInteger('order_type')->default(1)->comment('1=>Customer order, 2=>Pos Order');
            $table->bigInteger('created_by')->contrained('users')->onDelete('cascade')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
