<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "empleadosinfo.php" ?>
<?php include "usuariosinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$empleados_list = new cempleados_list();
$Page =& $empleados_list;

// Page init processing
$empleados_list->Page_Init();

// Page main processing
$empleados_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($empleados->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var empleados_list = new ew_Page("empleados_list");

// page properties
empleados_list.PageID = "list"; // page ID
var EW_PAGE_ID = empleados_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
empleados_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empleados_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empleados_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empleados_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($empleados->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($empleados->Export == "" && $empleados->SelectLimit);
	if (!$bSelectLimit)
		$rs = $empleados_list->LoadRecordset();
	$empleados_list->lTotalRecs = ($bSelectLimit) ? $empleados->SelectRecordCount() : $rs->RecordCount();
	$empleados_list->lStartRec = 1;
	if ($empleados_list->lDisplayRecs <= 0) // Display all records
		$empleados_list->lDisplayRecs = $empleados_list->lTotalRecs;
	if (!($empleados->ExportAll && $empleados->Export <> ""))
		$empleados_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $empleados_list->LoadRecordset($empleados_list->lStartRec-1, $empleados_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Empleados
<?php if ($empleados->Export == "" && $empleados->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $empleados_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $empleados_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $empleados_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($empleados->Export == "" && $empleados->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(empleados_list);" style="text-decoration: none;"><img id="empleados_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="empleados_list_SearchPanel">
<form name="fempleadoslistsrch" id="fempleadoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="empleados">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($empleados->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $empleados_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($empleados->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($empleados->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($empleados->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $empleados_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($empleados->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($empleados->CurrentAction <> "gridadd" && $empleados->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empleados_list->Pager)) $empleados_list->Pager = new cPrevNextPager($empleados_list->lStartRec, $empleados_list->lDisplayRecs, $empleados_list->lTotalRecs) ?>
<?php if ($empleados_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empleados_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empleados_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empleados_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empleados_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empleados_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empleados_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $empleados_list->Pager->FromIndex ?> a <?php echo $empleados_list->Pager->ToIndex ?> de <?php echo $empleados_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($empleados_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($empleados_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="empleados">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($empleados_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($empleados_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($empleados_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($empleados_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($empleados_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($empleados_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($empleados->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empleados->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($empleados_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fempleadoslist)) alert('No se seleccionaron registros'); else {document.fempleadoslist.action='empleadosdelete.php';document.fempleadoslist.encoding='application/x-www-form-urlencoded';document.fempleadoslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fempleadoslist" id="fempleadoslist" class="ewForm" action="" method="post">
<?php if ($empleados_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$empleados_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$empleados_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$empleados_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$empleados_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$empleados_list->lOptionCnt++; // Multi-select
}
	$empleados_list->lOptionCnt += count($empleados_list->ListOptions->Items); // Custom list options
?>
<?php echo $empleados->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($empleados->id_empleado->Visible) { // id_empleado ?>
	<?php if ($empleados->SortUrl($empleados->id_empleado) == "") { ?>
		<td>Id Empleado</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->id_empleado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Empleado</td><td style="width: 10px;"><?php if ($empleados->id_empleado->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->id_empleado->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->id_empresa->Visible) { // id_empresa ?>
	<?php if ($empleados->SortUrl($empleados->id_empresa) == "") { ?>
		<td>Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->id_empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Empresa</td><td style="width: 10px;"><?php if ($empleados->id_empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->id_empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->nombre_completo->Visible) { // nombre_completo ?>
	<?php if ($empleados->SortUrl($empleados->nombre_completo) == "") { ?>
		<td>Nombre Completo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->nombre_completo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre Completo&nbsp;(*)</td><td style="width: 10px;"><?php if ($empleados->nombre_completo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->nombre_completo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->cedula->Visible) { // cedula ?>
	<?php if ($empleados->SortUrl($empleados->cedula) == "") { ?>
		<td>Cedula</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->cedula) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Cedula&nbsp;(*)</td><td style="width: 10px;"><?php if ($empleados->cedula->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->cedula->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->fecha_ingreso->Visible) { // fecha_ingreso ?>
	<?php if ($empleados->SortUrl($empleados->fecha_ingreso) == "") { ?>
		<td>Fecha Ingreso</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->fecha_ingreso) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Fecha Ingreso</td><td style="width: 10px;"><?php if ($empleados->fecha_ingreso->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->fecha_ingreso->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->ultimas_vacaciones->Visible) { // ultimas_vacaciones ?>
	<?php if ($empleados->SortUrl($empleados->ultimas_vacaciones) == "") { ?>
		<td>Ult.Vacaciones</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->ultimas_vacaciones) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Ult.Vacaciones&nbsp;(*)</td><td style="width: 10px;"><?php if ($empleados->ultimas_vacaciones->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->ultimas_vacaciones->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->proximas_vacaciones->Visible) { // proximas_vacaciones ?>
	<?php if ($empleados->SortUrl($empleados->proximas_vacaciones) == "") { ?>
		<td>Prox.Vacaciones</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->proximas_vacaciones) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Prox.Vacaciones&nbsp;(*)</td><td style="width: 10px;"><?php if ($empleados->proximas_vacaciones->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->proximas_vacaciones->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->Posicion->Visible) { // Posicion ?>
	<?php if ($empleados->SortUrl($empleados->Posicion) == "") { ?>
		<td>Posicion</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->Posicion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Posicion&nbsp;(*)</td><td style="width: 10px;"><?php if ($empleados->Posicion->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->Posicion->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->salario_mensual->Visible) { // salario_mensual ?>
	<?php if ($empleados->SortUrl($empleados->salario_mensual) == "") { ?>
		<td>Salario Mensual</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->salario_mensual) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Salario Mensual</td><td style="width: 10px;"><?php if ($empleados->salario_mensual->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->salario_mensual->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->salario_quincenal->Visible) { // salario_quincenal ?>
	<?php if ($empleados->SortUrl($empleados->salario_quincenal) == "") { ?>
		<td>Salario Quincenal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->salario_quincenal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Salario Quincenal</td><td style="width: 10px;"><?php if ($empleados->salario_quincenal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->salario_quincenal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->deducible_afp->Visible) { // deducible_afp ?>
	<?php if ($empleados->SortUrl($empleados->deducible_afp) == "") { ?>
		<td>Deducible Afp</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->deducible_afp) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Deducible Afp</td><td style="width: 10px;"><?php if ($empleados->deducible_afp->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->deducible_afp->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->deducible_sf->Visible) { // deducible_sf ?>
	<?php if ($empleados->SortUrl($empleados->deducible_sf) == "") { ?>
		<td>Deducible Sf</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empleados->SortUrl($empleados->deducible_sf) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Deducible Sf</td><td style="width: 10px;"><?php if ($empleados->deducible_sf->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empleados->deducible_sf->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empleados->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="empleados_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($empleados_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($empleados->ExportAll && $empleados->Export <> "") {
	$empleados_list->lStopRec = $empleados_list->lTotalRecs;
} else {
	$empleados_list->lStopRec = $empleados_list->lStartRec + $empleados_list->lDisplayRecs - 1; // Set the last record to display
}
$empleados_list->lRecCount = $empleados_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$empleados->SelectLimit && $empleados_list->lStartRec > 1)
		$rs->Move($empleados_list->lStartRec - 1);
}
$empleados->salario_mensual->Total = 0; // Initialize total to zero for aggregation
$empleados->salario_quincenal->Total = 0; // Initialize total to zero for aggregation
$empleados->deducible_afp->Total = 0; // Initialize total to zero for aggregation
$empleados->deducible_sf->Total = 0; // Initialize total to zero for aggregation
$empleados_list->lRowCnt = 0;
while (($empleados->CurrentAction == "gridadd" || !$rs->EOF) &&
	$empleados_list->lRecCount < $empleados_list->lStopRec) {
	$empleados_list->lRecCount++;
	if (intval($empleados_list->lRecCount) >= intval($empleados_list->lStartRec)) {
		$empleados_list->lRowCnt++;

	// Init row class and style
	$empleados->CssClass = "";
	$empleados->CssStyle = "";
	$empleados->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($empleados->CurrentAction == "gridadd") {
		$empleados_list->LoadDefaultValues(); // Load default values
	} else {
		$empleados_list->LoadRowValues($rs); // Load row values
	}
	if (is_numeric($empleados->salario_mensual->CurrentValue)) $empleados->salario_mensual->Total += $empleados->salario_mensual->CurrentValue; // Accumulate total
	if (is_numeric($empleados->salario_quincenal->CurrentValue)) $empleados->salario_quincenal->Total += $empleados->salario_quincenal->CurrentValue; // Accumulate total
	if (is_numeric($empleados->deducible_afp->CurrentValue)) $empleados->deducible_afp->Total += $empleados->deducible_afp->CurrentValue; // Accumulate total
	if (is_numeric($empleados->deducible_sf->CurrentValue)) $empleados->deducible_sf->Total += $empleados->deducible_sf->CurrentValue; // Accumulate total
	$empleados->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$empleados_list->RenderRow();
?>
	<tr<?php echo $empleados->RowAttributes() ?>>
	<?php if ($empleados->id_empleado->Visible) { // id_empleado ?>
		<td<?php echo $empleados->id_empleado->CellAttributes() ?>>
<div<?php echo $empleados->id_empleado->ViewAttributes() ?>><?php echo $empleados->id_empleado->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->id_empresa->Visible) { // id_empresa ?>
		<td<?php echo $empleados->id_empresa->CellAttributes() ?>>
<div<?php echo $empleados->id_empresa->ViewAttributes() ?>><?php echo $empleados->id_empresa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->nombre_completo->Visible) { // nombre_completo ?>
		<td<?php echo $empleados->nombre_completo->CellAttributes() ?>>
<div<?php echo $empleados->nombre_completo->ViewAttributes() ?>><?php echo $empleados->nombre_completo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->cedula->Visible) { // cedula ?>
		<td<?php echo $empleados->cedula->CellAttributes() ?>>
<div<?php echo $empleados->cedula->ViewAttributes() ?>><?php echo $empleados->cedula->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->fecha_ingreso->Visible) { // fecha_ingreso ?>
		<td<?php echo $empleados->fecha_ingreso->CellAttributes() ?>>
<div<?php echo $empleados->fecha_ingreso->ViewAttributes() ?>><?php echo $empleados->fecha_ingreso->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->ultimas_vacaciones->Visible) { // ultimas_vacaciones ?>
		<td<?php echo $empleados->ultimas_vacaciones->CellAttributes() ?>>
<div<?php echo $empleados->ultimas_vacaciones->ViewAttributes() ?>><?php echo $empleados->ultimas_vacaciones->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->proximas_vacaciones->Visible) { // proximas_vacaciones ?>
		<td<?php echo $empleados->proximas_vacaciones->CellAttributes() ?>>
<div<?php echo $empleados->proximas_vacaciones->ViewAttributes() ?>><?php echo $empleados->proximas_vacaciones->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->Posicion->Visible) { // Posicion ?>
		<td<?php echo $empleados->Posicion->CellAttributes() ?>>
<div<?php echo $empleados->Posicion->ViewAttributes() ?>><?php echo $empleados->Posicion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->salario_mensual->Visible) { // salario_mensual ?>
		<td<?php echo $empleados->salario_mensual->CellAttributes() ?>>
<div<?php echo $empleados->salario_mensual->ViewAttributes() ?>><?php echo $empleados->salario_mensual->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->salario_quincenal->Visible) { // salario_quincenal ?>
		<td<?php echo $empleados->salario_quincenal->CellAttributes() ?>>
<div<?php echo $empleados->salario_quincenal->ViewAttributes() ?>><?php echo $empleados->salario_quincenal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->deducible_afp->Visible) { // deducible_afp ?>
		<td<?php echo $empleados->deducible_afp->CellAttributes() ?>>
<div<?php echo $empleados->deducible_afp->ViewAttributes() ?>><?php echo $empleados->deducible_afp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empleados->deducible_sf->Visible) { // deducible_sf ?>
		<td<?php echo $empleados->deducible_sf->CellAttributes() ?>>
<div<?php echo $empleados->deducible_sf->ViewAttributes() ?>><?php echo $empleados->deducible_sf->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($empleados->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $empleados->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $empleados->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $empleados->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($empleados->id_empleado->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($empleados_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($empleados->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php
$empleados->salario_mensual->CurrentValue = $empleados->salario_mensual->Total;
$empleados->salario_mensual->ViewValue = $empleados->salario_mensual->CurrentValue;
$empleados->salario_mensual->CssStyle = "";
$empleados->salario_mensual->CssClass = "";
$empleados->salario_mensual->ViewCustomAttributes = "";
$empleados->salario_mensual->HrefValue = ""; // Clear href value
$empleados->salario_quincenal->CurrentValue = $empleados->salario_quincenal->Total;
$empleados->salario_quincenal->ViewValue = $empleados->salario_quincenal->CurrentValue;
$empleados->salario_quincenal->CssStyle = "";
$empleados->salario_quincenal->CssClass = "";
$empleados->salario_quincenal->ViewCustomAttributes = "";
$empleados->salario_quincenal->HrefValue = ""; // Clear href value
$empleados->deducible_afp->CurrentValue = $empleados->deducible_afp->Total;
$empleados->deducible_afp->ViewValue = $empleados->deducible_afp->CurrentValue;
$empleados->deducible_afp->CssStyle = "";
$empleados->deducible_afp->CssClass = "";
$empleados->deducible_afp->ViewCustomAttributes = "";
$empleados->deducible_afp->HrefValue = ""; // Clear href value
$empleados->deducible_sf->CurrentValue = $empleados->deducible_sf->Total;
$empleados->deducible_sf->ViewValue = $empleados->deducible_sf->CurrentValue;
$empleados->deducible_sf->CssStyle = "";
$empleados->deducible_sf->CssClass = "";
$empleados->deducible_sf->ViewCustomAttributes = "";
$empleados->deducible_sf->HrefValue = ""; // Clear href value
?>
<?php if ($empleados_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
	<?php if ($empleados->id_empleado->Visible) { // id_empleado ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->id_empresa->Visible) { // id_empresa ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->nombre_completo->Visible) { // nombre_completo ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->cedula->Visible) { // cedula ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->fecha_ingreso->Visible) { // fecha_ingreso ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->ultimas_vacaciones->Visible) { // ultimas_vacaciones ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->proximas_vacaciones->Visible) { // proximas_vacaciones ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->Posicion->Visible) { // Posicion ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($empleados->salario_mensual->Visible) { // salario_mensual ?>
		<td>
		Total: 
<div<?php echo $empleados->salario_mensual->ViewAttributes() ?>><?php echo $empleados->salario_mensual->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($empleados->salario_quincenal->Visible) { // salario_quincenal ?>
		<td>
		Total: 
<div<?php echo $empleados->salario_quincenal->ViewAttributes() ?>><?php echo $empleados->salario_quincenal->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($empleados->deducible_afp->Visible) { // deducible_afp ?>
		<td>
		Total: 
<div<?php echo $empleados->deducible_afp->ViewAttributes() ?>><?php echo $empleados->deducible_afp->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($empleados->deducible_sf->Visible) { // deducible_sf ?>
		<td>
		Total: 
<div<?php echo $empleados->deducible_sf->ViewAttributes() ?>><?php echo $empleados->deducible_sf->ViewValue ?></div>
		</td>
	<?php } ?>
<?php if ($empleados->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php

// Custom list options
foreach ($empleados_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->FooterCellHtml;
}
?>
<?php } ?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($empleados_list->lTotalRecs > 0) { ?>
<?php if ($empleados->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($empleados->CurrentAction <> "gridadd" && $empleados->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empleados_list->Pager)) $empleados_list->Pager = new cPrevNextPager($empleados_list->lStartRec, $empleados_list->lDisplayRecs, $empleados_list->lTotalRecs) ?>
<?php if ($empleados_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empleados_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empleados_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empleados_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empleados_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empleados_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_list->PageUrl() ?>start=<?php echo $empleados_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empleados_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $empleados_list->Pager->FromIndex ?> a <?php echo $empleados_list->Pager->ToIndex ?> de <?php echo $empleados_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($empleados_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($empleados_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="empleados">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($empleados_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($empleados_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($empleados_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($empleados_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($empleados_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($empleados_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($empleados->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($empleados_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empleados->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($empleados_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fempleadoslist)) alert('No se seleccionaron registros'); else {document.fempleadoslist.action='empleadosdelete.php';document.fempleadoslist.encoding='application/x-www-form-urlencoded';document.fempleadoslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($empleados->Export == "" && $empleados->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(empleados_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($empleados->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cempleados_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'empleados';

	// Page Object Name
	var $PageObjName = 'empleados_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $empleados;
		if ($empleados->UseTokenInUrl) $PageUrl .= "t=" . $empleados->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $empleados;
		if ($empleados->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($empleados->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($empleados->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cempleados_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["empleados"] = new cempleados();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empleados', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $empleados;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$empleados->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $empleados->Export; // Get export parameter, used in header
	$gsExportFile = $empleados->TableVar; // Get export file, used in header
	if ($empleados->Export == "print" || $empleados->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($empleados->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($empleados->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $empleados;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($empleados->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $empleados->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$empleados->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$empleados->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$empleados->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$empleados->setSessionWhere($sFilter);
		$empleados->CurrentFilter = "";

		// Export data only
		if (in_array($empleados->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $empleados;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 20; // Non-numeric, load default
				}
			}
			$empleados->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$empleados->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $empleados;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $empleados->nombre_completo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empleados->cedula->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empleados->ultimas_vacaciones->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empleados->proximas_vacaciones->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empleados->Posicion->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $empleados;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$empleados->setBasicSearchKeyword($sSearchKeyword);
			$empleados->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $empleados;
		$this->sSrchWhere = "";
		$empleados->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $empleados;
		$empleados->setBasicSearchKeyword("");
		$empleados->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $empleados;
		$this->sSrchWhere = $empleados->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $empleados;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$empleados->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$empleados->CurrentOrderType = @$_GET["ordertype"];
			$empleados->UpdateSort($empleados->id_empleado); // Field 
			$empleados->UpdateSort($empleados->id_empresa); // Field 
			$empleados->UpdateSort($empleados->nombre_completo); // Field 
			$empleados->UpdateSort($empleados->cedula); // Field 
			$empleados->UpdateSort($empleados->fecha_ingreso); // Field 
			$empleados->UpdateSort($empleados->ultimas_vacaciones); // Field 
			$empleados->UpdateSort($empleados->proximas_vacaciones); // Field 
			$empleados->UpdateSort($empleados->Posicion); // Field 
			$empleados->UpdateSort($empleados->salario_mensual); // Field 
			$empleados->UpdateSort($empleados->salario_quincenal); // Field 
			$empleados->UpdateSort($empleados->deducible_afp); // Field 
			$empleados->UpdateSort($empleados->deducible_sf); // Field 
			$empleados->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $empleados;
		$sOrderBy = $empleados->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($empleados->SqlOrderBy() <> "") {
				$sOrderBy = $empleados->SqlOrderBy();
				$empleados->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $empleados;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$empleados->setSessionOrderBy($sOrderBy);
				$empleados->id_empleado->setSort("");
				$empleados->id_empresa->setSort("");
				$empleados->nombre_completo->setSort("");
				$empleados->cedula->setSort("");
				$empleados->fecha_ingreso->setSort("");
				$empleados->ultimas_vacaciones->setSort("");
				$empleados->proximas_vacaciones->setSort("");
				$empleados->Posicion->setSort("");
				$empleados->salario_mensual->setSort("");
				$empleados->salario_quincenal->setSort("");
				$empleados->deducible_afp->setSort("");
				$empleados->deducible_sf->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$empleados->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $empleados;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$empleados->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$empleados->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $empleados->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$empleados->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$empleados->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$empleados->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $empleados;

		// Call Recordset Selecting event
		$empleados->Recordset_Selecting($empleados->CurrentFilter);

		// Load list page SQL
		$sSql = $empleados->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$empleados->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $empleados;
		$sFilter = $empleados->KeyFilter();

		// Call Row Selecting event
		$empleados->Row_Selecting($sFilter);

		// Load sql based on filter
		$empleados->CurrentFilter = $sFilter;
		$sSql = $empleados->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$empleados->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $empleados;
		$empleados->id_empleado->setDbValue($rs->fields('id_empleado'));
		$empleados->id_empresa->setDbValue($rs->fields('id_empresa'));
		$empleados->nombre_completo->setDbValue($rs->fields('nombre_completo'));
		$empleados->cedula->setDbValue($rs->fields('cedula'));
		$empleados->fecha_ingreso->setDbValue($rs->fields('fecha_ingreso'));
		$empleados->ultimas_vacaciones->setDbValue($rs->fields('ultimas_vacaciones'));
		$empleados->proximas_vacaciones->setDbValue($rs->fields('proximas_vacaciones'));
		$empleados->Posicion->setDbValue($rs->fields('Posicion'));
		$empleados->salario_mensual->setDbValue($rs->fields('salario_mensual'));
		$empleados->salario_quincenal->setDbValue($rs->fields('salario_quincenal'));
		$empleados->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$empleados->deducible_sf->setDbValue($rs->fields('deducible_sf'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $empleados;

		// Call Row_Rendering event
		$empleados->Row_Rendering();

		// Common render codes for all row types
		// id_empleado

		$empleados->id_empleado->CellCssStyle = "";
		$empleados->id_empleado->CellCssClass = "";

		// id_empresa
		$empleados->id_empresa->CellCssStyle = "";
		$empleados->id_empresa->CellCssClass = "";

		// nombre_completo
		$empleados->nombre_completo->CellCssStyle = "";
		$empleados->nombre_completo->CellCssClass = "";

		// cedula
		$empleados->cedula->CellCssStyle = "";
		$empleados->cedula->CellCssClass = "";

		// fecha_ingreso
		$empleados->fecha_ingreso->CellCssStyle = "";
		$empleados->fecha_ingreso->CellCssClass = "";

		// ultimas_vacaciones
		$empleados->ultimas_vacaciones->CellCssStyle = "";
		$empleados->ultimas_vacaciones->CellCssClass = "";

		// proximas_vacaciones
		$empleados->proximas_vacaciones->CellCssStyle = "";
		$empleados->proximas_vacaciones->CellCssClass = "";

		// Posicion
		$empleados->Posicion->CellCssStyle = "";
		$empleados->Posicion->CellCssClass = "";

		// salario_mensual
		$empleados->salario_mensual->CellCssStyle = "";
		$empleados->salario_mensual->CellCssClass = "";

		// salario_quincenal
		$empleados->salario_quincenal->CellCssStyle = "";
		$empleados->salario_quincenal->CellCssClass = "";

		// deducible_afp
		$empleados->deducible_afp->CellCssStyle = "";
		$empleados->deducible_afp->CellCssClass = "";

		// deducible_sf
		$empleados->deducible_sf->CellCssStyle = "";
		$empleados->deducible_sf->CellCssClass = "";
		if ($empleados->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_empleado
			$empleados->id_empleado->ViewValue = $empleados->id_empleado->CurrentValue;
			$empleados->id_empleado->CssStyle = "";
			$empleados->id_empleado->CssClass = "";
			$empleados->id_empleado->ViewCustomAttributes = "";

			// id_empresa
			if (strval($empleados->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($empleados->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$empleados->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$empleados->id_empresa->ViewValue = $empleados->id_empresa->CurrentValue;
				}
			} else {
				$empleados->id_empresa->ViewValue = NULL;
			}
			$empleados->id_empresa->CssStyle = "";
			$empleados->id_empresa->CssClass = "";
			$empleados->id_empresa->ViewCustomAttributes = "";

			// nombre_completo
			$empleados->nombre_completo->ViewValue = $empleados->nombre_completo->CurrentValue;
			$empleados->nombre_completo->CssStyle = "";
			$empleados->nombre_completo->CssClass = "";
			$empleados->nombre_completo->ViewCustomAttributes = "";

			// cedula
			$empleados->cedula->ViewValue = $empleados->cedula->CurrentValue;
			$empleados->cedula->CssStyle = "";
			$empleados->cedula->CssClass = "";
			$empleados->cedula->ViewCustomAttributes = "";

			// fecha_ingreso
			$empleados->fecha_ingreso->ViewValue = $empleados->fecha_ingreso->CurrentValue;
			$empleados->fecha_ingreso->ViewValue = ew_FormatDateTime($empleados->fecha_ingreso->ViewValue, 7);
			$empleados->fecha_ingreso->CssStyle = "";
			$empleados->fecha_ingreso->CssClass = "";
			$empleados->fecha_ingreso->ViewCustomAttributes = "";

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->ViewValue = $empleados->ultimas_vacaciones->CurrentValue;
			$empleados->ultimas_vacaciones->CssStyle = "";
			$empleados->ultimas_vacaciones->CssClass = "";
			$empleados->ultimas_vacaciones->ViewCustomAttributes = "";

			// proximas_vacaciones
			$empleados->proximas_vacaciones->ViewValue = $empleados->proximas_vacaciones->CurrentValue;
			$empleados->proximas_vacaciones->CssStyle = "";
			$empleados->proximas_vacaciones->CssClass = "";
			$empleados->proximas_vacaciones->ViewCustomAttributes = "";

			// Posicion
			$empleados->Posicion->ViewValue = $empleados->Posicion->CurrentValue;
			$empleados->Posicion->CssStyle = "";
			$empleados->Posicion->CssClass = "";
			$empleados->Posicion->ViewCustomAttributes = "";

			// salario_mensual
			$empleados->salario_mensual->ViewValue = $empleados->salario_mensual->CurrentValue;
			$empleados->salario_mensual->CssStyle = "";
			$empleados->salario_mensual->CssClass = "";
			$empleados->salario_mensual->ViewCustomAttributes = "";

			// salario_quincenal
			$empleados->salario_quincenal->ViewValue = $empleados->salario_quincenal->CurrentValue;
			$empleados->salario_quincenal->CssStyle = "";
			$empleados->salario_quincenal->CssClass = "";
			$empleados->salario_quincenal->ViewCustomAttributes = "";

			// deducible_afp
			$empleados->deducible_afp->ViewValue = $empleados->deducible_afp->CurrentValue;
			$empleados->deducible_afp->CssStyle = "";
			$empleados->deducible_afp->CssClass = "";
			$empleados->deducible_afp->ViewCustomAttributes = "";

			// deducible_sf
			$empleados->deducible_sf->ViewValue = $empleados->deducible_sf->CurrentValue;
			$empleados->deducible_sf->CssStyle = "";
			$empleados->deducible_sf->CssClass = "";
			$empleados->deducible_sf->ViewCustomAttributes = "";

			// id_empleado
			$empleados->id_empleado->HrefValue = "";

			// id_empresa
			$empleados->id_empresa->HrefValue = "";

			// nombre_completo
			$empleados->nombre_completo->HrefValue = "";

			// cedula
			$empleados->cedula->HrefValue = "";

			// fecha_ingreso
			$empleados->fecha_ingreso->HrefValue = "";

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->HrefValue = "";

			// proximas_vacaciones
			$empleados->proximas_vacaciones->HrefValue = "";

			// Posicion
			$empleados->Posicion->HrefValue = "";

			// salario_mensual
			$empleados->salario_mensual->HrefValue = "";

			// salario_quincenal
			$empleados->salario_quincenal->HrefValue = "";

			// deducible_afp
			$empleados->deducible_afp->HrefValue = "";

			// deducible_sf
			$empleados->deducible_sf->HrefValue = "";
		}

		// Call Row Rendered event
		$empleados->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $empleados;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($empleados->ExportAll) {
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export 1 page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($empleados->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($empleados->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $empleados->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_empleado', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'id_empresa', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'nombre_completo', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'cedula', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'fecha_ingreso', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'ultimas_vacaciones', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'proximas_vacaciones', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'Posicion', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'salario_mensual', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'salario_quincenal', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'deducible_afp', $empleados->Export);
				ew_ExportAddValue($sExportStr, 'deducible_sf', $empleados->Export);
				echo ew_ExportLine($sExportStr, $empleados->Export);
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row for display
				$empleados->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($empleados->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_empleado', $empleados->id_empleado->CurrentValue);
					$XmlDoc->AddField('id_empresa', $empleados->id_empresa->CurrentValue);
					$XmlDoc->AddField('nombre_completo', $empleados->nombre_completo->CurrentValue);
					$XmlDoc->AddField('cedula', $empleados->cedula->CurrentValue);
					$XmlDoc->AddField('fecha_ingreso', $empleados->fecha_ingreso->CurrentValue);
					$XmlDoc->AddField('ultimas_vacaciones', $empleados->ultimas_vacaciones->CurrentValue);
					$XmlDoc->AddField('proximas_vacaciones', $empleados->proximas_vacaciones->CurrentValue);
					$XmlDoc->AddField('Posicion', $empleados->Posicion->CurrentValue);
					$XmlDoc->AddField('salario_mensual', $empleados->salario_mensual->CurrentValue);
					$XmlDoc->AddField('salario_quincenal', $empleados->salario_quincenal->CurrentValue);
					$XmlDoc->AddField('deducible_afp', $empleados->deducible_afp->CurrentValue);
					$XmlDoc->AddField('deducible_sf', $empleados->deducible_sf->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $empleados->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_empleado', $empleados->id_empleado->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('id_empresa', $empleados->id_empresa->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('nombre_completo', $empleados->nombre_completo->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('cedula', $empleados->cedula->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('fecha_ingreso', $empleados->fecha_ingreso->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('ultimas_vacaciones', $empleados->ultimas_vacaciones->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('proximas_vacaciones', $empleados->proximas_vacaciones->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('Posicion', $empleados->Posicion->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('salario_mensual', $empleados->salario_mensual->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('salario_quincenal', $empleados->salario_quincenal->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('deducible_afp', $empleados->deducible_afp->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportField('deducible_sf', $empleados->deducible_sf->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $empleados->id_empleado->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->id_empresa->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->nombre_completo->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->cedula->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->fecha_ingreso->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->ultimas_vacaciones->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->proximas_vacaciones->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->Posicion->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->salario_mensual->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->salario_quincenal->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->deducible_afp->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						ew_ExportAddValue($sExportStr, $empleados->deducible_sf->ExportValue($empleados->Export, $empleados->ExportOriginalValue), $empleados->Export);
						echo ew_ExportLine($sExportStr, $empleados->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($empleados->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($empleados->Export);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
