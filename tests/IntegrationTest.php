<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\DB;

class IntegrationTest extends TestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollback();
        parent::tearDown();
    }
}
