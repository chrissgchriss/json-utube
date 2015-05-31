<?php
// make sure application knows it is json data not php
header("Content-Type: application/json");
$jsonData = '{
    "u1":{"user":"John", "age":22, "country":"phpUnited States"},
    "u2":{"user":"Will", "age":27, "country":"phpUnited Kingdom"},
    "u3":{"user":"Abiel", "age":19, "country":"phpMixico"},
    "u4":{"user":"Kirk", "age":30, "country":"phpUtah"},
    "u5":{"user":"Jessus", "age":31, "country":"China"},
    "u6":{"user":"Markie Mark", "age":8, "country":"Iran"},
    "u7":{"user":"MonkeyMan", "age":12, "country":"thailand"},
    "u8":{"user":"Frodo", "age":18, "country":"Hobbit"},
    "u9":{"user":"machineman", "age":62, "country":"Canada"}
}';
echo $jsonData;
?>