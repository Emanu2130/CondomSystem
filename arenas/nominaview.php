<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "nominainfo.php" ?>
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
$nomina_view = new cnomina_view();
$Page =& $nomina_view;

// Page init processing
$nomina_view->Page_Init();

// Page main processing
$nomina_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($nomina->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var nomina_view = new ew_Page("nomina_view");

// page properties
nomina_view.PageID = "view"; // page ID
var EW_PAGE_ID = nomina_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nomina_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nomina_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nomina_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nomina_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Nomina
<br><br>
<?php if ($nomina->Export == "") { ?>
<a href="nominalist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $nomina->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $nomina->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $nomina->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $nomina->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $nomina_view->ShowMessage() ?>
<p>
<?php if ($nomina->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($nomina_view->Pager)) $nomina_view->Pager = new cPrevNextPager($nomina_view->lStartRec, $nomina_view->lDisplayRecs, $nomina_view->lTotalRecs) ?>
<?php if ($nomina_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($nomina_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($nomina_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $nomina_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($nomina_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($nomina_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $nomina_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($nomina_view->sSrchWhere == "0=101") { ?>
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
<?php if ($nomina->id_nomina->Visible) { // id_nomina ?>
	<tr<?php echo $nomina->id_nomina->RowAttributes ?>>
		<td class="ewTableHeader">Id Nomina</td>
		<td<?php echo $nomina->id_nomina->CellAttributes() ?>>
<div<?php echo $nomina->id_nomina->ViewAttributes() ?>><?php echo $nomina->id_nomina->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $nomina->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Id Empresa</td>
		<td<?php echo $nomina->id_empresa->CellAttributes() ?>>
<div<?php echo $nomina->id_empresa->ViewAttributes() ?>><?php echo $nomina->id_empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->empleado->Visible) { // empleado ?>
	<tr<?php echo $nomina->empleado->RowAttributes ?>>
		<td class="ewTableHeader">Empleado</td>
		<td<?php echo $nomina->empleado->CellAttributes() ?>>
<div<?php echo $nomina->empleado->ViewAttributes() ?>><?php echo $nomina->empleado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->monto_pago->Visible) { // monto_pago ?>
	<tr<?php echo $nomina->monto_pago->RowAttributes ?>>
		<td class="ewTableHeader">Pago quincenal</td>
		<td<?php echo $nomina->monto_pago->CellAttributes() ?>>
<div<?php echo $nomina->monto_pago->ViewAttributes() ?>><?php echo $nomina->monto_pago->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->deducible_afp->Visible) { // deducible_afp ?>
	<tr<?php echo $nomina->deducible_afp->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Afp</td>
		<td<?php echo $nomina->deducible_afp->CellAttributes() ?>>
<div<?php echo $nomina->deducible_afp->ViewAttributes() ?>><?php echo $nomina->deducible_afp->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->deducible_sf->Visible) { // deducible_sf ?>
	<tr<?php echo $nomina->deducible_sf->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Sf</td>
		<td<?php echo $nomina->deducible_sf->CellAttributes() ?>>
<div<?php echo $nomina->deducible_sf->ViewAttributes() ?>><?php echo $nomina->deducible_sf->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->fecha->Visible) { // fecha ?>
	<tr<?php echo $nomina->fecha->RowAttributes ?>>
		<td class="ewTableHeader">Fecha</td>
		<td<?php echo $nomina->fecha->CellAttributes() ?>>
<div<?php echo $nomina->fecha->ViewAttributes() ?>><?php echo $nomina->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nomina->notas->Visible) { // notas ?>
	<tr<?php echo $nomina->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $nomina->notas->CellAttributes() ?>>
<div<?php echo $nomina->notas->ViewAttributes() ?>><?php echo $nomina->notas->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($nomina->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($nomina_view->Pager)) $nomina_view->Pager = new cPrevNextPager($nomina_view->lStartRec, $nomina_view->lDisplayRecs, $nomina_view->lTotalRecs) ?>
<?php if ($nomina_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($nomina_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($nomina_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $nomina_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($nomina_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($nomina_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_view->PageUrl() ?>start=<?php echo $nomina_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $nomina_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($nomina_view->sSrchWhere == "0=101") { ?>
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
<?php if ($nomina->Export == "") { ?>
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
class cnomina_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'nomina';

	// Page Object Name
	var $PageObjName = 'nomina_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $nomina;
		if ($nomina->UseTokenInUrl) $PageUrl .= "t=" . $nomina->TableVar . "&"; // add page token
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
		global $objForm, $nomina;
		if ($nomina->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($nomina->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($nomina->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnomina_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["nomina"] = new cnomina();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nomina', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $nomina;
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
		global $nomina;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_nomina"] <> "") {
				$nomina->id_nomina->setQueryStringValue($_GET["id_nomina"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$nomina->CurrentAction = "I"; // Display form
			switch ($nomina->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("nominalist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($nomina->id_nomina->CurrentValue) == strval($rs->fields('id_nomina'))) {
								$nomina->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "nominalist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "nominalist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$nomina->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $nomina;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$nomina->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$nomina->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $nomina->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$nomina->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$nomina->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$nomina->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $nomina;

		// Call Recordset Selecting event
		$nomina->Recordset_Selecting($nomina->CurrentFilter);

		// Load list page SQL
		$sSql = $nomina->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$nomina->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $nomina;
		$sFilter = $nomina->KeyFilter();

		// Call Row Selecting event
		$nomina->Row_Selecting($sFilter);

		// Load sql based on filter
		$nomina->CurrentFilter = $sFilter;
		$sSql = $nomina->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$nomina->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $nomina;
		$nomina->id_nomina->setDbValue($rs->fields('id_nomina'));
		$nomina->id_empresa->setDbValue($rs->fields('id_empresa'));
		$nomina->empleado->setDbValue($rs->fields('empleado'));
		$nomina->monto_pago->setDbValue($rs->fields('monto_pago'));
		$nomina->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$nomina->deducible_sf->setDbValue($rs->fields('deducible_sf'));
		$nomina->fecha->setDbValue($rs->fields('fecha'));
		$nomina->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $nomina;

		// Call Row_Rendering event
		$nomina->Row_Rendering();

		// Common render codes for all row types
		// id_nomina

		$nomina->id_nomina->CellCssStyle = "";
		$nomina->id_nomina->CellCssClass = "";

		// id_empresa
		$nomina->id_empresa->CellCssStyle = "";
		$nomina->id_empresa->CellCssClass = "";

		// empleado
		$nomina->empleado->CellCssStyle = "";
		$nomina->empleado->CellCssClass = "";

		// monto_pago
		$nomina->monto_pago->CellCssStyle = "";
		$nomina->monto_pago->CellCssClass = "";

		// deducible_afp
		$nomina->deducible_afp->CellCssStyle = "";
		$nomina->deducible_afp->CellCssClass = "";

		// deducible_sf
		$nomina->deducible_sf->CellCssStyle = "";
		$nomina->deducible_sf->CellCssClass = "";

		// fecha
		$nomina->fecha->CellCssStyle = "";
		$nomina->fecha->CellCssClass = "";

		// notas
		$nomina->notas->CellCssStyle = "";
		$nomina->notas->CellCssClass = "";
		if ($nomina->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_nomina
			$nomina->id_nomina->ViewValue = $nomina->id_nomina->CurrentValue;
			$nomina->id_nomina->CssStyle = "";
			$nomina->id_nomina->CssClass = "";
			$nomina->id_nomina->ViewCustomAttributes = "";

			// id_empresa
			if (strval($nomina->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($nomina->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$nomina->id_empresa->ViewValue = $nomina->id_empresa->CurrentValue;
				}
			} else {
				$nomina->id_empresa->ViewValue = NULL;
			}
			$nomina->id_empresa->CssStyle = "";
			$nomina->id_empresa->CssClass = "";
			$nomina->id_empresa->ViewCustomAttributes = "";

			// empleado
			if (strval($nomina->empleado->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_completo` FROM `empleados` WHERE `id_empleado` = " . ew_AdjustSql($nomina->empleado->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->empleado->ViewValue = $rswrk->fields('nombre_completo');
					$rswrk->Close();
				} else {
					$nomina->empleado->ViewValue = $nomina->empleado->CurrentValue;
				}
			} else {
				$nomina->empleado->ViewValue = NULL;
			}
			$nomina->empleado->CssStyle = "";
			$nomina->empleado->CssClass = "";
			$nomina->empleado->ViewCustomAttributes = "";

			// monto_pago
			if (strval($nomina->monto_pago->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `salario_quincenal` FROM `empleados` WHERE `salario_quincenal` = " . ew_AdjustSql($nomina->monto_pago->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->monto_pago->ViewValue = $rswrk->fields('salario_quincenal');
					$rswrk->Close();
				} else {
					$nomina->monto_pago->ViewValue = $nomina->monto_pago->CurrentValue;
				}
			} else {
				$nomina->monto_pago->ViewValue = NULL;
			}
			$nomina->monto_pago->CssStyle = "";
			$nomina->monto_pago->CssClass = "";
			$nomina->monto_pago->ViewCustomAttributes = "";

			// deducible_afp
			if (strval($nomina->deducible_afp->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `deducible_afp` FROM `empleados` WHERE `deducible_afp` = " . ew_AdjustSql($nomina->deducible_afp->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->deducible_afp->ViewValue = $rswrk->fields('deducible_afp');
					$rswrk->Close();
				} else {
					$nomina->deducible_afp->ViewValue = $nomina->deducible_afp->CurrentValue;
				}
			} else {
				$nomina->deducible_afp->ViewValue = NULL;
			}
			$nomina->deducible_afp->CssStyle = "";
			$nomina->deducible_afp->CssClass = "";
			$nomina->deducible_afp->ViewCustomAttributes = "";

			// deducible_sf
			if (strval($nomina->deducible_sf->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `deducible_sf` FROM `empleados` WHERE `deducible_sf` = " . ew_AdjustSql($nomina->deducible_sf->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->deducible_sf->ViewValue = $rswrk->fields('deducible_sf');
					$rswrk->Close();
				} else {
					$nomina->deducible_sf->ViewValue = $nomina->deducible_sf->CurrentValue;
				}
			} else {
				$nomina->deducible_sf->ViewValue = NULL;
			}
			$nomina->deducible_sf->CssStyle = "";
			$nomina->deducible_sf->CssClass = "";
			$nomina->deducible_sf->ViewCustomAttributes = "";

			// fecha
			$nomina->fecha->ViewValue = $nomina->fecha->CurrentValue;
			$nomina->fecha->ViewValue = ew_FormatDateTime($nomina->fecha->ViewValue, 7);
			$nomina->fecha->CssStyle = "";
			$nomina->fecha->CssClass = "";
			$nomina->fecha->ViewCustomAttributes = "";

			// notas
			$nomina->notas->ViewValue = $nomina->notas->CurrentValue;
			$nomina->notas->CssStyle = "";
			$nomina->notas->CssClass = "";
			$nomina->notas->ViewCustomAttributes = "";

			// id_nomina
			$nomina->id_nomina->HrefValue = "";

			// id_empresa
			$nomina->id_empresa->HrefValue = "";

			// empleado
			$nomina->empleado->HrefValue = "";

			// monto_pago
			$nomina->monto_pago->HrefValue = "";

			// deducible_afp
			$nomina->deducible_afp->HrefValue = "";

			// deducible_sf
			$nomina->deducible_sf->HrefValue = "";

			// fecha
			$nomina->fecha->HrefValue = "";

			// notas
			$nomina->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$nomina->Row_Rendered();
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
