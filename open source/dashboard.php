<?php include("libs/counter.php");?>
<?php include("libs/fetch_data.php");?>
<?php @include("{$currDir}/hooks/links-home.php"); ?>
<?php if(!defined('PREPEND_PATH')) define('PREPEND_PATH', ''); ?>
<?php if(!defined('datalist_db_encoding')) define('datalist_db_encoding', 'UTF-8'); ?>
<?php include("libs/redirect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RENTAL MANAGEMENT SYSTEM</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">


        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Rental Management</a>
            </div>
         

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                     <ul class="dropdown-menu">
              <li><a href="<?php echo PREPEND_PATH; ?>membership_profile.php"><i class="fa fa-user"></i> <strong>My Profile Details</strong> </a></li>
            
              <li>
               <?php if(getLoggedAdmin()){ ?>
               <a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn btn-sm hidden-xs"><i class="fa fa-cog"></i> <strong><?php echo $Translation['admin area']; ?></strong></a>
               <a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn btn-sm visible-xs btn-sm"><i class="fa fa-cog"></i> <strong><?php echo $Translation['admin area']; ?></strong></a>
               <?php } ?>
               <?php if(!$_GET['signIn'] && !$_GET['loginFailed']){ ?>
               <?php if(getLoggedMemberID() == $adminConfig['anonymousMember']){ ?>
               <p class="navbar-text navbar-right">&nbsp;</p>
               <a href="<?php echo PREPEND_PATH; ?>index.php?signIn=1" class="btn btn-success navbar-btn btn-sm navbar-right"><strong><?php echo $Translation['sign in']; ?></strong></a>
               <p class="navbar-text navbar-right">
                <?php echo $Translation['not signed in']; ?>
              </p>
              <?php }else{ ?>
              <ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
              </ul>
              <ul class="nav navbar-nav visible-xs">
              </ul>
              <?php } ?>
              <?php } ?>
            </li>
        
            <li class="divider"></li>
            <li><a class="btn navbar-btn btn-warning" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="fa fa-power-off"></i> <strong style="color:black"><?php echo $Translation['sign out']; ?></strong> </a></li>
          </ul>
                
                </li>
               
            </ul>
            

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building fa-fw"></i>Houses<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/rentalmanagement/houses_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=5&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D=vaccant">Vaccant</a>
                                </li>
                                <li>
                                    <a href="http://localhost/rentalmanagement/houses_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=5&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D=occupied">Occupied</a>
                                </li>
                            </ul>
                           
                        </li>
                        <li>
                            <a href="tenants_view.php"><i class="fa fa-users fa-fw"></i>Tenants</a>
                        </li>
                        <!-- <li>
                            <a href="invoices_view.php"><i class="fa fa-credit-card fa-fw"></i>Invoices</a>
                        </li>
                        <li>
                            <a href="payments_view.php"><i class="fa fa-money fa-fw"></i>Payments</a>
                        </li>
                        <li>
                            <a href="http://localhost/rentalmanagement/payments_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=8&FilterOperator%5B1%5D=greater-than&FilterValue%5B1%5D=0"><i class="fa fa-list-alt fa-fw"></i>Outstanding Balances</a>
                        </li> -->
                    </ul>
                </div>
                
            </div>
            
        </nav>

        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome <?php echo getLoggedMemberID(); ?>!!</h1>
                    </div>
                    
                </div>
                
                 <?php include("interface.php");?>
            </div>
            >
            </div>
        

    </div>
    

    
    <script src="vendor/jquery/jquery.min.js"></script>

    
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
