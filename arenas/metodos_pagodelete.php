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
$metodos_pago_delete = new cmetodos_pago_delete();
$Page =& $metodos_pago_delete;

// Page init processing
$metodos_pago_delete->Page_Init();

// Page main processing
$metodos_pago_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var metodos_pago_delete = new ew_Page("metodos_pago_delete");

// page properties
metodos_pago_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = metodos_pago_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
metodos_pago_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
metodos_pago_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
metodos_pago_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
metodos_pago_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $metodos_pago_delete->LoadRecordset();
$metodos_pago_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($metodos_pago_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$metodos_pago_delete->Page_Terminate("metodos_pagolist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Metodos Pago<br><br>
<a href="<?php echo $metodos_pago->getReturnUrl() ?>">Volver</a></span></p>
<?php $metodos_pago_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="metodos_pago">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($metodos_pago_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $metodos_pago->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Metodo</td>
		<td valign="top">Metodo</td>
	</tr>
	</thead>
	<tbody>
<?php
$metodos_pago_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$metodos_pago_delete->lRecCnt++;

	// Set row properties
	$metodos_pago->CssClass = "";
	$metodos_pago->CssStyle = "";
	$metodos_pago->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$metodos_pago_delete->LoadRowValues($rs);

	// Render row
	$metodos_pago_delete->RenderRow();
?>
	<tr<?php echo $metodos_pago->RowAttributes() ?>>
		<td<?php echo $metodos_pago->id_metodo->CellAttributes() ?>>
<div<?php echo $metodos_pago->id_metodo->ViewAttributes() ?>><?php echo $metodos_pago->id_metodo->ListViewValue() ?></div></td>
		<td<?php echo $metodos_pago->metodo->CellAttributes() ?>>
<div<?php echo $metodos_pago->metodo->ViewAttributes() ?>><?php echo $metodos_pago->metodo->ListViewValue() ?></div></td>
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
class cmetodos_pago_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'metodos_pago';

	// Page Object Name
	var $PageObjName = 'metodos_pago_delete';

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
	function cmetodos_pago_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["metodos_pago"] = new cmetodos_pago();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $metodos_pago;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_metodo"] <> "") {
			$metodos_pago->id_metodo->setQueryStringValue($_GET["id_metodo"]);
			if (!is_numeric($metodos_pago->id_metodo->QueryStringValue))
				$this->Page_Terminate("metodos_pagolist.php"); // Prevent SQL injection, exit
			$sKey .= $metodos_pago->id_metodo->QueryStringValue;
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
			$this->Page_Terminate("metodos_pagolist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("metodos_pagolist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_metodo`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in metodos_pago class, metodos_pagoinfo.php

		$metodos_pago->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$metodos_pago->CurrentAction = $_POST["a_delete"];
		} else {
			$metodos_pago->CurrentAction = "I"; // Display record
		}
		switch ($metodos_pago->CurrentAction) {
			case "D": // Delete
				$metodos_pago->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($metodos_pago->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $metodos_pago;
		$DeleteRows = TRUE;
		$sWrkFilter = $metodos_pago->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in metodos_pago class, metodos_pagoinfo.php

		$metodos_pago->CurrentFilter = $sWrkFilter;
		$sSql = $metodos_pago->SQL();
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
				$DeleteRows = $metodos_pago->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_metodo'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($metodos_pago->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($metodos_pago->CancelMessage <> "") {
				$this->setMessage($metodos_pago->CancelMessage);
				$metodos_pago->CancelMessage = "";
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
				$metodos_pago->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
