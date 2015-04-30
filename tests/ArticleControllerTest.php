<?php

class ArticleControllerTest extends TestCase {

    protected $repositoryMock = null;

    public function setUp()
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock('App\Repositories\ArticleRepository');
        $this->app->instance('App\Repositories\ArticleRepository', $this->repositoryMock);
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testArticleList()
    {
        $this->repositoryMock
            ->shouldReceive('latest10')
            ->once()
            ->andReturn([]);

        $this->call('GET', '/articles');
        $this->assertResponseOk();

        // 應取得 articles 變數
        $this->assertViewHas('articles', []);
    }

    public function testCsrfFailed()
    {
        $this->call('POST', 'articles');
        $this->assertResponseStatus(500);
    }

}
