<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }
    
    .header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }
    
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 15px;
      font-size: 16px;
    }
    
    .input-group {
      margin-bottom: 20px;
	  margin-right: 20px
    }
    
    .btn {
      background-color: black;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px;
    }
    
    .btn:hover {
      background-color: #45a049;
    }
    
    .error {
      background-color: #f44336;
      color: white;
      padding: 10px;
      margin-bottom: 15px;
      text-align: center;
      border-radius: 3px;
    }
  </style>
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="email" name="username">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  </form>
</body>
</html>
