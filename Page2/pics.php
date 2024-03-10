<?php
$src_path = "D:/xampp/htdocs/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/chatPage/celestial_connections.db";
$pdo = new PDO('sqlite:' . $src_path);

// Profile Picture Upload:
$username = "ramp";
$file = $_FILES['file'];
$file_name = basename($file["name"]);
$targetDir = "uploads/";
$targetFile = $targetDir . basename($file["name"]);

try{
    $query2 = $pdo->prepare("INSERT INTO Profile_pic (username, image) VALUES (:username, :image)");
    $query2->bindParam(':username', $username);
    $query2->bindParam(':image', $file_name);
    $query2->execute();

    $Picquery = $pdo->prepare("SELECT image FROM Profile_pic WHERE username = :username");
    $Picquery->bindParam(':username', $username);
    $Picquery->execute();

    $images = $Picquery->fetchAll(PDO::FETCH_ASSOC);

    foreach ($images as $image) {
        echo '<img src="uploads/' . $image['image'] . '" alt="Image">';
    }
}
catch (PDOException $e) {
    echo "ERROR: ". $e->getMessage();
}


if (move_uploaded_file($file["tmp_name"], $targetFile)) {
    echo "";
} else {
    echo "";
}

?>