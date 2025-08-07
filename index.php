
  <?php 
// include("includes/header.php")
?>

     <!-- inner page section -->
      <!-- <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Register Now</h3>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
      <!-- end inner page section -->
      <!-- why section -->
      <!-- <section class="why_section layout_padding">       -->
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
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST['name'];
$useremail = $_POST['email'];
$userpassword = $_POST['password'];
$userrole = $_POST['role']; 

$check = $conn->query("SELECT * FROM users WHERE email = '$useremail'");


if($check->num_rows > 0){
  echo "<script>('email already exist');</script>";
  exit;
}

$sql = "INSERT INTO users (name, email, password, role) 
        VALUES ('$username', '$useremail', '$userpassword', '$userrole')";


if($conn->query($sql)){
$_SESSION['email'] = $useremail;
  $_SESSION['role'] = $userrole;


  // redirect based on role 

  if($userrole == 'admin'){
    header(header: "location: admin/dashboard.php");
  }

  else{
    header(header: "location: home.php");
  }

}
}
?>
      
      <div class="register-box">
      <div class="container">
         <!-- form -->
  <div class="register form">

    <form action="" method="POST">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required placeholder="your name">
      </div>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" required placeholder="your email">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required placeholder="create password">
      </div>
      <div class="mb-3">
        <label class="form-label">Register as</label>
        <select class="form-control" name="role" required>
          
          <option value="admin">Admin</option>
          <option value="user">User</option>
          
        </select>
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
  </div>
</div>
</div>

         </div>
      </section>
      <!-- end why section -->
    

<?php 
// include("includes/footer.php")
?>