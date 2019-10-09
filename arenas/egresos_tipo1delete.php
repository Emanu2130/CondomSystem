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
$egresos_tipo1_delete = new cegresos_tipo1_delete();
$Page =& $egresos_tipo1_delete;

// Page init processing
$egresos_tipo1_delete->Page_Init();

// Page main processing
$egresos_tipo1_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_tipo1_delete = new ew_Page("egresos_tipo1_delete");

// page properties
egresos_tipo1_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = egresos_tipo1_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
egresos_tipo1_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_tipo1_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_tipo1_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_tipo1_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $egresos_tipo1_delete->LoadRecordset();
$egresos_tipo1_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($egresos_tipo1_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$egresos_tipo1_delete->Page_Terminate("egresos_tipo1list.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Egresos Tipo 1<br><br>
<a href="<?php echo $egresos_tipo1->getReturnUrl() ?>">Volver</a></span></p>
<?php $egresos_tipo1_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="egresos_tipo1">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($egresos_tipo1_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $egresos_tipo1->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Tipo</td>
		<td valign="top">Tipo</td>
	</tr>
	</thead>
	<tbody>
<?php
$egresos_tipo1_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$egresos_tipo1_delete->lRecCnt++;

	// Set row properties
	$egresos_tipo1->CssClass = "";
	$egresos_tipo1->CssStyle = "";
	$egresos_tipo1->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$egresos_tipo1_delete->LoadRowValues($rs);

	// Render row
	$egresos_tipo1_delete->RenderRow();
?>
	<tr<?php echo $egresos_tipo1->RowAttributes() ?>>
		<td<?php echo $egresos_tipo1->id_tipo->CellAttributes() ?>>
<div<?php echo $egresos_tipo1->id_tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->id_tipo->ListViewValue() ?></div></td>
		<td<?php echo $egresos_tipo1->tipo->CellAttributes() ?>>
<div<?php echo $egresos_tipo1->tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->tipo->ListViewValue() ?></div></td>
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
class cegresos_tipo1_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'egresos_tipo1';

	// Page Object Name
	var $PageObjName = 'egresos_tipo1_delete';

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
	function cegresos_tipo1_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos_tipo1"] = new cegresos_tipo1();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $egresos_tipo1;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_tipo"] <> "") {
			$egresos_tipo1->id_tipo->setQueryStringValue($_GET["id_tipo"]);
			if (!is_numeric($egresos_tipo1->id_tipo->QueryStringValue))
				$this->Page_Terminate("egresos_tipo1list.php"); // Prevent SQL injection, exit
			$sKey .= $egresos_tipo1->id_tipo->QueryStringValue;
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
			$this->Page_Terminate("egresos_tipo1list.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("egresos_tipo1list.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_tipo`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in egresos_tipo1 class, egresos_tipo1info.php

		$egresos_tipo1->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$egresos_tipo1->CurrentAction = $_POST["a_delete"];
		} else {
			$egresos_tipo1->CurrentAction = "I"; // Display record
		}
		switch ($egresos_tipo1->CurrentAction) {
			case "D": // Delete
				$egresos_tipo1->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($egresos_tipo1->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $egresos_tipo1;
		$DeleteRows = TRUE;
		$sWrkFilter = $egresos_tipo1->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in egresos_tipo1 class, egresos_tipo1info.php

		$egresos_tipo1->CurrentFilter = $sWrkFilter;
		$sSql = $egresos_tipo1->SQL();
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
				$DeleteRows = $egresos_tipo1->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_tipo'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($egresos_tipo1->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($egresos_tipo1->CancelMessage <> "") {
				$this->setMessage($egresos_tipo1->CancelMessage);
				$egresos_tipo1->CancelMessage = "";
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
				$egresos_tipo1->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
