<?php include_once "header.php" ?>
<?php require_once "config.php";
?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Department:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter department..." /><i class="" aria-hidden="true"></i>

  <form action=""></form>
  <b>Main Function:</b><br />
  <button onclick="window.location='createDepartment.php'" class="nv btn add-new" type="button" data-toggle="tooltip" data-placement="top" title="Add Post" style="float:right; background-color:  #008000">Create
  </button>
  <div class="table-title">
    <div class="row"></div>
  </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="50%"style="background-color:gray">Name</th>
        <th width="50%"style="background-color:gray">Manage</th>
      </tr>
    </thead>
    <tbody>
      <?php //del button on pm 
      include_once("config.php");
      if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $sq = "SELECT categoryName from department WHERE department_Id='$id'";
          $res = mysqli_query($conn, $sq);
          mysqli_query($conn, "DELETE FROM department WHERE department_Id='$id'");
          echo '<meta http-equiv="refresh" content="0;URL =department.php"/>';
        }
      }
      ?>
      <script>
        function deleteConfirm() {
          if (confirm("Do you want to delete?")) {
            return true;
          } else {
            return false;
          }
        }
      </script>
      <?php
      $sql = "SELECT *, row_number() OVER (ORDER BY department_Id) as num FROM department";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <tr>
            <td style="text-align: center"><?php echo $row["departmentName"] ?></td>
            <td>
              <div class="text-center">
                <button class="btn btn-success btn-sm edit" style="background-color:#38b000" type="button" onclick="window.location.href='editdepartment.php?id=<?php echo $row['department_Id']; ?>'">Edit</button>
                </button>
                <button class="btn btn-danger btn-sm delete" style="background-color:red"><a style="color:white" href="?page=pm&&function=del&&id=<?php echo $row["department_Id"]; ?>" onclick="return deleteConfirm()">Delete</button>
              </div>
            </td>
        <?php
        }
      }
        ?>
          </tr>
    </tbody>
  </table>
  <?php include_once "footer.php" ?>