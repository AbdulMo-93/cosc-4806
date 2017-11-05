<?php
require_once('../app/core/utils.php');

if (isset($_SESSION['auth']) == 1) {
    header('Location: /home');
}
?>

<!DOCTYPE html>
<html lang="en">
    <link href= "/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
    <title>COSC 4806</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>



<body>