<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cuentas_bancariasinfo.php" ?>
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
$cuentas_bancarias_list = new ccuentas_bancarias_list();
$Page =& $cuentas_bancarias_list;

// Page init processing
$cuentas_bancarias_list->Page_Init();

// Page main processing
$cuentas_bancarias_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cuentas_bancarias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cuentas_bancarias_list = new ew_Page("cuentas_bancarias_list");

// page properties
cuentas_bancarias_list.PageID = "list"; // page ID
var EW_PAGE_ID = cuentas_bancarias_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cuentas_bancarias_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
cuentas_bancarias_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cuentas_bancarias_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuentas_bancarias_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($cuentas_bancarias->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($cuentas_bancarias->Export == "" && $cuentas_bancarias->SelectLimit);
	if (!$bSelectLimit)
		$rs = $cuentas_bancarias_list->LoadRecordset();
	$cuentas_bancarias_list->lTotalRecs = ($bSelectLimit) ? $cuentas_bancarias->SelectRecordCount() : $rs->RecordCount();
	$cuentas_bancarias_list->lStartRec = 1;
	if ($cuentas_bancarias_list->lDisplayRecs <= 0) // Display all records
		$cuentas_bancarias_list->lDisplayRecs = $cuentas_bancarias_list->lTotalRecs;
	if (!($cuentas_bancarias->ExportAll && $cuentas_bancarias->Export <> ""))
		$cuentas_bancarias_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $cuentas_bancarias_list->LoadRecordset($cuentas_bancarias_list->lStartRec-1, $cuentas_bancarias_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Cuentas Bancarias
<?php if ($cuentas_bancarias->Export == "" && $cuentas_bancarias->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($cuentas_bancarias->Export == "" && $cuentas_bancarias->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(cuentas_bancarias_list);" style="text-decoration: none;"><img id="cuentas_bancarias_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="cuentas_bancarias_list_SearchPanel">
<form name="fcuentas_bancariaslistsrch" id="fcuentas_bancariaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="cuentas_bancarias">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($cuentas_bancarias->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($cuentas_bancarias->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($cuentas_bancarias->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($cuentas_bancarias->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $cuentas_bancarias_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($cuentas_bancarias->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($cuentas_bancarias->CurrentAction <> "gridadd" && $cuentas_bancarias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cuentas_bancarias_list->Pager)) $cuentas_bancarias_list->Pager = new cPrevNextPager($cuentas_bancarias_list->lStartRec, $cuentas_bancarias_list->lDisplayRecs, $cuentas_bancarias_list->lTotalRecs) ?>
<?php if ($cuentas_bancarias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($cuentas_bancarias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cuentas_bancarias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cuentas_bancarias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cuentas_bancarias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cuentas_bancarias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $cuentas_bancarias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $cuentas_bancarias_list->Pager->FromIndex ?> a <?php echo $cuentas_bancarias_list->Pager->ToIndex ?> de <?php echo $cuentas_bancarias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($cuentas_bancarias_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="cuentas_bancarias">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($cuentas_bancarias_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($cuentas_bancarias_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($cuentas_bancarias_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($cuentas_bancarias_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($cuentas_bancarias_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($cuentas_bancarias_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($cuentas_bancarias->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cuentas_bancarias->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcuentas_bancariaslist)) alert('No se seleccionaron registros'); else {document.fcuentas_bancariaslist.action='cuentas_bancariasdelete.php';document.fcuentas_bancariaslist.encoding='application/x-www-form-urlencoded';document.fcuentas_bancariaslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcuentas_bancariaslist" id="fcuentas_bancariaslist" class="ewForm" action="" method="post">
<?php if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$cuentas_bancarias_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$cuentas_bancarias_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$cuentas_bancarias_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$cuentas_bancarias_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$cuentas_bancarias_list->lOptionCnt++; // Multi-select
}
	$cuentas_bancarias_list->lOptionCnt += count($cuentas_bancarias_list->ListOptions->Items); // Custom list options
?>
<?php echo $cuentas_bancarias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($cuentas_bancarias->id_banco->Visible) { // id_banco ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->id_banco) == "") { ?>
		<td>Id Banco</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->id_banco) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Banco</td><td style="width: 10px;"><?php if ($cuentas_bancarias->id_banco->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->id_banco->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->id_empresa->Visible) { // id_empresa ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->id_empresa) == "") { ?>
		<td>Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->id_empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Empresa</td><td style="width: 10px;"><?php if ($cuentas_bancarias->id_empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->id_empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->Banco->Visible) { // Banco ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->Banco) == "") { ?>
		<td>Banco</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->Banco) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Banco&nbsp;(*)</td><td style="width: 10px;"><?php if ($cuentas_bancarias->Banco->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->Banco->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->numero_cuenta->Visible) { // numero_cuenta ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->numero_cuenta) == "") { ?>
		<td>Numero Cuenta</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->numero_cuenta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Numero Cuenta&nbsp;(*)</td><td style="width: 10px;"><?php if ($cuentas_bancarias->numero_cuenta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->numero_cuenta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->ejecutivo_cuenta->Visible) { // ejecutivo_cuenta ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->ejecutivo_cuenta) == "") { ?>
		<td>Ejecutivo Cuenta</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->ejecutivo_cuenta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Ejecutivo Cuenta&nbsp;(*)</td><td style="width: 10px;"><?php if ($cuentas_bancarias->ejecutivo_cuenta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->ejecutivo_cuenta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->telefono_ejecutivo->Visible) { // telefono_ejecutivo ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->telefono_ejecutivo) == "") { ?>
		<td>Telefono Ejecutivo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->telefono_ejecutivo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Telefono Ejecutivo&nbsp;(*)</td><td style="width: 10px;"><?php if ($cuentas_bancarias->telefono_ejecutivo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->telefono_ejecutivo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->tipo_cuenta->Visible) { // tipo_cuenta ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->tipo_cuenta) == "") { ?>
		<td>Tipo Cuenta</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->tipo_cuenta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipo Cuenta</td><td style="width: 10px;"><?php if ($cuentas_bancarias->tipo_cuenta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->tipo_cuenta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->moneda->Visible) { // moneda ?>
	<?php if ($cuentas_bancarias->SortUrl($cuentas_bancarias->moneda) == "") { ?>
		<td>Moneda</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuentas_bancarias->SortUrl($cuentas_bancarias->moneda) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Moneda&nbsp;(*)</td><td style="width: 10px;"><?php if ($cuentas_bancarias->moneda->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuentas_bancarias->moneda->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cuentas_bancarias->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="cuentas_bancarias_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($cuentas_bancarias_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($cuentas_bancarias->ExportAll && $cuentas_bancarias->Export <> "") {
	$cuentas_bancarias_list->lStopRec = $cuentas_bancarias_list->lTotalRecs;
} else {
	$cuentas_bancarias_list->lStopRec = $cuentas_bancarias_list->lStartRec + $cuentas_bancarias_list->lDisplayRecs - 1; // Set the last record to display
}
$cuentas_bancarias_list->lRecCount = $cuentas_bancarias_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$cuentas_bancarias->SelectLimit && $cuentas_bancarias_list->lStartRec > 1)
		$rs->Move($cuentas_bancarias_list->lStartRec - 1);
}
$cuentas_bancarias_list->lRowCnt = 0;
while (($cuentas_bancarias->CurrentAction == "gridadd" || !$rs->EOF) &&
	$cuentas_bancarias_list->lRecCount < $cuentas_bancarias_list->lStopRec) {
	$cuentas_bancarias_list->lRecCount++;
	if (intval($cuentas_bancarias_list->lRecCount) >= intval($cuentas_bancarias_list->lStartRec)) {
		$cuentas_bancarias_list->lRowCnt++;

	// Init row class and style
	$cuentas_bancarias->CssClass = "";
	$cuentas_bancarias->CssStyle = "";
	$cuentas_bancarias->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($cuentas_bancarias->CurrentAction == "gridadd") {
		$cuentas_bancarias_list->LoadDefaultValues(); // Load default values
	} else {
		$cuentas_bancarias_list->LoadRowValues($rs); // Load row values
	}
	$cuentas_bancarias->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$cuentas_bancarias_list->RenderRow();
?>
	<tr<?php echo $cuentas_bancarias->RowAttributes() ?>>
	<?php if ($cuentas_bancarias->id_banco->Visible) { // id_banco ?>
		<td<?php echo $cuentas_bancarias->id_banco->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->id_banco->ViewAttributes() ?>><?php echo $cuentas_bancarias->id_banco->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->id_empresa->Visible) { // id_empresa ?>
		<td<?php echo $cuentas_bancarias->id_empresa->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->id_empresa->ViewAttributes() ?>><?php echo $cuentas_bancarias->id_empresa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->Banco->Visible) { // Banco ?>
		<td<?php echo $cuentas_bancarias->Banco->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->Banco->ViewAttributes() ?>><?php echo $cuentas_bancarias->Banco->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->numero_cuenta->Visible) { // numero_cuenta ?>
		<td<?php echo $cuentas_bancarias->numero_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->numero_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->numero_cuenta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->ejecutivo_cuenta->Visible) { // ejecutivo_cuenta ?>
		<td<?php echo $cuentas_bancarias->ejecutivo_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->ejecutivo_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->ejecutivo_cuenta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->telefono_ejecutivo->Visible) { // telefono_ejecutivo ?>
		<td<?php echo $cuentas_bancarias->telefono_ejecutivo->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->telefono_ejecutivo->ViewAttributes() ?>><?php echo $cuentas_bancarias->telefono_ejecutivo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->tipo_cuenta->Visible) { // tipo_cuenta ?>
		<td<?php echo $cuentas_bancarias->tipo_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->tipo_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->tipo_cuenta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cuentas_bancarias->moneda->Visible) { // moneda ?>
		<td<?php echo $cuentas_bancarias->moneda->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->moneda->ViewAttributes() ?>><?php echo $cuentas_bancarias->moneda->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($cuentas_bancarias->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $cuentas_bancarias->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $cuentas_bancarias->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $cuentas_bancarias->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($cuentas_bancarias->id_banco->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($cuentas_bancarias_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($cuentas_bancarias->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
<?php if ($cuentas_bancarias->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($cuentas_bancarias->CurrentAction <> "gridadd" && $cuentas_bancarias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cuentas_bancarias_list->Pager)) $cuentas_bancarias_list->Pager = new cPrevNextPager($cuentas_bancarias_list->lStartRec, $cuentas_bancarias_list->lDisplayRecs, $cuentas_bancarias_list->lTotalRecs) ?>
<?php if ($cuentas_bancarias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($cuentas_bancarias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cuentas_bancarias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cuentas_bancarias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cuentas_bancarias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cuentas_bancarias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_list->PageUrl() ?>start=<?php echo $cuentas_bancarias_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $cuentas_bancarias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $cuentas_bancarias_list->Pager->FromIndex ?> a <?php echo $cuentas_bancarias_list->Pager->ToIndex ?> de <?php echo $cuentas_bancarias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($cuentas_bancarias_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="cuentas_bancarias">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($cuentas_bancarias_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($cuentas_bancarias_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($cuentas_bancarias_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($cuentas_bancarias_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($cuentas_bancarias_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($cuentas_bancarias_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($cuentas_bancarias->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cuentas_bancarias->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($cuentas_bancarias_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcuentas_bancariaslist)) alert('No se seleccionaron registros'); else {document.fcuentas_bancariaslist.action='cuentas_bancariasdelete.php';document.fcuentas_bancariaslist.encoding='application/x-www-form-urlencoded';document.fcuentas_bancariaslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($cuentas_bancarias->Export == "" && $cuentas_bancarias->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(cuentas_bancarias_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($cuentas_bancarias->Export == "") { ?>
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
class ccuentas_bancarias_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'cuentas_bancarias';

	// Page Object Name
	var $PageObjName = 'cuentas_bancarias_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cuentas_bancarias;
		if ($cuentas_bancarias->UseTokenInUrl) $PageUrl .= "t=" . $cuentas_bancarias->TableVar . "&"; // add page token
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
		global $objForm, $cuentas_bancarias;
		if ($cuentas_bancarias->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cuentas_bancarias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cuentas_bancarias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccuentas_bancarias_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["cuentas_bancarias"] = new ccuentas_bancarias();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cuentas_bancarias', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cuentas_bancarias;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$cuentas_bancarias->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $cuentas_bancarias->Export; // Get export parameter, used in header
	$gsExportFile = $cuentas_bancarias->TableVar; // Get export file, used in header
	if ($cuentas_bancarias->Export == "print" || $cuentas_bancarias->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($cuentas_bancarias->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($cuentas_bancarias->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $cuentas_bancarias;
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
		if ($cuentas_bancarias->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $cuentas_bancarias->getRecordsPerPage(); // Restore from Session
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
		$cuentas_bancarias->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$cuentas_bancarias->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
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
		$cuentas_bancarias->setSessionWhere($sFilter);
		$cuentas_bancarias->CurrentFilter = "";

		// Export data only
		if (in_array($cuentas_bancarias->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $cuentas_bancarias;
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
			$cuentas_bancarias->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $cuentas_bancarias;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $cuentas_bancarias->Banco->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cuentas_bancarias->numero_cuenta->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cuentas_bancarias->ejecutivo_cuenta->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cuentas_bancarias->telefono_ejecutivo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cuentas_bancarias->tipo_cuenta->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cuentas_bancarias->moneda->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cuentas_bancarias->notas->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $cuentas_bancarias;
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
			$cuentas_bancarias->setBasicSearchKeyword($sSearchKeyword);
			$cuentas_bancarias->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $cuentas_bancarias;
		$this->sSrchWhere = "";
		$cuentas_bancarias->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $cuentas_bancarias;
		$cuentas_bancarias->setBasicSearchKeyword("");
		$cuentas_bancarias->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $cuentas_bancarias;
		$this->sSrchWhere = $cuentas_bancarias->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $cuentas_bancarias;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$cuentas_bancarias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$cuentas_bancarias->CurrentOrderType = @$_GET["ordertype"];
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->id_banco); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->id_empresa); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->Banco); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->numero_cuenta); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->ejecutivo_cuenta); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->telefono_ejecutivo); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->tipo_cuenta); // Field 
			$cuentas_bancarias->UpdateSort($cuentas_bancarias->moneda); // Field 
			$cuentas_bancarias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $cuentas_bancarias;
		$sOrderBy = $cuentas_bancarias->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($cuentas_bancarias->SqlOrderBy() <> "") {
				$sOrderBy = $cuentas_bancarias->SqlOrderBy();
				$cuentas_bancarias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $cuentas_bancarias;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$cuentas_bancarias->setSessionOrderBy($sOrderBy);
				$cuentas_bancarias->id_banco->setSort("");
				$cuentas_bancarias->id_empresa->setSort("");
				$cuentas_bancarias->Banco->setSort("");
				$cuentas_bancarias->numero_cuenta->setSort("");
				$cuentas_bancarias->ejecutivo_cuenta->setSort("");
				$cuentas_bancarias->telefono_ejecutivo->setSort("");
				$cuentas_bancarias->tipo_cuenta->setSort("");
				$cuentas_bancarias->moneda->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cuentas_bancarias;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cuentas_bancarias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cuentas_bancarias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cuentas_bancarias;

		// Call Recordset Selecting event
		$cuentas_bancarias->Recordset_Selecting($cuentas_bancarias->CurrentFilter);

		// Load list page SQL
		$sSql = $cuentas_bancarias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cuentas_bancarias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cuentas_bancarias;
		$sFilter = $cuentas_bancarias->KeyFilter();

		// Call Row Selecting event
		$cuentas_bancarias->Row_Selecting($sFilter);

		// Load sql based on filter
		$cuentas_bancarias->CurrentFilter = $sFilter;
		$sSql = $cuentas_bancarias->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cuentas_bancarias->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cuentas_bancarias;
		$cuentas_bancarias->id_banco->setDbValue($rs->fields('id_banco'));
		$cuentas_bancarias->id_empresa->setDbValue($rs->fields('id_empresa'));
		$cuentas_bancarias->Banco->setDbValue($rs->fields('Banco'));
		$cuentas_bancarias->numero_cuenta->setDbValue($rs->fields('numero_cuenta'));
		$cuentas_bancarias->ejecutivo_cuenta->setDbValue($rs->fields('ejecutivo_cuenta'));
		$cuentas_bancarias->telefono_ejecutivo->setDbValue($rs->fields('telefono_ejecutivo'));
		$cuentas_bancarias->tipo_cuenta->setDbValue($rs->fields('tipo_cuenta'));
		$cuentas_bancarias->moneda->setDbValue($rs->fields('moneda'));
		$cuentas_bancarias->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cuentas_bancarias;

		// Call Row_Rendering event
		$cuentas_bancarias->Row_Rendering();

		// Common render codes for all row types
		// id_banco

		$cuentas_bancarias->id_banco->CellCssStyle = "";
		$cuentas_bancarias->id_banco->CellCssClass = "";

		// id_empresa
		$cuentas_bancarias->id_empresa->CellCssStyle = "";
		$cuentas_bancarias->id_empresa->CellCssClass = "";

		// Banco
		$cuentas_bancarias->Banco->CellCssStyle = "";
		$cuentas_bancarias->Banco->CellCssClass = "";

		// numero_cuenta
		$cuentas_bancarias->numero_cuenta->CellCssStyle = "";
		$cuentas_bancarias->numero_cuenta->CellCssClass = "";

		// ejecutivo_cuenta
		$cuentas_bancarias->ejecutivo_cuenta->CellCssStyle = "";
		$cuentas_bancarias->ejecutivo_cuenta->CellCssClass = "";

		// telefono_ejecutivo
		$cuentas_bancarias->telefono_ejecutivo->CellCssStyle = "";
		$cuentas_bancarias->telefono_ejecutivo->CellCssClass = "";

		// tipo_cuenta
		$cuentas_bancarias->tipo_cuenta->CellCssStyle = "";
		$cuentas_bancarias->tipo_cuenta->CellCssClass = "";

		// moneda
		$cuentas_bancarias->moneda->CellCssStyle = "";
		$cuentas_bancarias->moneda->CellCssClass = "";
		if ($cuentas_bancarias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_banco
			$cuentas_bancarias->id_banco->ViewValue = $cuentas_bancarias->id_banco->CurrentValue;
			$cuentas_bancarias->id_banco->CssStyle = "";
			$cuentas_bancarias->id_banco->CssClass = "";
			$cuentas_bancarias->id_banco->ViewCustomAttributes = "";

			// id_empresa
			if (strval($cuentas_bancarias->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($cuentas_bancarias->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cuentas_bancarias->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$cuentas_bancarias->id_empresa->ViewValue = $cuentas_bancarias->id_empresa->CurrentValue;
				}
			} else {
				$cuentas_bancarias->id_empresa->ViewValue = NULL;
			}
			$cuentas_bancarias->id_empresa->CssStyle = "";
			$cuentas_bancarias->id_empresa->CssClass = "";
			$cuentas_bancarias->id_empresa->ViewCustomAttributes = "";

			// Banco
			$cuentas_bancarias->Banco->ViewValue = $cuentas_bancarias->Banco->CurrentValue;
			$cuentas_bancarias->Banco->CssStyle = "";
			$cuentas_bancarias->Banco->CssClass = "";
			$cuentas_bancarias->Banco->ViewCustomAttributes = "";

			// numero_cuenta
			$cuentas_bancarias->numero_cuenta->ViewValue = $cuentas_bancarias->numero_cuenta->CurrentValue;
			$cuentas_bancarias->numero_cuenta->CssStyle = "";
			$cuentas_bancarias->numero_cuenta->CssClass = "";
			$cuentas_bancarias->numero_cuenta->ViewCustomAttributes = "";

			// ejecutivo_cuenta
			$cuentas_bancarias->ejecutivo_cuenta->ViewValue = $cuentas_bancarias->ejecutivo_cuenta->CurrentValue;
			$cuentas_bancarias->ejecutivo_cuenta->CssStyle = "";
			$cuentas_bancarias->ejecutivo_cuenta->CssClass = "";
			$cuentas_bancarias->ejecutivo_cuenta->ViewCustomAttributes = "";

			// telefono_ejecutivo
			$cuentas_bancarias->telefono_ejecutivo->ViewValue = $cuentas_bancarias->telefono_ejecutivo->CurrentValue;
			$cuentas_bancarias->telefono_ejecutivo->CssStyle = "";
			$cuentas_bancarias->telefono_ejecutivo->CssClass = "";
			$cuentas_bancarias->telefono_ejecutivo->ViewCustomAttributes = "";

			// tipo_cuenta
			if (strval($cuentas_bancarias->tipo_cuenta->CurrentValue) <> "") {
				switch ($cuentas_bancarias->tipo_cuenta->CurrentValue) {
					case "Ahorros":
						$cuentas_bancarias->tipo_cuenta->ViewValue = "Ahorros";
						break;
					case "Corriente":
						$cuentas_bancarias->tipo_cuenta->ViewValue = "Corriente";
						break;
					default:
						$cuentas_bancarias->tipo_cuenta->ViewValue = $cuentas_bancarias->tipo_cuenta->CurrentValue;
				}
			} else {
				$cuentas_bancarias->tipo_cuenta->ViewValue = NULL;
			}
			$cuentas_bancarias->tipo_cuenta->CssStyle = "";
			$cuentas_bancarias->tipo_cuenta->CssClass = "";
			$cuentas_bancarias->tipo_cuenta->ViewCustomAttributes = "";

			// moneda
			$cuentas_bancarias->moneda->ViewValue = $cuentas_bancarias->moneda->CurrentValue;
			$cuentas_bancarias->moneda->CssStyle = "";
			$cuentas_bancarias->moneda->CssClass = "";
			$cuentas_bancarias->moneda->ViewCustomAttributes = "";

			// id_banco
			$cuentas_bancarias->id_banco->HrefValue = "";

			// id_empresa
			$cuentas_bancarias->id_empresa->HrefValue = "";

			// Banco
			$cuentas_bancarias->Banco->HrefValue = "";

			// numero_cuenta
			$cuentas_bancarias->numero_cuenta->HrefValue = "";

			// ejecutivo_cuenta
			$cuentas_bancarias->ejecutivo_cuenta->HrefValue = "";

			// telefono_ejecutivo
			$cuentas_bancarias->telefono_ejecutivo->HrefValue = "";

			// tipo_cuenta
			$cuentas_bancarias->tipo_cuenta->HrefValue = "";

			// moneda
			$cuentas_bancarias->moneda->HrefValue = "";
		}

		// Call Row Rendered event
		$cuentas_bancarias->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $cuentas_bancarias;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($cuentas_bancarias->ExportAll) {
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
		if ($cuentas_bancarias->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($cuentas_bancarias->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $cuentas_bancarias->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_banco', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'id_empresa', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'Banco', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'numero_cuenta', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'ejecutivo_cuenta', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'telefono_ejecutivo', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'tipo_cuenta', $cuentas_bancarias->Export);
				ew_ExportAddValue($sExportStr, 'moneda', $cuentas_bancarias->Export);
				echo ew_ExportLine($sExportStr, $cuentas_bancarias->Export);
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
				$cuentas_bancarias->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($cuentas_bancarias->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_banco', $cuentas_bancarias->id_banco->CurrentValue);
					$XmlDoc->AddField('id_empresa', $cuentas_bancarias->id_empresa->CurrentValue);
					$XmlDoc->AddField('Banco', $cuentas_bancarias->Banco->CurrentValue);
					$XmlDoc->AddField('numero_cuenta', $cuentas_bancarias->numero_cuenta->CurrentValue);
					$XmlDoc->AddField('ejecutivo_cuenta', $cuentas_bancarias->ejecutivo_cuenta->CurrentValue);
					$XmlDoc->AddField('telefono_ejecutivo', $cuentas_bancarias->telefono_ejecutivo->CurrentValue);
					$XmlDoc->AddField('tipo_cuenta', $cuentas_bancarias->tipo_cuenta->CurrentValue);
					$XmlDoc->AddField('moneda', $cuentas_bancarias->moneda->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $cuentas_bancarias->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_banco', $cuentas_bancarias->id_banco->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('id_empresa', $cuentas_bancarias->id_empresa->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('Banco', $cuentas_bancarias->Banco->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('numero_cuenta', $cuentas_bancarias->numero_cuenta->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('ejecutivo_cuenta', $cuentas_bancarias->ejecutivo_cuenta->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('telefono_ejecutivo', $cuentas_bancarias->telefono_ejecutivo->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('tipo_cuenta', $cuentas_bancarias->tipo_cuenta->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportField('moneda', $cuentas_bancarias->moneda->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->id_banco->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->id_empresa->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->Banco->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->numero_cuenta->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->ejecutivo_cuenta->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->telefono_ejecutivo->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->tipo_cuenta->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						ew_ExportAddValue($sExportStr, $cuentas_bancarias->moneda->ExportValue($cuentas_bancarias->Export, $cuentas_bancarias->ExportOriginalValue), $cuentas_bancarias->Export);
						echo ew_ExportLine($sExportStr, $cuentas_bancarias->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($cuentas_bancarias->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($cuentas_bancarias->Export);
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
