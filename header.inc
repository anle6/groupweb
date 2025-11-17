<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Glitzers</title>

  <!-- Stylesheets -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/responsive.css">
</head>

<body<?php if(!empty($pageClass)) echo ' class="'.htmlspecialchars($pageClass).'"'; ?>>
<header class="site-header">
  <div class="container">
      <div class="brand">
        <a class="logo-link" href="index.php">
          <img src="images/Logos.png" alt="Glitzers logo">
        </a>
        <h1 class="site-title"><a href="index.php">Glitzers</a></h1>
      </div>
    <?php require_once 'nav.inc'; ?>
  </div>
</header>
