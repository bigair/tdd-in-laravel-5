<?php

use App\Article;
use App\Repositories\ArticleRepository;

class ArticleRepositoryTest extends TestCase
{
    protected $repository = null;

    protected function seedData()
    {
        for ($i = 1; $i <= 100; $i++) {
            Article::create([
                'title' => 'title ' . $i,
                'body'  => 'body' . $i,
            ]);
        }
    }

    public function setUp()
    {
        parent::setUp();

        $this->initDatabase();
        $this->seedData();

        $this->repository = new ArticleRepository();
    }

    public function tearDown()
    {
        $this->resetDatabase();
        $this->repository = null;
    }

    public function testFetchLatest10Articles()
    {
        $articles = $this->repository->latest10();
        $this->assertEquals(10, count($articles));
    }
}
