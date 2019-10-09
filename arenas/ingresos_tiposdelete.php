<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "ingresos_tiposinfo.php" ?>
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
$ingresos_tipos_delete = new cingresos_tipos_delete();
$Page =& $ingresos_tipos_delete;

// Page init processing
$ingresos_tipos_delete->Page_Init();

// Page main processing
$ingresos_tipos_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_tipos_delete = new ew_Page("ingresos_tipos_delete");

// page properties
ingresos_tipos_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = ingresos_tipos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
ingresos_tipos_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_tipos_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_tipos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_tipos_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $ingresos_tipos_delete->LoadRecordset();
$ingresos_tipos_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($ingresos_tipos_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$ingresos_tipos_delete->Page_Terminate("ingresos_tiposlist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Ingresos Tipos<br><br>
<a href="<?php echo $ingresos_tipos->getReturnUrl() ?>">Volver</a></span></p>
<?php $ingresos_tipos_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="ingresos_tipos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($ingresos_tipos_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $ingresos_tipos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Ingresos</td>
		<td valign="top">Nombre</td>
	</tr>
	</thead>
	<tbody>
<?php
$ingresos_tipos_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$ingresos_tipos_delete->lRecCnt++;

	// Set row properties
	$ingresos_tipos->CssClass = "";
	$ingresos_tipos->CssStyle = "";
	$ingresos_tipos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$ingresos_tipos_delete->LoadRowValues($rs);

	// Render row
	$ingresos_tipos_delete->RenderRow();
?>
	<tr<?php echo $ingresos_tipos->RowAttributes() ?>>
		<td<?php echo $ingresos_tipos->id_ingresos->CellAttributes() ?>>
<div<?php echo $ingresos_tipos->id_ingresos->ViewAttributes() ?>><?php echo $ingresos_tipos->id_ingresos->ListViewValue() ?></div></td>
		<td<?php echo $ingresos_tipos->nombre->CellAttributes() ?>>
<div<?php echo $ingresos_tipos->nombre->ViewAttributes() ?>><?php echo $ingresos_tipos->nombre->ListViewValue() ?></div></td>
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
class cingresos_tipos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'ingresos_tipos';

	// Page Object Name
	var $PageObjName = 'ingresos_tipos_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ingresos_tipos;
		if ($ingresos_tipos->UseTokenInUrl) $PageUrl .= "t=" . $ingresos_tipos->TableVar . "&"; // add page token
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
		global $objForm, $ingresos_tipos;
		if ($ingresos_tipos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($ingresos_tipos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ingresos_tipos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cingresos_tipos_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["ingresos_tipos"] = new cingresos_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ingresos_tipos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ingresos_tipos;
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
		global $ingresos_tipos;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_ingresos"] <> "") {
			$ingresos_tipos->id_ingresos->setQueryStringValue($_GET["id_ingresos"]);
			if (!is_numeric($ingresos_tipos->id_ingresos->QueryStringValue))
				$this->Page_Terminate("ingresos_tiposlist.php"); // Prevent SQL injection, exit
			$sKey .= $ingresos_tipos->id_ingresos->QueryStringValue;
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
			$this->Page_Terminate("ingresos_tiposlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("ingresos_tiposlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_ingresos`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in ingresos_tipos class, ingresos_tiposinfo.php

		$ingresos_tipos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$ingresos_tipos->CurrentAction = $_POST["a_delete"];
		} else {
			$ingresos_tipos->CurrentAction = "I"; // Display record
		}
		switch ($ingresos_tipos->CurrentAction) {
			case "D": // Delete
				$ingresos_tipos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($ingresos_tipos->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $ingresos_tipos;
		$DeleteRows = TRUE;
		$sWrkFilter = $ingresos_tipos->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in ingresos_tipos class, ingresos_tiposinfo.php

		$ingresos_tipos->CurrentFilter = $sWrkFilter;
		$sSql = $ingresos_tipos->SQL();
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
				$DeleteRows = $ingresos_tipos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_ingresos'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($ingresos_tipos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($ingresos_tipos->CancelMessage <> "") {
				$this->setMessage($ingresos_tipos->CancelMessage);
				$ingresos_tipos->CancelMessage = "";
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
				$ingresos_tipos->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $ingresos_tipos;

		// Call Recordset Selecting event
		$ingresos_tipos->Recordset_Selecting($ingresos_tipos->CurrentFilter);

		// Load list page SQL
		$sSql = $ingresos_tipos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$ingresos_tipos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ingresos_tipos;
		$sFilter = $ingresos_tipos->KeyFilter();

		// Call Row Selecting event
		$ingresos_tipos->Row_Selecting($sFilter);

		// Load sql based on filter
		$ingresos_tipos->CurrentFilter = $sFilter;
		$sSql = $ingresos_tipos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$ingresos_tipos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $ingresos_tipos;
		$ingresos_tipos->id_ingresos->setDbValue($rs->fields('id_ingresos'));
		$ingresos_tipos->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $ingresos_tipos;

		// Call Row_Rendering event
		$ingresos_tipos->Row_Rendering();

		// Common render codes for all row types
		// id_ingresos

		$ingresos_tipos->id_ingresos->CellCssStyle = "";
		$ingresos_tipos->id_ingresos->CellCssClass = "";

		// nombre
		$ingresos_tipos->nombre->CellCssStyle = "";
		$ingresos_tipos->nombre->CellCssClass = "";
		if ($ingresos_tipos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ingresos
			$ingresos_tipos->id_ingresos->ViewValue = $ingresos_tipos->id_ingresos->CurrentValue;
			$ingresos_tipos->id_ingresos->CssStyle = "";
			$ingresos_tipos->id_ingresos->CssClass = "";
			$ingresos_tipos->id_ingresos->ViewCustomAttributes = "";

			// nombre
			$ingresos_tipos->nombre->ViewValue = $ingresos_tipos->nombre->CurrentValue;
			$ingresos_tipos->nombre->CssStyle = "";
			$ingresos_tipos->nombre->CssClass = "";
			$ingresos_tipos->nombre->ViewCustomAttributes = "";

			// id_ingresos
			$ingresos_tipos->id_ingresos->HrefValue = "";

			// nombre
			$ingresos_tipos->nombre->HrefValue = "";
		}

		// Call Row Rendered event
		$ingresos_tipos->Row_Rendered();
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
