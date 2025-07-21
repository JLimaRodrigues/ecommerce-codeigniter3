<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ecommerce - ERP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
    }

    .sidebar {
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      background-color: #343a40;
      padding-top: 60px;
      z-index: 1030;
    }

    .sidebar .nav-link {
      color: #ccc;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      color: #fff;
      background-color: #495057;
    }

    main {
      margin-left: 240px;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      main {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
