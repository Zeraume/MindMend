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

        .anim {
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
                <td class="menu-btn menu-icon-patient" style="padding-top: 25px;">
                    <a href="schedule.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">My Sessions</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-appoinment" style="padding-top: 25px;">
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
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
            <div class="header-container mt-2 anim" style="background-color: #161c2d;">
                <div class="title">Settings</div>
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
                <td colspan="4">

                    <center>
                    <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=edit&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" 
                                            style="padding:20px;margin:auto;width:95%;display: flex; background-color: #161c2d;">
                                            <div class="btn-icon-back dashboard-icons-setting"
                                                style="background-image: url('../img/icons/doctors-hover.svg'); background-color: #E5EDFA"></div>
                                            <div>
                                                <div class="h1-dashboard">
                                                    Account Settings &nbsp;

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px; color: white;">
                                                    Edit your Account Details & Change Password
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=view&id=<?php echo $userid ?>" class="non-style-link">
                                        <div class="dashboard-items setting-tabs"
                                            style="padding:20px;margin:auto;width:95%;display: flex; background-color: #161c2d;">
                                            <div class="btn-icon-back dashboard-icons-setting"
                                                style="background-image: url('../img/icons/view-iceblue.svg'); background-color: #E5EDFA"></div>
                                            <div>
                                                <div class="h1-dashboard">
                                                    View Account Details

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px; color: white;">
                                                    View Personal information About Your Account
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=drop&id=<?php echo $userid . '&name=' . $username ?>"
                                        class="non-style-link">
                                        <div class="dashboard-items setting-tabs"
                                            style="padding:20px;margin:auto;width:95%;display: flex; background-color: #161c2d;">
                                            <div class="btn-icon-back dashboard-icons-setting"
                                                style="background-image: url('../img/icons/patients-hover.svg'); background-color: #E5EDFA"></div>
                                            <div>
                                                <div class="h1-dashboard" style="color: #ff5050;">
                                                    Delete Account

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px; color: white;">
                                                    Will Permanently Remove your Account
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        </table>
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
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from doctor where docid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];

            $spcil_res = $database->query("select sname from specialties where id='$spe'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $tele = $row['doctel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            MindMend Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Phone Number: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $spcil_name . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="settings.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'edit') {
            $sqlmain = "select * from doctor where docid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];

            $spcil_res = $database->query("select sname from specialties where id='$spe'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $tele = $row['doctel'];

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );

            if ($error_1 != '4') {
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="settings.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Doctor Details.</p>
                                        Doctor ID : ' . $id . ' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-doc.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="hidden" name="oldemail" value="' . $email . '" >
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="' . $email . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="' . $name . '" required><br>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Phone Number: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Phone Number Number" value="' . $tele . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Choose specialties: (Current' . $spcil_name . ')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="spec" id="" class="box">';


                $list11 = $database->query("select  * from  specialties;");

                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $sn = $row00["sname"];
                    $id00 = $row00["id"];
                    echo "<option value=" . $id00 . ">$sn</option><br/>";
                }
                ;




                echo '       </select><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Conform Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
            } else {
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="settings.php">&times;</a>
                            <div class="content">
                                If You change your email also Please logout and login again with your new email
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                            <a href="../logout.php" class="non-style-link"><button  class="btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Log out&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';



            }
            ;
        }

    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>