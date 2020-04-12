<?php

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/houses.php");
	include("$currDir/houses_dml.php");

	
	$perm=getTablePermissions('houses');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "houses";


	$x->QueryFieldsTV = array(   
		"`houses`.`id`" => "id",
		"`houses`.`house_number`" => "house_number",
		"`houses`.`features`" => "features",
		"`houses`.`rent`" => "rent",
		"`houses`.`status`" => "status"
	);

	$x->SortFields = array(   
		1 => '`houses`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5
	);


	$x->QueryFieldsCSV = array(   
		"`houses`.`id`" => "id",
		"`houses`.`house_number`" => "house_number",
		"`houses`.`features`" => "features",
		"`houses`.`rent`" => "rent",
		"`houses`.`status`" => "status"
	);
	
	$x->QueryFieldsFilters = array(   
		"`houses`.`id`" => "ID",
		"`houses`.`house_number`" => "House number",
		"`houses`.`features`" => "Features",
		"`houses`.`rent`" => "Rent",
		"`houses`.`status`" => "Status"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`houses`.`id`" => "id",
		"`houses`.`house_number`" => "house_number",
		"`houses`.`features`" => "features",
		"`houses`.`rent`" => "rent",
		"`houses`.`status`" => "status"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`houses` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "houses_view.php";
	$x->RedirectAfterInsert = "houses_view.php?SelectedID=#ID#";
	$x->TableTitle = "Houses";
	$x->TableIcon = "resources/table_icons/building_add.png";
	$x->PrimaryKey = "`houses`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150);
	$x->ColCaption = array("House number", "Features", "Rent", "Status");
	$x->ColFieldName = array('house_number', 'features', 'rent', 'status');
	$x->ColNumber  = array(2, 3, 4, 5);

	// template paths below are based on the app main directory
	$x->Template = 'templates/houses_templateTV.html';
	$x->SelectedTemplate = 'templates/houses_templateTVS.html';
	$x->TemplateDV = 'templates/houses_templateDV.html';
	$x->TemplateDVP = 'templates/houses_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `houses`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='houses' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `houses`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='houses' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`houses`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: houses_init
	$render=TRUE;
	if(function_exists('houses_init')){
		$args=array();
		$render=houses_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: houses_header
	$headerCode='';
	if(function_exists('houses_header')){
		$args=array();
		$headerCode=houses_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: houses_footer
	$footerCode='';
	if(function_exists('houses_footer')){
		$args=array();
		$footerCode=houses_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>