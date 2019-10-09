<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cuentas_bancariasinfo.php" ?>
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
$cuentas_bancarias_delete = new ccuentas_bancarias_delete();
$Page =& $cuentas_bancarias_delete;

// Page init processing
$cuentas_bancarias_delete->Page_Init();

// Page main processing
$cuentas_bancarias_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cuentas_bancarias_delete = new ew_Page("cuentas_bancarias_delete");

// page properties
cuentas_bancarias_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = cuentas_bancarias_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cuentas_bancarias_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
cuentas_bancarias_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cuentas_bancarias_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuentas_bancarias_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $cuentas_bancarias_delete->LoadRecordset();
$cuentas_bancarias_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($cuentas_bancarias_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$cuentas_bancarias_delete->Page_Terminate("cuentas_bancariaslist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Cuentas Bancarias<br><br>
<a href="<?php echo $cuentas_bancarias->getReturnUrl() ?>">Volver</a></span></p>
<?php $cuentas_bancarias_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="cuentas_bancarias">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cuentas_bancarias_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $cuentas_bancarias->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Banco</td>
		<td valign="top">Empresa</td>
		<td valign="top">Banco</td>
		<td valign="top">Numero Cuenta</td>
		<td valign="top">Ejecutivo Cuenta</td>
		<td valign="top">Telefono Ejecutivo</td>
		<td valign="top">Tipo Cuenta</td>
		<td valign="top">Moneda</td>
	</tr>
	</thead>
	<tbody>
<?php
$cuentas_bancarias_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$cuentas_bancarias_delete->lRecCnt++;

	// Set row properties
	$cuentas_bancarias->CssClass = "";
	$cuentas_bancarias->CssStyle = "";
	$cuentas_bancarias->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cuentas_bancarias_delete->LoadRowValues($rs);

	// Render row
	$cuentas_bancarias_delete->RenderRow();
?>
	<tr<?php echo $cuentas_bancarias->RowAttributes() ?>>
		<td<?php echo $cuentas_bancarias->id_banco->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->id_banco->ViewAttributes() ?>><?php echo $cuentas_bancarias->id_banco->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->id_empresa->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->id_empresa->ViewAttributes() ?>><?php echo $cuentas_bancarias->id_empresa->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->Banco->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->Banco->ViewAttributes() ?>><?php echo $cuentas_bancarias->Banco->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->numero_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->numero_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->numero_cuenta->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->ejecutivo_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->ejecutivo_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->ejecutivo_cuenta->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->telefono_ejecutivo->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->telefono_ejecutivo->ViewAttributes() ?>><?php echo $cuentas_bancarias->telefono_ejecutivo->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->tipo_cuenta->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->tipo_cuenta->ViewAttributes() ?>><?php echo $cuentas_bancarias->tipo_cuenta->ListViewValue() ?></div></td>
		<td<?php echo $cuentas_bancarias->moneda->CellAttributes() ?>>
<div<?php echo $cuentas_bancarias->moneda->ViewAttributes() ?>><?php echo $cuentas_bancarias->moneda->ListViewValue() ?></div></td>
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
class ccuentas_bancarias_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'cuentas_bancarias';

	// Page Object Name
	var $PageObjName = 'cuentas_bancarias_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cuentas_bancarias;
		if ($cuentas_bancarias->UseTokenInUrl) $PageUrl .= "t=" . $cuentas_bancarias->TableVar . "&"; // add page token
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
		global $objForm, $cuentas_bancarias;
		if ($cuentas_bancarias->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cuentas_bancarias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cuentas_bancarias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccuentas_bancarias_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["cuentas_bancarias"] = new ccuentas_bancarias();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cuentas_bancarias', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cuentas_bancarias;
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
		global $cuentas_bancarias;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_banco"] <> "") {
			$cuentas_bancarias->id_banco->setQueryStringValue($_GET["id_banco"]);
			if (!is_numeric($cuentas_bancarias->id_banco->QueryStringValue))
				$this->Page_Terminate("cuentas_bancariaslist.php"); // Prevent SQL injection, exit
			$sKey .= $cuentas_bancarias->id_banco->QueryStringValue;
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
			$this->Page_Terminate("cuentas_bancariaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("cuentas_bancariaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_banco`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in cuentas_bancarias class, cuentas_bancariasinfo.php

		$cuentas_bancarias->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$cuentas_bancarias->CurrentAction = $_POST["a_delete"];
		} else {
			$cuentas_bancarias->CurrentAction = "I"; // Display record
		}
		switch ($cuentas_bancarias->CurrentAction) {
			case "D": // Delete
				$cuentas_bancarias->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($cuentas_bancarias->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $cuentas_bancarias;
		$DeleteRows = TRUE;
		$sWrkFilter = $cuentas_bancarias->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in cuentas_bancarias class, cuentas_bancariasinfo.php

		$cuentas_bancarias->CurrentFilter = $sWrkFilter;
		$sSql = $cuentas_bancarias->SQL();
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
				$DeleteRows = $cuentas_bancarias->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_banco'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($cuentas_bancarias->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($cuentas_bancarias->CancelMessage <> "") {
				$this->setMessage($cuentas_bancarias->CancelMessage);
				$cuentas_bancarias->CancelMessage = "";
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
				$cuentas_bancarias->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cuentas_bancarias;

		// Call Recordset Selecting event
		$cuentas_bancarias->Recordset_Selecting($cuentas_bancarias->CurrentFilter);

		// Load list page SQL
		$sSql = $cuentas_bancarias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cuentas_bancarias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cuentas_bancarias;
		$sFilter = $cuentas_bancarias->KeyFilter();

		// Call Row Selecting event
		$cuentas_bancarias->Row_Selecting($sFilter);

		// Load sql based on filter
		$cuentas_bancarias->CurrentFilter = $sFilter;
		$sSql = $cuentas_bancarias->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cuentas_bancarias->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cuentas_bancarias;
		$cuentas_bancarias->id_banco->setDbValue($rs->fields('id_banco'));
		$cuentas_bancarias->id_empresa->setDbValue($rs->fields('id_empresa'));
		$cuentas_bancarias->Banco->setDbValue($rs->fields('Banco'));
		$cuentas_bancarias->numero_cuenta->setDbValue($rs->fields('numero_cuenta'));
		$cuentas_bancarias->ejecutivo_cuenta->setDbValue($rs->fields('ejecutivo_cuenta'));
		$cuentas_bancarias->telefono_ejecutivo->setDbValue($rs->fields('telefono_ejecutivo'));
		$cuentas_bancarias->tipo_cuenta->setDbValue($rs->fields('tipo_cuenta'));
		$cuentas_bancarias->moneda->setDbValue($rs->fields('moneda'));
		$cuentas_bancarias->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cuentas_bancarias;

		// Call Row_Rendering event
		$cuentas_bancarias->Row_Rendering();

		// Common render codes for all row types
		// id_banco

		$cuentas_bancarias->id_banco->CellCssStyle = "";
		$cuentas_bancarias->id_banco->CellCssClass = "";

		// id_empresa
		$cuentas_bancarias->id_empresa->CellCssStyle = "";
		$cuentas_bancarias->id_empresa->CellCssClass = "";

		// Banco
		$cuentas_bancarias->Banco->CellCssStyle = "";
		$cuentas_bancarias->Banco->CellCssClass = "";

		// numero_cuenta
		$cuentas_bancarias->numero_cuenta->CellCssStyle = "";
		$cuentas_bancarias->numero_cuenta->CellCssClass = "";

		// ejecutivo_cuenta
		$cuentas_bancarias->ejecutivo_cuenta->CellCssStyle = "";
		$cuentas_bancarias->ejecutivo_cuenta->CellCssClass = "";

		// telefono_ejecutivo
		$cuentas_bancarias->telefono_ejecutivo->CellCssStyle = "";
		$cuentas_bancarias->telefono_ejecutivo->CellCssClass = "";

		// tipo_cuenta
		$cuentas_bancarias->tipo_cuenta->CellCssStyle = "";
		$cuentas_bancarias->tipo_cuenta->CellCssClass = "";

		// moneda
		$cuentas_bancarias->moneda->CellCssStyle = "";
		$cuentas_bancarias->moneda->CellCssClass = "";
		if ($cuentas_bancarias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_banco
			$cuentas_bancarias->id_banco->ViewValue = $cuentas_bancarias->id_banco->CurrentValue;
			$cuentas_bancarias->id_banco->CssStyle = "";
			$cuentas_bancarias->id_banco->CssClass = "";
			$cuentas_bancarias->id_banco->ViewCustomAttributes = "";

			// id_empresa
			if (strval($cuentas_bancarias->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($cuentas_bancarias->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cuentas_bancarias->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$cuentas_bancarias->id_empresa->ViewValue = $cuentas_bancarias->id_empresa->CurrentValue;
				}
			} else {
				$cuentas_bancarias->id_empresa->ViewValue = NULL;
			}
			$cuentas_bancarias->id_empresa->CssStyle = "";
			$cuentas_bancarias->id_empresa->CssClass = "";
			$cuentas_bancarias->id_empresa->ViewCustomAttributes = "";

			// Banco
			$cuentas_bancarias->Banco->ViewValue = $cuentas_bancarias->Banco->CurrentValue;
			$cuentas_bancarias->Banco->CssStyle = "";
			$cuentas_bancarias->Banco->CssClass = "";
			$cuentas_bancarias->Banco->ViewCustomAttributes = "";

			// numero_cuenta
			$cuentas_bancarias->numero_cuenta->ViewValue = $cuentas_bancarias->numero_cuenta->CurrentValue;
			$cuentas_bancarias->numero_cuenta->CssStyle = "";
			$cuentas_bancarias->numero_cuenta->CssClass = "";
			$cuentas_bancarias->numero_cuenta->ViewCustomAttributes = "";

			// ejecutivo_cuenta
			$cuentas_bancarias->ejecutivo_cuenta->ViewValue = $cuentas_bancarias->ejecutivo_cuenta->CurrentValue;
			$cuentas_bancarias->ejecutivo_cuenta->CssStyle = "";
			$cuentas_bancarias->ejecutivo_cuenta->CssClass = "";
			$cuentas_bancarias->ejecutivo_cuenta->ViewCustomAttributes = "";

			// telefono_ejecutivo
			$cuentas_bancarias->telefono_ejecutivo->ViewValue = $cuentas_bancarias->telefono_ejecutivo->CurrentValue;
			$cuentas_bancarias->telefono_ejecutivo->CssStyle = "";
			$cuentas_bancarias->telefono_ejecutivo->CssClass = "";
			$cuentas_bancarias->telefono_ejecutivo->ViewCustomAttributes = "";

			// tipo_cuenta
			if (strval($cuentas_bancarias->tipo_cuenta->CurrentValue) <> "") {
				switch ($cuentas_bancarias->tipo_cuenta->CurrentValue) {
					case "Ahorros":
						$cuentas_bancarias->tipo_cuenta->ViewValue = "Ahorros";
						break;
					case "Corriente":
						$cuentas_bancarias->tipo_cuenta->ViewValue = "Corriente";
						break;
					default:
						$cuentas_bancarias->tipo_cuenta->ViewValue = $cuentas_bancarias->tipo_cuenta->CurrentValue;
				}
			} else {
				$cuentas_bancarias->tipo_cuenta->ViewValue = NULL;
			}
			$cuentas_bancarias->tipo_cuenta->CssStyle = "";
			$cuentas_bancarias->tipo_cuenta->CssClass = "";
			$cuentas_bancarias->tipo_cuenta->ViewCustomAttributes = "";

			// moneda
			$cuentas_bancarias->moneda->ViewValue = $cuentas_bancarias->moneda->CurrentValue;
			$cuentas_bancarias->moneda->CssStyle = "";
			$cuentas_bancarias->moneda->CssClass = "";
			$cuentas_bancarias->moneda->ViewCustomAttributes = "";

			// id_banco
			$cuentas_bancarias->id_banco->HrefValue = "";

			// id_empresa
			$cuentas_bancarias->id_empresa->HrefValue = "";

			// Banco
			$cuentas_bancarias->Banco->HrefValue = "";

			// numero_cuenta
			$cuentas_bancarias->numero_cuenta->HrefValue = "";

			// ejecutivo_cuenta
			$cuentas_bancarias->ejecutivo_cuenta->HrefValue = "";

			// telefono_ejecutivo
			$cuentas_bancarias->telefono_ejecutivo->HrefValue = "";

			// tipo_cuenta
			$cuentas_bancarias->tipo_cuenta->HrefValue = "";

			// moneda
			$cuentas_bancarias->moneda->HrefValue = "";
		}

		// Call Row Rendered event
		$cuentas_bancarias->Row_Rendered();
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
