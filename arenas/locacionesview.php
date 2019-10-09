<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "locacionesinfo.php" ?>
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
$locaciones_view = new clocaciones_view();
$Page =& $locaciones_view;

// Page init processing
$locaciones_view->Page_Init();

// Page main processing
$locaciones_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($locaciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var locaciones_view = new ew_Page("locaciones_view");

// page properties
locaciones_view.PageID = "view"; // page ID
var EW_PAGE_ID = locaciones_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
locaciones_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
locaciones_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
locaciones_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
locaciones_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Locaciones
<br><br>
<?php if ($locaciones->Export == "") { ?>
<a href="locacioneslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $locaciones->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $locaciones->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $locaciones->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $locaciones->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="ingresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=locaciones&id_locacion=<?php echo urlencode(strval($locaciones->id_locacion->CurrentValue)) ?>">Ingresos</a>
&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="egresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=locaciones&id_locacion=<?php echo urlencode(strval($locaciones->id_locacion->CurrentValue)) ?>">Egresos</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $locaciones_view->ShowMessage() ?>
<p>
<?php if ($locaciones->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($locaciones_view->Pager)) $locaciones_view->Pager = new cPrevNextPager($locaciones_view->lStartRec, $locaciones_view->lDisplayRecs, $locaciones_view->lTotalRecs) ?>
<?php if ($locaciones_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($locaciones_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($locaciones_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $locaciones_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($locaciones_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($locaciones_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $locaciones_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($locaciones_view->sSrchWhere == "0=101") { ?>
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
<?php if ($locaciones->id_locacion->Visible) { // id_locacion ?>
	<tr<?php echo $locaciones->id_locacion->RowAttributes ?>>
		<td class="ewTableHeader">Id Locacion</td>
		<td<?php echo $locaciones->id_locacion->CellAttributes() ?>>
<div<?php echo $locaciones->id_locacion->ViewAttributes() ?>><?php echo $locaciones->id_locacion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($locaciones->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $locaciones->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Id Empresa</td>
		<td<?php echo $locaciones->id_empresa->CellAttributes() ?>>
<div<?php echo $locaciones->id_empresa->ViewAttributes() ?>><?php echo $locaciones->id_empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($locaciones->nombre->Visible) { // nombre ?>
	<tr<?php echo $locaciones->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre</td>
		<td<?php echo $locaciones->nombre->CellAttributes() ?>>
<div<?php echo $locaciones->nombre->ViewAttributes() ?>><?php echo $locaciones->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($locaciones->notas->Visible) { // notas ?>
	<tr<?php echo $locaciones->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $locaciones->notas->CellAttributes() ?>>
<div<?php echo $locaciones->notas->ViewAttributes() ?>><?php echo $locaciones->notas->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($locaciones->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($locaciones_view->Pager)) $locaciones_view->Pager = new cPrevNextPager($locaciones_view->lStartRec, $locaciones_view->lDisplayRecs, $locaciones_view->lTotalRecs) ?>
<?php if ($locaciones_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($locaciones_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($locaciones_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $locaciones_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($locaciones_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($locaciones_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_view->PageUrl() ?>start=<?php echo $locaciones_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $locaciones_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($locaciones_view->sSrchWhere == "0=101") { ?>
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
<?php if ($locaciones->Export == "") { ?>
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
class clocaciones_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'locaciones';

	// Page Object Name
	var $PageObjName = 'locaciones_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $locaciones;
		if ($locaciones->UseTokenInUrl) $PageUrl .= "t=" . $locaciones->TableVar . "&"; // add page token
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
		global $objForm, $locaciones;
		if ($locaciones->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($locaciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($locaciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clocaciones_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["locaciones"] = new clocaciones();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'locaciones', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $locaciones;
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
		global $locaciones;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_locacion"] <> "") {
				$locaciones->id_locacion->setQueryStringValue($_GET["id_locacion"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$locaciones->CurrentAction = "I"; // Display form
			switch ($locaciones->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("locacioneslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($locaciones->id_locacion->CurrentValue) == strval($rs->fields('id_locacion'))) {
								$locaciones->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "locacioneslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "locacioneslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$locaciones->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $locaciones;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$locaciones->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$locaciones->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $locaciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$locaciones->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$locaciones->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$locaciones->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $locaciones;

		// Call Recordset Selecting event
		$locaciones->Recordset_Selecting($locaciones->CurrentFilter);

		// Load list page SQL
		$sSql = $locaciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$locaciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $locaciones;
		$sFilter = $locaciones->KeyFilter();

		// Call Row Selecting event
		$locaciones->Row_Selecting($sFilter);

		// Load sql based on filter
		$locaciones->CurrentFilter = $sFilter;
		$sSql = $locaciones->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$locaciones->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $locaciones;
		$locaciones->id_locacion->setDbValue($rs->fields('id_locacion'));
		$locaciones->id_empresa->setDbValue($rs->fields('id_empresa'));
		$locaciones->nombre->setDbValue($rs->fields('nombre'));
		$locaciones->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $locaciones;

		// Call Row_Rendering event
		$locaciones->Row_Rendering();

		// Common render codes for all row types
		// id_locacion

		$locaciones->id_locacion->CellCssStyle = "";
		$locaciones->id_locacion->CellCssClass = "";

		// id_empresa
		$locaciones->id_empresa->CellCssStyle = "";
		$locaciones->id_empresa->CellCssClass = "";

		// nombre
		$locaciones->nombre->CellCssStyle = "";
		$locaciones->nombre->CellCssClass = "";

		// notas
		$locaciones->notas->CellCssStyle = "";
		$locaciones->notas->CellCssClass = "";
		if ($locaciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_locacion
			$locaciones->id_locacion->ViewValue = $locaciones->id_locacion->CurrentValue;
			$locaciones->id_locacion->CssStyle = "";
			$locaciones->id_locacion->CssClass = "";
			$locaciones->id_locacion->ViewCustomAttributes = "";

			// id_empresa
			if (strval($locaciones->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($locaciones->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$locaciones->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$locaciones->id_empresa->ViewValue = $locaciones->id_empresa->CurrentValue;
				}
			} else {
				$locaciones->id_empresa->ViewValue = NULL;
			}
			$locaciones->id_empresa->CssStyle = "";
			$locaciones->id_empresa->CssClass = "";
			$locaciones->id_empresa->ViewCustomAttributes = "";

			// nombre
			$locaciones->nombre->ViewValue = $locaciones->nombre->CurrentValue;
			$locaciones->nombre->CssStyle = "";
			$locaciones->nombre->CssClass = "";
			$locaciones->nombre->ViewCustomAttributes = "";

			// notas
			$locaciones->notas->ViewValue = $locaciones->notas->CurrentValue;
			$locaciones->notas->CssStyle = "";
			$locaciones->notas->CssClass = "";
			$locaciones->notas->ViewCustomAttributes = "";

			// id_locacion
			$locaciones->id_locacion->HrefValue = "";

			// id_empresa
			$locaciones->id_empresa->HrefValue = "";

			// nombre
			$locaciones->nombre->HrefValue = "";

			// notas
			$locaciones->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$locaciones->Row_Rendered();
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
