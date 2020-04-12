<?php


	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/tenants.php");
	include("$currDir/tenants_dml.php");

	
	$perm=getTablePermissions('tenants');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "tenants";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`tenants`.`id`" => "id",
		"`tenants`.`fullname`" => "fullname",
		"`tenants`.`gender`" => "gender",
		"`tenants`.`national_id`" => "national_id",
		"`tenants`.`phone_number`" => "phone_number",
		"`tenants`.`email`" => "email",
		"if(`tenants`.`registration_date`,date_format(`tenants`.`registration_date`,'%m/%d/%Y'),'')" => "registration_date",
		"IF(    CHAR_LENGTH(`houses1`.`house_number`), CONCAT_WS('',   `houses1`.`house_number`), '') /* House */" => "house",
		"`tenants`.`agreement_document`" => "agreement_document",
		"`tenants`.`status`" => "status",
		"if(`tenants`.`exit_date`,date_format(`tenants`.`exit_date`,'%m/%d/%Y'),'')" => "exit_date"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`tenants`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`tenants`.`registration_date`',
		8 => '`houses1`.`house_number`',
		9 => 9,
		10 => 10,
		11 => '`tenants`.`exit_date`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`tenants`.`id`" => "id",
		"`tenants`.`fullname`" => "fullname",
		"`tenants`.`gender`" => "gender",
		"`tenants`.`national_id`" => "national_id",
		"`tenants`.`phone_number`" => "phone_number",
		"`tenants`.`email`" => "email",
		"if(`tenants`.`registration_date`,date_format(`tenants`.`registration_date`,'%m/%d/%Y'),'')" => "registration_date",
		"IF(    CHAR_LENGTH(`houses1`.`house_number`), CONCAT_WS('',   `houses1`.`house_number`), '') /* House */" => "house",
		"`tenants`.`agreement_document`" => "agreement_document",
		"`tenants`.`status`" => "status",
		"if(`tenants`.`exit_date`,date_format(`tenants`.`exit_date`,'%m/%d/%Y'),'')" => "exit_date"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`tenants`.`id`" => "ID",
		"`tenants`.`fullname`" => "Fullname",
		"`tenants`.`gender`" => "Gender",
		"`tenants`.`national_id`" => "National ID",
		"`tenants`.`phone_number`" => "Phone number",
		"`tenants`.`email`" => "Email",
		"`tenants`.`registration_date`" => "Registration date",
		"IF(    CHAR_LENGTH(`houses1`.`house_number`), CONCAT_WS('',   `houses1`.`house_number`), '') /* House */" => "House",
		"`tenants`.`agreement_document`" => "Agreement document",
		"`tenants`.`status`" => "Status",
		"`tenants`.`exit_date`" => "Exit date"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`tenants`.`id`" => "id",
		"`tenants`.`fullname`" => "fullname",
		"`tenants`.`gender`" => "gender",
		"`tenants`.`national_id`" => "national_id",
		"`tenants`.`phone_number`" => "phone_number",
		"`tenants`.`email`" => "email",
		"if(`tenants`.`registration_date`,date_format(`tenants`.`registration_date`,'%m/%d/%Y'),'')" => "registration_date",
		"IF(    CHAR_LENGTH(`houses1`.`house_number`), CONCAT_WS('',   `houses1`.`house_number`), '') /* House */" => "house",
		"`tenants`.`agreement_document`" => "agreement_document",
		"`tenants`.`status`" => "status",
		"if(`tenants`.`exit_date`,date_format(`tenants`.`exit_date`,'%m/%d/%Y'),'')" => "exit_date"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'house' => 'House');

	$x->QueryFrom = "`tenants` LEFT JOIN `houses` as houses1 ON `houses1`.`id`=`tenants`.`house` ";
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
	$x->ScriptFileName = "tenants_view.php";
	$x->RedirectAfterInsert = "tenants_view.php?SelectedID=#ID#";
	$x->TableTitle = "Tenants";
	$x->TableIcon = "resources/table_icons/group_add.png";
	$x->PrimaryKey = "`tenants`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Fullname", "Gender", "National ID", "Phone number", "Email", "Registration date", "House", "Agreement document", "Status", "Exit date");
	$x->ColFieldName = array('fullname', 'gender', 'national_id', 'phone_number', 'email', 'registration_date', 'house', 'agreement_document', 'status', 'exit_date');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11);

	// template paths below are based on the app main directory
	$x->Template = 'templates/tenants_templateTV.html';
	$x->SelectedTemplate = 'templates/tenants_templateTVS.html';
	$x->TemplateDV = 'templates/tenants_templateDV.html';
	$x->TemplateDVP = 'templates/tenants_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `tenants`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='tenants' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `tenants`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='tenants' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`tenants`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: tenants_init
	$render=TRUE;
	if(function_exists('tenants_init')){
		$args=array();
		$render=tenants_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: tenants_header
	$headerCode='';
	if(function_exists('tenants_header')){
		$args=array();
		$headerCode=tenants_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: tenants_footer
	$footerCode='';
	if(function_exists('tenants_footer')){
		$args=array();
		$footerCode=tenants_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>