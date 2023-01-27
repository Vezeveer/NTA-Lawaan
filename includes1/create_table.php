<?php

require_once 'databasehandler.inc.php';

$query1 = "CREATE TABLE `year_{$_POST['year']}` (`id` INT(6) NOT NULL AUTO_INCREMENT , `project` VARCHAR(100) NOT NULL , `approved` BOOLEAN NOT NULL , `aipRefCode` VARCHAR(20) NOT NULL , `activityDesc` VARCHAR(50) NOT NULL , `impOffice` VARCHAR(50) NOT NULL , `startDate` DATE NOT NULL , `endDate` DATE NOT NULL , `expectedOutput` VARCHAR(50) NOT NULL , `fundingServices` DECIMAL NOT NULL , `personalServices` DECIMAL NOT NULL , `maint` DECIMAL NOT NULL , `capitalOutlay` DECIMAL NOT NULL , `total` DECIMAL NOT NULL , PRIMARY KEY (`id`));";

$query2 = "INSERT INTO `status` (`status`, year, active) VALUES ('bdc_initializing', '{$_POST['year']}', '1');";

$query = $query1.$query2;

// Execute multiple queries
if (mysqli_multi_query($conn, $query)) {
    header("location: ../dashboard.php");
} else {
    echo "Error executing queries: " . mysqli_error($conn);
}

mysqli_close($conn);