<?php
include_once('config.php');
session_start();
global $pdo;
$sql = "SELECT Title FROM Postovi";
$stmt = $pdo->query($sql);
$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
//fetch= array_values($fetch);

foreach($fetch as $row){
  //echo $row['Title'];
  $arr[] =array(
    'Title' => $row['Title']);
}

//var_dump($arr);

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($arr as $name) {
        if (stristr($q, substr($name['Title'], 0, $len))) {
            if ($hint === "") {
                $hint = "<a href ='https://marcelbockovac.from.hr/show_page.php?post=" . $name['Title'] . "'>".$name['Title'] ."</a>";
            } else {
                $hint .= "<br>". "<a href ='https://marcelbockovac.from.hr/show_page.php?post=" . $name['Title'] . "'>".$name['Title'] ."</a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "Found nothing...." : $hint;
?>
