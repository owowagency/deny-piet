<?php

namespace OwowAgency\DenyPiet\Tests\Unit;

use Illuminate\Foundation\Auth\User;
use OwowAgency\DenyPiet\Tests\TestCase;
use OwowAgency\DenyPiet\Middleware\DenyAccessToPiet;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MiddlewareTest extends TestCase
{
    /** @test */
    public function it_denies_piet_access(): void
    {
        $this->expectException(HttpException::class);

        $middleware = new DenyAccessToPiet();

        // Log in as Pieter-Jan.
        $this->actingAs($this->createUser('pieterjan@owow.io'));

        $middleware->handle(request(), function () {});
    }

    /** @test */
    public function it_gives_everybody_else_access(): void
    {
        $middleware = new DenyAccessToPiet();

        // Log in as Dees.
        $this->actingAs($this->createUser('dees@owow.io'));

        $response = $middleware->handle(request(), function () { return true; });

        $this->assertTrue($response);
    }

    /**
     * Creates a new user.
     *
     * @param  string  $email
     * @return \Illuminate\Foundation\Auth\User
     */
    protected function createUser(string $email): User
    {
        $user = new User();
        $user->email = $email;
        $user->name = $email;

        return $user;
    }
}
