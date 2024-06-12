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
            animation: transitionIn-Y-bottom 0.2s;
        }

        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        /* .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        } */

        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .container-h1 {
            width: 85%;
            border: 1px solid #ebebeb;
            border-radius: 0;
            margin: 0;
            border-spacing: 0;
            padding: 0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border: 2px solid #161c2d;
            animation: transitionIn-Y-bottom 0.2s;
        }

        .text-center {
            text-align: center;
        }

        .table-session {
            width: 100%;
            height: 100%;
            overflow: auto;
            margin: 0;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }

        .sub-table thead th {
            border-bottom: 2px solid #465060;
            /* Tambahkan border bawah biru pada header tabel */
            padding: 10px;
            /* Atur padding jika diperlukan */
        }

        .sub-table {
            border: 0px solid #161c2d;
            border-radius: 0;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            margin: 0;
        }

        .dashboard-icons {
            background-color: #BACAE1;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 7px;
            margin-left: 40px;
            margin-right: 0px;

        }

        .btn-icon-back {
            background-image: url('../img/icons/back-iceblue.svg');
            background-position: 18px 50%;
            background-repeat: no-repeat;
            transition: 0.5s;
            padding: 5px 30px 5px 30px;
        }

        .anim{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <?php

    //learn from w3schools.com
    
    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }

    } else {
        header("location: ../login.php");
    }


    //import database
    include ("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


    //echo $userid;
//echo $username;
    
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
                <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" style="padding-top: 25px;">
                    <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                        <div>
                            <p class="menu-text">Home</p>
                        </div>
                    </a>

                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-doctor" style="padding-top: 25px;">
                    <a href="appointment.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">My Appointments</p>
                        </div>
                    </a>

                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-session" style="padding-top: 25px;">
                    <a href="schedule.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">My Sessions</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-patient" style="padding-top: 25px;">
                    <a href="patient.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">My Patients</p>
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

    <div class="dash-body" style="margin-top: 0px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
            <div class="header-container mt-2 anim" style="background-color: #161c2d;">
                <div class="title">Home</div>
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
                <td width="15%">
                    <p class="heading-sub12" style="padding: 0;margin: 0; color: white;">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');

                        $today = date('Y-m-d');
                        echo $today;


                        $patientrow = $database->query("select  * from  patient;");
                        $doctorrow = $database->query("select  * from  doctor;");
                        $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                        $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <center>
                        <table class="filter-container doctor-header" style="border: none;width:95%; height: 70%"
                            border="0">
                            <tr>
                                <td class=""
                                    style="padding-left: 30px; padding-top: 25px; padding-bottom: 15px; padding-right: 30px">
                                    <h3>Welcome!</h3>
                                    <h1 style="font-weight: bold; color: #4483F7"><?php echo $username ?>.</h1>
                                    <p>Thank you for joining us. We strive to provide you with comprehensive service.
                                        <br>
                                        You can view your daily schedule and attend patients' appointments from home!
                                    </p>
                                    <a href="appointment.php" class="non-style-link"><button class="btn-primary btn"
                                            style="width:20%; margin-top: 15px">View My Appointments</button></a>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table border="0" width="100%"">
                            <tr>
                                <td width=" 50%">
                        <center>
                            <table class="filter-container" style="border: none;" border="0">
                                <tr>
                                    <td colspan="4">
                                        <p
                                            style="font-size: 20px;font-weight:bold ;padding-left: 20px; color: #4483F7;">
                                            Status</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:90%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $doctorrow->num_rows ?>
                                                </div>
                                                <br>
                                                <div class="h3-dashboard"
                                                    style="font-size: 18px;color: white; font-weight: normal">
                                                    All Doctors &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:90%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $patientrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard"
                                                    style="font-size: 18px;color: white; font-weight: normal">
                                                    All Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:90%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $appointmentrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard"
                                                    style="font-size: 18px;color: white; font-weight: normal">
                                                    NewBooking &nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');">
                                            </div>
                                        </div>

                                    </td>

                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:90%;display: flex; justify-content: space-between; background-color: #161c2d;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $schedulerow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard"
                                                    style="font-size: 18px;color: white; font-weight: normal">
                                                    Today Sessions
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/session-iceblue.svg');">
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </center>
                </td>
                <td>
                    <div class="container-h1 mx-auto text-center" style="background-color: #161c2d;">
                        <p id="anim" style="font-size: 20px; font-weight: bold; color: #4483F7; padding-top: 15px;">
                            Your Up Coming Sessions until Next week
                        </p>
                    </div>
                    <center>
                        <div class="table-session scroll" style=" padding: 0;margin: 0;">
                            <table width="85%" class="sub-table scrolldown" border="0"
                                style="background-color: #161c2d;">
                                <thead>
                                    <tr>
                                        <th class="table-headin"
                                            style="color: white; font-weight: normal; text-align: center; width: 33%;">
                                            Session Title
                                        </th>
                                        <th class="table-headin"
                                            style="color: white; font-weight: normal; text-align: center; width: 33%;">
                                            Scheduled Date
                                        </th>
                                        <th class="table-headin"
                                            style="color: white; font-weight: normal; text-align: center; width: 33%;">
                                            Time
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $nextweek = date("Y-m-d", strtotime("+1 week"));
                                    $sqlmain = "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today' and schedule.scheduledate<='$nextweek' order by schedule.scheduledate desc";
                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color: white">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';

                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $docname = $row["docname"];
                                            $scheduledate = $row["scheduledate"];
                                            $scheduletime = $row["scheduletime"];
                                            $nop = $row["nop"];
                                            echo '<tr>
                                                        <td style="padding:20px;"> &nbsp;' .
                                                substr($title, 0, 30)
                                                . '</td>
                                                        <td style="padding:20px;font-size:13px;">
                                                        ' . substr($scheduledate, 0, 10) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . substr($scheduletime, 0, 5) . '
                                                        </td>

                
                                                       
                                                    </tr>';

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
        </td>
        <tr>
            </table>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>