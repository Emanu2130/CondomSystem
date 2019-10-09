<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$usuarios_list = new cusuarios_list();
$Page =& $usuarios_list;

// Page init processing
$usuarios_list->Page_Init();

// Page main processing
$usuarios_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_list = new ew_Page("usuarios_list");

// page properties
usuarios_list.PageID = "list"; // page ID
var EW_PAGE_ID = usuarios_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
usuarios_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($usuarios->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($usuarios->Export == "" && $usuarios->SelectLimit);
	if (!$bSelectLimit)
		$rs = $usuarios_list->LoadRecordset();
	$usuarios_list->lTotalRecs = ($bSelectLimit) ? $usuarios->SelectRecordCount() : $rs->RecordCount();
	$usuarios_list->lStartRec = 1;
	if ($usuarios_list->lDisplayRecs <= 0) // Display all records
		$usuarios_list->lDisplayRecs = $usuarios_list->lTotalRecs;
	if (!($usuarios->ExportAll && $usuarios->Export <> ""))
		$usuarios_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $usuarios_list->LoadRecordset($usuarios_list->lStartRec-1, $usuarios_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Usuarios
<?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $usuarios_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $usuarios_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $usuarios_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(usuarios_list);" style="text-decoration: none;"><img id="usuarios_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="usuarios_list_SearchPanel">
<form name="fusuarioslistsrch" id="fusuarioslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="usuarios">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($usuarios->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $usuarios_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
			<a href="usuariossrch.php">Consulta avanzada</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($usuarios->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($usuarios->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($usuarios->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $usuarios_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($usuarios->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($usuarios->CurrentAction <> "gridadd" && $usuarios->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuarios_list->Pager)) $usuarios_list->Pager = new cPrevNextPager($usuarios_list->lStartRec, $usuarios_list->lDisplayRecs, $usuarios_list->lTotalRecs) ?>
<?php if ($usuarios_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuarios_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuarios_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuarios_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuarios_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuarios_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $usuarios_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $usuarios_list->Pager->FromIndex ?> a <?php echo $usuarios_list->Pager->ToIndex ?> de <?php echo $usuarios_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($usuarios_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($usuarios_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="usuarios">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($usuarios_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($usuarios_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($usuarios_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($usuarios_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($usuarios_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($usuarios_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($usuarios->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($usuarios_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fusuarioslist)) alert('No se seleccionaron registros'); else {document.fusuarioslist.action='usuariosdelete.php';document.fusuarioslist.encoding='application/x-www-form-urlencoded';document.fusuarioslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fusuarioslist)) alert('No se seleccionaron registros'); else {document.fusuarioslist.action='usuariosupdate.php';document.fusuarioslist.encoding='application/x-www-form-urlencoded';document.fusuarioslist.submit();};return false;">Actualizar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fusuarioslist" id="fusuarioslist" class="ewForm" action="" method="post">
<?php if ($usuarios_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$usuarios_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$usuarios_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$usuarios_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$usuarios_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$usuarios_list->lOptionCnt++; // Multi-select
}
	$usuarios_list->lOptionCnt += count($usuarios_list->ListOptions->Items); // Custom list options
?>
<?php echo $usuarios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($usuarios->user_id->Visible) { // user_id ?>
	<?php if ($usuarios->SortUrl($usuarios->user_id) == "") { ?>
		<td>User Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->user_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>User Id</td><td style="width: 10px;"><?php if ($usuarios->user_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->user_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->usuario->Visible) { // usuario ?>
	<?php if ($usuarios->SortUrl($usuarios->usuario) == "") { ?>
		<td>Usuario</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->usuario) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Usuario&nbsp;(*)</td><td style="width: 10px;"><?php if ($usuarios->usuario->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->usuario->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->clave->Visible) { // clave ?>
	<?php if ($usuarios->SortUrl($usuarios->clave) == "") { ?>
		<td>Clave</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->clave) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Clave</td><td style="width: 10px;"><?php if ($usuarios->clave->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->clave->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->Nombre->Visible) { // Nombre ?>
	<?php if ($usuarios->SortUrl($usuarios->Nombre) == "") { ?>
		<td>Nombre</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->Nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre&nbsp;(*)</td><td style="width: 10px;"><?php if ($usuarios->Nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->Nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="usuarios_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($usuarios_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($usuarios->ExportAll && $usuarios->Export <> "") {
	$usuarios_list->lStopRec = $usuarios_list->lTotalRecs;
} else {
	$usuarios_list->lStopRec = $usuarios_list->lStartRec + $usuarios_list->lDisplayRecs - 1; // Set the last record to display
}
$usuarios_list->lRecCount = $usuarios_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$usuarios->SelectLimit && $usuarios_list->lStartRec > 1)
		$rs->Move($usuarios_list->lStartRec - 1);
}
$usuarios_list->lRowCnt = 0;
while (($usuarios->CurrentAction == "gridadd" || !$rs->EOF) &&
	$usuarios_list->lRecCount < $usuarios_list->lStopRec) {
	$usuarios_list->lRecCount++;
	if (intval($usuarios_list->lRecCount) >= intval($usuarios_list->lStartRec)) {
		$usuarios_list->lRowCnt++;

	// Init row class and style
	$usuarios->CssClass = "";
	$usuarios->CssStyle = "";
	$usuarios->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($usuarios->CurrentAction == "gridadd") {
		$usuarios_list->LoadDefaultValues(); // Load default values
	} else {
		$usuarios_list->LoadRowValues($rs); // Load row values
	}
	$usuarios->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$usuarios_list->RenderRow();
?>
	<tr<?php echo $usuarios->RowAttributes() ?>>
	<?php if ($usuarios->user_id->Visible) { // user_id ?>
		<td<?php echo $usuarios->user_id->CellAttributes() ?>>
<div<?php echo $usuarios->user_id->ViewAttributes() ?>><?php echo $usuarios->user_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->usuario->Visible) { // usuario ?>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>>
<div<?php echo $usuarios->usuario->ViewAttributes() ?>><?php echo $usuarios->usuario->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->clave->Visible) { // clave ?>
		<td<?php echo $usuarios->clave->CellAttributes() ?>>
<div<?php echo $usuarios->clave->ViewAttributes() ?>><?php echo $usuarios->clave->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->Nombre->Visible) { // Nombre ?>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>>
<div<?php echo $usuarios->Nombre->ViewAttributes() ?>><?php echo $usuarios->Nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($usuarios->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $usuarios->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $usuarios->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $usuarios->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($usuarios->user_id->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($usuarios_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($usuarios->CurrentAction <> "gridadd")
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
<?php if ($usuarios_list->lTotalRecs > 0) { ?>
<?php if ($usuarios->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($usuarios->CurrentAction <> "gridadd" && $usuarios->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuarios_list->Pager)) $usuarios_list->Pager = new cPrevNextPager($usuarios_list->lStartRec, $usuarios_list->lDisplayRecs, $usuarios_list->lTotalRecs) ?>
<?php if ($usuarios_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuarios_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuarios_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuarios_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuarios_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuarios_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $usuarios_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $usuarios_list->Pager->FromIndex ?> a <?php echo $usuarios_list->Pager->ToIndex ?> de <?php echo $usuarios_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($usuarios_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($usuarios_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="usuarios">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($usuarios_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($usuarios_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($usuarios_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($usuarios_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($usuarios_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($usuarios_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($usuarios->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($usuarios_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($usuarios_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fusuarioslist)) alert('No se seleccionaron registros'); else {document.fusuarioslist.action='usuariosdelete.php';document.fusuarioslist.encoding='application/x-www-form-urlencoded';document.fusuarioslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fusuarioslist)) alert('No se seleccionaron registros'); else {document.fusuarioslist.action='usuariosupdate.php';document.fusuarioslist.encoding='application/x-www-form-urlencoded';document.fusuarioslist.submit();};return false;">Actualizar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(usuarios_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($usuarios->Export == "") { ?>
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
class cusuarios_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'usuarios';

	// Page Object Name
	var $PageObjName = 'usuarios_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // add page token
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
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cusuarios_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["usuarios"] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $usuarios;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$usuarios->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $usuarios->Export; // Get export parameter, used in header
	$gsExportFile = $usuarios->TableVar; // Get export file, used in header
	if ($usuarios->Export == "print" || $usuarios->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($usuarios->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($usuarios->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $usuarios;
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

			// Get search criteria for advanced search
			$this->LoadSearchValues(); // Get search values
			if ($this->ValidateSearch()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			} else {
				$this->setMessage($gsSearchError);
			}

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($usuarios->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $usuarios->getRecordsPerPage(); // Restore from Session
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
		$usuarios->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$usuarios->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$usuarios->setStartRecordNumber($this->lStartRec);
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
		$usuarios->setSessionWhere($sFilter);
		$usuarios->CurrentFilter = "";

		// Export data only
		if (in_array($usuarios->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $usuarios;
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
			$usuarios->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$usuarios->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $usuarios;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $usuarios->user_id, FALSE); // Field user_id
		$this->BuildSearchSql($sWhere, $usuarios->usuario, FALSE); // Field usuario
		$this->BuildSearchSql($sWhere, $usuarios->clave, FALSE); // Field clave
		$this->BuildSearchSql($sWhere, $usuarios->Nombre, FALSE); // Field Nombre

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($usuarios->user_id); // Field user_id
			$this->SetSearchParm($usuarios->usuario); // Field usuario
			$this->SetSearchParm($usuarios->clave); // Field clave
			$this->SetSearchParm($usuarios->Nombre); // Field Nombre
		}
		return $sWhere;
	}

	// Build search sql
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = @$_GET["x_$FldParm"];
		$FldOpr = @$_GET["z_$FldParm"];
		$FldCond = @$_GET["v_$FldParm"];
		$FldVal2 = @$_GET["y_$FldParm"];
		$FldOpr2 = @$_GET["w_$FldParm"];
		$sWrk = "";
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parm
	function SetSearchParm(&$Fld) {
		global $usuarios;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = @$_GET["x_$FldParm"];
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = @$_GET["y_$FldParm"];
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$usuarios->setAdvancedSearch("x_$FldParm", $FldVal);
		$usuarios->setAdvancedSearch("z_$FldParm", @$_GET["z_$FldParm"]);
		$usuarios->setAdvancedSearch("v_$FldParm", @$_GET["v_$FldParm"]);
		$usuarios->setAdvancedSearch("y_$FldParm", $FldVal2);
		$usuarios->setAdvancedSearch("w_$FldParm", @$_GET["w_$FldParm"]);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $usuarios;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $usuarios->usuario->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $usuarios->clave->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $usuarios->Nombre->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $usuarios;
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
			$usuarios->setBasicSearchKeyword($sSearchKeyword);
			$usuarios->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $usuarios;
		$this->sSrchWhere = "";
		$usuarios->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $usuarios;
		$usuarios->setBasicSearchKeyword("");
		$usuarios->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $usuarios;
		$usuarios->setAdvancedSearch("x_user_id", "");
		$usuarios->setAdvancedSearch("x_usuario", "");
		$usuarios->setAdvancedSearch("x_clave", "");
		$usuarios->setAdvancedSearch("x_Nombre", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $usuarios;
		$this->sSrchWhere = $usuarios->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $usuarios;
		 $usuarios->user_id->AdvancedSearch->SearchValue = $usuarios->getAdvancedSearch("x_user_id");
		 $usuarios->usuario->AdvancedSearch->SearchValue = $usuarios->getAdvancedSearch("x_usuario");
		 $usuarios->clave->AdvancedSearch->SearchValue = $usuarios->getAdvancedSearch("x_clave");
		 $usuarios->Nombre->AdvancedSearch->SearchValue = $usuarios->getAdvancedSearch("x_Nombre");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $usuarios;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$usuarios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$usuarios->CurrentOrderType = @$_GET["ordertype"];
			$usuarios->UpdateSort($usuarios->user_id); // Field 
			$usuarios->UpdateSort($usuarios->usuario); // Field 
			$usuarios->UpdateSort($usuarios->clave); // Field 
			$usuarios->UpdateSort($usuarios->Nombre); // Field 
			$usuarios->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $usuarios;
		$sOrderBy = $usuarios->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($usuarios->SqlOrderBy() <> "") {
				$sOrderBy = $usuarios->SqlOrderBy();
				$usuarios->setSessionOrderBy($sOrderBy);
				$usuarios->user_id->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $usuarios;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$usuarios->setSessionOrderBy($sOrderBy);
				$usuarios->user_id->setSort("");
				$usuarios->usuario->setSort("");
				$usuarios->clave->setSort("");
				$usuarios->Nombre->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$usuarios->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $usuarios;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$usuarios->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$usuarios->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $usuarios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$usuarios->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$usuarios->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$usuarios->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $usuarios;

		// Load search values
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuarios;

		// Call Recordset Selecting event
		$usuarios->Recordset_Selecting($usuarios->CurrentFilter);

		// Load list page SQL
		$sSql = $usuarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$usuarios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load sql based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$usuarios->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $usuarios;
		$usuarios->user_id->setDbValue($rs->fields('user_id'));
		$usuarios->usuario->setDbValue($rs->fields('usuario'));
		$usuarios->clave->setDbValue($rs->fields('clave'));
		$usuarios->Nombre->setDbValue($rs->fields('Nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $usuarios;

		// Call Row_Rendering event
		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// user_id

		$usuarios->user_id->CellCssStyle = "";
		$usuarios->user_id->CellCssClass = "";

		// usuario
		$usuarios->usuario->CellCssStyle = "";
		$usuarios->usuario->CellCssClass = "";

		// clave
		$usuarios->clave->CellCssStyle = "";
		$usuarios->clave->CellCssClass = "";

		// Nombre
		$usuarios->Nombre->CellCssStyle = "";
		$usuarios->Nombre->CellCssClass = "";
		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// user_id
			$usuarios->user_id->ViewValue = $usuarios->user_id->CurrentValue;
			$usuarios->user_id->CssStyle = "";
			$usuarios->user_id->CssClass = "";
			$usuarios->user_id->ViewCustomAttributes = "";

			// usuario
			$usuarios->usuario->ViewValue = $usuarios->usuario->CurrentValue;
			$usuarios->usuario->CssStyle = "";
			$usuarios->usuario->CssClass = "";
			$usuarios->usuario->ViewCustomAttributes = "";

			// clave
			$usuarios->clave->ViewValue = "********";
			$usuarios->clave->CssStyle = "";
			$usuarios->clave->CssClass = "";
			$usuarios->clave->ViewCustomAttributes = "";

			// Nombre
			$usuarios->Nombre->ViewValue = $usuarios->Nombre->CurrentValue;
			$usuarios->Nombre->CssStyle = "";
			$usuarios->Nombre->CssClass = "";
			$usuarios->Nombre->ViewCustomAttributes = "";

			// user_id
			$usuarios->user_id->HrefValue = "";

			// usuario
			$usuarios->usuario->HrefValue = "";

			// clave
			$usuarios->clave->HrefValue = "";

			// Nombre
			$usuarios->Nombre->HrefValue = "";
		}

		// Call Row Rendered event
		$usuarios->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $usuarios;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $usuarios;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $usuarios;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($usuarios->ExportAll) {
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
		if ($usuarios->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($usuarios->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $usuarios->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'user_id', $usuarios->Export);
				ew_ExportAddValue($sExportStr, 'usuario', $usuarios->Export);
				ew_ExportAddValue($sExportStr, 'clave', $usuarios->Export);
				ew_ExportAddValue($sExportStr, 'Nombre', $usuarios->Export);
				echo ew_ExportLine($sExportStr, $usuarios->Export);
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
				$usuarios->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($usuarios->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('user_id', $usuarios->user_id->CurrentValue);
					$XmlDoc->AddField('usuario', $usuarios->usuario->CurrentValue);
					$XmlDoc->AddField('clave', $usuarios->clave->CurrentValue);
					$XmlDoc->AddField('Nombre', $usuarios->Nombre->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $usuarios->Export <> "csv") { // Vertical format
						echo ew_ExportField('user_id', $usuarios->user_id->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						echo ew_ExportField('usuario', $usuarios->usuario->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						echo ew_ExportField('clave', $usuarios->clave->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						echo ew_ExportField('Nombre', $usuarios->Nombre->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $usuarios->user_id->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						ew_ExportAddValue($sExportStr, $usuarios->usuario->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						ew_ExportAddValue($sExportStr, $usuarios->clave->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						ew_ExportAddValue($sExportStr, $usuarios->Nombre->ExportValue($usuarios->Export, $usuarios->ExportOriginalValue), $usuarios->Export);
						echo ew_ExportLine($sExportStr, $usuarios->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($usuarios->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($usuarios->Export);
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
