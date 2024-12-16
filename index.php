<?php
require('connexion.php');
include('DeletePlayer.php');
include('fetchStat.php');
include('AddPlayer.php');
include('AddMembre.php');


session_start();

// Fetch player data
$stmt = $pdo->query("SELECT * FROM joueurs");
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user_name = $_SESSION['nom']; // User's name
// $user_email = $_SESSION['email']; // User's email





// Fetch notifications, messages, and emails from your database
// Example:
$notifications = getNotifications(); // This function should fetch notifications from your database
$messages = getMessages(); // Fetch messages
$emails = getEmails(); // Fetch emails
$unread_notifications_count = count($notifications);
$unread_messages_count = count($messages);
$unread_emails_count = count($emails);

// Function examples (you need to implement these functions to query your database)
function getNotifications()
{
    // SQL query to fetch notifications
    return []; // Example, return a list of notifications
}

function getMessages()
{
    // SQL query to fetch messages
    return []; // Example, return a list of messages
}

function getEmails()
{
    // SQL query to fetch emails
    return []; // Example, return a list of emails
}

// Fetch Member data
$stmt = $pdo->query("SELECT * FROM members");
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->query("SELECT COUNT(*) AS total FROM members");
$countMember = $stmt->fetch(PDO::FETCH_ASSOC);

// Safely access the count
$totalMembers = $countMember['total'];



// Fetch ADMIN data
$stmt = $pdo->query("SELECT * FROM admins");
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->query("SELECT COUNT(*) AS total FROM admins");
$countAdmins = $stmt->fetch(PDO::FETCH_ASSOC);

