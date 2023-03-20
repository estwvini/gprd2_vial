<?php

declare(strict_types=1);

namespace Tests\Feature;

test('the application returns a successful response', function () {

    $response = $this->get('/admin/login');

    $response->assertStatus(200);
});
