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
$locaciones_addopt = new clocaciones_addopt();
$Page =& $locaciones_addopt;

// Page init processing
$locaciones_addopt->Page_Init();

// Page main processing
$locaciones_addopt->Page_Main();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $locaciones_addopt->ShowMessage() ?>
<form name="flocacionesaddopt" id="flocacionesaddopt" action="locacionesaddopt.php" method="post" onsubmit="return locaciones_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="locaciones">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td>Id Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_id_empresa">
<select id="x_id_empresa" name="x_id_empresa"<?php echo $locaciones->id_empresa->EditAttributes() ?>>
<?php
if (is_array($locaciones->id_empresa->EditValue)) {
	$arwrk = $locaciones->id_empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($locaciones->id_empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span></td>
	</tr>
	<tr>
		<td>Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $locaciones->nombre->EditValue ?>"<?php echo $locaciones->nombre->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Notas</td>
		<td><span id="el_notas">
<input type="text" name="x_notas" id="x_notas" size="30" maxlength="255" value="<?php echo $locaciones->notas->EditValue ?>"<?php echo $locaciones->notas->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
<!-- <input type="submit" name="btnAction" id="btnAction" value="  Agregar  "> -->
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php

//
// Page Class
//
class clocaciones_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table Name
	var $TableName = 'locaciones';

	// Page Object Name
	var $PageObjName = 'locaciones_addopt';

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
	function clocaciones_addopt() {
		global $conn;

		// Initialize table object
		$GLOBALS["locaciones"] = new clocaciones();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

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
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			echo "No tiene permisos para ver esta pagina";
			exit();
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

//
// Page main processing
//
	function Page_Main() {
		global $objForm, $gsFormError, $locaciones;

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$locaciones->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$locaciones->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$locaciones->CurrentAction = "I"; // Display Blank Record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($locaciones->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$locaciones->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("root");
					$XMLDoc->Encoding = "utf-8";
					$XMLDoc->BeginRow("result");
					$XMLDoc->AddField("x_id_locacion", strval($locaciones->id_locacion->DbValue));
					$XMLDoc->AddField("x_id_empresa", strval($locaciones->id_empresa->FormValue));
					$XMLDoc->AddField("x_nombre", strval($locaciones->nombre->FormValue));
					$XMLDoc->AddField("x_notas", strval($locaciones->notas->FormValue));
					$XMLDoc->EndRow();
					ob_end_clean();
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$locaciones->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $locaciones;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $locaciones;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $locaciones;
		$locaciones->id_empresa->setFormValue($objForm->GetValue("x_id_empresa"));
		$locaciones->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$locaciones->notas->setFormValue($objForm->GetValue("x_notas"));
		$locaciones->id_locacion->setFormValue($objForm->GetValue("x_id_locacion"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $locaciones;
		$locaciones->id_locacion->CurrentValue = $locaciones->id_locacion->FormValue;
		$locaciones->id_empresa->CurrentValue = $locaciones->id_empresa->FormValue;
		$locaciones->nombre->CurrentValue = $locaciones->nombre->FormValue;
		$locaciones->notas->CurrentValue = $locaciones->notas->FormValue;
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

			// id_empresa
			$locaciones->id_empresa->HrefValue = "";

			// nombre
			$locaciones->nombre->HrefValue = "";

			// notas
			$locaciones->notas->HrefValue = "";
		} elseif ($locaciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_empresa
			$locaciones->id_empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$locaciones->id_empresa->EditValue = $arwrk;

			// nombre
			$locaciones->nombre->EditCustomAttributes = "";
			$locaciones->nombre->EditValue = ew_HtmlEncode($locaciones->nombre->CurrentValue);

			// notas
			$locaciones->notas->EditCustomAttributes = "";
			$locaciones->notas->EditValue = ew_HtmlEncode($locaciones->notas->CurrentValue);
		}

		// Call Row Rendered event
		$locaciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $locaciones;

		// Initialize
		$gsFormError = "";
		if ($locaciones->id_empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Id Empresa";
		}
		if ($locaciones->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Nombre";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $locaciones;
		if ($locaciones->nombre->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nombre = '" . ew_AdjustSql($locaciones->nombre->CurrentValue) . "')";
			$rsChk = $locaciones->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "nombre", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $locaciones->nombre->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field id_empresa
		$locaciones->id_empresa->SetDbValueDef($locaciones->id_empresa->CurrentValue, 0);
		$rsnew['id_empresa'] =& $locaciones->id_empresa->DbValue;

		// Field nombre
		$locaciones->nombre->SetDbValueDef($locaciones->nombre->CurrentValue, "");
		$rsnew['nombre'] =& $locaciones->nombre->DbValue;

		// Field notas
		$locaciones->notas->SetDbValueDef($locaciones->notas->CurrentValue, NULL);
		$rsnew['notas'] =& $locaciones->notas->DbValue;

		// Call Row Inserting event
		$bInsertRow = $locaciones->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($locaciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($locaciones->CancelMessage <> "") {
				$this->setMessage($locaciones->CancelMessage);
				$locaciones->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$locaciones->id_locacion->setDbValue($conn->Insert_ID());
			$rsnew['id_locacion'] =& $locaciones->id_locacion->DbValue;

			// Call Row Inserted event
			$locaciones->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Custom validate event
	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
