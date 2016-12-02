<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function setUp() {
        $app = $this->createApplication();

        parent::setUp();

        \Artisan::call('migrate');
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHome()
    {
        $this->visit('/')
             ->see('Available methods:');
    }

    public function testApiHome() {
        $content = $this->get('/api/recipies')
                        ->response
                        ->getContent();

        $content = json_decode($content);

        // test if the page is returning valid content
        $this->assertEquals(count($content->data), 5);

        // test if the pagination works
        $this->assertEquals($content->current_page, 1);
    }

    public function testCategoryFilter() {
        $content = $this->get('/api/recipies/category/recipe_cuisine/italian')
                        ->response
                        ->getContent();

        $content = json_decode($content);

        // we only have 2 elements in the 'italian' category after bootrstraping
        // our application
        $this->assertEquals(count($content->data), 2);
    }

    public function testStoreMethod() {
        $content = $this->post('/api/recipies/', $this->recipyProvider())
                        ->response
                        ->getContent();

        $content = json_decode($content);

        $this->assertEquals($content->title, 'My super cool box');
        $this->assertEquals($content->box_type, 'vegetarian');
        $this->assertEquals($content->gousto_reference, 99);
        $this->assertEquals($content->marketing_description, 'Lorem ipsum dolor');
    }

    public function testUpdateMethod() {
        $content = $this->put('/api/recipies/1', ['box_type' => 'gourmet'])
                        ->response
                        ->getContent();

        $content = json_decode($content);
        $this->assertEquals($content->box_type, 'gourmet');
    }

    public function recipyProvider() {
        return [
            'box_type'          => 'vegetarian',
            'title'             => 'My super cool box',
            'slug'              => 'my-super-cool-box',
            'gousto_reference'  => 99,
            'marketing_description' => 'Lorem ipsum dolor'
        ];
    }

}
