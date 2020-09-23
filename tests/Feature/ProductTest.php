<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test updating a Prodduct
     * 
     */
    public function testArticlesAreUpdatedCorrectly()
    {

        $product = Product::factory()->create();

        $payload = [
            'name' => 'Product name updated',
            'description' => 'Product description updated',
            'price' => 230.00,
            'photo' => UploadedFile::fake()->image('avatar.jpg'),
            'category_id' => Category::factory()->create()->id
        ];

        $response = $this->json('PUT', '/api/products/' . $product->id, $payload)
            ->assertStatus(200);
    }
}
