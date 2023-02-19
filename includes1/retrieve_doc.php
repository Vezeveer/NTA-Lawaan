<?php

require 'databasehandler.inc.php';

$sql = "SELECT * FROM docs";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo '<img src="data:image/png;base64,'.base64_encode($row['img_data']).'"/>';
}