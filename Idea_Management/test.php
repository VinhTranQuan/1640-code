<?php 
// Lấy dữ liệu date_end từ cơ sở dữ liệu
$sql = "SELECT date_ending FROM post";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Lặp qua các hàng để lấy giá trị date_end
  while($row = mysqli_fetch_assoc($result)) {
    $date_end = $row["date_ending"];
  }
} else {
  echo "Không có dữ liệu";
}

// Kiểm tra date_end với ngày hiện tại
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time() + 7 * 60 * 60; // Cộng thêm 7 giờ để đổi sang múi giờ GMT+7
if (strtotime($date_end) >= $timestamp) {
  echo "Thiết bị đã quá hạn sử dụng";
} else {
  echo "Thiết bị còn hạn sử dụng";
}

mysqli_close($conn);
?>