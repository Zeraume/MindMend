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

        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .table-session {
            width: 100%;
            height: 100%;
            overflow: auto;
            margin: 0;
        }

        .sub-table thead th {
            border-bottom: 2px solid #465060;
            /* Tambahkan border bawah biru pada header tabel */
            padding: 10px;
            /* Atur padding jika diperlukan */
        }

        .sub-table {
            border: 0px solid #161c2d;
            border-radius: 8px;
            margin: 0;
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
                <td class="menu-btn menu-icon-home " style="padding-top: 25px;">
                    <a href="index.php" class="non-style-link-menu">
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
                <td class="menu-btn menu-icon-session menu-active menu-icon-session-active" style="padding-top: 25px;">
                    <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active">
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

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <div class="header-container mt-2 anim" style="background-color: #161c2d;">
                <div class="title">My Sessions</div>
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

            <?php
            $list110 = $database->query("select  * from  schedule where docid=$userid;");
            ?>

            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0"
                            style="background-color: #161c2d; border-radius: 10px; padding: 10px; width: 1000px;">
                            <tr>
                                <td width="10%">
                                    <p class="heading-main12"
                                        style="margin-left: 45px;font-size:18px; color: #BACAE1; text-align: center; padding-top: 15px;">
                                        Session
                                        (<?php echo $list110->num_rows; ?>)</p>
                                </td>
                                <td width="5%" style="text-align: center; color: white;">
                                </td>
                                <td width="25%">
                                    <form action="" method="post">
                                        <input type="date" name="sheduledate" id="date"
                                            class="input-text filter-container-items" style="margin: 0;width: 75%;">
                                </td>
                                <td width="4%" style="padding: 10px; text-align: center;">
                                    <input type="submit" name="filter" value=" Filter"
                                        class=" btn-primary-soft btn button-icon btn-filter"
                                        style="padding: 10px; margin :0;width:100%">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>

            <?php

            $sqlmain = "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid where doctor.docid=$userid ";
            if ($_POST) {
                //print_r($_POST);
                $sqlpt1 = "";
                if (!empty($_POST["sheduledate"])) {
                    $sheduledate = $_POST["sheduledate"];
                    $sqlmain .= " and schedule.scheduledate='$sheduledate' ";
                }

            }

            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="table-session scroll">
                            <table width="93%" class="sub-table scrolldown" border="0"
                                style="background-color: #161c2d;">
                                <thead>
                                    <tr>
                                        <th class="table-headin" style="color: #BACAE1;">
                                            Session Title
                                        </th>

                                        <th class="table-headin" style="color: #BACAE1;">
                                            Sheduled Date & Time
                                        </th>
                                        <th class="table-headin" style="color: #BACAE1;">
                                            Max num that can be booked
                                        </th>

                                        <th class="table-headin" style="color: #BACAE1;">
                                            Events
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
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
                                    <td style="font-weight:normal; color:white; text-align:center;"> &nbsp;' .
                                                substr($title, 0, 30)
                                                . '</td>
                                        
                                        <td style="font-weight:normal; color:white; text-align:center;">
                                            ' . substr($scheduledate, 0, 10) . ' ' . substr($scheduletime, 0, 5) . '
                                        </td>
                                        <td style="font-weight:normal; color:white; text-align:center;">
                                            ' . $nop . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id=' . $scheduleid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id=' . $scheduleid . '&name=' . $title . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel Session</font></button></a>
                                        </div>
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
    </div>
    </div>
    <?php

    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-session.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where  schedule.scheduleid=$id";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $docname = $row["docname"];
            $scheduleid = $row["scheduleid"];
            $title = $row["title"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];


            $nop = $row['nop'];


            $sqlmain12 = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.scheduleid=$id;";
            $result12 = $database->query($sqlmain12);
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div class="table-session scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0" style="background-color: #161c2d;">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Session Title: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $title . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Doctor of this session: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $docname . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Scheduled Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $scheduledate . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Scheduled Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $scheduletime . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Patients that Already registerd for this session:</b> (' . $result12->num_rows . "/" . $nop . ')</label>
                                    <br><br>
                                </td>
                            </tr>

                            
                            <tr>
                            <td colspan="4">
                                <center>
                                 <div class="table-session scroll">
                                 <table width="100%" class="sub-table scrolldown" border="0" style="background-color: #161c2d;">
                                 <thead>
                                 <tr>   
                                        <th class="table-headin">
                                             Patient ID
                                         </th>
                                         <th class="table-headin">
                                             Patient name
                                         </th>
                                         <th class="table-headin">
                                             
                                             Appointment number
                                             
                                         </th>
                                        
                                         
                                         <th class="table-headin">
                                             Patient Phone Number
                                         </th>
                                         
                                 </thead>
                                 <tbody>';




            $result = $database->query($sqlmain12);

            if ($result->num_rows == 0) {
                echo '<tr>
                                             <td colspan="7">
                                             <br><br><br><br>
                                             <center>
                                             <img src="../img/notfound.svg" width="25%">
                                             
                                             <br>
                                             <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                             <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                             </a>
                                             </center>
                                             <br><br><br><br>
                                             </td>
                                             </tr>';

            } else {
                for ($x = 0; $x < $result->num_rows; $x++) {
                    $row = $result->fetch_assoc();
                    $apponum = $row["apponum"];
                    $pid = $row["pid"];
                    $pname = $row["pname"];
                    $ptel = $row["ptel"];

                    echo '<tr style="text-align:center;">
                                                <td>
                                                ' . substr($pid, 0, 15) . '
                                                </td>
                                                 <td style="font-weight:600;padding:25px">' .

                        substr($pname, 0, 25)
                        . '</td >
                                                 <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                                 ' . $apponum . '
                                                 
                                                 </td>
                                                 <td>
                                                 ' . substr($ptel, 0, 25) . '
                                                 </td>
                                                 
                                                 
                
                                                 
                                             </tr>';

                }
            }



            echo '</tbody>
                
                                 </table>
                                 </div>
                                 </center>
                            </td> 
                         </tr>

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }
    }

    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>