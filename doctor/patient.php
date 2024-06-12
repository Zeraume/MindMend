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

        .header-searchbar {
            animation: transitionIn-Y-bottom 0.5s;
            width: 500px;
            /* Adjust the width as needed */
            padding: 5px;
            /* Adjust the padding as needed */
            font-size: 14px;
            /* Adjust the font size as needed */
        }

        .login-btn {
            padding: 5px 15px;
            /* Adjust the padding as needed */
            font-size: 14px;
            /* Adjust the font size as needed */
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
                <td class="menu-btn menu-icon-session" style="padding-top: 25px;">
                    <a href="schedule.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">My Sessions</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active" style="padding-top: 25px;">
                    <a href="patient.php" class="non-style-link-menu non-style-link-menu-active">
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

    <?php

    $selecttype = "My";
    $current = "My patients Only";
    if ($_POST) {

        if (isset($_POST["search"])) {
            $keyword = $_POST["search12"];

            $sqlmain = "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
            $selecttype = "my";
        }

        if (isset($_POST["filter"])) {
            if ($_POST["showonly"] == 'all') {
                $sqlmain = "select * from patient";
                $selecttype = "All";
                $current = "All patients";
            } else {
                $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
                $selecttype = "My";
                $current = "My patients Only";
            }
        }
    } else {
        $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
        $selecttype = "My";
    }



    ?>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <div class="header-container mt-2 anim" style="background-color: #161c2d;">
                <div class="title">My Patients</div>
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
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0"
                            style="background-color: #161c2d; border-radius: 10px; padding: 10px; width: 1000px;">
                            <tr>
                                <?php
                                echo '<datalist id="patient">';
                                $list11 = $database->query($sqlmain);
                                //$list12= $database->query("select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=1;");
                                
                                for ($y = 0; $y < $list11->num_rows; $y++) {
                                    $row00 = $list11->fetch_assoc();
                                    $d = $row00["pname"];
                                    $c = $row00["pemail"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                }
                                ;

                                echo ' </datalist>';
                                ?>
                                <td width="10%">
                                    <p class="heading-main12"
                                        style="margin-left: 45px;font-size:18px; color: #BACAE1; text-align: center; padding-top: 15px;">
                                        <?php echo $selecttype . " Patients (" . $list11->num_rows . ")"; ?>
                                    </p>
                                </td>
                                <td width="5%" style="text-align: center; color: white;">
                                </td>
                                <td width="25%">
                                    <form action="" method="post">
                                        <select name="showonly" id="" class="box filter-container-items"
                                            style="width:75% ;height: 37px;margin: 0;">
                                            <option value="" disabled selected hidden><?php echo $current ?></option>
                                            <br />
                                            <option value="my">My Patients Only</option><br />
                                            <option value="all">All Patients</option><br />


                                        </select>
                                </td>
                                </form>
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
        <tr>
            <td style="margin-bottom: 20px;"> <!-- Add margin-bottom here -->
                <form action="" method="post" class="header-search" style="margin-bottom: 20px;">
                    <!-- Or add margin-bottom here -->
                    <input type="search" name="search12" class="input-text header-searchbar"
                        placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;
                    <input type="Submit" value="Search" name="search" class="login-btn btn-primary btn anim"
                        style="padding-left: 25px; padding-right: 25px; padding-top: 10px; padding-bottom: 10px;">
                </form>
            </td>
        </tr>

        </table>

        </center>
        </td>
        </tr>

        <tr>
            <td colspan="4">
                <center>
                    <div class="table-session scroll">
                        <table width="93%" class="sub-table scrolldown"
                            style="border-spacing:0; background-color: #161c2d;">
                            <thead>
                                <tr>
                                    <th class="table-headin" style="color: #BACAE1;">
                                        Name
                                    </th>
                                    <th class="table-headin" style="color: #BACAE1;">
                                        Phone Number
                                    </th>
                                    <th class="table-headin" style="color: #BACAE1;">
                                        Email
                                    </th>
                                    <th class="table-headin" style="color: #BACAE1;">
                                        Date of Birth
                                    </th>
                                    <th class="table-headin" style="color: #BACAE1;">
                                        Events
                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                $result = $database->query($sqlmain);
                                //echo $sqlmain;
                                if ($result->num_rows == 0) {
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                                } else {
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        $row = $result->fetch_assoc();
                                        $pid = $row["pid"];
                                        $name = $row["pname"];
                                        $email = $row["pemail"];
                                        $dob = $row["pdob"];
                                        $tel = $row["ptel"];

                                        echo '<tr>
                                    <td style="font-weight:normal; color:white; text-align:center;"> &nbsp;' .
                                            substr($name, 0, 35)
                                            . '</td>
                                        <td style="font-weight:normal; color:white; text-align:center;">
                                            ' . substr($tel, 0, 10) . '
                                        </td>
                                        <td style="font-weight:normal; color:white; text-align:center;">
                                        ' . substr($email, 0, 20) . '
                                         </td>
                                         <td style="font-weight:normal; color:white; text-align:center;">
                                        ' . substr($dob, 0, 10) . '
                                        </td>
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id=' . $pid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       
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
        $sqlmain = "select * from patient where pid='$id'";
        $result = $database->query($sqlmain);
        $row = $result->fetch_assoc();
        $name = $row["pname"];
        $email = $row["pemail"];
        $dob = $row["pdob"];
        $tele = $row["ptel"];
        $address = $row["paddress"];
        echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

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
                                    <label for="name" class="form-label">Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    P-' . $id . '<br><br>
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
                                    <label for="spec" class="form-label">Address: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $address . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Date of Birth: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $dob . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
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
    ;

    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>