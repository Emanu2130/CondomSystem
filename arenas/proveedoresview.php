<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "proveedoresinfo.php" ?>
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
$proveedores_view = new cproveedores_view();
$Page =& $proveedores_view;

// Page init processing
$proveedores_view->Page_Init();

// Page main processing
$proveedores_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($proveedores->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var proveedores_view = new ew_Page("proveedores_view");

// page properties
proveedores_view.PageID = "view"; // page ID
var EW_PAGE_ID = proveedores_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
proveedores_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
proveedores_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
proveedores_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
proveedores_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Proveedores
<br><br>
<?php if ($proveedores->Export == "") { ?>
<a href="proveedoreslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $proveedores->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $proveedores->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $proveedores->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $proveedores->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="ingresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=proveedores&id_proveedor=<?php echo urlencode(strval($proveedores->id_proveedor->CurrentValue)) ?>">Ingresos</a>
&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="egresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=proveedores&id_proveedor=<?php echo urlencode(strval($proveedores->id_proveedor->CurrentValue)) ?>">Egresos</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $proveedores_view->ShowMessage() ?>
<p>
<?php if ($proveedores->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($proveedores_view->Pager)) $proveedores_view->Pager = new cPrevNextPager($proveedores_view->lStartRec, $proveedores_view->lDisplayRecs, $proveedores_view->lTotalRecs) ?>
<?php if ($proveedores_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($proveedores_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($proveedores_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $proveedores_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($proveedores_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($proveedores_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $proveedores_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($proveedores_view->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($proveedores->id_proveedor->Visible) { // id_proveedor ?>
	<tr<?php echo $proveedores->id_proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Id Proveedor</td>
		<td<?php echo $proveedores->id_proveedor->CellAttributes() ?>>
<div<?php echo $proveedores->id_proveedor->ViewAttributes() ?>><?php echo $proveedores->id_proveedor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($proveedores->nombre->Visible) { // nombre ?>
	<tr<?php echo $proveedores->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre</td>
		<td<?php echo $proveedores->nombre->CellAttributes() ?>>
<div<?php echo $proveedores->nombre->ViewAttributes() ?>><?php echo $proveedores->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($proveedores->rnc_cedula->Visible) { // rnc_cedula ?>
	<tr<?php echo $proveedores->rnc_cedula->RowAttributes ?>>
		<td class="ewTableHeader">Rnc /cedula</td>
		<td<?php echo $proveedores->rnc_cedula->CellAttributes() ?>>
<div<?php echo $proveedores->rnc_cedula->ViewAttributes() ?>><?php echo $proveedores->rnc_cedula->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($proveedores->telefonos->Visible) { // telefonos ?>
	<tr<?php echo $proveedores->telefonos->RowAttributes ?>>
		<td class="ewTableHeader">Telefonos</td>
		<td<?php echo $proveedores->telefonos->CellAttributes() ?>>
<div<?php echo $proveedores->telefonos->ViewAttributes() ?>><?php echo $proveedores->telefonos->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($proveedores->notas->Visible) { // notas ?>
	<tr<?php echo $proveedores->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $proveedores->notas->CellAttributes() ?>>
<div<?php echo $proveedores->notas->ViewAttributes() ?>><?php echo $proveedores->notas->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($proveedores->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $proveedores->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $proveedores->Empresa->CellAttributes() ?>>
<div<?php echo $proveedores->Empresa->ViewAttributes() ?>><?php echo $proveedores->Empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($proveedores->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($proveedores_view->Pager)) $proveedores_view->Pager = new cPrevNextPager($proveedores_view->lStartRec, $proveedores_view->lDisplayRecs, $proveedores_view->lTotalRecs) ?>
<?php if ($proveedores_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($proveedores_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($proveedores_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $proveedores_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($proveedores_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($proveedores_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_view->PageUrl() ?>start=<?php echo $proveedores_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $proveedores_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($proveedores_view->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
<?php if ($proveedores->Export == "") { ?>
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
class cproveedores_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'proveedores';

	// Page Object Name
	var $PageObjName = 'proveedores_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $proveedores;
		if ($proveedores->UseTokenInUrl) $PageUrl .= "t=" . $proveedores->TableVar . "&"; // add page token
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
		global $objForm, $proveedores;
		if ($proveedores->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($proveedores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($proveedores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproveedores_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["proveedores"] = new cproveedores();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'proveedores', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $proveedores;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $proveedores;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_proveedor"] <> "") {
				$proveedores->id_proveedor->setQueryStringValue($_GET["id_proveedor"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$proveedores->CurrentAction = "I"; // Display form
			switch ($proveedores->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("proveedoreslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($proveedores->id_proveedor->CurrentValue) == strval($rs->fields('id_proveedor'))) {
								$proveedores->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage("No se encontraron registros"); // Set no record message
						$sReturnUrl = "proveedoreslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "proveedoreslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$proveedores->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $proveedores;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$proveedores->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$proveedores->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $proveedores->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$proveedores->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$proveedores->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$proveedores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $proveedores;

		// Call Recordset Selecting event
		$proveedores->Recordset_Selecting($proveedores->CurrentFilter);

		// Load list page SQL
		$sSql = $proveedores->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$proveedores->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $proveedores;
		$sFilter = $proveedores->KeyFilter();

		// Call Row Selecting event
		$proveedores->Row_Selecting($sFilter);

		// Load sql based on filter
		$proveedores->CurrentFilter = $sFilter;
		$sSql = $proveedores->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$proveedores->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $proveedores;
		$proveedores->id_proveedor->setDbValue($rs->fields('id_proveedor'));
		$proveedores->nombre->setDbValue($rs->fields('nombre'));
		$proveedores->rnc_cedula->setDbValue($rs->fields('rnc_cedula'));
		$proveedores->telefonos->setDbValue($rs->fields('telefonos'));
		$proveedores->notas->setDbValue($rs->fields('notas'));
		$proveedores->Empresa->setDbValue($rs->fields('Empresa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $proveedores;

		// Call Row_Rendering event
		$proveedores->Row_Rendering();

		// Common render codes for all row types
		// id_proveedor

		$proveedores->id_proveedor->CellCssStyle = "";
		$proveedores->id_proveedor->CellCssClass = "";

		// nombre
		$proveedores->nombre->CellCssStyle = "";
		$proveedores->nombre->CellCssClass = "";

		// rnc_cedula
		$proveedores->rnc_cedula->CellCssStyle = "";
		$proveedores->rnc_cedula->CellCssClass = "";

		// telefonos
		$proveedores->telefonos->CellCssStyle = "";
		$proveedores->telefonos->CellCssClass = "";

		// notas
		$proveedores->notas->CellCssStyle = "";
		$proveedores->notas->CellCssClass = "";

		// Empresa
		$proveedores->Empresa->CellCssStyle = "";
		$proveedores->Empresa->CellCssClass = "";
		if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_proveedor
			$proveedores->id_proveedor->ViewValue = $proveedores->id_proveedor->CurrentValue;
			$proveedores->id_proveedor->CssStyle = "";
			$proveedores->id_proveedor->CssClass = "";
			$proveedores->id_proveedor->ViewCustomAttributes = "";

			// nombre
			$proveedores->nombre->ViewValue = $proveedores->nombre->CurrentValue;
			$proveedores->nombre->CssStyle = "";
			$proveedores->nombre->CssClass = "";
			$proveedores->nombre->ViewCustomAttributes = "";

			// rnc_cedula
			$proveedores->rnc_cedula->ViewValue = $proveedores->rnc_cedula->CurrentValue;
			$proveedores->rnc_cedula->CssStyle = "";
			$proveedores->rnc_cedula->CssClass = "";
			$proveedores->rnc_cedula->ViewCustomAttributes = "";

			// telefonos
			$proveedores->telefonos->ViewValue = $proveedores->telefonos->CurrentValue;
			$proveedores->telefonos->CssStyle = "";
			$proveedores->telefonos->CssClass = "";
			$proveedores->telefonos->ViewCustomAttributes = "";

			// notas
			$proveedores->notas->ViewValue = $proveedores->notas->CurrentValue;
			$proveedores->notas->CssStyle = "";
			$proveedores->notas->CssClass = "";
			$proveedores->notas->ViewCustomAttributes = "";

			// Empresa
			if (strval($proveedores->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($proveedores->Empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$proveedores->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$proveedores->Empresa->ViewValue = $proveedores->Empresa->CurrentValue;
				}
			} else {
				$proveedores->Empresa->ViewValue = NULL;
			}
			$proveedores->Empresa->CssStyle = "";
			$proveedores->Empresa->CssClass = "";
			$proveedores->Empresa->ViewCustomAttributes = "";

			// id_proveedor
			$proveedores->id_proveedor->HrefValue = "";

			// nombre
			$proveedores->nombre->HrefValue = "";

			// rnc_cedula
			$proveedores->rnc_cedula->HrefValue = "";

			// telefonos
			$proveedores->telefonos->HrefValue = "";

			// notas
			$proveedores->notas->HrefValue = "";

			// Empresa
			$proveedores->Empresa->HrefValue = "";
		}

		// Call Row Rendered event
		$proveedores->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
