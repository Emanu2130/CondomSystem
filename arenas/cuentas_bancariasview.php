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
$cuentas_bancarias_view = new ccuentas_bancarias_view();
$Page =& $cuentas_bancarias_view;

// Page init processing
$cuentas_bancarias_view->Page_Init();

// Page main processing
$cuentas_bancarias_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cuentas_bancarias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cuentas_bancarias_view = new ew_Page("cuentas_bancarias_view");

// page properties
cuentas_bancarias_view.PageID = "view"; // page ID
var EW_PAGE_ID = cuentas_bancarias_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cuentas_bancarias_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
cuentas_bancarias_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cuentas_bancarias_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuentas_bancarias_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Cuentas Bancarias
<br><br>
<?php if ($cuentas_bancarias->Export == "") { ?>
<a href="cuentas_bancariaslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cuentas_bancarias->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cuentas_bancarias->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cuentas_bancarias->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cuentas_bancarias->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $cuentas_bancarias_view->ShowMessage() ?>
<p>
<?php if ($cuentas_bancarias->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cuentas_bancarias_view->Pager)) $cuentas_bancarias_view->Pager = new cPrevNextPager($cuentas_bancarias_view->lStartRec, $cuentas_bancarias_view->lDisplayRecs, $cuentas_bancarias_view->lTotalRecs) ?>
<?php if ($cuentas_bancarias_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($cuentas_bancarias_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cuentas_bancarias_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cuentas_bancarias_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cuentas_bancarias_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cuentas_bancarias_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $cuentas_bancarias_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($cuentas_bancarias_view->sSrchWhere == "0=101") { ?>
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
<?php if ($cuentas_bancarias->id_banco->Visible) { // id_banco ?>
	<tr<?php echo $cuentas_bancarias->id_banco->RowAttributes ?>>
		<td class="ewTableHeader">Id Banco</td>
		<td<?php echo $cuentas_bancarias->id_banco->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->id_banco->ViewAttributes() ?>><?php echo $cuentas_bancarias->id_banco->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $cuentas_bancarias->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $cuentas_bancarias->id_empresa->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->id_empresa->ViewAttributes() ?>><?php echo $cuentas_bancarias->id_empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->Banco->Visible) { // Banco ?>
	<tr<?php echo $cuentas_bancarias->Banco->RowAttributes ?>>
		<td class="ewTableHeader">Banco</td>
		<td<?php echo $cuentas_bancarias->Banco->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->Banco->ViewAttributes() ?>><?php echo $cuentas_bancarias->Banco->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->numero_cuenta->Visible) { // numero_cuenta ?>
	<tr<?php echo $cuentas_bancarias->numero_cuenta->RowAttributes ?>>
		<td class="ewTableHeader">Numero Cuenta</td>
		<td<?php echo $cuentas_bancarias->numero_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->numero_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->numero_cuenta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->ejecutivo_cuenta->Visible) { // ejecutivo_cuenta ?>
	<tr<?php echo $cuentas_bancarias->ejecutivo_cuenta->RowAttributes ?>>
		<td class="ewTableHeader">Ejecutivo Cuenta</td>
		<td<?php echo $cuentas_bancarias->ejecutivo_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->ejecutivo_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->ejecutivo_cuenta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->telefono_ejecutivo->Visible) { // telefono_ejecutivo ?>
	<tr<?php echo $cuentas_bancarias->telefono_ejecutivo->RowAttributes ?>>
		<td class="ewTableHeader">Telefono Ejecutivo</td>
		<td<?php echo $cuentas_bancarias->telefono_ejecutivo->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->telefono_ejecutivo->ViewAttributes() ?>><?php echo $cuentas_bancarias->telefono_ejecutivo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->tipo_cuenta->Visible) { // tipo_cuenta ?>
	<tr<?php echo $cuentas_bancarias->tipo_cuenta->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Cuenta</td>
		<td<?php echo $cuentas_bancarias->tipo_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->tipo_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->tipo_cuenta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->moneda->Visible) { // moneda ?>
	<tr<?php echo $cuentas_bancarias->moneda->RowAttributes ?>>
		<td class="ewTableHeader">Moneda</td>
		<td<?php echo $cuentas_bancarias->moneda->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->moneda->ViewAttributes() ?>><?php echo $cuentas_bancarias->moneda->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cuentas_bancarias->notas->Visible) { // notas ?>
	<tr<?php echo $cuentas_bancarias->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $cuentas_bancarias->notas->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->notas->ViewAttributes() ?>><?php echo $cuentas_bancarias->notas->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($cuentas_bancarias->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cuentas_bancarias_view->Pager)) $cuentas_bancarias_view->Pager = new cPrevNextPager($cuentas_bancarias_view->lStartRec, $cuentas_bancarias_view->lDisplayRecs, $cuentas_bancarias_view->lTotalRecs) ?>
<?php if ($cuentas_bancarias_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($cuentas_bancarias_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cuentas_bancarias_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cuentas_bancarias_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cuentas_bancarias_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cuentas_bancarias_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cuentas_bancarias_view->PageUrl() ?>start=<?php echo $cuentas_bancarias_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $cuentas_bancarias_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($cuentas_bancarias_view->sSrchWhere == "0=101") { ?>
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
class ccuentas_bancarias_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'cuentas_bancarias';

	// Page Object Name
	var $PageObjName = 'cuentas_bancarias_view';

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
	function ccuentas_bancarias_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["cuentas_bancarias"] = new ccuentas_bancarias();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cuentas_bancarias', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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
		global $cuentas_bancarias;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_banco"] <> "") {
				$cuentas_bancarias->id_banco->setQueryStringValue($_GET["id_banco"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$cuentas_bancarias->CurrentAction = "I"; // Display form
			switch ($cuentas_bancarias->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("cuentas_bancariaslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($cuentas_bancarias->id_banco->CurrentValue) == strval($rs->fields('id_banco'))) {
								$cuentas_bancarias->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "cuentas_bancariaslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "cuentas_bancariaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$cuentas_bancarias->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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

		// notas
		$cuentas_bancarias->notas->CellCssStyle = "";
		$cuentas_bancarias->notas->CellCssClass = "";
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

			// notas
			$cuentas_bancarias->notas->ViewValue = $cuentas_bancarias->notas->CurrentValue;
			$cuentas_bancarias->notas->CssStyle = "";
			$cuentas_bancarias->notas->CssClass = "";
			$cuentas_bancarias->notas->ViewCustomAttributes = "";

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

			// notas
			$cuentas_bancarias->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$cuentas_bancarias->Row_Rendered();
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
