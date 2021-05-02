<?php

declare(strict_types=1);

namespace Unit;

use KanbanBoard\GithubOAuth;
use PHPUnit\Framework\TestCase;

class GithubOAuthTest extends TestCase
{
    /**
     * @test
     */
    public function checkIfGithubBaseUrlValueIsCorrect(): void
    {
        // Create a stub for the GithubOAuth class.
        $stub = $this->createStub(GithubOAuth::class);

        // Configure the stub.
        $stub->method('getBaseUrl')
             ->willReturn('https://github.com/login/oauth');

        $this->assertSame('https://github.com/login/oauth', $stub->getBaseUrl(), 'Incorrect URL! Please check spelling.');
    }
}
