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
$empresas_view = new cempresas_view();
$Page =& $empresas_view;

// Page init processing
$empresas_view->Page_Init();

// Page main processing
$empresas_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($empresas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var empresas_view = new ew_Page("empresas_view");

// page properties
empresas_view.PageID = "view"; // page ID
var EW_PAGE_ID = empresas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
empresas_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empresas_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empresas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empresas_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Empresas
<br><br>
<?php if ($empresas->Export == "") { ?>
<a href="empresaslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empresas->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empresas->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empresas->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empresas->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $empresas_view->ShowMessage() ?>
<p>
<?php if ($empresas->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empresas_view->Pager)) $empresas_view->Pager = new cPrevNextPager($empresas_view->lStartRec, $empresas_view->lDisplayRecs, $empresas_view->lTotalRecs) ?>
<?php if ($empresas_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empresas_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empresas_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empresas_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empresas_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empresas_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empresas_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($empresas_view->sSrchWhere == "0=101") { ?>
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
<?php if ($empresas->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $empresas->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Id Empresa</td>
		<td<?php echo $empresas->id_empresa->CellAttributes() ?>>
<div<?php echo $empresas->id_empresa->ViewAttributes() ?>><?php echo $empresas->id_empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empresas->nombre->Visible) { // nombre ?>
	<tr<?php echo $empresas->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre</td>
		<td<?php echo $empresas->nombre->CellAttributes() ?>>
<div<?php echo $empresas->nombre->ViewAttributes() ?>><?php echo $empresas->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empresas->rnc->Visible) { // rnc ?>
	<tr<?php echo $empresas->rnc->RowAttributes ?>>
		<td class="ewTableHeader">Rnc</td>
		<td<?php echo $empresas->rnc->CellAttributes() ?>>
<div<?php echo $empresas->rnc->ViewAttributes() ?>><?php echo $empresas->rnc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empresas->direccion->Visible) { // direccion ?>
	<tr<?php echo $empresas->direccion->RowAttributes ?>>
		<td class="ewTableHeader">Direccion</td>
		<td<?php echo $empresas->direccion->CellAttributes() ?>>
<div<?php echo $empresas->direccion->ViewAttributes() ?>><?php echo $empresas->direccion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empresas->email->Visible) { // email ?>
	<tr<?php echo $empresas->email->RowAttributes ?>>
		<td class="ewTableHeader">Email</td>
		<td<?php echo $empresas->email->CellAttributes() ?>>
<div<?php echo $empresas->email->ViewAttributes() ?>><?php echo $empresas->email->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empresas->Telefono->Visible) { // Telefono ?>
	<tr<?php echo $empresas->Telefono->RowAttributes ?>>
		<td class="ewTableHeader">Telefono</td>
		<td<?php echo $empresas->Telefono->CellAttributes() ?>>
<div<?php echo $empresas->Telefono->ViewAttributes() ?>><?php echo $empresas->Telefono->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($empresas->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empresas_view->Pager)) $empresas_view->Pager = new cPrevNextPager($empresas_view->lStartRec, $empresas_view->lDisplayRecs, $empresas_view->lTotalRecs) ?>
<?php if ($empresas_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empresas_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empresas_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empresas_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empresas_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empresas_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empresas_view->PageUrl() ?>start=<?php echo $empresas_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empresas_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($empresas_view->sSrchWhere == "0=101") { ?>
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
class cempresas_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'empresas';

	// Page Object Name
	var $PageObjName = 'empresas_view';

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
	function cempresas_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["empresas"] = new cempresas();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empresas', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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
		global $empresas;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_empresa"] <> "") {
				$empresas->id_empresa->setQueryStringValue($_GET["id_empresa"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$empresas->CurrentAction = "I"; // Display form
			switch ($empresas->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("empresaslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($empresas->id_empresa->CurrentValue) == strval($rs->fields('id_empresa'))) {
								$empresas->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "empresaslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "empresaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$empresas->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
