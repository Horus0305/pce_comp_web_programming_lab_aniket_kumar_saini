<?php
$scale = 0;

session_start();

$name = $_SESSION['name'];

try{
$db_path = "../database/baba.db";
$pdo = new PDO("sqlite:" . $db_path);

$query = $pdo->prepare('SELECT * FROM male WHERE name = :name');
$query->bindValue(':name', $name, PDO::PARAM_STR);
$query->execute();
$male_data = $query->fetchAll(PDO::FETCH_ASSOC);

$query2 = $pdo->prepare('SELECT * FROM female WHERE name = :name');
$query2->bindValue(':name', $name, PDO::PARAM_STR);
$query2->execute();
$female_data = $query2->fetchAll(PDO::FETCH_ASSOC);

if ($male_data) {
    foreach ($male_data as $mData) {
        if ($mData['id'] === NULL || $mData['name'] === NULL || $mData['email'] === NULL || $mData['pass'] === NULL){
            $scale = 0;
            echo "$scale";
        } 

        if ($mData['age'] === NULL || $mData['number'] === NULL || $mData['city'] === NULL || $mData['work'] === NULL || $mData['dob'] === NULL || $mData['pob'] === NULL || $mData['tob'] === NULL){
            $scale = 1;
            echo "$scale";
        }
        
        if($mData['latitude'] === NULL || $mData['longitude'] === NULL || $mData['height'] === NULL || $mData['weight'] === NULL || $mData['bmi'] === NULL || $mData['sign'] === NULL){
            $scale = 2;
            echo "$scale";
        }

        if($mData['photocontent'] === NULL){
            $scale = 3;
            echo "$scale";
        }

        else {
            $scale = 4;
            echo "$scale";
        }
    }
}

else if ($female_data) {
    foreach ($female_data as $fData) {
        if ($fData['id'] === NULL || $fData['name'] === NULL || $fData['email'] === NULL || $fData['pass'] === NULL){
            $scale = 0;
            echo "$scale";
        } 

        if ($fData['age'] === NULL || $fData['number'] === NULL || $fData['city'] === NULL || $fData['work'] === NULL || $fData['dob'] === NULL || $fData['pob'] === NULL || $fData['tob'] === NULL){
            $scale = 1;
            echo "$scale";
        }
        
        if($fData['latitude'] === NULL || $fData['longitude'] === NULL || $fData['height'] === NULL || $fData['weight'] === NULL || $fData['bmi'] === NULL || $fData['sign'] === NULL){
            $scale = 2;
            echo "$scale";
        }

        if($fData['photocontent'] === NULL){
            $scale = 3;
            echo "$scale";
        }

        else {
            $scale = 4;
            echo "$scale";
        }
    }
} 

else {
    echo "no data found";
}
}

catch (Exception $e){
    echo $e->getMessage();
}
?>