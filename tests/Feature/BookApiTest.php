<?php

it('returns a 200 OK for the books endpoint', function () {
    $response = $this->getJson('/api/books');

    $response->assertStatus(200);
});

