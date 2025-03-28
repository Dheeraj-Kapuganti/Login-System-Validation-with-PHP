<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <?php
      session_start();
      
      $email = ""; 
      $password = "";
      $emailMessage = ""; 
      $passwordMessage = "";
      $loginMessage = "";

      if(isset($_POST['submit'])){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailMessage = "<p class='text-green-600'>Valid email address</p>";
        } else {
            $emailMessage = "<p class='text-red-600'>Invalid email address</p>";
        }

        $hasUpper = false;
        $hasLower = false;
        $hasSpecial = false;
        $hasDigit = false;

        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];
            if (ctype_upper($char)) $hasUpper = true;
            if (ctype_lower($char)) $hasLower = true;
            if (ctype_digit($char)) $hasDigit = true;
            if (!ctype_alnum($char)) $hasSpecial = true;
        }

        if(strlen($password) >= 8 && $hasUpper && $hasLower && $hasSpecial && $hasDigit){
            $passwordMessage = "<p class='text-green-600'>Strong password</p>";
            
            // Dummy login validation (replace with database check)
            if ($email == "test@example.com" && $password == "Test@1234") {
                $_SESSION['loggedin'] = true;
                $loginMessage = "<p class='text-green-600 text-center'>Login Successful</p>";
            } else {
                $loginMessage = "<p class='text-red-600 text-center'>Invalid credentials</p>";
            }
        } else {
            $passwordMessage = "<p class='text-red-600'>Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one special character, and one number</p>";
        }
      }
    ?>
    
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>
        <form action="" method="post" class="space-y-4">
            <div>
                <label class="block font-medium">Email</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full p-2 border rounded-md">
                <?php echo $emailMessage; ?>
            </div>
            <div>
                <label class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-md">
                <?php echo $passwordMessage; ?>
            </div>
            <button type="submit" name="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition">
                Submit
            </button>
        </form>
        <?php echo $loginMessage; ?>
    </div>
</body>
</html>
