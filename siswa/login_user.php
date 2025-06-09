<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh login statis admin
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin'] = true;
        header("Location: dashboard_admin.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin - PSB</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-primary mb-6">Login Admin</h2>
    <?php if (!empty($error)) echo "<p class='text-red-500 text-sm mb-4'>$error</p>"; ?>
    <form method="POST">
      <div class="mb-4">
        <label class="block mb-1 text-sm">Username</label>
        <input type="text" name="username" class="w-full px-4 py-2 border rounded" required />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm">Password</label>
        <input type="password" name="password" class="w-full px-4 py-2 border rounded" required />
      </div>
      <button name="login" type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-primary/90">Login</button>
    </form>
  </div>
</body>
</html>
