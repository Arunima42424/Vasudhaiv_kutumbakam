<?php
include "db.php";


$name = $_POST['userName'];
$email = $_POST['userEmail'];
$phone = $_POST['userPhone'];

$item_name = $_POST['bookName'];
$item_type = $_POST['authorName'];
$item_condition = $_POST['condition'];

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$address = $_POST['address'];

// Image upload handling
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$image_name = time() . "_" . basename($_FILES["bookImage"]["name"]);
$target_file = $target_dir . $image_name;

move_uploaded_file($_FILES["bookImage"]["tmp_name"], $target_file);

// Insert into database
$sql = "INSERT INTO donations (name, email, phone, item_name, item_type, item_condition, latitude, longitude, address, image_path)
        VALUES ('$name', '$email', '$phone', '$item_name', '$item_type', '$item_condition', '$latitude', '$longitude', '$address', '$target_file')";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Donation Submitted Successfully!</h2>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
