<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <title>Dashboard</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .header-searchbar {
            animation: transitionIn-Y-bottom 0.5s;
            width: 500px; /* Adjust the width as needed */
            padding: 5px; /* Adjust the padding as needed */
            font-size: 14px; /* Adjust the font size as needed */
        }

        .login-btn {
            padding: 5px 15px; /* Adjust the padding as needed */
            font-size: 14px; /* Adjust the font size as needed */
        }
    </style>
</head>

<body>
    <?php

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }

    } else {
        header("location: ../login.php");
    }

    include ("../connection.php");
    $sqlmain = "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];

    date_default_timezone_set('Asia/Jakarta');
    $today = date('Y-m-d');
    ?>

    <div class="menu sb-color">
        <div style="padding-top: 31px; text-align: center;">
            <p style="color: white; font-weight: bold; font-size: 36px; margin-bottom: 40px; margin-top: 0px;">
                <span style="color: white; margin-right: -4px;">MIND</span>
                <span style="color: #007bff; margin-left: -4px;">MEND</span>
            </p>
        </div>
        <table class="menu-container" style="margin-top: 0px;" border="0">
            <tr>
                <td style="padding:0px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px">
                                <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
                                <p class="profile-title"><?php echo substr($username, 0, 13) ?>..</p>
                                <p class="profile-subtitle"><?php echo substr($useremail, 0, 22) ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom: 30px;">
                                <a href="../logout.php"><input type="button" value="Log out"
                                        class="logout-btn btn-primary-soft btn"></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-home" style="padding-top: 25px;">
                    <a href="index.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Home</p>
                        </div>
                    </a>

                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-doctor" style="padding-top: 25px;">
                    <a href="doctors.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Appointed Doctors</p>
                        </div>
                    </a>

                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-session menu-active menu-icon-session-active" style="padding-top: 25px;">
                    <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active">
                        <div>
                            <p class="menu-text">Scheduled Sessions</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-appoinment" style="padding-top: 25px;">
                    <a href="appointment.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">My Bookings</p>
                    </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings" style="padding-top: 25px;">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a>
            </div>
        </td>
    </tr>
    </table>
    </div>

    <?php

    $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";
    $sqlpt1 = "";
    $insertkey = "";
    $q = '';
    $searchtype = "All";
    if ($_POST) {
        if (!empty($_POST["search"])) {
            $keyword = $_POST["search"];
            $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' and (doctor.docname='$keyword' or doctor.docname like '$keyword%' or doctor.docname like '%$keyword' or doctor.docname like '%$keyword%' or schedule.title='$keyword' or schedule.title like '$keyword%' or schedule.title like '%$keyword' or schedule.title like '%$keyword%' or schedule.scheduledate like '$keyword%' or schedule.scheduledate like '%$keyword' or schedule.scheduledate like '%$keyword%' or schedule.scheduledate='$keyword' )  order by schedule.scheduledate asc";
            $insertkey = $keyword;
            $searchtype = "Search Result : ";
            $q = '"';
        }
    }

    $result = $database->query($sqlmain)
    ?>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px;">
            <div class="header-container mt-2 anim" style="background-color: #161c2d;">
                <div class="title">Scheduled Sessions</div>
                <div class="date" style="display: flex; align-items: center;">
                    <div>
                        <p class="subtitle" style="color: #808A9A">Today's Date</p>
                        <p style="color: white;">
                            <?php
                            date_default_timezone_set('Asia/Jakarta');
                            echo date('Y-m-d');
                            ?>
                        </p>
                    </div>
                    <button class="btn-label ml-3"
                        style="display: flex; justify-content: center; align-items: center; background-color: #BACAE1; pointer-events: none;">
                        <img src="../img/calendar.svg" width="100%">
                    </button>
                </div>
            </div>
            <tr>
                <td>
                    <form action="" method="post" class="header-search">
                        <input type="search" name="search" class="input-text header-searchbar"
                            placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors"
                            value="<?php echo $insertkey ?>">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select DISTINCT * from  doctor;");
                        $list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");

                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["docname"];
                            echo "<option value='$d'><br/>";
                        }

                        for ($y = 0; $y < $list12->num_rows; $y++) {
                            $row00 = $list12->fetch_assoc();
                            $d = $row00["title"];
                            echo "<option value='$d'><br/>";
                        }
                        echo ' </datalist>';
                        ?>

                        <input type="Submit" value="Search" class="login-btn btn-primary btn anim"
                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </form>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color: #0A76D8;">
                        <?php echo $searchtype . " Sessions" . "(" . $result->num_rows . ")"; ?> </p>
                    <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)">
                        <?php echo $q . $insertkey . $q; ?> </p>
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                                <tbody>

                                    <?php
                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color: #071327">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary btn anim"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < ($result->num_rows); $x++) {
                                            echo "<tr>";
                                            for ($q = 0; $q < 3; $q++) {
                                                $row = $result->fetch_assoc();
                                                if (!isset($row)) {
                                                    break;
                                                }
                                                $scheduleid = $row["scheduleid"];
                                                $title = $row["title"];
                                                $docname = $row["docname"];
                                                $scheduledate = $row["scheduledate"];
                                                $scheduletime = $row["scheduletime"];

                                                if ($scheduleid == "") {
                                                    break;
                                                }

                                                echo '
                                        <td style="width: 25%;">
                                                <div  class="dashboard-items search-items" style="background-color: #161c2d;">
                                                    <div style="width:100%">
                                                            <div class="h1-search">
                                                                ' . substr($title, 0, 21) . '
                                                            </div><br>
                                                            <div class="h3-search">
                                                                ' . substr($docname, 0, 30) . '
                                                            </div>
                                                            <div class="h4-search">
                                                                ' . $scheduledate . '<br>Starts: <b>@' . substr($scheduletime, 0, 5) . '</b> (24h)
                                                            </div>
                                                            <br>
                                                            <a href="booking.php?id=' . $scheduleid . '" ><button  class="login-btn btn-primary btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Book Now</font></button></a>
                                                    </div>
                                                </div>
                                            </td>';
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </center>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
