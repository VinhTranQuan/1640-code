<?php include_once "header.php" ?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Feedback:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter feedback..." />

    <form action=""></form>
   
    <div class="table-title">
      <div class="row"></div>
    </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="30%"style="background-color:gray">Post Title</th>
        <th width="10%" style="background-color:gray">Feedback</th>
        <th width="20%" style="background-color:gray">Category</th>
        <th width="20%" style="background-color:gray">Department</th>
        <th width="20%" style="background-color:gray">Day Submited</th>
        <th width="20%" style="background-color:gray">Comment</th>
        <th width="10%" style="background-color:gray">Date end comment</th>
      </tr>
    </thead>
    <?php
    include_once("config.php");
    if (isset($_SESSION["username"])) {
      $us = $_SESSION["username"];
      $sqlString = "SELECT * from account where email= '$us'";
      $result = mysqli_query($conn, $sqlString);
      $row2 = mysqli_fetch_array($result);
      $department = $row2["department_Id"];
      $account = $row2["account_Id"];
    }
    if ($row2["role"] == 1) {
      // Show all posts, regardless of department
      $sql = "SELECT tp.*, tc.categoryName, td.departmentName
              FROM post tp, category tc, department td
              WHERE tp.category_Id = tc.category_Id 
                AND tp.department_Id = td.department_Id";
    } else {
      $sql = "SELECT tp.*, tc.categoryName, td.departmentName
            FROM post tp, category tc, department td
            WHERE tp.category_Id = tc.category_Id 
              AND tp.department_Id = td.department_Id 
              AND tp.department_Id = '$department'";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
      <tbody>
        <tr>
          <td><?php echo $row["title"] ?></td>
          <td>
          <?php

// Kiểm tra date_end với ngày hiện tại
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time() + 7 * 60 * 60; // Cộng thêm 7 giờ để đổi sang múi giờ GMT+7
if (strtotime($row["date_ending"]) >= $timestamp) {
?>

  <button style="margin-left: auto; margin-right: auto; display: block" onclick="window.location.href='feedback.php?id=<?php echo $row['post_Id']; ?>'">
    Feedback
  </button>

<?php
} else {
  echo "Out of date";
}

?>
          </td>
          <td style="text-align: center"><?php echo $row["categoryName"] ?></td>
          <td style="text-align: center"><?php echo $row["departmentName"] ?></td>
          <td style="text-align: center"><?php echo $row["date_ending"] ?></td>
          <td style="text-align: center"><?php echo $row["date_end_read"] ?></td>

          <td>
          <?php

// Kiểm tra date_end với ngày hiện tại
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time() + 7 * 60 * 60; // Cộng thêm 7 giờ để đổi sang múi giờ GMT+7
if (strtotime($row["date_end_read"]) >= $timestamp) {
?>

  <button style="margin-left: auto; margin-right: auto; display: block" onclick="window.location.href='listfeedback.php?id=<?php echo $row['post_Id']; ?>'">
    Comment

  <?php
} else {
  echo "Out of date comment";
}

  ?>
</td>
          </td>
        </tr>
      <?php
    }
      ?>
      </tbody>
  </table>
  <script>
function myFunction() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}
</script>
  <?php include_once "footer.php" ?>