<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
//php artisan test
class ProductTest extends TestCase
{

    use RefreshDatabase;
    public function testStoreProducts(){
        $product = Product::create([
            'name' => 'mobile',
            'price' => 99,
            'quantity' => 10,
            'category_id' => 1
        ]);
        $this->assertDatabaseHas('products', [
            'name' => 'mobile',
        ]);
    }

}
