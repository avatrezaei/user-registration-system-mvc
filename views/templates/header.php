<?php
$error = $this->getSessionError();
    if ($error) {
        echo "<div class='error-message'>{$error}</div>";
    }

    $success = $this->getSessionSuccess();
    if ($success) {
        echo "<div class='success-message'>{$success}</div>";
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User Registration</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="./public/css/roboto-font.css">
    <link rel="stylesheet" type="text/css" href="./public/fonts/font-awesome-5/css/fontawesome-all.min.css">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="./public/css/style.css" />
</head>

<body class="form-v5">
    <div class="page-content">