<?php

namespace Tests\Feature;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSearchYo()
    {
        $category = Category::factory([
            'name' => 'мёд',
            'description' => 'asdiwejfiwje as',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $response = $this->get(route('category.search'). '?name=мед');

        $response->assertOk();

        $data = $response->json();
        $this::assertEquals('мёд', $data[0]['name']);
    }

    public function testSearchUpperCase()
    {
        $category = Category::factory([
            'name' => 'JustIN',
            'description' => 'asdiwejfiwje as',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $response = $this->get(route('category.search'). '?name=justIn');
        $response->assertOk();

        $data = $response->json();
        $this::assertEquals('JustIN', $data[0]['name']);
    }

    public function testEmptyQuery()
    {
        $category = Category::factory([
            'name' => 'JustIN',
            'description' => 'asdiwejfiwje as',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $response = $this->get(route('category.search'). '?name= &active ');
        $response->assertOk();

        $data = $response->json();
        $this::assertEquals('JustIN', $data[0]['name']);
    }


    public function testSortEmpty()
    {
        $category1 = Category::factory([
            'name' => 'JustIN',
            'description' => 'asdiwejfiwje as',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();
        $category2 = Category::factory([
            'name' => 'JustIN',
            'description' => 'asdiwejfiwje as',
            'createdDate' => Carbon::now()->subHour(),
            'active' => true,
        ])->create();

        $response = $this->get(route('category.search'). '?name= &active ');
        $response->assertOk();

        $data = $response->json();

        $this::assertEquals($category1->id, $data[0]['id']);
        $this::assertEquals($category2->id, $data[1]['id']);
    }

    public function testSortOrder()
    {
        $category1 = Category::factory([
            'name' => 'JustIN',
            'description' => 'ab',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();
        $category2 = Category::factory([
            'name' => 'JustIN',
            'description' => 'ac',
            'createdDate' => Carbon::now()->subHour(),
            'active' => true,
        ])->create();

        $responseAsc = $this->get(route('category.search'). '?sort=description');
        $responseAsc->assertOk();

        $dataAsc = $responseAsc->json();

        $this::assertEquals($category1->id, $dataAsc[0]['id']);
        $this::assertEquals($category2->id, $dataAsc[1]['id']);

        $responseAsc = $this->get(route('category.search'). '?sort=-description');
        $responseAsc->assertOk();

        $dataAsc = $responseAsc->json();

        $this::assertEquals($category2->id, $dataAsc[0]['id']);
        $this::assertEquals($category1->id, $dataAsc[1]['id']);
    }

    public function testSortNotExistingColumn()
    {
        $category1 = Category::factory([
            'name' => 'JustIN',
            'description' => 'ab',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();
        $category2 = Category::factory([
            'name' => 'JustIN',
            'description' => 'ac',
            'createdDate' => Carbon::now()->subHour(),
            'active' => true,
        ])->create();

        $response = $this->get(route('category.search'). '?name=justin&sort=-opisanie');
        $response->assertOk();

        $data = $response->json();
        $this::assertEquals($category1->id, $data[0]['id']);
        $this::assertEquals($category2->id, $data[1]['id']);
    }

    public function testCreate()
    {
        $response = $this->post(route('category.store'), [
            'name' => 'asd',
            'active' => 'false'
        ]);

        $response->assertOk();
    }

    public function testUpdate()
    {
        $category = Category::factory([
            'name' => 'JustIN',
            'description' => 'ab',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $response = $this->post(route('category.update'), [
            'id' => $category->id,
            'name' => 'new value',
            'description' => 'new value',
        ]);

        //dd($response);
        $response->assertOk();

        $request = $this->get(route('category.find-by-id', ['id' => $category->id]));
        $request->assertOk();

        $data = $request->json();
        $this->assertEquals('new value', $data['name']);
        $this->assertEquals('new value', $data['description']);
    }

    public function testPaging()
    {
        $category1 = Category::factory([
            'name' => 'ab',
            'description' => 'ab',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $category2 = Category::factory([
            'name' => 'ac',
            'description' => 'ab',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $category3 = Category::factory([
            'name' => 'ad',
            'description' => 'ab',
            'createdDate' => Carbon::now(),
            'active' => true,
        ])->create();

        $response = $this->get(route('category.search'). '?pageSize=3');
        $response->assertOk();

        $this::assertCount(3, $response->json());

        $response = $this->get(route('category.search'). '?page=2&pageSize=3');
        $response->assertOk();

        $this::assertCount(0, $response->json());
    }
}
