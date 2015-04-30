<?php

use App\Article;
use App\Repositories\ArticleRepository;

class ArticleRepositoryTest extends TestCase
{
    const ARTICLE_COUNT = 100;

    protected $repository = null;

    protected function seedData()
    {
        for ($i = 1; $i <= self::ARTICLE_COUNT; $i++) {
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
        parent::tearDown();
    }

    public function testFetchLatest10Articles()
    {
        $articles = $this->repository->latest10();
        $this->assertEquals(10, count($articles));
    }

    public function testCreatePOST()
    {
        // 因為 seedData 已經 create 100 筆了
        // 所以這裡預設新增後的 id 是 101
        $latestId = self::ARTICLE_COUNT + 1;

        $article = $this->repository->create([
            'title' => 'title '. $latestId,
            'body' => 'body '. $latestId,
        ]);

        $this->assertEquals(self::ARTICLE_COUNT + 1, $article->id);
    }
}
