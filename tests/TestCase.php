<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Empêche Vite de chercher le manifest de build pendant les tests.
        // Sans ça, toutes les vues qui utilisent @vite() lancent une exception
        // et retournent 500 au lieu du vrai statut HTTP.
        $this->withoutVite();
    }
}
