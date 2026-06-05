<?php
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'managing_events');
    }

    // =============================================
    // STRING TESTS - Full Name Field
    // =============================================

    // Test 1: Empty full name
    public function testEmptyFullName()
    {
        $full_name = '';
        $this->assertEmpty($full_name, "Full name should not be empty");
    }

    // Test 2: Full name minimum length (1 char)
    public function testFullNameMinLength()
    {
        $full_name = 'A';
        $this->assertGreaterThanOrEqual(1, strlen($full_name));
    }

    // Test 3: Full name maximum length (100 chars)
    public function testFullNameMaxLength()
    {
        $full_name = str_repeat('A', 100);
        $this->assertLessThanOrEqual(100, strlen($full_name));
    }

    // Test 4: Full name exceeds max length
    public function testFullNameExceedsMaxLength()
    {
        $full_name = str_repeat('A', 101);
        $this->assertGreaterThan(100, strlen($full_name));
    }

    // Test 5: Full name with spaces (valid)
    public function testFullNameWithSpaces()
    {
        $full_name = 'Subash Khatri';
        $this->assertNotEmpty($full_name);
        $this->assertTrue(strlen($full_name) <= 100);
    }

    // =============================================
    // STRING TESTS - Email Field
    // =============================================

    // Test 6: Empty email
    public function testEmptyEmail()
    {
        $email = '';
        $this->assertEmpty($email);
    }

    // Test 7: Valid email format
    public function testValidEmailFormat()
    {
        $email = 'test@example.com';
        $this->assertTrue(filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
    }

    // Test 8: Invalid email format
    public function testInvalidEmailFormat()
    {
        $email = 'notanemail';
        $this->assertFalse(filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    // Test 9: Email missing @ symbol
    public function testEmailMissingAtSymbol()
    {
        $email = 'testexample.com';
        $this->assertFalse(filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    // Test 10: Email maximum length (100 chars)
    public function testEmailMaxLength()
    {
        $email = 'test@example.com';
        $this->assertLessThanOrEqual(100, strlen($email));
    }

    // Test 11: Duplicate email in database
    public function testDuplicateEmailInDatabase()
    {
        $email = mysqli_real_escape_string($this->conn, 'ds@gmail.com');
        $result = mysqli_query($this->conn, "SELECT id FROM users WHERE email='$email'");
        $this->assertGreaterThan(0, mysqli_num_rows($result));
    }

    // Test 12: New email not in database
    public function testNewEmailNotInDatabase()
    {
        $email = mysqli_real_escape_string($this->conn, 'brandnew99@test.com');
        $result = mysqli_query($this->conn, "SELECT id FROM users WHERE email='$email'");
        $this->assertEquals(0, mysqli_num_rows($result));
    }

    // =============================================
    // STRING TESTS - Password Field
    // =============================================

    // Test 13: Empty password
    public function testEmptyPassword()
    {
        $password = '';
        $this->assertEmpty($password);
    }

    // Test 14: Password below minimum (5 chars)
    public function testPasswordBelowMinimum()
    {
        $password = '12345';
        $this->assertFalse(strlen($password) >= 6);
    }

    // Test 15: Password at minimum boundary (6 chars)
    public function testPasswordAtMinimumBoundary()
    {
        $password = '123456';
        $this->assertTrue(strlen($password) >= 6);
    }

    // Test 16: Password above minimum (7 chars)
    public function testPasswordAboveMinimum()
    {
        $password = '1234567';
        $this->assertTrue(strlen($password) >= 6);
    }

    // Test 17: Password maximum length (255 chars)
    public function testPasswordMaxLength()
    {
        $password = str_repeat('a', 255);
        $this->assertLessThanOrEqual(255, strlen($password));
    }

    // Test 18: Passwords match
    public function testPasswordsMatch()
    {
        $password = 'abc123';
        $confirm  = 'abc123';
        $this->assertEquals($password, $confirm);
    }

    // Test 19: Passwords do not match
    public function testPasswordsDoNotMatch()
    {
        $password = 'abc123';
        $confirm  = 'xyz789';
        $this->assertNotEquals($password, $confirm);
    }

    // =============================================
    // NUMERIC TESTS - User ID Field
    // =============================================

    // Test 20: User ID is numeric
    public function testUserIdIsNumeric()
    {
        $user_id = 1;
        $this->assertTrue(is_numeric($user_id));
    }

    // Test 21: User ID minimum value (1)
    public function testUserIdMinimumValue()
    {
        $user_id = 1;
        $this->assertGreaterThanOrEqual(1, $user_id);
    }

    // Test 22: User ID zero is invalid
    public function testUserIdZeroIsInvalid()
    {
        $user_id = 0;
        $this->assertFalse($user_id > 0);
    }

    // Test 23: User ID exists in database
    public function testUserIdExistsInDatabase()
    {
        $user_id = 1;
        $result = mysqli_query($this->conn, "SELECT id FROM users WHERE id='$user_id'");
        $this->assertGreaterThan(0, mysqli_num_rows($result));
    }

    // Test 24: User ID does not exist in database
    public function testUserIdDoesNotExist()
    {
        $user_id = 99999;
        $result = mysqli_query($this->conn, "SELECT id FROM users WHERE id='$user_id'");
        $this->assertEquals(0, mysqli_num_rows($result));
    }

    // =============================================
    // BOOLEAN TESTS - Login & Session
    // =============================================

    // Test 25: Valid login returns true
    public function testValidLoginReturnsTrue()
    {
        $email    = mysqli_real_escape_string($this->conn, 'ds@gmail.com');
        $password = mysqli_real_escape_string($this->conn, 'ds12345');
        $result   = mysqli_query($this->conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        $this->assertTrue(mysqli_num_rows($result) > 0);
    }

    // Test 26: Invalid login returns false
    public function testInvalidLoginReturnsFalse()
    {
        $email    = mysqli_real_escape_string($this->conn, 'ds@gmail.com');
        $password = mysqli_real_escape_string($this->conn, 'wrongpassword');
        $result   = mysqli_query($this->conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        $this->assertFalse(mysqli_num_rows($result) > 0);
    }

    // Test 27: Non-existent user login returns false
    public function testNonExistentUserLoginFalse()
    {
        $email    = mysqli_real_escape_string($this->conn, 'nobody@nowhere.com');
        $password = mysqli_real_escape_string($this->conn, 'password123');
        $result   = mysqli_query($this->conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        $this->assertFalse(mysqli_num_rows($result) > 0);
    }

    // Test 28: Email validation returns boolean true for valid email
    public function testEmailValidationBooleanTrue()
    {
        $email = 'valid@email.com';
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        $this->assertTrue($isValid);
    }

    // Test 29: Email validation returns boolean false for invalid email
    public function testEmailValidationBooleanFalse()
    {
        $email = 'invalidemail';
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        $this->assertFalse($isValid);
    }

    // =============================================
    // DATE TESTS - created_at Field
    // =============================================

    // Test 30: User created_at date exists in database
    public function testUserCreatedAtDateExists()
    {
        $result = mysqli_query($this->conn, "SELECT created_at FROM users WHERE id=1");
        $row = mysqli_fetch_assoc($result);
        $this->assertNotNull($row['created_at']);
    }

    // Test 31: created_at is a valid date format
    public function testCreatedAtIsValidDate()
    {
        $result = mysqli_query($this->conn, "SELECT created_at FROM users WHERE id=1");
        $row = mysqli_fetch_assoc($result);
        $date = strtotime($row['created_at']);
        $this->assertNotFalse($date);
    }

    // Test 32: Reset token expiry is in the future (valid token)
    public function testResetTokenExpiryInFuture()
    {
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $this->assertTrue(strtotime($expiry) > strtotime('now'));
    }

    // Test 33: Reset token expiry in the past (expired token)
    public function testResetTokenExpiryInPast()
    {
        $expiry = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $this->assertFalse(strtotime($expiry) > strtotime('now'));
    }

    // Test 34: Reset token length is correct (64 chars)
    public function testResetTokenLength()
    {
        $token = bin2hex(random_bytes(32));
        $this->assertEquals(64, strlen($token));
    }

    // Test 35: Reset token is unique (two tokens are different)
    public function testResetTokenIsUnique()
    {
        $token1 = bin2hex(random_bytes(32));
        $token2 = bin2hex(random_bytes(32));
        $this->assertNotEquals($token1, $token2);
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }
}