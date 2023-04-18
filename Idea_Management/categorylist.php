<?php include_once "header.php" ?>
<?php require_once "config.php";
?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Category:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter category..." /><i class="" aria-hidden="true"></i>

  <form action=""></form>
  <b>Main Function:</b><br />
  <button onclick="window.location='CreateCategory.php'" class="nv btn add-new" type="button" data-toggle="tooltip" data-placement="top" title="Add Post" style="float:right; background-color: #008000">Create  
   </button>
  <div class="table-title">
    <div class="row"></div>
  </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="50%" style="background-color:gray">Name</th>
        <th width="30%" style="background-color:gray">Manage</th>
      </tr>
    </thead>
    <tbody>
      <?php //del button on pm 
      include_once("config.php");
      if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $sq = "SELECT categoryName from category WHERE category_Id='$id'";
          $res = mysqli_query($conn, $sq);
          mysqli_query($conn, "DELETE FROM category WHERE category_Id='$id'");
          echo '<meta http-equiv="refresh" content="0;URL =categorylist.php"/>';
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
      $sql = "SELECT *, row_number() OVER (ORDER BY category_Id) as num FROM category";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <tr>
            <td style="text-align: center"><?php echo $row["categoryName"] ?></td>
            <td>
              <div class="text-center">
                <button class="btn btn-primary btn-sm edit" style="background-color: #38b000"type="button" onclick="window.location.href='editcategory.php?id=<?php echo $row['category_Id']; ?>'">

Edit                </button>
               <button class="btn btn-primary btn-sm edit" style="background-color: red"> <a style="color:white" href="?page=pm&&function=del&&id=<?php echo $row["category_Id"]; ?>" onclick="return deleteConfirm()"> Delete </button>
              </div>
            </td>
        <?php
        }
      }
        ?>
          </tr>
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