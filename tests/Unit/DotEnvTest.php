<?php

declare(strict_types=1);

namespace Unit;

use PHPUnit\Framework\TestCase;

class DotEnvTest extends TestCase
{
    /**
     * @test
     */
    public function envFileExists(): void
    {
        $this->assertFileExists('.env', 'Please add `.env` file to root of project.');
    }
}
