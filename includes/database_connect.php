<?php
   $db = new PDO('sqlite:../database/baba.db');
   $db->exec("PRAGMA foreign_keys = ON;");
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $conn = $db;
?>