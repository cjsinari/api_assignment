<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Register</h2>
<div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <form action="register.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="d-grid">
            <input type="submit" value="Register" class="btn btn-primary">
        </div>
    </form>
</div>
</body>
</html>