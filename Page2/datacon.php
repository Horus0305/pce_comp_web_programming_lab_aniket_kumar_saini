<?php
$src_path = "D:/xampp/htdocs/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/chatPage/celestial_connections.db";
$pdo = new PDO('sqlite:' . $src_path);

// Profile_info page data:
$username = "Reddy";
$fullName = $_POST["fullName"];
$phoneNumber = $_POST["phoneNumber"];
$birthDate = $_POST["birthDate"];
$gender = "Male";
$address = $_POST["address"];
$city = $_POST["city"];

try {
    $query0 = $pdo->prepare("INSERT INTO Profile_info (username , fullname, phonenumber, birthdate, gender, address, city) VALUES (:username, :fullname, :phonenumber, :birthdate, :gender, :address, :city)");
    $query0->bindParam(':username', $username);
    $query0->bindParam(':fullname', $fullName);
    $query0->bindParam(':phonenumber', $phoneNumber);
    $query0->bindParam(':birthdate', $birthDate);
    $query0->bindParam(':gender', $gender);
    $query0->bindParam(':address', $address);
    $query0->bindParam(':city', $city);
    $query0->execute();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}






// Hobbies and Req pages data:
$hob = $_POST['hobbies'];
$r = $_POST['req'];

try {
    $query1 = $pdo->prepare("INSERT INTO hob_req (username , hobbies, requirements) VALUES (:username, :hob, :req)");
    $query1->bindParam(':username', $username);
    $query1->bindParam(':hob', $hob);
    $query1->bindParam(':req', $r);
    $query1->execute();


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>