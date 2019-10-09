<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "empleadosinfo.php" ?>
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
$empleados_delete = new cempleados_delete();
$Page =& $empleados_delete;

// Page init processing
$empleados_delete->Page_Init();

// Page main processing
$empleados_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var empleados_delete = new ew_Page("empleados_delete");

// page properties
empleados_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = empleados_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
empleados_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empleados_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empleados_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empleados_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $empleados_delete->LoadRecordset();
$empleados_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($empleados_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$empleados_delete->Page_Terminate("empleadoslist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Empleados<br><br>
<a href="<?php echo $empleados->getReturnUrl() ?>">Volver</a></span></p>
<?php $empleados_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="empleados">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($empleados_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $empleados->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Empleado</td>
		<td valign="top">Empresa</td>
		<td valign="top">Nombre Completo</td>
		<td valign="top">Cedula</td>
		<td valign="top">Fecha Ingreso</td>
		<td valign="top">Ult.Vacaciones</td>
		<td valign="top">Prox.Vacaciones</td>
		<td valign="top">Posicion</td>
		<td valign="top">Salario Mensual</td>
		<td valign="top">Salario Quincenal</td>
		<td valign="top">Deducible Afp</td>
		<td valign="top">Deducible Sf</td>
	</tr>
	</thead>
	<tbody>
<?php
$empleados_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$empleados_delete->lRecCnt++;

	// Set row properties
	$empleados->CssClass = "";
	$empleados->CssStyle = "";
	$empleados->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$empleados_delete->LoadRowValues($rs);

	// Render row
	$empleados_delete->RenderRow();
?>
	<tr<?php echo $empleados->RowAttributes() ?>>
		<td<?php echo $empleados->id_empleado->CellAttributes() ?>>
<div<?php echo $empleados->id_empleado->ViewAttributes() ?>><?php echo $empleados->id_empleado->ListViewValue() ?></div></td>
		<td<?php echo $empleados->id_empresa->CellAttributes() ?>>
<div<?php echo $empleados->id_empresa->ViewAttributes() ?>><?php echo $empleados->id_empresa->ListViewValue() ?></div></td>
		<td<?php echo $empleados->nombre_completo->CellAttributes() ?>>
<div<?php echo $empleados->nombre_completo->ViewAttributes() ?>><?php echo $empleados->nombre_completo->ListViewValue() ?></div></td>
		<td<?php echo $empleados->cedula->CellAttributes() ?>>
<div<?php echo $empleados->cedula->ViewAttributes() ?>><?php echo $empleados->cedula->ListViewValue() ?></div></td>
		<td<?php echo $empleados->fecha_ingreso->CellAttributes() ?>>
<div<?php echo $empleados->fecha_ingreso->ViewAttributes() ?>><?php echo $empleados->fecha_ingreso->ListViewValue() ?></div></td>
		<td<?php echo $empleados->ultimas_vacaciones->CellAttributes() ?>>
<div<?php echo $empleados->ultimas_vacaciones->ViewAttributes() ?>><?php echo $empleados->ultimas_vacaciones->ListViewValue() ?></div></td>
		<td<?php echo $empleados->proximas_vacaciones->CellAttributes() ?>>
<div<?php echo $empleados->proximas_vacaciones->ViewAttributes() ?>><?php echo $empleados->proximas_vacaciones->ListViewValue() ?></div></td>
		<td<?php echo $empleados->Posicion->CellAttributes() ?>>
<div<?php echo $empleados->Posicion->ViewAttributes() ?>><?php echo $empleados->Posicion->ListViewValue() ?></div></td>
		<td<?php echo $empleados->salario_mensual->CellAttributes() ?>>
<div<?php echo $empleados->salario_mensual->ViewAttributes() ?>><?php echo $empleados->salario_mensual->ListViewValue() ?></div></td>
		<td<?php echo $empleados->salario_quincenal->CellAttributes() ?>>
<div<?php echo $empleados->salario_quincenal->ViewAttributes() ?>><?php echo $empleados->salario_quincenal->ListViewValue() ?></div></td>
		<td<?php echo $empleados->deducible_afp->CellAttributes() ?>>
<div<?php echo $empleados->deducible_afp->ViewAttributes() ?>><?php echo $empleados->deducible_afp->ListViewValue() ?></div></td>
		<td<?php echo $empleados->deducible_sf->CellAttributes() ?>>
<div<?php echo $empleados->deducible_sf->ViewAttributes() ?>><?php echo $empleados->deducible_sf->ListViewValue() ?></div></td>
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
class cempleados_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'empleados';

	// Page Object Name
	var $PageObjName = 'empleados_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $empleados;
		if ($empleados->UseTokenInUrl) $PageUrl .= "t=" . $empleados->TableVar . "&"; // add page token
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
		global $objForm, $empleados;
		if ($empleados->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($empleados->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($empleados->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cempleados_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["empleados"] = new cempleados();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empleados', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $empleados;
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
		global $empleados;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_empleado"] <> "") {
			$empleados->id_empleado->setQueryStringValue($_GET["id_empleado"]);
			if (!is_numeric($empleados->id_empleado->QueryStringValue))
				$this->Page_Terminate("empleadoslist.php"); // Prevent SQL injection, exit
			$sKey .= $empleados->id_empleado->QueryStringValue;
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
			$this->Page_Terminate("empleadoslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("empleadoslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_empleado`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in empleados class, empleadosinfo.php

		$empleados->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$empleados->CurrentAction = $_POST["a_delete"];
		} else {
			$empleados->CurrentAction = "I"; // Display record
		}
		switch ($empleados->CurrentAction) {
			case "D": // Delete
				$empleados->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($empleados->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $empleados;
		$DeleteRows = TRUE;
		$sWrkFilter = $empleados->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in empleados class, empleadosinfo.php

		$empleados->CurrentFilter = $sWrkFilter;
		$sSql = $empleados->SQL();
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
				$DeleteRows = $empleados->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_empleado'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($empleados->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($empleados->CancelMessage <> "") {
				$this->setMessage($empleados->CancelMessage);
				$empleados->CancelMessage = "";
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
				$empleados->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $empleados;

		// Call Recordset Selecting event
		$empleados->Recordset_Selecting($empleados->CurrentFilter);

		// Load list page SQL
		$sSql = $empleados->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$empleados->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $empleados;
		$sFilter = $empleados->KeyFilter();

		// Call Row Selecting event
		$empleados->Row_Selecting($sFilter);

		// Load sql based on filter
		$empleados->CurrentFilter = $sFilter;
		$sSql = $empleados->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$empleados->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $empleados;
		$empleados->id_empleado->setDbValue($rs->fields('id_empleado'));
		$empleados->id_empresa->setDbValue($rs->fields('id_empresa'));
		$empleados->nombre_completo->setDbValue($rs->fields('nombre_completo'));
		$empleados->cedula->setDbValue($rs->fields('cedula'));
		$empleados->fecha_ingreso->setDbValue($rs->fields('fecha_ingreso'));
		$empleados->ultimas_vacaciones->setDbValue($rs->fields('ultimas_vacaciones'));
		$empleados->proximas_vacaciones->setDbValue($rs->fields('proximas_vacaciones'));
		$empleados->Posicion->setDbValue($rs->fields('Posicion'));
		$empleados->salario_mensual->setDbValue($rs->fields('salario_mensual'));
		$empleados->salario_quincenal->setDbValue($rs->fields('salario_quincenal'));
		$empleados->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$empleados->deducible_sf->setDbValue($rs->fields('deducible_sf'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $empleados;

		// Call Row_Rendering event
		$empleados->Row_Rendering();

		// Common render codes for all row types
		// id_empleado

		$empleados->id_empleado->CellCssStyle = "";
		$empleados->id_empleado->CellCssClass = "";

		// id_empresa
		$empleados->id_empresa->CellCssStyle = "";
		$empleados->id_empresa->CellCssClass = "";

		// nombre_completo
		$empleados->nombre_completo->CellCssStyle = "";
		$empleados->nombre_completo->CellCssClass = "";

		// cedula
		$empleados->cedula->CellCssStyle = "";
		$empleados->cedula->CellCssClass = "";

		// fecha_ingreso
		$empleados->fecha_ingreso->CellCssStyle = "";
		$empleados->fecha_ingreso->CellCssClass = "";

		// ultimas_vacaciones
		$empleados->ultimas_vacaciones->CellCssStyle = "";
		$empleados->ultimas_vacaciones->CellCssClass = "";

		// proximas_vacaciones
		$empleados->proximas_vacaciones->CellCssStyle = "";
		$empleados->proximas_vacaciones->CellCssClass = "";

		// Posicion
		$empleados->Posicion->CellCssStyle = "";
		$empleados->Posicion->CellCssClass = "";

		// salario_mensual
		$empleados->salario_mensual->CellCssStyle = "";
		$empleados->salario_mensual->CellCssClass = "";

		// salario_quincenal
		$empleados->salario_quincenal->CellCssStyle = "";
		$empleados->salario_quincenal->CellCssClass = "";

		// deducible_afp
		$empleados->deducible_afp->CellCssStyle = "";
		$empleados->deducible_afp->CellCssClass = "";

		// deducible_sf
		$empleados->deducible_sf->CellCssStyle = "";
		$empleados->deducible_sf->CellCssClass = "";
		if ($empleados->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_empleado
			$empleados->id_empleado->ViewValue = $empleados->id_empleado->CurrentValue;
			$empleados->id_empleado->CssStyle = "";
			$empleados->id_empleado->CssClass = "";
			$empleados->id_empleado->ViewCustomAttributes = "";

			// id_empresa
			if (strval($empleados->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($empleados->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$empleados->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$empleados->id_empresa->ViewValue = $empleados->id_empresa->CurrentValue;
				}
			} else {
				$empleados->id_empresa->ViewValue = NULL;
			}
			$empleados->id_empresa->CssStyle = "";
			$empleados->id_empresa->CssClass = "";
			$empleados->id_empresa->ViewCustomAttributes = "";

			// nombre_completo
			$empleados->nombre_completo->ViewValue = $empleados->nombre_completo->CurrentValue;
			$empleados->nombre_completo->CssStyle = "";
			$empleados->nombre_completo->CssClass = "";
			$empleados->nombre_completo->ViewCustomAttributes = "";

			// cedula
			$empleados->cedula->ViewValue = $empleados->cedula->CurrentValue;
			$empleados->cedula->CssStyle = "";
			$empleados->cedula->CssClass = "";
			$empleados->cedula->ViewCustomAttributes = "";

			// fecha_ingreso
			$empleados->fecha_ingreso->ViewValue = $empleados->fecha_ingreso->CurrentValue;
			$empleados->fecha_ingreso->ViewValue = ew_FormatDateTime($empleados->fecha_ingreso->ViewValue, 7);
			$empleados->fecha_ingreso->CssStyle = "";
			$empleados->fecha_ingreso->CssClass = "";
			$empleados->fecha_ingreso->ViewCustomAttributes = "";

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->ViewValue = $empleados->ultimas_vacaciones->CurrentValue;
			$empleados->ultimas_vacaciones->CssStyle = "";
			$empleados->ultimas_vacaciones->CssClass = "";
			$empleados->ultimas_vacaciones->ViewCustomAttributes = "";

			// proximas_vacaciones
			$empleados->proximas_vacaciones->ViewValue = $empleados->proximas_vacaciones->CurrentValue;
			$empleados->proximas_vacaciones->CssStyle = "";
			$empleados->proximas_vacaciones->CssClass = "";
			$empleados->proximas_vacaciones->ViewCustomAttributes = "";

			// Posicion
			$empleados->Posicion->ViewValue = $empleados->Posicion->CurrentValue;
			$empleados->Posicion->CssStyle = "";
			$empleados->Posicion->CssClass = "";
			$empleados->Posicion->ViewCustomAttributes = "";

			// salario_mensual
			$empleados->salario_mensual->ViewValue = $empleados->salario_mensual->CurrentValue;
			$empleados->salario_mensual->CssStyle = "";
			$empleados->salario_mensual->CssClass = "";
			$empleados->salario_mensual->ViewCustomAttributes = "";

			// salario_quincenal
			$empleados->salario_quincenal->ViewValue = $empleados->salario_quincenal->CurrentValue;
			$empleados->salario_quincenal->CssStyle = "";
			$empleados->salario_quincenal->CssClass = "";
			$empleados->salario_quincenal->ViewCustomAttributes = "";

			// deducible_afp
			$empleados->deducible_afp->ViewValue = $empleados->deducible_afp->CurrentValue;
			$empleados->deducible_afp->CssStyle = "";
			$empleados->deducible_afp->CssClass = "";
			$empleados->deducible_afp->ViewCustomAttributes = "";

			// deducible_sf
			$empleados->deducible_sf->ViewValue = $empleados->deducible_sf->CurrentValue;
			$empleados->deducible_sf->CssStyle = "";
			$empleados->deducible_sf->CssClass = "";
			$empleados->deducible_sf->ViewCustomAttributes = "";

			// id_empleado
			$empleados->id_empleado->HrefValue = "";

			// id_empresa
			$empleados->id_empresa->HrefValue = "";

			// nombre_completo
			$empleados->nombre_completo->HrefValue = "";

			// cedula
			$empleados->cedula->HrefValue = "";

			// fecha_ingreso
			$empleados->fecha_ingreso->HrefValue = "";

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->HrefValue = "";

			// proximas_vacaciones
			$empleados->proximas_vacaciones->HrefValue = "";

			// Posicion
			$empleados->Posicion->HrefValue = "";

			// salario_mensual
			$empleados->salario_mensual->HrefValue = "";

			// salario_quincenal
			$empleados->salario_quincenal->HrefValue = "";

			// deducible_afp
			$empleados->deducible_afp->HrefValue = "";

			// deducible_sf
			$empleados->deducible_sf->HrefValue = "";
		}

		// Call Row Rendered event
		$empleados->Row_Rendered();
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
