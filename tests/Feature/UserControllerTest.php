<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" =>"khannedy"
        ])->get('/login')
            ->assertRedirect("/");
    }


    public function testLogin()
    {
        $this->post('/login', [
            "user" => "khannedy",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "khannedy");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "khannedy"
        ])->post('/login', [
            "user" => "khannedy",
            "password" => "rahasia"
        ])->assertRedirect("/");
    }

    public function testLoginValidationErrror()
    {
        $this->post('/login', [])
            ->assertSeeText("user or password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("user or password is Wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "khannedy",
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/");

    }
}
