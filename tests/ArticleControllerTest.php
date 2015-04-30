<?php

class ArticleControllerTest extends TestCase {

    public function testArticleList()
    {
        $this->call('GET', '/articles');

        $this->assertResponseOk();

        $this->assertViewHas('articles');
    }

}
