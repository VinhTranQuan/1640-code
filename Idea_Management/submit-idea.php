<?php
include_once("config.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sqlString = "SELECT * from post where post_Id='$id'";

  $result = mysqli_query($conn, $sqlString);
  $row = mysqli_fetch_array($result);
  if (isset($_SESSION["username"])) {
    $us = $_SESSION["username"];
    $sqlString = "SELECT * from account where email= '$us'";
    $result = mysqli_query($conn, $sqlString);
    $row2 = mysqli_fetch_array($result);
    $department = $row2["department_Id"];
    $account = $row2["account_Id"];
  }
?>
  <div id="contact-form" class="cf hidden">
    <form method="POST" enctype="multipart/form-data">
      <div class="half left cf">
        <label class="input-title" for="input-title">Title:</label>
        <input type="text" name="" id="input-name" value="<?php echo $row['title']; ?>" />
        <input type="file" name="file" id="input-subject" />
        <select id="input-select" name="anonymous">
          <option value="anonymous">Anonymous</option>
          <option value="<?php echo $row2['fullname']; ?>">Name</option>
        </select>
      </div>
      <textarea name="feedback" type="text" id="input-message" placeholder="Message"></textarea>
      <input type="submit" value="Submit" name="postIdea" id="input-submit" />
    </form>
  </div>
<?php }


if (isset($_POST['postIdea'])) {

  
  $file_name = $_FILES['file']['name'];
  $temp_file = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_type = $_FILES['file']['type'];

 
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($file_name);

  
  $allowed_types = array('application/pdf', 'image/jpeg', 'image/png', 'image/gif', 'text/plain');

  
  if (in_array($file_type, $allowed_types)) {
    
    if (move_uploaded_file($temp_file, $target_file)) {
   
      $anonymous = $_POST['anonymous'];
      $feedback = $_POST['feedback'];

      
      $sql = "INSERT INTO feedback (post_Id, anonymous, feedback, file_name, file_path, department_Id, account_Id, likes) 
      VALUES ('$id', '$anonymous', '$feedback', '$file_name', '$target_file', '$department', '$account', '0')";

      if (mysqli_query($conn, $sql)) {
        echo '<meta http-equiv="refresh" content="0;"';
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    } else {
      echo "Error when download file.";
    }
  } else {
    echo "Error file type.";
  }

 
  mysqli_close($conn);
}


?>