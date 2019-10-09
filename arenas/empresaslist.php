<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "empresasinfo.php" ?>
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
$empresas_list = new cempresas_list();
$Page =& $empresas_list;

// Page init processing
$empresas_list->Page_Init();

// Page main processing
$empresas_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($empresas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var empresas_list = new ew_Page("empresas_list");

// page properties
empresas_list.PageID = "list"; // page ID
var EW_PAGE_ID = empresas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
empresas_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empresas_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empresas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empresas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($empresas->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($empresas->Export == "" && $empresas->SelectLimit);
	if (!$bSelectLimit)
		$rs = $empresas_list->LoadRecordset();
	$empresas_list->lTotalRecs = ($bSelectLimit) ? $empresas->SelectRecordCount() : $rs->RecordCount();
	$empresas_list->lStartRec = 1;
	if ($empresas_list->lDisplayRecs <= 0) // Display all records
		$empresas_list->lDisplayRecs = $empresas_list->lTotalRecs;
	if (!($empresas->ExportAll && $empresas->Export <> ""))
		$empresas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $empresas_list->LoadRecordset($empresas_list->lStartRec-1, $empresas_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Empresas
<?php if ($empresas->Export == "" && $empresas->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $empresas_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $empresas_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $empresas_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($empresas->Export == "" && $empresas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(empresas_list);" style="text-decoration: none;"><img id="empresas_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="empresas_list_SearchPanel">
<form name="fempresaslistsrch" id="fempresaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="empresas">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($empresas->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $empresas_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($empresas->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($empresas->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($empresas->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $empresas_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($empresas->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($empresas->CurrentAction <> "gridadd" && $empresas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empresas_list->Pager)) $empresas_list->Pager = new cPrevNextPager($empresas_list->lStartRec, $empresas_list->lDisplayRecs, $empresas_list->lTotalRecs) ?>
<?php if ($empresas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empresas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empresas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empresas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empresas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empresas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empresas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $empresas_list->Pager->FromIndex ?> a <?php echo $empresas_list->Pager->ToIndex ?> de <?php echo $empresas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($empresas_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($empresas_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="empresas">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($empresas_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($empresas_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($empresas_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($empresas_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($empresas_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($empresas_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($empresas->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empresas->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($empresas_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fempresaslist)) alert('No se seleccionaron registros'); else {document.fempresaslist.action='empresasdelete.php';document.fempresaslist.encoding='application/x-www-form-urlencoded';document.fempresaslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fempresaslist" id="fempresaslist" class="ewForm" action="" method="post">
<?php if ($empresas_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$empresas_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$empresas_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$empresas_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$empresas_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$empresas_list->lOptionCnt++; // Multi-select
}
	$empresas_list->lOptionCnt += count($empresas_list->ListOptions->Items); // Custom list options
?>
<?php echo $empresas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($empresas->id_empresa->Visible) { // id_empresa ?>
	<?php if ($empresas->SortUrl($empresas->id_empresa) == "") { ?>
		<td>Id Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empresas->SortUrl($empresas->id_empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Empresa</td><td style="width: 10px;"><?php if ($empresas->id_empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empresas->id_empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empresas->nombre->Visible) { // nombre ?>
	<?php if ($empresas->SortUrl($empresas->nombre) == "") { ?>
		<td>Nombre</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empresas->SortUrl($empresas->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre&nbsp;(*)</td><td style="width: 10px;"><?php if ($empresas->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empresas->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empresas->rnc->Visible) { // rnc ?>
	<?php if ($empresas->SortUrl($empresas->rnc) == "") { ?>
		<td>Rnc</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empresas->SortUrl($empresas->rnc) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Rnc&nbsp;(*)</td><td style="width: 10px;"><?php if ($empresas->rnc->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empresas->rnc->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empresas->direccion->Visible) { // direccion ?>
	<?php if ($empresas->SortUrl($empresas->direccion) == "") { ?>
		<td>Direccion</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empresas->SortUrl($empresas->direccion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Direccion&nbsp;(*)</td><td style="width: 10px;"><?php if ($empresas->direccion->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empresas->direccion->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empresas->email->Visible) { // email ?>
	<?php if ($empresas->SortUrl($empresas->email) == "") { ?>
		<td>Email</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empresas->SortUrl($empresas->email) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Email&nbsp;(*)</td><td style="width: 10px;"><?php if ($empresas->email->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empresas->email->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empresas->Telefono->Visible) { // Telefono ?>
	<?php if ($empresas->SortUrl($empresas->Telefono) == "") { ?>
		<td>Telefono</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $empresas->SortUrl($empresas->Telefono) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Telefono&nbsp;(*)</td><td style="width: 10px;"><?php if ($empresas->Telefono->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($empresas->Telefono->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($empresas->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="empresas_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($empresas_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($empresas->ExportAll && $empresas->Export <> "") {
	$empresas_list->lStopRec = $empresas_list->lTotalRecs;
} else {
	$empresas_list->lStopRec = $empresas_list->lStartRec + $empresas_list->lDisplayRecs - 1; // Set the last record to display
}
$empresas_list->lRecCount = $empresas_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$empresas->SelectLimit && $empresas_list->lStartRec > 1)
		$rs->Move($empresas_list->lStartRec - 1);
}
$empresas_list->lRowCnt = 0;
while (($empresas->CurrentAction == "gridadd" || !$rs->EOF) &&
	$empresas_list->lRecCount < $empresas_list->lStopRec) {
	$empresas_list->lRecCount++;
	if (intval($empresas_list->lRecCount) >= intval($empresas_list->lStartRec)) {
		$empresas_list->lRowCnt++;

	// Init row class and style
	$empresas->CssClass = "";
	$empresas->CssStyle = "";
	$empresas->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($empresas->CurrentAction == "gridadd") {
		$empresas_list->LoadDefaultValues(); // Load default values
	} else {
		$empresas_list->LoadRowValues($rs); // Load row values
	}
	$empresas->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$empresas_list->RenderRow();
?>
	<tr<?php echo $empresas->RowAttributes() ?>>
	<?php if ($empresas->id_empresa->Visible) { // id_empresa ?>
		<td<?php echo $empresas->id_empresa->CellAttributes() ?>>
<div<?php echo $empresas->id_empresa->ViewAttributes() ?>><?php echo $empresas->id_empresa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empresas->nombre->Visible) { // nombre ?>
		<td<?php echo $empresas->nombre->CellAttributes() ?>>
<div<?php echo $empresas->nombre->ViewAttributes() ?>><?php echo $empresas->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empresas->rnc->Visible) { // rnc ?>
		<td<?php echo $empresas->rnc->CellAttributes() ?>>
<div<?php echo $empresas->rnc->ViewAttributes() ?>><?php echo $empresas->rnc->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empresas->direccion->Visible) { // direccion ?>
		<td<?php echo $empresas->direccion->CellAttributes() ?>>
<div<?php echo $empresas->direccion->ViewAttributes() ?>><?php echo $empresas->direccion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empresas->email->Visible) { // email ?>
		<td<?php echo $empresas->email->CellAttributes() ?>>
<div<?php echo $empresas->email->ViewAttributes() ?>><?php echo $empresas->email->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($empresas->Telefono->Visible) { // Telefono ?>
		<td<?php echo $empresas->Telefono->CellAttributes() ?>>
<div<?php echo $empresas->Telefono->ViewAttributes() ?>><?php echo $empresas->Telefono->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($empresas->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $empresas->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $empresas->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $empresas->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($empresas->id_empresa->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($empresas_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($empresas->CurrentAction <> "gridadd")
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
<?php if ($empresas_list->lTotalRecs > 0) { ?>
<?php if ($empresas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($empresas->CurrentAction <> "gridadd" && $empresas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empresas_list->Pager)) $empresas_list->Pager = new cPrevNextPager($empresas_list->lStartRec, $empresas_list->lDisplayRecs, $empresas_list->lTotalRecs) ?>
<?php if ($empresas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empresas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empresas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empresas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empresas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empresas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_list->PageUrl() ?>start=<?php echo $empresas_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empresas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $empresas_list->Pager->FromIndex ?> a <?php echo $empresas_list->Pager->ToIndex ?> de <?php echo $empresas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($empresas_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($empresas_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="empresas">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($empresas_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($empresas_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($empresas_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($empresas_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($empresas_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($empresas_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($empresas->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($empresas_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empresas->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($empresas_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fempresaslist)) alert('No se seleccionaron registros'); else {document.fempresaslist.action='empresasdelete.php';document.fempresaslist.encoding='application/x-www-form-urlencoded';document.fempresaslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($empresas->Export == "" && $empresas->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(empresas_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($empresas->Export == "") { ?>
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
class cempresas_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'empresas';

	// Page Object Name
	var $PageObjName = 'empresas_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $empresas;
		if ($empresas->UseTokenInUrl) $PageUrl .= "t=" . $empresas->TableVar . "&"; // add page token
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
		global $objForm, $empresas;
		if ($empresas->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($empresas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($empresas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cempresas_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["empresas"] = new cempresas();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empresas', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $empresas;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$empresas->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $empresas->Export; // Get export parameter, used in header
	$gsExportFile = $empresas->TableVar; // Get export file, used in header
	if ($empresas->Export == "print" || $empresas->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($empresas->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($empresas->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $empresas;
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
		if ($empresas->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $empresas->getRecordsPerPage(); // Restore from Session
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
		$empresas->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$empresas->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$empresas->setStartRecordNumber($this->lStartRec);
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
		$empresas->setSessionWhere($sFilter);
		$empresas->CurrentFilter = "";

		// Export data only
		if (in_array($empresas->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $empresas;
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
			$empresas->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$empresas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $empresas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $empresas->nombre->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empresas->rnc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empresas->direccion->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empresas->email->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $empresas->Telefono->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $empresas;
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
			$empresas->setBasicSearchKeyword($sSearchKeyword);
			$empresas->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $empresas;
		$this->sSrchWhere = "";
		$empresas->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $empresas;
		$empresas->setBasicSearchKeyword("");
		$empresas->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $empresas;
		$this->sSrchWhere = $empresas->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $empresas;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$empresas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$empresas->CurrentOrderType = @$_GET["ordertype"];
			$empresas->UpdateSort($empresas->id_empresa); // Field 
			$empresas->UpdateSort($empresas->nombre); // Field 
			$empresas->UpdateSort($empresas->rnc); // Field 
			$empresas->UpdateSort($empresas->direccion); // Field 
			$empresas->UpdateSort($empresas->email); // Field 
			$empresas->UpdateSort($empresas->Telefono); // Field 
			$empresas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $empresas;
		$sOrderBy = $empresas->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($empresas->SqlOrderBy() <> "") {
				$sOrderBy = $empresas->SqlOrderBy();
				$empresas->setSessionOrderBy($sOrderBy);
				$empresas->id_empresa->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $empresas;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$empresas->setSessionOrderBy($sOrderBy);
				$empresas->id_empresa->setSort("");
				$empresas->nombre->setSort("");
				$empresas->rnc->setSort("");
				$empresas->direccion->setSort("");
				$empresas->email->setSort("");
				$empresas->Telefono->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$empresas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $empresas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$empresas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$empresas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $empresas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$empresas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$empresas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$empresas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $empresas;

		// Call Recordset Selecting event
		$empresas->Recordset_Selecting($empresas->CurrentFilter);

		// Load list page SQL
		$sSql = $empresas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$empresas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $empresas;
		$sFilter = $empresas->KeyFilter();

		// Call Row Selecting event
		$empresas->Row_Selecting($sFilter);

		// Load sql based on filter
		$empresas->CurrentFilter = $sFilter;
		$sSql = $empresas->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$empresas->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $empresas;
		$empresas->id_empresa->setDbValue($rs->fields('id_empresa'));
		$empresas->nombre->setDbValue($rs->fields('nombre'));
		$empresas->rnc->setDbValue($rs->fields('rnc'));
		$empresas->direccion->setDbValue($rs->fields('direccion'));
		$empresas->email->setDbValue($rs->fields('email'));
		$empresas->Telefono->setDbValue($rs->fields('Telefono'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $empresas;

		// Call Row_Rendering event
		$empresas->Row_Rendering();

		// Common render codes for all row types
		// id_empresa

		$empresas->id_empresa->CellCssStyle = "";
		$empresas->id_empresa->CellCssClass = "";

		// nombre
		$empresas->nombre->CellCssStyle = "";
		$empresas->nombre->CellCssClass = "";

		// rnc
		$empresas->rnc->CellCssStyle = "";
		$empresas->rnc->CellCssClass = "";

		// direccion
		$empresas->direccion->CellCssStyle = "";
		$empresas->direccion->CellCssClass = "";

		// email
		$empresas->email->CellCssStyle = "";
		$empresas->email->CellCssClass = "";

		// Telefono
		$empresas->Telefono->CellCssStyle = "";
		$empresas->Telefono->CellCssClass = "";
		if ($empresas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_empresa
			$empresas->id_empresa->ViewValue = $empresas->id_empresa->CurrentValue;
			$empresas->id_empresa->CssStyle = "";
			$empresas->id_empresa->CssClass = "";
			$empresas->id_empresa->ViewCustomAttributes = "";

			// nombre
			$empresas->nombre->ViewValue = $empresas->nombre->CurrentValue;
			$empresas->nombre->CssStyle = "";
			$empresas->nombre->CssClass = "";
			$empresas->nombre->ViewCustomAttributes = "";

			// rnc
			$empresas->rnc->ViewValue = $empresas->rnc->CurrentValue;
			$empresas->rnc->CssStyle = "";
			$empresas->rnc->CssClass = "";
			$empresas->rnc->ViewCustomAttributes = "";

			// direccion
			$empresas->direccion->ViewValue = $empresas->direccion->CurrentValue;
			$empresas->direccion->CssStyle = "";
			$empresas->direccion->CssClass = "";
			$empresas->direccion->ViewCustomAttributes = "";

			// email
			$empresas->email->ViewValue = $empresas->email->CurrentValue;
			$empresas->email->CssStyle = "";
			$empresas->email->CssClass = "";
			$empresas->email->ViewCustomAttributes = "";

			// Telefono
			$empresas->Telefono->ViewValue = $empresas->Telefono->CurrentValue;
			$empresas->Telefono->CssStyle = "";
			$empresas->Telefono->CssClass = "";
			$empresas->Telefono->ViewCustomAttributes = "";

			// id_empresa
			$empresas->id_empresa->HrefValue = "";

			// nombre
			$empresas->nombre->HrefValue = "";

			// rnc
			$empresas->rnc->HrefValue = "";

			// direccion
			$empresas->direccion->HrefValue = "";

			// email
			$empresas->email->HrefValue = "";

			// Telefono
			$empresas->Telefono->HrefValue = "";
		}

		// Call Row Rendered event
		$empresas->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $empresas;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($empresas->ExportAll) {
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
		if ($empresas->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($empresas->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $empresas->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_empresa', $empresas->Export);
				ew_ExportAddValue($sExportStr, 'nombre', $empresas->Export);
				ew_ExportAddValue($sExportStr, 'rnc', $empresas->Export);
				ew_ExportAddValue($sExportStr, 'direccion', $empresas->Export);
				ew_ExportAddValue($sExportStr, 'email', $empresas->Export);
				ew_ExportAddValue($sExportStr, 'Telefono', $empresas->Export);
				echo ew_ExportLine($sExportStr, $empresas->Export);
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
				$empresas->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($empresas->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_empresa', $empresas->id_empresa->CurrentValue);
					$XmlDoc->AddField('nombre', $empresas->nombre->CurrentValue);
					$XmlDoc->AddField('rnc', $empresas->rnc->CurrentValue);
					$XmlDoc->AddField('direccion', $empresas->direccion->CurrentValue);
					$XmlDoc->AddField('email', $empresas->email->CurrentValue);
					$XmlDoc->AddField('Telefono', $empresas->Telefono->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $empresas->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_empresa', $empresas->id_empresa->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						echo ew_ExportField('nombre', $empresas->nombre->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						echo ew_ExportField('rnc', $empresas->rnc->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						echo ew_ExportField('direccion', $empresas->direccion->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						echo ew_ExportField('email', $empresas->email->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						echo ew_ExportField('Telefono', $empresas->Telefono->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $empresas->id_empresa->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						ew_ExportAddValue($sExportStr, $empresas->nombre->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						ew_ExportAddValue($sExportStr, $empresas->rnc->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						ew_ExportAddValue($sExportStr, $empresas->direccion->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						ew_ExportAddValue($sExportStr, $empresas->email->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						ew_ExportAddValue($sExportStr, $empresas->Telefono->ExportValue($empresas->Export, $empresas->ExportOriginalValue), $empresas->Export);
						echo ew_ExportLine($sExportStr, $empresas->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($empresas->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($empresas->Export);
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
