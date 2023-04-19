<?php 

$sql = "SELECT date_ending FROM post";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  
  while($row = mysqli_fetch_assoc($result)) {
    $date_end = $row["date_ending"];
  }
} else {
  echo "No data";
}


date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time() + 7 * 60 * 60; 
if (strtotime($date_end) >= $timestamp) {
  echo "Error";
} else {
  echo "Error";
}

mysqli_close($conn);
?>