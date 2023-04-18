<!DOCTYPE html>
<html>

<head>
  <title>Edit Post</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    h1 {
      color: #333;
      text-align: center;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
      max-width: 500px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #555;
    }

    input[type='text'],
    textarea {
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
      font-size: 16px;
      margin-bottom: 20px;
    }

    input[type='file'] {
      margin-bottom: 20px;
    }

    input[type='submit'] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type='submit']:hover {
      background-color: #555;
    }

    .preview-image {
      max-width: 100%;
      margin-top: 10px;
    }
    input[type='submit']:hover {
      background-color: #555;
    }
    input[type='button'] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type='buton']:hover {
      background-color: #555;
    }
  </style>
</head>

<body>
  <h1>Edit Post</h1>
  <?php
  include_once("config.php"); // Kết nối đến cơ sở dữ liệu
  function bind_Category_List($conn, $selectedValue)
  {
    $sqlString = "SELECT * from category";
    $result = mysqli_query($conn, $sqlString);
    echo "<SELECT name ='CategoryList' class='from-control'>
			<option value='0'>Choose Category</option>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      if ($row['category_Id'] == $selectedValue) {
        echo "<option value ='" . $row['category_Id'] . "' selected>" . $row['categoryName'] . "</option>";
      } else {
        echo "<option value='" . $row['category_Id'] . "'>" . $row['categoryName'] . "</option>";
      }
    }
    echo "</select>";
  }
  function bind_Department_List($conn, $selectedValue)
  {
    $sqlString = "SELECT * from department";
    $result = mysqli_query($conn, $sqlString);
    echo "<SELECT name ='DepartmentList' class='from-control'>
			<option value='0'>Choose Department</option>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      if ($row['department_Id'] == $selectedValue) {
        echo "<option value ='" . $row['department_Id'] . "' selected>" . $row['departmentName'] . "</option>";
      } else {
        echo "<option value='" . $row['department_Id'] . "'>" . $row['departmentName'] . "</option>";
      }
    }
    echo "</select>";
  }
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlString = "SELECT * from post where post_Id='$id'";

    $result = mysqli_query($conn, $sqlString);
    $row = mysqli_fetch_array($result);

  ?>

    <form action="" method="post" enctype="multipart/form-data">

      <label for="title">Title:</label>
      <input type="text" id="title" name="title" value="<?php echo $row["title"] ?>"   required> </input>

      <div class="form-group col-md-3">
        <label for="exampleSelect1" class="control-label">Category</label>
        <?php bind_Category_List($conn, $row['category_Id']); ?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="exampleSelect1" class="control-label">Department</label>
        <?php bind_Department_List($conn, $row['department_Id']); ?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="enddate">End submit :</label>
        <input type="datetime-local" id="enddate" name="enddate" value="<?php echo $row["date_ending"] ?>" />
      </div>
      <div class="form-group col-md-3">
        <label for="enddate">End comment:</label>
        <input type="datetime-local" id="enddatecmt" name="enddatecmt" value="<?php echo $row["date_end_read"] ?>" />
      </div>
      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="5" cols="50"  required><?php echo $row["content"] ?></textarea>

      <br />
      <input type="submit" name="btnUpdate" value="Post" />
      <input type="button" value="Cancel" onclick="window.location='listpost.php'" />
    </form>
  <?php
    if (isset($_POST["btnUpdate"])) { // Kiểm tra xem form đã được submit hay chưa
      $title = $_POST["title"];
      $category = $_POST['CategoryList'];
      $department = $_POST['DepartmentList'];
      $date_ending = $_POST['enddate'];
      $date_end_read = $_POST['enddatecmt'];
      $content = $_POST['content'];
      $err = "";

      $sqlstring = "UPDATE post SET 
      title='$title',
      date_ending = '$date_ending',
      date_end_read = '$date_end_read',
      content='$content',
      department_Id='$department',
      category_Id = '$category'
      where post_Id ='$id'";
      if (mysqli_query($conn, $sqlstring)) { // Thực hiện truy vấn SQL để thêm sản phẩm mới vào cơ sở dữ liệu
        echo "Add successfully";
      }
    }
  }
  ?>
</body>

</html>