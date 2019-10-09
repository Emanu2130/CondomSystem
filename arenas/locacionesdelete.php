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
$locaciones_delete = new clocaciones_delete();
$Page =& $locaciones_delete;

// Page init processing
$locaciones_delete->Page_Init();

// Page main processing
$locaciones_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var locaciones_delete = new ew_Page("locaciones_delete");

// page properties
locaciones_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = locaciones_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
locaciones_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
locaciones_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
locaciones_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
locaciones_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
$rs = $locaciones_delete->LoadRecordset();
$locaciones_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($locaciones_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$locaciones_delete->Page_Terminate("locacioneslist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Locaciones<br><br>
<a href="<?php echo $locaciones->getReturnUrl() ?>">Volver</a></span></p>
<?php $locaciones_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="locaciones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($locaciones_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $locaciones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Locacion</td>
		<td valign="top">Id Empresa</td>
		<td valign="top">Nombre</td>
		<td valign="top">Notas</td>
	</tr>
	</thead>
	<tbody>
<?php
$locaciones_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$locaciones_delete->lRecCnt++;

	// Set row properties
	$locaciones->CssClass = "";
	$locaciones->CssStyle = "";
	$locaciones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$locaciones_delete->LoadRowValues($rs);

	// Render row
	$locaciones_delete->RenderRow();
?>
	<tr<?php echo $locaciones->RowAttributes() ?>>
		<td<?php echo $locaciones->id_locacion->CellAttributes() ?>>
<div<?php echo $locaciones->id_locacion->ViewAttributes() ?>><?php echo $locaciones->id_locacion->ListViewValue() ?></div></td>
		<td<?php echo $locaciones->id_empresa->CellAttributes() ?>>
<div<?php echo $locaciones->id_empresa->ViewAttributes() ?>><?php echo $locaciones->id_empresa->ListViewValue() ?></div></td>
		<td<?php echo $locaciones->nombre->CellAttributes() ?>>
<div<?php echo $locaciones->nombre->ViewAttributes() ?>><?php echo $locaciones->nombre->ListViewValue() ?></div></td>
		<td<?php echo $locaciones->notas->CellAttributes() ?>>
<div<?php echo $locaciones->notas->ViewAttributes() ?>><?php echo $locaciones->notas->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="Confirmar Eliminar">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class clocaciones_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'locaciones';

	// Page Object Name
	var $PageObjName = 'locaciones_delete';

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
	function clocaciones_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["locaciones"] = new clocaciones();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $locaciones;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_locacion"] <> "") {
			$locaciones->id_locacion->setQueryStringValue($_GET["id_locacion"]);
			if (!is_numeric($locaciones->id_locacion->QueryStringValue))
				$this->Page_Terminate("locacioneslist.php"); // Prevent SQL injection, exit
			$sKey .= $locaciones->id_locacion->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("locacioneslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("locacioneslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_locacion`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in locaciones class, locacionesinfo.php

		$locaciones->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$locaciones->CurrentAction = $_POST["a_delete"];
		} else {
			$locaciones->CurrentAction = "I"; // Display record
		}
		switch ($locaciones->CurrentAction) {
			case "D": // Delete
				$locaciones->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($locaciones->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $locaciones;
		$DeleteRows = TRUE;
		$sWrkFilter = $locaciones->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in locaciones class, locacionesinfo.php

		$locaciones->CurrentFilter = $sWrkFilter;
		$sSql = $locaciones->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("No se encontraron registros"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $locaciones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_locacion'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($locaciones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($locaciones->CancelMessage <> "") {
				$this->setMessage($locaciones->CancelMessage);
				$locaciones->CancelMessage = "";
			} else {
				$this->setMessage("Eliminar cancelado");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$locaciones->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
