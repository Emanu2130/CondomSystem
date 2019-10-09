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
$usuarios_delete = new cusuarios_delete();
$Page =& $usuarios_delete;

// Page init processing
$usuarios_delete->Page_Init();

// Page main processing
$usuarios_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_delete = new ew_Page("usuarios_delete");

// page properties
usuarios_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = usuarios_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
usuarios_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $usuarios_delete->LoadRecordset();
$usuarios_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($usuarios_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$usuarios_delete->Page_Terminate("usuarioslist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Usuarios<br><br>
<a href="<?php echo $usuarios->getReturnUrl() ?>">Volver</a></span></p>
<?php $usuarios_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($usuarios_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $usuarios->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">User Id</td>
		<td valign="top">Usuario</td>
		<td valign="top">Clave</td>
		<td valign="top">Nombre</td>
	</tr>
	</thead>
	<tbody>
<?php
$usuarios_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$usuarios_delete->lRecCnt++;

	// Set row properties
	$usuarios->CssClass = "";
	$usuarios->CssStyle = "";
	$usuarios->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$usuarios_delete->LoadRowValues($rs);

	// Render row
	$usuarios_delete->RenderRow();
?>
	<tr<?php echo $usuarios->RowAttributes() ?>>
		<td<?php echo $usuarios->user_id->CellAttributes() ?>>
<div<?php echo $usuarios->user_id->ViewAttributes() ?>><?php echo $usuarios->user_id->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>>
<div<?php echo $usuarios->usuario->ViewAttributes() ?>><?php echo $usuarios->usuario->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->clave->CellAttributes() ?>>
<div<?php echo $usuarios->clave->ViewAttributes() ?>><?php echo $usuarios->clave->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>>
<div<?php echo $usuarios->Nombre->ViewAttributes() ?>><?php echo $usuarios->Nombre->ListViewValue() ?></div></td>
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
class cusuarios_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'usuarios';

	// Page Object Name
	var $PageObjName = 'usuarios_delete';

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
	function cusuarios_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["usuarios"] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $usuarios;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["user_id"] <> "") {
			$usuarios->user_id->setQueryStringValue($_GET["user_id"]);
			if (!is_numeric($usuarios->user_id->QueryStringValue))
				$this->Page_Terminate("usuarioslist.php"); // Prevent SQL injection, exit
			$sKey .= $usuarios->user_id->QueryStringValue;
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
			$this->Page_Terminate("usuarioslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("usuarioslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`user_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in usuarios class, usuariosinfo.php

		$usuarios->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$usuarios->CurrentAction = $_POST["a_delete"];
		} else {
			$usuarios->CurrentAction = "I"; // Display record
		}
		switch ($usuarios->CurrentAction) {
			case "D": // Delete
				$usuarios->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($usuarios->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $usuarios;
		$DeleteRows = TRUE;
		$sWrkFilter = $usuarios->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in usuarios class, usuariosinfo.php

		$usuarios->CurrentFilter = $sWrkFilter;
		$sSql = $usuarios->SQL();
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
				$DeleteRows = $usuarios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['user_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($usuarios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($usuarios->CancelMessage <> "") {
				$this->setMessage($usuarios->CancelMessage);
				$usuarios->CancelMessage = "";
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
				$usuarios->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
