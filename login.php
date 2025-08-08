
<style>
.register-box {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 50px 0;
  background: #f5f7fa;
}

.register-box .container {
  width: 100%;
  max-width: 400px;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.register-box h3 {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
  text-align: center;
}

.register-box .form-label {
  font-weight: 500;
  display: block;
  margin-bottom: 6px;
}

.register-box .form-control {
  width: 100%;
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  margin-bottom: 15px;
  font-size: 14px;
}

.register-box .form-control:focus {
  border-color: #007bff;
  outline: none;
}

.register-box .btn {
  width: 100%;
  background: #007bff;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 16px;
}

.register-box .btn:hover {
  background: #0056b3;
}

.register-box select.form-control {
  padding: 10px;
  font-size: 14px;
  height: auto;
  line-height: 1.5;

}

</style>

<?php 
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];

    $sql = $conn->query("SELECT * FROM users WHERE email = '$useremail'");

    if ($sql && $sql->num_rows == 1) {
        $userrow = $sql->fetch_assoc();

        // Assuming your DB has a 'password' and 'role' column
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userrole = $userrow['role'];

        if (password_verify($userpassword, $hashedPassword)) {
            $_SESSION['email'] = $useremail;
            $_SESSION['role'] = $userrole;

            // redirect based on role
            if ($userrole == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: home.php");
            }
            exit;
        } else {
            echo "<script>alert('Invalid password'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Email not found'); window.location='login.php';</script>";
    }
}
?>





<div class="register-box">
      <div class="container">
         <!-- form -->
  <div class="register form">

    <form action="" method="POST">
     
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" required placeholder="your email">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required placeholder="Enter password">
      </div>
     
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <p class="text-center mt-3">Do not have an account? <a href="index.php">Register Here</a></p>
    </form>
  </div>
</div>
</div>

         </div>