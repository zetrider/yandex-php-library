<?php

if (!isset($_COOKIE['yaAccessToken'])) {
    header('Location: ../OAuth/index.php?back=http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Yandex Disk Test Page</title>
    <link rel="stylesheet" href="//yandex.st/bootstrap/3.0.0/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/require.js"></script>
    <script src="js/index.js"></script>
</head>
<body></body>
</html>