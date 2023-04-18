<?php include_once "header.php" ?>

<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Post:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter post..." />

  <form action=""></form>
  <b>Main Function:</b><br />
  <button onclick="window.location='CreateFeedback.php'" class="nv btn add-new" type="button" data-toggle="tooltip" data-placement="top" title="Add Post" style="float:right; background-color: #008000">Create
  </button>
  <div class="table-title">
    <div class="row"></div>
  </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="40%"style="background-color:gray">Title</th>
        <th width="10%"style="background-color:gray">Department</th>
        <th width="10%"style="background-color:gray">Category</th>
        <th width="10%"style="background-color:gray">Create Date</th>
        <th width="10%"style="background-color:gray">End Date</th>
        <th width="10%"style="background-color:gray">Manage</th>
      </tr>
    </thead>
    <?php //del button on pm 
    include_once("config.php");
    if (isset($_GET["function"]) == "del") {
      if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT post_Id(s)
                                        FROM post
                                        JOIN category
                                        ON post.category_Id = category.category_Id;";
        mysqli_query($conn, "DELETE FROM post WHERE post_Id='$id'");
        echo '<meta http-equiv="refresh" content="0;URL =listpost.php"/>';
      }
    }
    ?>
    <tbody>
      <?php
      $sql = "SELECT post.*, category.categoryName, department.departmentName, row_number() OVER (ORDER BY post_Id) as num
          FROM post INNER JOIN category ON post.category_Id = category.category_Id
          INNER JOIN department ON department.department_Id = post.department_Id ";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <tr>
          <td><?php echo $row["title"] ?></td>
          <td style="text-align: center"><?php echo $row["departmentName"] ?></td>
          <td style="text-align: center"><?php echo $row["categoryName"] ?></td>

          <td style="text-align: center"><?php echo $row["date_create"] ?></td>
          <td style="text-align: center"><?php echo $row["date_ending"] ?></td>

          <td>
            <div class="text-center">
              <button class="btn btn-primary btn-sm edit" style="background-color:#38b000"type="button" onclick="window.location.href='editpost.php?id=<?php echo $row['post_Id']; ?>'">
Edit              </button>
              <button class="btn btn-primary btn-sm edit" style="background-color:red"><a style="color:white" href="?&&function=del&&id=<?php echo $row["post_Id"]; ?>" onclick="return deleteConfirm()">Delete</button>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <script>
        function deleteConfirm() {
          if (confirm("Do you want to delete?")) {
            return true;
          } else {
            return false;
          }
        }
      </script>
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