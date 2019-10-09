<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "metodos_pagoinfo.php" ?>
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
$metodos_pago_view = new cmetodos_pago_view();
$Page =& $metodos_pago_view;

// Page init processing
$metodos_pago_view->Page_Init();

// Page main processing
$metodos_pago_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($metodos_pago->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var metodos_pago_view = new ew_Page("metodos_pago_view");

// page properties
metodos_pago_view.PageID = "view"; // page ID
var EW_PAGE_ID = metodos_pago_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
metodos_pago_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
metodos_pago_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
metodos_pago_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
metodos_pago_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Metodos Pago
<br><br>
<?php if ($metodos_pago->Export == "") { ?>
<a href="metodos_pagolist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $metodos_pago->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $metodos_pago->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $metodos_pago->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $metodos_pago->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $metodos_pago_view->ShowMessage() ?>
<p>
<?php if ($metodos_pago->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($metodos_pago_view->Pager)) $metodos_pago_view->Pager = new cPrevNextPager($metodos_pago_view->lStartRec, $metodos_pago_view->lDisplayRecs, $metodos_pago_view->lTotalRecs) ?>
<?php if ($metodos_pago_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($metodos_pago_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($metodos_pago_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $metodos_pago_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($metodos_pago_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($metodos_pago_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $metodos_pago_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($metodos_pago_view->sSrchWhere == "0=101") { ?>
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
<?php if ($metodos_pago->id_metodo->Visible) { // id_metodo ?>
	<tr<?php echo $metodos_pago->id_metodo->RowAttributes ?>>
		<td class="ewTableHeader">Id Metodo</td>
		<td<?php echo $metodos_pago->id_metodo->CellAttributes() ?>>
<div<?php echo $metodos_pago->id_metodo->ViewAttributes() ?>><?php echo $metodos_pago->id_metodo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($metodos_pago->metodo->Visible) { // metodo ?>
	<tr<?php echo $metodos_pago->metodo->RowAttributes ?>>
		<td class="ewTableHeader">Metodo</td>
		<td<?php echo $metodos_pago->metodo->CellAttributes() ?>>
<div<?php echo $metodos_pago->metodo->ViewAttributes() ?>><?php echo $metodos_pago->metodo->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($metodos_pago->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($metodos_pago_view->Pager)) $metodos_pago_view->Pager = new cPrevNextPager($metodos_pago_view->lStartRec, $metodos_pago_view->lDisplayRecs, $metodos_pago_view->lTotalRecs) ?>
<?php if ($metodos_pago_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($metodos_pago_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($metodos_pago_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $metodos_pago_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($metodos_pago_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($metodos_pago_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_view->PageUrl() ?>start=<?php echo $metodos_pago_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $metodos_pago_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($metodos_pago_view->sSrchWhere == "0=101") { ?>
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
<?php if ($metodos_pago->Export == "") { ?>
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
class cmetodos_pago_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'metodos_pago';

	// Page Object Name
	var $PageObjName = 'metodos_pago_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $metodos_pago;
		if ($metodos_pago->UseTokenInUrl) $PageUrl .= "t=" . $metodos_pago->TableVar . "&"; // add page token
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
		global $objForm, $metodos_pago;
		if ($metodos_pago->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($metodos_pago->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($metodos_pago->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmetodos_pago_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["metodos_pago"] = new cmetodos_pago();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'metodos_pago', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $metodos_pago;
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
		global $metodos_pago;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_metodo"] <> "") {
				$metodos_pago->id_metodo->setQueryStringValue($_GET["id_metodo"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$metodos_pago->CurrentAction = "I"; // Display form
			switch ($metodos_pago->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("metodos_pagolist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($metodos_pago->id_metodo->CurrentValue) == strval($rs->fields('id_metodo'))) {
								$metodos_pago->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "metodos_pagolist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "metodos_pagolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$metodos_pago->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $metodos_pago;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$metodos_pago->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$metodos_pago->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $metodos_pago->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $metodos_pago;

		// Call Recordset Selecting event
		$metodos_pago->Recordset_Selecting($metodos_pago->CurrentFilter);

		// Load list page SQL
		$sSql = $metodos_pago->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$metodos_pago->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $metodos_pago;
		$sFilter = $metodos_pago->KeyFilter();

		// Call Row Selecting event
		$metodos_pago->Row_Selecting($sFilter);

		// Load sql based on filter
		$metodos_pago->CurrentFilter = $sFilter;
		$sSql = $metodos_pago->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$metodos_pago->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $metodos_pago;
		$metodos_pago->id_metodo->setDbValue($rs->fields('id_metodo'));
		$metodos_pago->metodo->setDbValue($rs->fields('metodo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $metodos_pago;

		// Call Row_Rendering event
		$metodos_pago->Row_Rendering();

		// Common render codes for all row types
		// id_metodo

		$metodos_pago->id_metodo->CellCssStyle = "";
		$metodos_pago->id_metodo->CellCssClass = "";

		// metodo
		$metodos_pago->metodo->CellCssStyle = "";
		$metodos_pago->metodo->CellCssClass = "";
		if ($metodos_pago->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_metodo
			$metodos_pago->id_metodo->ViewValue = $metodos_pago->id_metodo->CurrentValue;
			$metodos_pago->id_metodo->CssStyle = "";
			$metodos_pago->id_metodo->CssClass = "";
			$metodos_pago->id_metodo->ViewCustomAttributes = "";

			// metodo
			$metodos_pago->metodo->ViewValue = $metodos_pago->metodo->CurrentValue;
			$metodos_pago->metodo->CssStyle = "";
			$metodos_pago->metodo->CssClass = "";
			$metodos_pago->metodo->ViewCustomAttributes = "";

			// id_metodo
			$metodos_pago->id_metodo->HrefValue = "";

			// metodo
			$metodos_pago->metodo->HrefValue = "";
		}

		// Call Row Rendered event
		$metodos_pago->Row_Rendered();
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
