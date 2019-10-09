<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "nominainfo.php" ?>
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
$nomina_delete = new cnomina_delete();
$Page =& $nomina_delete;

// Page init processing
$nomina_delete->Page_Init();

// Page main processing
$nomina_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var nomina_delete = new ew_Page("nomina_delete");

// page properties
nomina_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = nomina_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nomina_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nomina_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nomina_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nomina_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $nomina_delete->LoadRecordset();
$nomina_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($nomina_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$nomina_delete->Page_Terminate("nominalist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Nomina<br><br>
<a href="<?php echo $nomina->getReturnUrl() ?>">Volver</a></span></p>
<?php $nomina_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="nomina">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($nomina_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $nomina->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Nomina</td>
		<td valign="top">Id Empresa</td>
		<td valign="top">Empleado</td>
		<td valign="top">Pago quincenal</td>
		<td valign="top">Deducible Afp</td>
		<td valign="top">Deducible Sf</td>
		<td valign="top">Fecha</td>
		<td valign="top">Notas</td>
	</tr>
	</thead>
	<tbody>
<?php
$nomina_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$nomina_delete->lRecCnt++;

	// Set row properties
	$nomina->CssClass = "";
	$nomina->CssStyle = "";
	$nomina->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$nomina_delete->LoadRowValues($rs);

	// Render row
	$nomina_delete->RenderRow();
?>
	<tr<?php echo $nomina->RowAttributes() ?>>
		<td<?php echo $nomina->id_nomina->CellAttributes() ?>>
<div<?php echo $nomina->id_nomina->ViewAttributes() ?>><?php echo $nomina->id_nomina->ListViewValue() ?></div></td>
		<td<?php echo $nomina->id_empresa->CellAttributes() ?>>
<div<?php echo $nomina->id_empresa->ViewAttributes() ?>><?php echo $nomina->id_empresa->ListViewValue() ?></div></td>
		<td<?php echo $nomina->empleado->CellAttributes() ?>>
<div<?php echo $nomina->empleado->ViewAttributes() ?>><?php echo $nomina->empleado->ListViewValue() ?></div></td>
		<td<?php echo $nomina->monto_pago->CellAttributes() ?>>
<div<?php echo $nomina->monto_pago->ViewAttributes() ?>><?php echo $nomina->monto_pago->ListViewValue() ?></div></td>
		<td<?php echo $nomina->deducible_afp->CellAttributes() ?>>
<div<?php echo $nomina->deducible_afp->ViewAttributes() ?>><?php echo $nomina->deducible_afp->ListViewValue() ?></div></td>
		<td<?php echo $nomina->deducible_sf->CellAttributes() ?>>
<div<?php echo $nomina->deducible_sf->ViewAttributes() ?>><?php echo $nomina->deducible_sf->ListViewValue() ?></div></td>
		<td<?php echo $nomina->fecha->CellAttributes() ?>>
<div<?php echo $nomina->fecha->ViewAttributes() ?>><?php echo $nomina->fecha->ListViewValue() ?></div></td>
		<td<?php echo $nomina->notas->CellAttributes() ?>>
<div<?php echo $nomina->notas->ViewAttributes() ?>><?php echo $nomina->notas->ListViewValue() ?></div></td>
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
class cnomina_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'nomina';

	// Page Object Name
	var $PageObjName = 'nomina_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $nomina;
		if ($nomina->UseTokenInUrl) $PageUrl .= "t=" . $nomina->TableVar . "&"; // add page token
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
		global $objForm, $nomina;
		if ($nomina->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($nomina->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($nomina->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnomina_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["nomina"] = new cnomina();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nomina', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $nomina;
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
		global $nomina;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_nomina"] <> "") {
			$nomina->id_nomina->setQueryStringValue($_GET["id_nomina"]);
			if (!is_numeric($nomina->id_nomina->QueryStringValue))
				$this->Page_Terminate("nominalist.php"); // Prevent SQL injection, exit
			$sKey .= $nomina->id_nomina->QueryStringValue;
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
			$this->Page_Terminate("nominalist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("nominalist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_nomina`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in nomina class, nominainfo.php

		$nomina->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$nomina->CurrentAction = $_POST["a_delete"];
		} else {
			$nomina->CurrentAction = "I"; // Display record
		}
		switch ($nomina->CurrentAction) {
			case "D": // Delete
				$nomina->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($nomina->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $nomina;
		$DeleteRows = TRUE;
		$sWrkFilter = $nomina->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in nomina class, nominainfo.php

		$nomina->CurrentFilter = $sWrkFilter;
		$sSql = $nomina->SQL();
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
				$DeleteRows = $nomina->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_nomina'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($nomina->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($nomina->CancelMessage <> "") {
				$this->setMessage($nomina->CancelMessage);
				$nomina->CancelMessage = "";
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
				$nomina->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $nomina;

		// Call Recordset Selecting event
		$nomina->Recordset_Selecting($nomina->CurrentFilter);

		// Load list page SQL
		$sSql = $nomina->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$nomina->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $nomina;
		$sFilter = $nomina->KeyFilter();

		// Call Row Selecting event
		$nomina->Row_Selecting($sFilter);

		// Load sql based on filter
		$nomina->CurrentFilter = $sFilter;
		$sSql = $nomina->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$nomina->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $nomina;
		$nomina->id_nomina->setDbValue($rs->fields('id_nomina'));
		$nomina->id_empresa->setDbValue($rs->fields('id_empresa'));
		$nomina->empleado->setDbValue($rs->fields('empleado'));
		$nomina->monto_pago->setDbValue($rs->fields('monto_pago'));
		$nomina->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$nomina->deducible_sf->setDbValue($rs->fields('deducible_sf'));
		$nomina->fecha->setDbValue($rs->fields('fecha'));
		$nomina->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $nomina;

		// Call Row_Rendering event
		$nomina->Row_Rendering();

		// Common render codes for all row types
		// id_nomina

		$nomina->id_nomina->CellCssStyle = "";
		$nomina->id_nomina->CellCssClass = "";

		// id_empresa
		$nomina->id_empresa->CellCssStyle = "";
		$nomina->id_empresa->CellCssClass = "";

		// empleado
		$nomina->empleado->CellCssStyle = "";
		$nomina->empleado->CellCssClass = "";

		// monto_pago
		$nomina->monto_pago->CellCssStyle = "";
		$nomina->monto_pago->CellCssClass = "";

		// deducible_afp
		$nomina->deducible_afp->CellCssStyle = "";
		$nomina->deducible_afp->CellCssClass = "";

		// deducible_sf
		$nomina->deducible_sf->CellCssStyle = "";
		$nomina->deducible_sf->CellCssClass = "";

		// fecha
		$nomina->fecha->CellCssStyle = "";
		$nomina->fecha->CellCssClass = "";

		// notas
		$nomina->notas->CellCssStyle = "";
		$nomina->notas->CellCssClass = "";
		if ($nomina->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_nomina
			$nomina->id_nomina->ViewValue = $nomina->id_nomina->CurrentValue;
			$nomina->id_nomina->CssStyle = "";
			$nomina->id_nomina->CssClass = "";
			$nomina->id_nomina->ViewCustomAttributes = "";

			// id_empresa
			if (strval($nomina->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($nomina->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$nomina->id_empresa->ViewValue = $nomina->id_empresa->CurrentValue;
				}
			} else {
				$nomina->id_empresa->ViewValue = NULL;
			}
			$nomina->id_empresa->CssStyle = "";
			$nomina->id_empresa->CssClass = "";
			$nomina->id_empresa->ViewCustomAttributes = "";

			// empleado
			if (strval($nomina->empleado->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_completo` FROM `empleados` WHERE `id_empleado` = " . ew_AdjustSql($nomina->empleado->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->empleado->ViewValue = $rswrk->fields('nombre_completo');
					$rswrk->Close();
				} else {
					$nomina->empleado->ViewValue = $nomina->empleado->CurrentValue;
				}
			} else {
				$nomina->empleado->ViewValue = NULL;
			}
			$nomina->empleado->CssStyle = "";
			$nomina->empleado->CssClass = "";
			$nomina->empleado->ViewCustomAttributes = "";

			// monto_pago
			if (strval($nomina->monto_pago->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `salario_quincenal` FROM `empleados` WHERE `salario_quincenal` = " . ew_AdjustSql($nomina->monto_pago->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->monto_pago->ViewValue = $rswrk->fields('salario_quincenal');
					$rswrk->Close();
				} else {
					$nomina->monto_pago->ViewValue = $nomina->monto_pago->CurrentValue;
				}
			} else {
				$nomina->monto_pago->ViewValue = NULL;
			}
			$nomina->monto_pago->CssStyle = "";
			$nomina->monto_pago->CssClass = "";
			$nomina->monto_pago->ViewCustomAttributes = "";

			// deducible_afp
			if (strval($nomina->deducible_afp->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `deducible_afp` FROM `empleados` WHERE `deducible_afp` = " . ew_AdjustSql($nomina->deducible_afp->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->deducible_afp->ViewValue = $rswrk->fields('deducible_afp');
					$rswrk->Close();
				} else {
					$nomina->deducible_afp->ViewValue = $nomina->deducible_afp->CurrentValue;
				}
			} else {
				$nomina->deducible_afp->ViewValue = NULL;
			}
			$nomina->deducible_afp->CssStyle = "";
			$nomina->deducible_afp->CssClass = "";
			$nomina->deducible_afp->ViewCustomAttributes = "";

			// deducible_sf
			if (strval($nomina->deducible_sf->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `deducible_sf` FROM `empleados` WHERE `deducible_sf` = " . ew_AdjustSql($nomina->deducible_sf->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->deducible_sf->ViewValue = $rswrk->fields('deducible_sf');
					$rswrk->Close();
				} else {
					$nomina->deducible_sf->ViewValue = $nomina->deducible_sf->CurrentValue;
				}
			} else {
				$nomina->deducible_sf->ViewValue = NULL;
			}
			$nomina->deducible_sf->CssStyle = "";
			$nomina->deducible_sf->CssClass = "";
			$nomina->deducible_sf->ViewCustomAttributes = "";

			// fecha
			$nomina->fecha->ViewValue = $nomina->fecha->CurrentValue;
			$nomina->fecha->ViewValue = ew_FormatDateTime($nomina->fecha->ViewValue, 7);
			$nomina->fecha->CssStyle = "";
			$nomina->fecha->CssClass = "";
			$nomina->fecha->ViewCustomAttributes = "";

			// notas
			$nomina->notas->ViewValue = $nomina->notas->CurrentValue;
			$nomina->notas->CssStyle = "";
			$nomina->notas->CssClass = "";
			$nomina->notas->ViewCustomAttributes = "";

			// id_nomina
			$nomina->id_nomina->HrefValue = "";

			// id_empresa
			$nomina->id_empresa->HrefValue = "";

			// empleado
			$nomina->empleado->HrefValue = "";

			// monto_pago
			$nomina->monto_pago->HrefValue = "";

			// deducible_afp
			$nomina->deducible_afp->HrefValue = "";

			// deducible_sf
			$nomina->deducible_sf->HrefValue = "";

			// fecha
			$nomina->fecha->HrefValue = "";

			// notas
			$nomina->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$nomina->Row_Rendered();
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
