<?php include "../init.php";?>
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
        <div class="poll-object1287348466" data-left="0%"></div>
    </div>
    <div class="poll-account" data-left="100%">
        <?php
         if(voter_loggedIn()){
                echo "Welcome <strong>".$_SESSION['voter_name']."</strong>!  ";
                echo "&nbsp<a href = '../logout.php'>Logout</a>";
            }else{
                if (!strpos($_SERVER['PHP_SELF'], 'voter_login.php'))
                    echo "<strong>[ <a href='../login.php'>Login</a> ]</strong>";              
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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="vote.php">Vote</a></li>
                            <li><a href="#" <?php if (strpos($_SERVER['PHP_SELF'], 'view_aspirants.php')) echo "class='active'"; ?>>Candidates</a>
                                <?php           
                                    $select_query = "SELECT positionid, position FROM position";
                                    $result = mysql_query($select_query)or die ("Could not Query <BR>".mysql_error());
                                    if(mysql_num_rows($result)>0){
                                        echo "<ul>";
                                        while($row = mysql_fetch_array($result)){
                                            extract($row);
                                            echo "<li><a href='view_aspirants.php?positionID=$positionid'";
                                            if (strpos($_SERVER['PHP_SELF'], 'view_aspirants.php?positionID=$positionid')) print("class='active'"); 
                                            echo ">$position</a></li>";
                                        }
                                        echo "</ul>";
                                    }           
                                ?>      
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