<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "egresos_tipo1info.php" ?>
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
$egresos_tipo1_view = new cegresos_tipo1_view();
$Page =& $egresos_tipo1_view;

// Page init processing
$egresos_tipo1_view->Page_Init();

// Page main processing
$egresos_tipo1_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($egresos_tipo1->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_tipo1_view = new ew_Page("egresos_tipo1_view");

// page properties
egresos_tipo1_view.PageID = "view"; // page ID
var EW_PAGE_ID = egresos_tipo1_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
egresos_tipo1_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_tipo1_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_tipo1_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_tipo1_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Egresos Tipo 1
<br><br>
<?php if ($egresos_tipo1->Export == "") { ?>
<a href="egresos_tipo1list.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos_tipo1->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos_tipo1->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos_tipo1->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos_tipo1->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $egresos_tipo1_view->ShowMessage() ?>
<p>
<?php if ($egresos_tipo1->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_tipo1_view->Pager)) $egresos_tipo1_view->Pager = new cPrevNextPager($egresos_tipo1_view->lStartRec, $egresos_tipo1_view->lDisplayRecs, $egresos_tipo1_view->lTotalRecs) ?>
<?php if ($egresos_tipo1_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_tipo1_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_tipo1_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_tipo1_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_tipo1_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_tipo1_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_tipo1_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($egresos_tipo1_view->sSrchWhere == "0=101") { ?>
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
<?php if ($egresos_tipo1->id_tipo->Visible) { // id_tipo ?>
	<tr<?php echo $egresos_tipo1->id_tipo->RowAttributes ?>>
		<td class="ewTableHeader">Id Tipo</td>
		<td<?php echo $egresos_tipo1->id_tipo->CellAttributes() ?>>
<div<?php echo $egresos_tipo1->id_tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->id_tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos_tipo1->tipo->Visible) { // tipo ?>
	<tr<?php echo $egresos_tipo1->tipo->RowAttributes ?>>
		<td class="ewTableHeader">Tipo</td>
		<td<?php echo $egresos_tipo1->tipo->CellAttributes() ?>>
<div<?php echo $egresos_tipo1->tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($egresos_tipo1->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_tipo1_view->Pager)) $egresos_tipo1_view->Pager = new cPrevNextPager($egresos_tipo1_view->lStartRec, $egresos_tipo1_view->lDisplayRecs, $egresos_tipo1_view->lTotalRecs) ?>
<?php if ($egresos_tipo1_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_tipo1_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_tipo1_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_tipo1_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_tipo1_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_tipo1_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_view->PageUrl() ?>start=<?php echo $egresos_tipo1_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_tipo1_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($egresos_tipo1_view->sSrchWhere == "0=101") { ?>
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
<?php if ($egresos_tipo1->Export == "") { ?>
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
class cegresos_tipo1_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'egresos_tipo1';

	// Page Object Name
	var $PageObjName = 'egresos_tipo1_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $egresos_tipo1;
		if ($egresos_tipo1->UseTokenInUrl) $PageUrl .= "t=" . $egresos_tipo1->TableVar . "&"; // add page token
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
		global $objForm, $egresos_tipo1;
		if ($egresos_tipo1->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($egresos_tipo1->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($egresos_tipo1->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cegresos_tipo1_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos_tipo1"] = new cegresos_tipo1();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'egresos_tipo1', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $egresos_tipo1;
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
		global $egresos_tipo1;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_tipo"] <> "") {
				$egresos_tipo1->id_tipo->setQueryStringValue($_GET["id_tipo"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$egresos_tipo1->CurrentAction = "I"; // Display form
			switch ($egresos_tipo1->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("egresos_tipo1list.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($egresos_tipo1->id_tipo->CurrentValue) == strval($rs->fields('id_tipo'))) {
								$egresos_tipo1->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "egresos_tipo1list.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "egresos_tipo1list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$egresos_tipo1->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $egresos_tipo1;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$egresos_tipo1->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$egresos_tipo1->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $egresos_tipo1->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $egresos_tipo1;

		// Call Recordset Selecting event
		$egresos_tipo1->Recordset_Selecting($egresos_tipo1->CurrentFilter);

		// Load list page SQL
		$sSql = $egresos_tipo1->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$egresos_tipo1->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $egresos_tipo1;
		$sFilter = $egresos_tipo1->KeyFilter();

		// Call Row Selecting event
		$egresos_tipo1->Row_Selecting($sFilter);

		// Load sql based on filter
		$egresos_tipo1->CurrentFilter = $sFilter;
		$sSql = $egresos_tipo1->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$egresos_tipo1->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $egresos_tipo1;
		$egresos_tipo1->id_tipo->setDbValue($rs->fields('id_tipo'));
		$egresos_tipo1->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $egresos_tipo1;

		// Call Row_Rendering event
		$egresos_tipo1->Row_Rendering();

		// Common render codes for all row types
		// id_tipo

		$egresos_tipo1->id_tipo->CellCssStyle = "";
		$egresos_tipo1->id_tipo->CellCssClass = "";

		// tipo
		$egresos_tipo1->tipo->CellCssStyle = "";
		$egresos_tipo1->tipo->CellCssClass = "";
		if ($egresos_tipo1->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_tipo
			$egresos_tipo1->id_tipo->ViewValue = $egresos_tipo1->id_tipo->CurrentValue;
			$egresos_tipo1->id_tipo->CssStyle = "";
			$egresos_tipo1->id_tipo->CssClass = "";
			$egresos_tipo1->id_tipo->ViewCustomAttributes = "";

			// tipo
			$egresos_tipo1->tipo->ViewValue = $egresos_tipo1->tipo->CurrentValue;
			$egresos_tipo1->tipo->CssStyle = "";
			$egresos_tipo1->tipo->CssClass = "";
			$egresos_tipo1->tipo->ViewCustomAttributes = "";

			// id_tipo
			$egresos_tipo1->id_tipo->HrefValue = "";

			// tipo
			$egresos_tipo1->tipo->HrefValue = "";
		}

		// Call Row Rendered event
		$egresos_tipo1->Row_Rendered();
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
