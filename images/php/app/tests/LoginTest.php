<?php

use App\Models\Users;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }


    public function testUserLoginsSuccessfully()
    {
        $user = factory(Users::class)->create([
            'first_name' => 'anthony',
            'last_name' => 'helou',
            'email' => 'testlogin@user.com',
            'password' => bcrypt('toptal123'),
            'gender' => 'male',
            'mobile' => '223449',
            'dob' => '1/1/111'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => 'toptal123'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success' => true,
                'data' => [
                    'user_id' => $user->id,
                    'api_token' => $user->api_token,
                ]);

    }
}
