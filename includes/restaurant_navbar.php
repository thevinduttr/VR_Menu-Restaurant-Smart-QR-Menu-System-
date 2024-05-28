<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Restaurant Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f4f7f6;
      display: flex;
      transition: background-color 0.3s;
    }

    ul, .navbar-nav {
      list-style-type: none;
      margin: 0;
      padding: 0;
      transition: width 0.3s;
    }

    .navbar-dark .navbar-toggler {
      border: none;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-dark .navbar-nav .nav-link {
      color: #ecf0f1;
      padding: 10px 15px;
      transition: background-color 0.3s, transform 0.3s;
    }

    .navbar-dark .navbar-nav .nav-link:hover {
      background-color: #3498db;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .navbar-dark .navbar-nav .active {
      background-color: #3498db;
      color: white;
    }

    ul {
      width: 15%;
      background: linear-gradient(to bottom, #34495e, #2c3e50);
      position: fixed;
      height: 100%;
      overflow: auto;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    li a {
      display: flex;
      align-items: center;
      gap: 15px;
      color: #ecf0f1;
      padding: 15px 20px;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    li a.active, li a:hover {
      background-color: #3498db;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .fa-icon {
      min-width: 20px;
      text-align: center;
    }

    body > div {
      padding: 20px;
      margin-left: 15%;
      transition: margin-left 0.3s;
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }

      ul {
        width: 100%;
        position: relative;
        height: auto;
        background: linear-gradient(to bottom, #7f8c8d, #95a5a6);
        box-shadow: none;
      }

      body > div {
        margin-left: 0;
        padding-top: 60px;
      }

      .navbar-dark .navbar-nav {
        background: linear-gradient(to bottom, #7f8c8d, #95a5a6);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      }

      .navbar-dark .navbar-toggler {
        background-color: #2c3e50;
      }
    }
  </style>
</head>

<body>

  <!-- Desktop Navigation -->
  <ul class="d-none d-md-block">
    <li><a href="dashboard.php"><i class="fa-icon fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li><a href="add_menu.php"><i class="fa-icon fas fa-plus-circle"></i>Add Menu Details</a></li>
    <li><a href="viewedit_menu.php"><i class="fa-icon fas fa-edit"></i>Edit Menu Details</a></li>
    <li><a href="menu_themes.php"><i class="fa-icon fas fa-palette"></i>Themes & Designs</a></li>
    <li><a href="preview_menu.php"><i class="fa-icon fas fa-eye"></i>View Menu</a></li>
    <li><a href="qr_url.php"><i class="fa-icon fas fa-qrcode"></i>QR and URL</a></li>
    <li><a class="active" href="includes/logout.php"><i class="fa-icon fas fa-sign-out-alt"></i>Logout</a></li>
  </ul>

  <!-- Mobile Navigation -->
  <nav class="navbar navbar-dark bg-dark d-md-none">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="add_menu.php">Add Menu Details</a></li>
        <li class="nav-item"><a class="nav-link" href="viewedit_menu.php">Edit Menu Details</a></li>
        <li class="nav-item"><a class="nav-link" href="menu_themes.php">Themes & Designs</a></li>
        <li class="nav-item"><a class="nav-link" href="preview_menu.php">View Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="qr_url.php">QR and URL</a></li>
        <li class="nav-item"><a class="nav-link active" href="includes/logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>

  <div>
    <!-- Content Goes Here -->
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>

</html>


















