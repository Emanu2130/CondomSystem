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
$usuarios_view = new cusuarios_view();
$Page =& $usuarios_view;

// Page init processing
$usuarios_view->Page_Init();

// Page main processing
$usuarios_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_view = new ew_Page("usuarios_view");

// page properties
usuarios_view.PageID = "view"; // page ID
var EW_PAGE_ID = usuarios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
usuarios_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Usuarios
<br><br>
<?php if ($usuarios->Export == "") { ?>
<a href="usuarioslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $usuarios_view->ShowMessage() ?>
<p>
<?php if ($usuarios->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuarios_view->Pager)) $usuarios_view->Pager = new cPrevNextPager($usuarios_view->lStartRec, $usuarios_view->lDisplayRecs, $usuarios_view->lTotalRecs) ?>
<?php if ($usuarios_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuarios_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuarios_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuarios_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuarios_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuarios_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $usuarios_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($usuarios_view->sSrchWhere == "0=101") { ?>
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
<?php if ($usuarios->user_id->Visible) { // user_id ?>
	<tr<?php echo $usuarios->user_id->RowAttributes ?>>
		<td class="ewTableHeader">User Id</td>
		<td<?php echo $usuarios->user_id->CellAttributes() ?>>
<div<?php echo $usuarios->user_id->ViewAttributes() ?>><?php echo $usuarios->user_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->usuario->Visible) { // usuario ?>
	<tr<?php echo $usuarios->usuario->RowAttributes ?>>
		<td class="ewTableHeader">Usuario</td>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>>
<div<?php echo $usuarios->usuario->ViewAttributes() ?>><?php echo $usuarios->usuario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->clave->Visible) { // clave ?>
	<tr<?php echo $usuarios->clave->RowAttributes ?>>
		<td class="ewTableHeader">Clave</td>
		<td<?php echo $usuarios->clave->CellAttributes() ?>>
<div<?php echo $usuarios->clave->ViewAttributes() ?>><?php echo $usuarios->clave->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->Nombre->Visible) { // Nombre ?>
	<tr<?php echo $usuarios->Nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre</td>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>>
<div<?php echo $usuarios->Nombre->ViewAttributes() ?>><?php echo $usuarios->Nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($usuarios->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuarios_view->Pager)) $usuarios_view->Pager = new cPrevNextPager($usuarios_view->lStartRec, $usuarios_view->lDisplayRecs, $usuarios_view->lTotalRecs) ?>
<?php if ($usuarios_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuarios_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuarios_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuarios_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuarios_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuarios_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_view->PageUrl() ?>start=<?php echo $usuarios_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $usuarios_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($usuarios_view->sSrchWhere == "0=101") { ?>
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
class cusuarios_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'usuarios';

	// Page Object Name
	var $PageObjName = 'usuarios_view';

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
	function cusuarios_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["usuarios"] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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
		global $usuarios;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["user_id"] <> "") {
				$usuarios->user_id->setQueryStringValue($_GET["user_id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$usuarios->CurrentAction = "I"; // Display form
			switch ($usuarios->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("usuarioslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($usuarios->user_id->CurrentValue) == strval($rs->fields('user_id'))) {
								$usuarios->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "usuarioslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "usuarioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuarios->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
