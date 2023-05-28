<?php include("../init.php");?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.1.0.59861 -->
    <meta charset="utf-8">
    <title>KTTC Poll</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="../css/style.css" media="screen">
    <link rel="stylesheet" href="../css/layout.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="../css/style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="../css/style.responsive.css" media="all">


    <script src="../js/jquery.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/script.responsive.js"></script>



<style>.poll-content .poll-postcontent-0 .layout-item-0 { margin-top: 10px;margin-bottom: 10px;  }
.poll-content .poll-postcontent-0 .layout-item-1 { padding-right: 15px;padding-left: 15px;  }
.poll-content .poll-postcontent-0 .layout-item-2 { padding-top: 0px;padding-right: 20px;padding-bottom: 0px;padding-left: 15px;  }
.ie7 .poll-post .poll-layout-cell {border:none !important; padding:0 !important; }
.ie6 .poll-post .poll-layout-cell {border:none !important; padding:0 !important; }

</style></head>
<body>
<div id="poll-main">
<header class="poll-header">
    <div class="poll-shapes">
        <div class="kttc" data-left="0%"></div>
    </div> 
    <div class="poll-account" data-left="90%">
        <?php 
            //include "../init.php";
            if(admin_loggedIn()){
                echo "Welcome <strong>".$_SESSION['admin_name']."</strong>!  ";
                echo "&nbsp[<a href = '../logout.php'>Logout</a>]";
            }else{
                if (!strpos($_SERVER['PHP_SELF'], 'voter_login.php'))
                    header("Location: ../index.php");
                    exit();
            }
        ?>       
    </div>                          
</header>
<div class="poll-sheet clearfix">
    <div class="poll-layout-wrapper">
        <div class="poll-content-layout">
            <div class="poll-content-layout-row">
                <div class="poll-layout-cell poll-sidebar1"><div class="poll-vmenublock clearfix">
                    <div class="poll-vmenublockcontent">
                        <ul class="poll-vmenu">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li><a href="#" >Voters</a>
								<ul>
                                    <li><a href="voter_registration.php">Register Voter</a></li>                         
                                    <li><a href="view_voters.php">Manage Voters</a></li>
                                </ul>
							</li>                            
                            <li><a href="#">Candidates</a>
                                <ul>
                                    <li><a href="aspirant_reg.php">Register Candidate</a></li>                         
                                    <li><a href="manage_aspirants.php">Manage Candidates</a></li>
                                </ul>
                            </li>
                            <li><a href="#" >Polls</a>
                                <ul>
                                    <li><a href="pollChart.php">Poll Results</a></li>                         
                                    <li><a href="offline_vote.php">Offline Polls</a></li>
                                </ul>
                            </li>
                            <li><a href="#" >Admin Functions</a>
                                <ul>
                                    <li><a href="add_admin.php">New Admin</a></li>                         
                                    <li><a href="audit_trail.php">Audit Trail</a></li>
                                </ul>
                            </li>  
                        </ul>                
                    </div></div>
                    <div class="poll-block clearfix">
                        <div class="poll-blockcontent"><p><br></p></div>
                    </div><div class="poll-block clearfix">
                        <div class="poll-blockcontent"><p><br></p></div>
                </div></div>
                <div class="poll-layout-cell poll-content"><article class="poll-post poll-article">                
                    <div class="poll-postcontent poll-postcontent-0 clearfix"><div class="poll-content-layout-wrapper layout-item-0">
                        <div class="poll-content-layout">
                            <div class="poll-content-layout-row">
                                <!--End of header-->