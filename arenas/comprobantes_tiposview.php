<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "comprobantes_tiposinfo.php" ?>
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
$comprobantes_tipos_view = new ccomprobantes_tipos_view();
$Page =& $comprobantes_tipos_view;

// Page init processing
$comprobantes_tipos_view->Page_Init();

// Page main processing
$comprobantes_tipos_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($comprobantes_tipos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var comprobantes_tipos_view = new ew_Page("comprobantes_tipos_view");

// page properties
comprobantes_tipos_view.PageID = "view"; // page ID
var EW_PAGE_ID = comprobantes_tipos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comprobantes_tipos_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
comprobantes_tipos_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
comprobantes_tipos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comprobantes_tipos_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Comprobantes Tipos
<br><br>
<?php if ($comprobantes_tipos->Export == "") { ?>
<a href="comprobantes_tiposlist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comprobantes_tipos->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comprobantes_tipos->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comprobantes_tipos->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comprobantes_tipos->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $comprobantes_tipos_view->ShowMessage() ?>
<p>
<?php if ($comprobantes_tipos->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($comprobantes_tipos_view->Pager)) $comprobantes_tipos_view->Pager = new cPrevNextPager($comprobantes_tipos_view->lStartRec, $comprobantes_tipos_view->lDisplayRecs, $comprobantes_tipos_view->lTotalRecs) ?>
<?php if ($comprobantes_tipos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($comprobantes_tipos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($comprobantes_tipos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $comprobantes_tipos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($comprobantes_tipos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($comprobantes_tipos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $comprobantes_tipos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($comprobantes_tipos_view->sSrchWhere == "0=101") { ?>
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
<?php if ($comprobantes_tipos->id_comprobante->Visible) { // id_comprobante ?>
	<tr<?php echo $comprobantes_tipos->id_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Id Comprobante</td>
		<td<?php echo $comprobantes_tipos->id_comprobante->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->id_comprobante->ViewAttributes() ?>><?php echo $comprobantes_tipos->id_comprobante->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comprobantes_tipos->nombre_tipo->Visible) { // nombre_tipo ?>
	<tr<?php echo $comprobantes_tipos->nombre_tipo->RowAttributes ?>>
		<td class="ewTableHeader">Nombre Tipo</td>
		<td<?php echo $comprobantes_tipos->nombre_tipo->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->nombre_tipo->ViewAttributes() ?>><?php echo $comprobantes_tipos->nombre_tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comprobantes_tipos->descripcion->Visible) { // descripcion ?>
	<tr<?php echo $comprobantes_tipos->descripcion->RowAttributes ?>>
		<td class="ewTableHeader">Descripcion</td>
		<td<?php echo $comprobantes_tipos->descripcion->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->descripcion->ViewAttributes() ?>><?php echo $comprobantes_tipos->descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($comprobantes_tipos->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($comprobantes_tipos_view->Pager)) $comprobantes_tipos_view->Pager = new cPrevNextPager($comprobantes_tipos_view->lStartRec, $comprobantes_tipos_view->lDisplayRecs, $comprobantes_tipos_view->lTotalRecs) ?>
<?php if ($comprobantes_tipos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($comprobantes_tipos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($comprobantes_tipos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $comprobantes_tipos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($comprobantes_tipos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($comprobantes_tipos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_view->PageUrl() ?>start=<?php echo $comprobantes_tipos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $comprobantes_tipos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($comprobantes_tipos_view->sSrchWhere == "0=101") { ?>
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
<?php if ($comprobantes_tipos->Export == "") { ?>
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
class ccomprobantes_tipos_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'comprobantes_tipos';

	// Page Object Name
	var $PageObjName = 'comprobantes_tipos_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comprobantes_tipos;
		if ($comprobantes_tipos->UseTokenInUrl) $PageUrl .= "t=" . $comprobantes_tipos->TableVar . "&"; // add page token
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
		global $objForm, $comprobantes_tipos;
		if ($comprobantes_tipos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($comprobantes_tipos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comprobantes_tipos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccomprobantes_tipos_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["comprobantes_tipos"] = new ccomprobantes_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comprobantes_tipos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $comprobantes_tipos;
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
		global $comprobantes_tipos;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_comprobante"] <> "") {
				$comprobantes_tipos->id_comprobante->setQueryStringValue($_GET["id_comprobante"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$comprobantes_tipos->CurrentAction = "I"; // Display form
			switch ($comprobantes_tipos->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("comprobantes_tiposlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($comprobantes_tipos->id_comprobante->CurrentValue) == strval($rs->fields('id_comprobante'))) {
								$comprobantes_tipos->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "comprobantes_tiposlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "comprobantes_tiposlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$comprobantes_tipos->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $comprobantes_tipos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $comprobantes_tipos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comprobantes_tipos;

		// Call Recordset Selecting event
		$comprobantes_tipos->Recordset_Selecting($comprobantes_tipos->CurrentFilter);

		// Load list page SQL
		$sSql = $comprobantes_tipos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$comprobantes_tipos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comprobantes_tipos;
		$sFilter = $comprobantes_tipos->KeyFilter();

		// Call Row Selecting event
		$comprobantes_tipos->Row_Selecting($sFilter);

		// Load sql based on filter
		$comprobantes_tipos->CurrentFilter = $sFilter;
		$sSql = $comprobantes_tipos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$comprobantes_tipos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $comprobantes_tipos;
		$comprobantes_tipos->id_comprobante->setDbValue($rs->fields('id_comprobante'));
		$comprobantes_tipos->nombre_tipo->setDbValue($rs->fields('nombre_tipo'));
		$comprobantes_tipos->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $comprobantes_tipos;

		// Call Row_Rendering event
		$comprobantes_tipos->Row_Rendering();

		// Common render codes for all row types
		// id_comprobante

		$comprobantes_tipos->id_comprobante->CellCssStyle = "";
		$comprobantes_tipos->id_comprobante->CellCssClass = "";

		// nombre_tipo
		$comprobantes_tipos->nombre_tipo->CellCssStyle = "";
		$comprobantes_tipos->nombre_tipo->CellCssClass = "";

		// descripcion
		$comprobantes_tipos->descripcion->CellCssStyle = "";
		$comprobantes_tipos->descripcion->CellCssClass = "";
		if ($comprobantes_tipos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_comprobante
			$comprobantes_tipos->id_comprobante->ViewValue = $comprobantes_tipos->id_comprobante->CurrentValue;
			$comprobantes_tipos->id_comprobante->CssStyle = "";
			$comprobantes_tipos->id_comprobante->CssClass = "";
			$comprobantes_tipos->id_comprobante->ViewCustomAttributes = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->ViewValue = $comprobantes_tipos->nombre_tipo->CurrentValue;
			$comprobantes_tipos->nombre_tipo->CssStyle = "";
			$comprobantes_tipos->nombre_tipo->CssClass = "";
			$comprobantes_tipos->nombre_tipo->ViewCustomAttributes = "";

			// descripcion
			$comprobantes_tipos->descripcion->ViewValue = $comprobantes_tipos->descripcion->CurrentValue;
			$comprobantes_tipos->descripcion->CssStyle = "";
			$comprobantes_tipos->descripcion->CssClass = "";
			$comprobantes_tipos->descripcion->ViewCustomAttributes = "";

			// id_comprobante
			$comprobantes_tipos->id_comprobante->HrefValue = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->HrefValue = "";

			// descripcion
			$comprobantes_tipos->descripcion->HrefValue = "";
		}

		// Call Row Rendered event
		$comprobantes_tipos->Row_Rendered();
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
