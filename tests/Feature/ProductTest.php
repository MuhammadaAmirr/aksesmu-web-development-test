<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_index_displays_empty_state_when_no_products_exist(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee('No products found');
    }

    public function test_products_index_displays_product_list(): void
    {
        $product = Product::create([
            'name' => 'Beras Ramos 5kg',
            'description' => 'Beras kualitas premium',
            'price' => 74500,
            'stock' => 20,
        ]);

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Rp 74.500');
        $response->assertSee('20 in stock');
    }

    public function test_create_product_page_can_be_rendered(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertSee('Create Product');
        $response->assertSee('Save Product');
    }

    public function test_product_can_be_stored(): void
    {
        $payload = [
            'name' => 'Minyak Goreng 2L',
            'description' => 'Minyak goreng kelapa sawit kemasan pouch',
            'price' => 36000,
            'stock' => 50,
        ];

        $response = $this->post(route('products.store'), $payload);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('products', [
            'name' => 'Minyak Goreng 2L',
            'price' => 36000,
            'stock' => 50,
        ]);
    }

    public function test_store_product_validates_required_and_numeric_fields(): void
    {
        $response = $this->post(route('products.store'), [
            'name' => '',
            'price' => -500,
            'stock' => -1,
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'stock']);
        $this->assertDatabaseCount('products', 0);
    }

    public function test_show_product_page_displays_product_details(): void
    {
        $product = Product::create([
            'name' => 'Gula Pasir 1kg',
            'description' => 'Gula pasir putih kristal',
            'price' => 17500,
            'stock' => 40,
        ]);

        $response = $this->get(route('products.show', $product));

        $response->assertStatus(200);
        $response->assertSee('Product Details');
        $response->assertSee($product->name);
        $response->assertSee($product->description);
        $response->assertSee('Rp 17.500');
    }

    public function test_edit_product_page_can_be_rendered(): void
    {
        $product = Product::create([
            'name' => 'Tepung Terigu 1kg',
            'description' => 'Tepung terigu serbaguna',
            'price' => 13000,
            'stock' => 30,
        ]);

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
        $response->assertSee('Edit Product');
        $response->assertSee($product->name);
        $response->assertSee('Update Product');
    }

    public function test_product_can_be_updated(): void
    {
        $product = Product::create([
            'name' => 'Kopi Bubuk',
            'description' => 'Deskripsi lama',
            'price' => 12000,
            'stock' => 10,
        ]);

        $response = $this->put(route('products.update', $product), [
            'name' => 'Kopi Bubuk Renceng',
            'description' => 'Deskripsi baru',
            'price' => 14500,
            'stock' => 25,
        ]);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Kopi Bubuk Renceng',
            'price' => 14500,
            'stock' => 25,
        ]);
    }

    public function test_product_can_be_deleted(): void
    {
        $product = Product::create([
            'name' => 'Produk Dihapus',
            'description' => null,
            'price' => 10000,
            'stock' => 5,
        ]);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_product_seeder_is_idempotent(): void
    {
        $this->seed(ProductSeeder::class);
        $firstCount = Product::count();

        $this->assertGreaterThanOrEqual(5, $firstCount);

        $this->seed(ProductSeeder::class);
        $this->assertSame($firstCount, Product::count());
    }
}

