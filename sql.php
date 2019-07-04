<?php
$link = mysqli_connect("localhost", "root", "", "project1db");

/* проверка подключения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

$query = "SELECT id, Title FROM movies1";
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    printf("%s (%s)\n", $row[0], $row[1]);
}

mysqli_free_result($result);

mysqli_close($link);
?>