<?php

namespace OwowAgency\DenyPiet\Tests\Unit;

use OwowAgency\DenyPiet\Tests\TestCase;
use OwowAgency\DenyPiet\Rules\PietNotAllowed;

class RuleTest extends TestCase
{
    /** @test */
    public function it_denies_piet_access(): void
    {
        $rules = new PietNotAllowed();

        // Booooooooooooooh!
        $email = 'pieterjan@owow.io';

        $this->assertFalse($rules->passes('email', $email));
    }

    /** @test */
    public function it_gives_everybody_else_access(): void
    {
        $rules = new PietNotAllowed();

        // He's such a nice guy!
        $email = 'dees@owow.io';

        $this->assertTrue($rules->passes('email', $email));
    }
}
