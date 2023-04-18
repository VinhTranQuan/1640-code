<?php include_once "header.php";
include_once("config.php"); ?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search QA name:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter department name..." /><i class="" aria-hidden="true"></i>


    <div class="table-title">
      <div class="row"></div>
    </div>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr class="ex">
        <th width="20%"style="background-color:gray">Full Name</th>
          <th width="10%"style="background-color:gray">Gender</th>
          <th width="10%"style="background-color:gray">Date of birth</th>
          <th width="20%"style="background-color:gray">Address</th>
          <th width="10%"style="background-color:gray">Phone number</th>
          <th width="20%"style="background-color:gray">Email</th>
          <th width="20%"style="background-color:gray">Manage</th>

        </tr>
      </thead>
      <?php //del button on pm 
      include_once("config.php");
      if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $sql = "SELECT * FROM account";
          mysqli_query($conn, "DELETE FROM account WHERE account_Id='$id' AND role='1'");
          echo '<meta http-equiv="refresh" content="0;URL =listpost.php"/>';
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
      <tbody>
        <?php
        $sql = "SELECT * FROM account WHERE role ='1'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
              <td><?php echo $row["fullname"] ?></td>
              <td style="text-align: center"><?php echo $row["gender"] ?></td>
              <td style="text-align: center"><?php echo $row["date_of_birth"] ?></td>
              <td style="text-align: center"><?php echo $row["address"] ?></td>

              <td style="text-align: center"><?php echo $row["phone"] ?></td>

              <td style="text-align: center"><?php echo $row["email"] ?></td>
              <td>
                <div class="text-center">
                  <button class="btn btn-primary btn-sm edit" style="background-color:#38b000" type="button" onclick="window.location.href='editstaff.php?id=<?php echo $row['account_Id']; ?>'">Edit</button>
                 <button class="btn btn-primary btn-sm edit" style="background-color:red"> <a style="color:white" href="?&&function=del&&id=<?php echo $row["account_Id"]; ?>" onclick="return deleteConfirm()">Delete</button>
                </div>
              </td>
            </tr>
        <?php
          }
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