// Safely access the count
$totalAdmins = $countAdmins['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">


    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <!-- <script src="addMemberButton.js"></script> -->
    <style>

    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <a class="navbar-brand ps-3" href="index.php"> <img src="images/logo.png" alt="" width="180px"> </a>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.php">Dashboard 1</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>

                        <li>
                            <a href="EmploiTemps.php">
                                <i class="fas fa-Sheudles-alt"></i>Sheudles</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.php">Login</a>
                                </li>
                                <li>
                                    <a href="register.php">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.php">Forget Password</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->










        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <a class="navbar-brand ps-3" href="index.php"> <img src="images/logo.png" alt="" width="180px"> </a>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.php">Dashboard 1</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>

                        <li>
                            <a href="EmploiTemps.php">
                                <i class="fas fa-Sheudles-alt"></i>Sheudles</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.php">Login</a>
                                </li>
                                <li>
                                    <a href="register.php">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.php">Forget Password</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <!-- Search form -->
                            <form class="form-header" action="search_results.php" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <!-- Notifications -->
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity"><?php echo $unread_messages_count; ?></span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have <?php echo $unread_messages_count; ?> new message<?php echo $unread_messages_count > 1 ? 's' : ''; ?></p>
                                            </div>
                                            <?php foreach ($messages as $message): ?>
                                                <div class="mess__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-06.jpg" alt="<?php echo htmlspecialchars($message['sender']); ?>" />
                                                    </div>
                                                    <div class="content">
                                                        <h6><?php echo htmlspecialchars($message['sender']); ?></h6>
                                                        <p><?php echo htmlspecialchars($message['content']); ?></p>
                                                        <span class="time"><?php echo htmlspecialchars($message['timestamp']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Emails -->
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity"><?php echo $unread_emails_count; ?></span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have <?php echo $unread_emails_count; ?> new email<?php echo $unread_emails_count > 1 ? 's' : ''; ?></p>
                                            </div>
                                            <?php foreach ($emails as $email): ?>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p><?php echo htmlspecialchars($email['subject']); ?></p>
                                                        <span><?php echo htmlspecialchars($email['sender']); ?>, <?php echo htmlspecialchars($email['timestamp']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Notifications -->
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"><?php echo $unread_notifications_count; ?></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have <?php echo $unread_notifications_count; ?> notification<?php echo $unread_notifications_count > 1 ? 's' : ''; ?></p>
                                            </div>
                                            <?php foreach ($notifications as $notification): ?>
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p><?php echo htmlspecialchars($notification['message']); ?></p>
                                                        <span class="date"><?php echo htmlspecialchars($notification['timestamp']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Account Menu -->
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo htmlspecialchars($user_name); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo htmlspecialchars($user_name); ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo htmlspecialchars($user_email); ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="account.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="setting.php">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->



            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-run"></i>
                                            </div>


                                            <div class="text">
                                                <h2><?php echo $totalPlayers; ?></h2>
                                                <span>Players</span>
                                            </div>
                                        </div>
                                        <div class="links">
                                            <a href="">view more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon ">
                                                <i class="mdi mdi-school"></i>
                                            </div>


                                            <div class="text">
                                                <h2><?php echo $activeFormations ?></h2>
                                                <span>Formations</span>
                                            </div>
                                        </div>
                                        <div class="links">
                                            <a href="">view more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="mdi mdi-account-tie"></i>
                                            </div>

                                            <div class="text">
                                                <h2><?php echo $totalAdmins ?></h2>
                                                <span>Administartion</span>
                                            </div>
                                        </div>
                                        <div class="links">
                                            <a href="">view more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="mdi mdi-file-document"></i>
                                            </div>

                                            <div class="text">
                                                <h2><?php echo $validatedDocsPercentage ?></h2>
                                                <span>Documents</span>
                                            </div>
                                        </div>
                                        <div class="links text-light">
                                            <a href="">view more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="au-card recent-report">
                            <div class="au-card-inner">
                                <h3 class="title-2">recent reports</h3>
                                <div class="chart-info">
                                    <div class="chart-info__left">
                                        <div class="chart-note">
                                            <span class="dot dot--blue"></span>
                                            <span>products</span>
                                        </div>
                                        <div class="chart-note mr-0">
                                            <span class="dot dot--green"></span>
                                            <span>services</span>
                                        </div>
                                    </div>
                                    <div class="chart-info__right">
                                        <div class="chart-statis">
                                            <span class="index incre">
                                                <i class="zmdi zmdi-long-arrow-up"></i>25%</span>
                                            <span class="label">products</span>
                                        </div>
                                        <div class="chart-statis mr-0">
                                            <span class="index decre">
                                                <i class="zmdi zmdi-long-arrow-down"></i>10%</span>
                                            <span class="label">services</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="recent-report__chart">
                                    <canvas id="recent-rep-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Players</h2>

                                <!-- Search and Row Filter in Two Columns -->
                                <div class="row mb-3">
                                    <!-- Search Input -->
                                    <div class="col-6">
                                        <label for="datatable-input">Search:</label>
                                        <input id="datatable-input" class="datatable-input form-control" placeholder="Search..." type="search"
                                            title="Search within table" aria-controls="players-table">
                                    </div>

                                    <!-- Row Filter -->
                                    <div class="col-6">
                                        <label for="datatable-selector">Show rows:</label>
                                        <select id="datatable-selector" class="datatable-selector form-control">
                                            <option value="5">5</option>
                                            <option value="10" selected="">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning" id="players-table">
                                        <thead>
                                            <tr>
                                    <th>#</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                                <!-- <th>date</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($players as $index => $player): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><?php echo htmlspecialchars($player['nom']); ?></td>
                                                    <td><?php echo htmlspecialchars($player['age']); ?></td>
                                                    <td><?php echo htmlspecialchars($player['position']); ?></td>
                                                    <td>
                                                        <a href="?delete_player=<?php echo $player['id']; ?>" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ?');">
                                                            Supprimer
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="row">
    <div class="col-lg-7">
        <!-- Left Section -->
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
            <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                <div class="bg-overlay bg-overlay--blue"></div>
                <h3>
                    <i class="zmdi zmdi-comment-text"></i>Members
                </h3>
                <button id="toggleFormButton" class="au-btn-plus">
                    <i class="zmdi zmdi-plus"></i>
                </button>
            </div>

            <div class="au-inbox-wrap js-inbox-wrap">
                <div class="au-message js-list-load">
                    <div class="au-message__noti">
                        <p>There are
                            <span><?php echo htmlspecialchars($totalMembers, ENT_QUOTES, 'UTF-8'); ?></span>
                            Members
                        </p>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <?php foreach ($members as $index => $member): ?>
            <div class="au-message__item unread">
                <div class="au-message__item-inner">
                    <div class="au-message__item-text">
                        <div class="avatar-wrap">
                            <div class="avatar">
                                <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="John Smith">
                            </div>
                        </div>
                        <div class="text">
                            <h5 class="name"><?php echo htmlspecialchars($member['nom']); ?></h5>
                            <p><?php echo htmlspecialchars($member['metier']); ?></p>
                        </div>
                    </div>
                    <div class="au-message__item-time">
                        <span><?php echo htmlspecialchars($member['email']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-lg-5">
        <!-- Right Section -->
        <div id="formContainer" class="d-none border p-4 rounded shadow-sm">
        <form action="AddMembre.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Entrez votre nom" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" required>
    </div>
    <div class="mb-3">
        <label for="metier" class="form-label">Métier</label>
        <input type="text" id="metier" name="metier" class="form-control" placeholder="Entrez votre métier" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" id="image" name="image" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

        </div>
    </div>
</div>


                        </div>


            <!-- here ADMIN-->


                        <div class="row">
    <div class="col-lg-7">
        <!-- Left Section -->
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
            <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                <div class="bg-overlay bg-overlay--blue"></div>
                <h3>
                    <i class="zmdi zmdi-comment-text"></i>Admins
                </h3>
               
            </div>

            <div class="au-inbox-wrap js-inbox-wrap">
                <div class="au-message js-list-load">
                    <div class="au-message__noti">
                        <p>There are
                            <span><?php echo htmlspecialchars($totalAdmins, ENT_QUOTES, 'UTF-8'); ?></span>
                            Admins
                        </p>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <?php foreach ($admins as $index => $admin): ?>
            <div class="au-message__item unread">
                <div class="au-message__item-inner">
                    <div class="au-message__item-text">
                        <div class="avatar-wrap">
                            <div class="avatar">
                                <img src="<?php echo htmlspecialchars($admin['image']); ?>" alt="John Smith">
                            </div>
                        </div>
                        <div class="text">
                            <h5 class="name"><?php echo htmlspecialchars($admin['nom']); ?></h5>
                            <p>Admin</p>
                        </div>
                    </div>
                    <div class="au-message__item-time">
                        <span><?php echo htmlspecialchars($admin['email']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- <div class="col-lg-5">
       
        <div id="formContainer" class="d-none border p-4 rounded shadow-sm">
        <form action="AddMembre.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Entrez votre nom" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" required>
    </div>
    <div class="mb-3">
        <label for="metier" class="form-label">Métier</label>
        <input type="text" id="metier" name="metier" class="form-control" placeholder="Entrez votre métier" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" id="image" name="image" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

        </div> -->
    </div>
</div>


                        </div>






                        <div class="au-chat">


                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="col-4"></div> -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script>
        // JavaScript for Row Filtering
        document.getElementById('datatable-selector').addEventListener('change', function() {
            const rowsPerPage = parseInt(this.value);
            const table = document.getElementById('players-table');
            const rows = table.querySelectorAll('tbody tr');

            // Hide all rows initially
            rows.forEach((row, index) => {
                row.style.display = (index < rowsPerPage) ? '' : 'none';
            });
        });

        // JavaScript for Table Search
        document.getElementById('datatable-input').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const table = document.getElementById('players-table');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const text = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
    <!-- <script src="addMemberButton.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to toggle form visibility
        const toggleButton = document.getElementById('toggleFormButton');
        const formContainer = document.getElementById('formContainer');

        toggleButton.addEventListener('click', () => {
            if (formContainer.classList.contains('d-none')) {
                formContainer.classList.remove('d-none');
                // toggleButton.textContent = 'Hide Form';
            } else {
                formContainer.classList.add('d-none');
                // toggleButton.textContent = 'Show Form';
            }
        });
    </script>
    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<!-- end document-->