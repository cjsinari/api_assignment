
<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// DB configuration
$host = 'localhost';
$dbname = 'user_data';
$username = 'root';
$password = '';

// Connect to the database using PDO & OOP
class Database {
    private $pdo;
    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error connecting to the database: " . $e->getMessage());
        }
    }

    public function insertUser($username, $email, $passwordHash, $token) {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, token) VALUES (:username, :email, :password, :token)");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $passwordHash,
            ':token' => $token
        ]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$db = new Database($host, $dbname, $username, $password);

// Input Validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Password hashing
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Implement 2FA (Generate Token)
    $token = rand(100000, 999999);

    // Check if email already exists
    if ($db->getUserByEmail($email)) {
        echo "Email already exists.";
        exit;
    }

    // Store data in the database
    $db->insertUser($username, $email, $passwordHash, $token);

    // Here you would normally send the token via email or SMS
    echo "Registration successful. Your 2FA code is: " . $token;

    // Redirect to the verification page (not implemented here)
}
?>
