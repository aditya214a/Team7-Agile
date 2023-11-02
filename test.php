<?php
use PHPUnit\Framework\TestCase;

class test extends TestCase
{
    public function testValidLogin()
    {
        // Simulate a valid login
        $_POST['username'] = 'Aditya';
        $_POST['password'] = 'kdkasd';
        ob_start();
        
        $mockDatabase = $this->getMockBuilder(mysqli::class)
        ->disableOriginalConstructor()
        ->getMock();

        $mockDatabase->method('query')->willReturn(true);

        // Include your PHP script
        include 'login.php';

         // End output buffering and capture the output
        // Capture the output
        $output = ob_get_clean();

        // Add assertions to check the expected behavior, e.g., check if the user is redirected
        // $this->assertContains('Location: index.php', xdebug_get_headers());
        $this->assertTrue('Successful');
        // You can add more assertions as needed
    }

    public function testInvalidUsername()
    {   
        ob_start();
        // Simulate an invalid username
        $_POST['username'] = '45242';
        $_POST['password'] = 'hjshadjh';

        $mockDatabase = $this->getMockBuilder(mysqli::class)
        ->disableOriginalConstructor()
        ->getMock();

        $mockDatabase->method('query')->willReturn(true);

        // Include your PHP script
        include 'login.php';

         // End output buffering and capture the output
        // Capture the output
        $output = ob_get_clean();

        // Add assertions to check the expected behavior, e.g., check if the user is redirected
        // $this->assertContains('Location: index.php', xdebug_get_headers());
        $this->assertTrue('Invalid Username (should be alphanumeric)');
    }

    public function testInvalidPassword()
    {   ob_start();
        // Simulate an invalid password
        $_POST['username'] = 'Aditya';
        $_POST['password'] = '      ';

        $mockDatabase = $this->getMockBuilder(mysqli::class)
        ->disableOriginalConstructor()
        ->getMock();

        $mockDatabase->method('query')->willReturn(true);

        // Include your PHP script
        include 'login.php';

         // End output buffering and capture the output
        // Capture the output
        $output = ob_get_clean();

        // Add assertions to check the expected behavior, e.g., check if the user is redirected
        // $this->assertContains('Location: index.php', xdebug_get_headers());
        $this->assertTrue('Invalid Password only spaces present');

    }

    
    public function testSuccessfulLogin()
    {   ob_start();
        // Simulate a successful login
        $_POST['username'] = 'dhwaniltest';
        $_POST['password'] = 'dhwaniltest@123';

        // Include your PHP script
        include 'login.php';

        // Add assertions to check the expected behavior, e.g., check if the user is redirected and a success message is set
        // $this->assertContains('Location: index.php', xdebug_get_headers());
        // $this->assertContains('Welcome', $_SESSION['success']);
        $this->assertTrue('Successful login');
        // You can add more assertions as needed
    }
}
?>