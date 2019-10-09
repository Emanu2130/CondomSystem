<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "empresasinfo.php" ?>
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
$empresas_delete = new cempresas_delete();
$Page =& $empresas_delete;

// Page init processing
$empresas_delete->Page_Init();

// Page main processing
$empresas_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var empresas_delete = new ew_Page("empresas_delete");

// page properties
empresas_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = empresas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
empresas_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empresas_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empresas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empresas_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $empresas_delete->LoadRecordset();
$empresas_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($empresas_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$empresas_delete->Page_Terminate("empresaslist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Empresas<br><br>
<a href="<?php echo $empresas->getReturnUrl() ?>">Volver</a></span></p>
<?php $empresas_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="empresas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($empresas_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $empresas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Empresa</td>
		<td valign="top">Nombre</td>
		<td valign="top">Rnc</td>
		<td valign="top">Direccion</td>
		<td valign="top">Email</td>
		<td valign="top">Telefono</td>
	</tr>
	</thead>
	<tbody>
<?php
$empresas_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$empresas_delete->lRecCnt++;

	// Set row properties
	$empresas->CssClass = "";
	$empresas->CssStyle = "";
	$empresas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$empresas_delete->LoadRowValues($rs);

	// Render row
	$empresas_delete->RenderRow();
?>
	<tr<?php echo $empresas->RowAttributes() ?>>
		<td<?php echo $empresas->id_empresa->CellAttributes() ?>>
<div<?php echo $empresas->id_empresa->ViewAttributes() ?>><?php echo $empresas->id_empresa->ListViewValue() ?></div></td>
		<td<?php echo $empresas->nombre->CellAttributes() ?>>
<div<?php echo $empresas->nombre->ViewAttributes() ?>><?php echo $empresas->nombre->ListViewValue() ?></div></td>
		<td<?php echo $empresas->rnc->CellAttributes() ?>>
<div<?php echo $empresas->rnc->ViewAttributes() ?>><?php echo $empresas->rnc->ListViewValue() ?></div></td>
		<td<?php echo $empresas->direccion->CellAttributes() ?>>
<div<?php echo $empresas->direccion->ViewAttributes() ?>><?php echo $empresas->direccion->ListViewValue() ?></div></td>
		<td<?php echo $empresas->email->CellAttributes() ?>>
<div<?php echo $empresas->email->ViewAttributes() ?>><?php echo $empresas->email->ListViewValue() ?></div></td>
		<td<?php echo $empresas->Telefono->CellAttributes() ?>>
<div<?php echo $empresas->Telefono->ViewAttributes() ?>><?php echo $empresas->Telefono->ListViewValue() ?></div></td>
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
class cempresas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'empresas';

	// Page Object Name
	var $PageObjName = 'empresas_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $empresas;
		if ($empresas->UseTokenInUrl) $PageUrl .= "t=" . $empresas->TableVar . "&"; // add page token
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
		global $objForm, $empresas;
		if ($empresas->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($empresas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($empresas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cempresas_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["empresas"] = new cempresas();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empresas', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $empresas;
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
		global $empresas;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_empresa"] <> "") {
			$empresas->id_empresa->setQueryStringValue($_GET["id_empresa"]);
			if (!is_numeric($empresas->id_empresa->QueryStringValue))
				$this->Page_Terminate("empresaslist.php"); // Prevent SQL injection, exit
			$sKey .= $empresas->id_empresa->QueryStringValue;
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
			$this->Page_Terminate("empresaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("empresaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_empresa`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in empresas class, empresasinfo.php

		$empresas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$empresas->CurrentAction = $_POST["a_delete"];
		} else {
			$empresas->CurrentAction = "I"; // Display record
		}
		switch ($empresas->CurrentAction) {
			case "D": // Delete
				$empresas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($empresas->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $empresas;
		$DeleteRows = TRUE;
		$sWrkFilter = $empresas->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in empresas class, empresasinfo.php

		$empresas->CurrentFilter = $sWrkFilter;
		$sSql = $empresas->SQL();
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
				$DeleteRows = $empresas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_empresa'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($empresas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($empresas->CancelMessage <> "") {
				$this->setMessage($empresas->CancelMessage);
				$empresas->CancelMessage = "";
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
				$empresas->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $empresas;

		// Call Recordset Selecting event
		$empresas->Recordset_Selecting($empresas->CurrentFilter);

		// Load list page SQL
		$sSql = $empresas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$empresas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $empresas;
		$sFilter = $empresas->KeyFilter();

		// Call Row Selecting event
		$empresas->Row_Selecting($sFilter);

		// Load sql based on filter
		$empresas->CurrentFilter = $sFilter;
		$sSql = $empresas->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$empresas->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $empresas;
		$empresas->id_empresa->setDbValue($rs->fields('id_empresa'));
		$empresas->nombre->setDbValue($rs->fields('nombre'));
		$empresas->rnc->setDbValue($rs->fields('rnc'));
		$empresas->direccion->setDbValue($rs->fields('direccion'));
		$empresas->email->setDbValue($rs->fields('email'));
		$empresas->Telefono->setDbValue($rs->fields('Telefono'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $empresas;

		// Call Row_Rendering event
		$empresas->Row_Rendering();

		// Common render codes for all row types
		// id_empresa

		$empresas->id_empresa->CellCssStyle = "";
		$empresas->id_empresa->CellCssClass = "";

		// nombre
		$empresas->nombre->CellCssStyle = "";
		$empresas->nombre->CellCssClass = "";

		// rnc
		$empresas->rnc->CellCssStyle = "";
		$empresas->rnc->CellCssClass = "";

		// direccion
		$empresas->direccion->CellCssStyle = "";
		$empresas->direccion->CellCssClass = "";

		// email
		$empresas->email->CellCssStyle = "";
		$empresas->email->CellCssClass = "";

		// Telefono
		$empresas->Telefono->CellCssStyle = "";
		$empresas->Telefono->CellCssClass = "";
		if ($empresas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_empresa
			$empresas->id_empresa->ViewValue = $empresas->id_empresa->CurrentValue;
			$empresas->id_empresa->CssStyle = "";
			$empresas->id_empresa->CssClass = "";
			$empresas->id_empresa->ViewCustomAttributes = "";

			// nombre
			$empresas->nombre->ViewValue = $empresas->nombre->CurrentValue;
			$empresas->nombre->CssStyle = "";
			$empresas->nombre->CssClass = "";
			$empresas->nombre->ViewCustomAttributes = "";

			// rnc
			$empresas->rnc->ViewValue = $empresas->rnc->CurrentValue;
			$empresas->rnc->CssStyle = "";
			$empresas->rnc->CssClass = "";
			$empresas->rnc->ViewCustomAttributes = "";

			// direccion
			$empresas->direccion->ViewValue = $empresas->direccion->CurrentValue;
			$empresas->direccion->CssStyle = "";
			$empresas->direccion->CssClass = "";
			$empresas->direccion->ViewCustomAttributes = "";

			// email
			$empresas->email->ViewValue = $empresas->email->CurrentValue;
			$empresas->email->CssStyle = "";
			$empresas->email->CssClass = "";
			$empresas->email->ViewCustomAttributes = "";

			// Telefono
			$empresas->Telefono->ViewValue = $empresas->Telefono->CurrentValue;
			$empresas->Telefono->CssStyle = "";
			$empresas->Telefono->CssClass = "";
			$empresas->Telefono->ViewCustomAttributes = "";

			// id_empresa
			$empresas->id_empresa->HrefValue = "";

			// nombre
			$empresas->nombre->HrefValue = "";

			// rnc
			$empresas->rnc->HrefValue = "";

			// direccion
			$empresas->direccion->HrefValue = "";

			// email
			$empresas->email->HrefValue = "";

			// Telefono
			$empresas->Telefono->HrefValue = "";
		}

		// Call Row Rendered event
		$empresas->Row_Rendered();
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
