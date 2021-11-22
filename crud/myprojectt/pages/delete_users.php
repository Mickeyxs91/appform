<?php
$user_id = $_GET['id'];

//Instantiate Database object
$database = new Database;
//Query
$database->query('delete from users where id = :id');
$database->bind(':id',$user_id);
$row = $database->single();


$database->query('select * from users where id =:idd');
$database->bind(':idd',$user_id);
$roww = $database->single();
echo '<p>user'. $roww['id'].'is deleted</p>';
?>