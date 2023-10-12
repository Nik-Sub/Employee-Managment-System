<?php

//Created by Nikola Šubarić 2020/0271

namespace Tests\Unit;

use Tests\TestCase;

/**
 * This is the test class for testing LogController, LogOutController and createRole method of Admin controller
 * Conditon:
 * Users with this credentials already exists.
 */
class SSU13andSSU14Test extends TestCase
{
    
    /**
     * Test the successful loginSubmit method of LogController.
     * 
     * @return void
     */
    public function testLogInSuccAdmin()
    {

        // Define your test data for login
        $credentials = [
            'email' => 'uros@gmail.com',
            'password' => 'uros123'
        ];

        $this->get('/');

        // Make a POST request to the login route with the test data
        $response = $this->post('loginSubmit', $credentials);

        // Assert that the user is redirected to the desired route
        $response->assertRedirect('allEmployees');

        // assert that this user is admin
        $this->assertTrue(auth()->user()->idrole == 1);
    }

    /**
     * Test the successful loginSubmit method of LogController.
     * 
     * @return void
     */
    public function testLogInSuccManager()
    {

        // Define your test data for login
        $credentials = [
            'email' => 'nikola@gmail.com',
            'password' => 'nikola123'
        ];

        $this->get('/');

        // Make a POST request to the login route with the test data
        $response = $this->post('loginSubmit', $credentials);

        // Assert that the user is redirected to the desired route
        $response->assertRedirect('allEmployees');

        // assert that this user is manager
        $this->assertTrue(auth()->user()->idrole == 2);
    }

    /**
     * Test the successful loginSubmit method of LogController.
     * 
     * @return void
     */
    public function testLogInSuccEmployee()
    {

        // Define your test data for login
        $credentials = [
            'email' => 'boris@gmail.com',
            'password' => 'boris123'
        ];

        $this->get('/');

        // Make a POST request to the login route with the test data
        $response = $this->post('loginSubmit', $credentials);

        // Assert that the user is redirected to the desired route
        $response->assertRedirect('allEmployees');

        // assert that this user is employee
        $this->assertTrue(auth()->user()->idrole == 3);
    }


    /**
     * Test the unsuccessful loginSubmit method of LogController.
     *
     * @return void
     */
    public function testLogInUnsucc()
    {

        // Define your test data for login
        $credentials = [
            'email' => 'nikola@gmail.com',
            'password' => 'nikola'
        ];

        $this->get('/');

        // Make a POST request to the login route with the test data
        $response = $this->post('loginSubmit', $credentials);

        // Assert that the user is redirected to the desired route
        $response->assertRedirect('/');

    }

    /**
     * Test the logout method of LogOutController.
     *
     * @return void
     */
    public function testLogOut()
    {

        // Define your test data for login
        $credentials = [
            'email' => 'nikola@gmail.com',
            'password' => 'nikola123'
        ];

        $this->get('/');

        // Make a POST request to the login route with the test data
        $response = $this->post('loginSubmit', $credentials);

        // Assert that the user is authenticated after successful login
        $this->assertAuthenticated();

        $response = $this->get('logout');

        $response->assertRedirect('/');

    }

    /**
     * Test the createRoleSubmit method of AdminController.
     * Condition:
     *  User must be admin!
     *  Role does not exist!
     * @return void
     */
    public function testCreateRole()
    {

        // Define your test data for login
        $credentials = [
            'email' => 'uros@gmail.com',
            'password' => 'uros123'
        ];

        $this->get('/');

        // Make a POST request to the login route with the test data
        $response = $this->post('loginSubmit', $credentials);

        // Assert that the user is authenticated after successful login
        $this->assertAuthenticated();

        // Define your test data for Role
        $credentials = [
            'name' => 'novaRola'
        ];
        $response = $this->post('/createRoleSubmited', $credentials);
        
        // if we create rola, we will be redirected
        $response->assertRedirect('roleOverview');

    }

}
