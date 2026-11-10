<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Root URL should redirect to the products index page.
     */
    public function test_the_application_redirects_root_to_products_index(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('products.index'));
    }
}
