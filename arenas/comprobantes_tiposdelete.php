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
$comprobantes_tipos_delete = new ccomprobantes_tipos_delete();
$Page =& $comprobantes_tipos_delete;

// Page init processing
$comprobantes_tipos_delete->Page_Init();

// Page main processing
$comprobantes_tipos_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comprobantes_tipos_delete = new ew_Page("comprobantes_tipos_delete");

// page properties
comprobantes_tipos_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = comprobantes_tipos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comprobantes_tipos_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
comprobantes_tipos_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
comprobantes_tipos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comprobantes_tipos_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $comprobantes_tipos_delete->LoadRecordset();
$comprobantes_tipos_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($comprobantes_tipos_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$comprobantes_tipos_delete->Page_Terminate("comprobantes_tiposlist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Comprobantes Tipos<br><br>
<a href="<?php echo $comprobantes_tipos->getReturnUrl() ?>">Volver</a></span></p>
<?php $comprobantes_tipos_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="comprobantes_tipos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($comprobantes_tipos_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $comprobantes_tipos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Comprobante</td>
		<td valign="top">Nombre Tipo</td>
	</tr>
	</thead>
	<tbody>
<?php
$comprobantes_tipos_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$comprobantes_tipos_delete->lRecCnt++;

	// Set row properties
	$comprobantes_tipos->CssClass = "";
	$comprobantes_tipos->CssStyle = "";
	$comprobantes_tipos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$comprobantes_tipos_delete->LoadRowValues($rs);

	// Render row
	$comprobantes_tipos_delete->RenderRow();
?>
	<tr<?php echo $comprobantes_tipos->RowAttributes() ?>>
		<td<?php echo $comprobantes_tipos->id_comprobante->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->id_comprobante->ViewAttributes() ?>><?php echo $comprobantes_tipos->id_comprobante->ListViewValue() ?></div></td>
		<td<?php echo $comprobantes_tipos->nombre_tipo->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->nombre_tipo->ViewAttributes() ?>><?php echo $comprobantes_tipos->nombre_tipo->ListViewValue() ?></div></td>
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
class ccomprobantes_tipos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'comprobantes_tipos';

	// Page Object Name
	var $PageObjName = 'comprobantes_tipos_delete';

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
	function ccomprobantes_tipos_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["comprobantes_tipos"] = new ccomprobantes_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $comprobantes_tipos;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_comprobante"] <> "") {
			$comprobantes_tipos->id_comprobante->setQueryStringValue($_GET["id_comprobante"]);
			if (!is_numeric($comprobantes_tipos->id_comprobante->QueryStringValue))
				$this->Page_Terminate("comprobantes_tiposlist.php"); // Prevent SQL injection, exit
			$sKey .= $comprobantes_tipos->id_comprobante->QueryStringValue;
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
			$this->Page_Terminate("comprobantes_tiposlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("comprobantes_tiposlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_comprobante`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in comprobantes_tipos class, comprobantes_tiposinfo.php

		$comprobantes_tipos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$comprobantes_tipos->CurrentAction = $_POST["a_delete"];
		} else {
			$comprobantes_tipos->CurrentAction = "I"; // Display record
		}
		switch ($comprobantes_tipos->CurrentAction) {
			case "D": // Delete
				$comprobantes_tipos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($comprobantes_tipos->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $comprobantes_tipos;
		$DeleteRows = TRUE;
		$sWrkFilter = $comprobantes_tipos->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in comprobantes_tipos class, comprobantes_tiposinfo.php

		$comprobantes_tipos->CurrentFilter = $sWrkFilter;
		$sSql = $comprobantes_tipos->SQL();
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
				$DeleteRows = $comprobantes_tipos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_comprobante'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($comprobantes_tipos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($comprobantes_tipos->CancelMessage <> "") {
				$this->setMessage($comprobantes_tipos->CancelMessage);
				$comprobantes_tipos->CancelMessage = "";
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
				$comprobantes_tipos->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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

			// id_comprobante
			$comprobantes_tipos->id_comprobante->HrefValue = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->HrefValue = "";
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
