<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "proveedoresinfo.php" ?>
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
$proveedores_addopt = new cproveedores_addopt();
$Page =& $proveedores_addopt;

// Page init processing
$proveedores_addopt->Page_Init();

// Page main processing
$proveedores_addopt->Page_Main();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $proveedores_addopt->ShowMessage() ?>
<form name="fproveedoresaddopt" id="fproveedoresaddopt" action="proveedoresaddopt.php" method="post" onsubmit="return proveedores_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="proveedores">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td>Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $proveedores->nombre->EditValue ?>"<?php echo $proveedores->nombre->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Rnc /cedula<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_rnc_cedula">
<input type="text" name="x_rnc_cedula" id="x_rnc_cedula" size="30" maxlength="255" value="<?php echo $proveedores->rnc_cedula->EditValue ?>"<?php echo $proveedores->rnc_cedula->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Telefonos<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_telefonos">
<input type="text" name="x_telefonos" id="x_telefonos" size="30" maxlength="255" value="<?php echo $proveedores->telefonos->EditValue ?>"<?php echo $proveedores->telefonos->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Notas<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_notas">
<textarea name="x_notas" id="x_notas" cols="35" rows="4"<?php echo $proveedores->notas->EditAttributes() ?>><?php echo $proveedores->notas->EditValue ?></textarea>
</span></td>
	</tr>
	<tr>
		<td>Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_Empresa">
<select id="x_Empresa" name="x_Empresa"<?php echo $proveedores->Empresa->EditAttributes() ?>>
<?php
if (is_array($proveedores->Empresa->EditValue)) {
	$arwrk = $proveedores->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($proveedores->Empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
class cproveedores_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table Name
	var $TableName = 'proveedores';

	// Page Object Name
	var $PageObjName = 'proveedores_addopt';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $proveedores;
		if ($proveedores->UseTokenInUrl) $PageUrl .= "t=" . $proveedores->TableVar . "&"; // add page token
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
		global $objForm, $proveedores;
		if ($proveedores->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($proveedores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($proveedores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproveedores_addopt() {
		global $conn;

		// Initialize table object
		$GLOBALS["proveedores"] = new cproveedores();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'proveedores', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $proveedores;
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
		global $objForm, $gsFormError, $proveedores;

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$proveedores->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$proveedores->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$proveedores->CurrentAction = "I"; // Display Blank Record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($proveedores->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$proveedores->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("root");
					$XMLDoc->Encoding = "utf-8";
					$XMLDoc->BeginRow("result");
					$XMLDoc->AddField("x_id_proveedor", strval($proveedores->id_proveedor->DbValue));
					$XMLDoc->AddField("x_nombre", strval($proveedores->nombre->FormValue));
					$XMLDoc->AddField("x_rnc_cedula", strval($proveedores->rnc_cedula->FormValue));
					$XMLDoc->AddField("x_telefonos", strval($proveedores->telefonos->FormValue));
					$XMLDoc->AddField("x_notas", strval($proveedores->notas->FormValue));
					$XMLDoc->AddField("x_Empresa", strval($proveedores->Empresa->FormValue));
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
		$proveedores->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $proveedores;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $proveedores;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $proveedores;
		$proveedores->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$proveedores->rnc_cedula->setFormValue($objForm->GetValue("x_rnc_cedula"));
		$proveedores->telefonos->setFormValue($objForm->GetValue("x_telefonos"));
		$proveedores->notas->setFormValue($objForm->GetValue("x_notas"));
		$proveedores->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$proveedores->id_proveedor->setFormValue($objForm->GetValue("x_id_proveedor"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $proveedores;
		$proveedores->id_proveedor->CurrentValue = $proveedores->id_proveedor->FormValue;
		$proveedores->nombre->CurrentValue = $proveedores->nombre->FormValue;
		$proveedores->rnc_cedula->CurrentValue = $proveedores->rnc_cedula->FormValue;
		$proveedores->telefonos->CurrentValue = $proveedores->telefonos->FormValue;
		$proveedores->notas->CurrentValue = $proveedores->notas->FormValue;
		$proveedores->Empresa->CurrentValue = $proveedores->Empresa->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $proveedores;
		$sFilter = $proveedores->KeyFilter();

		// Call Row Selecting event
		$proveedores->Row_Selecting($sFilter);

		// Load sql based on filter
		$proveedores->CurrentFilter = $sFilter;
		$sSql = $proveedores->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$proveedores->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $proveedores;
		$proveedores->id_proveedor->setDbValue($rs->fields('id_proveedor'));
		$proveedores->nombre->setDbValue($rs->fields('nombre'));
		$proveedores->rnc_cedula->setDbValue($rs->fields('rnc_cedula'));
		$proveedores->telefonos->setDbValue($rs->fields('telefonos'));
		$proveedores->notas->setDbValue($rs->fields('notas'));
		$proveedores->Empresa->setDbValue($rs->fields('Empresa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $proveedores;

		// Call Row_Rendering event
		$proveedores->Row_Rendering();

		// Common render codes for all row types
		// nombre

		$proveedores->nombre->CellCssStyle = "";
		$proveedores->nombre->CellCssClass = "";

		// rnc_cedula
		$proveedores->rnc_cedula->CellCssStyle = "";
		$proveedores->rnc_cedula->CellCssClass = "";

		// telefonos
		$proveedores->telefonos->CellCssStyle = "";
		$proveedores->telefonos->CellCssClass = "";

		// notas
		$proveedores->notas->CellCssStyle = "";
		$proveedores->notas->CellCssClass = "";

		// Empresa
		$proveedores->Empresa->CellCssStyle = "";
		$proveedores->Empresa->CellCssClass = "";
		if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_proveedor
			$proveedores->id_proveedor->ViewValue = $proveedores->id_proveedor->CurrentValue;
			$proveedores->id_proveedor->CssStyle = "";
			$proveedores->id_proveedor->CssClass = "";
			$proveedores->id_proveedor->ViewCustomAttributes = "";

			// nombre
			$proveedores->nombre->ViewValue = $proveedores->nombre->CurrentValue;
			$proveedores->nombre->CssStyle = "";
			$proveedores->nombre->CssClass = "";
			$proveedores->nombre->ViewCustomAttributes = "";

			// rnc_cedula
			$proveedores->rnc_cedula->ViewValue = $proveedores->rnc_cedula->CurrentValue;
			$proveedores->rnc_cedula->CssStyle = "";
			$proveedores->rnc_cedula->CssClass = "";
			$proveedores->rnc_cedula->ViewCustomAttributes = "";

			// telefonos
			$proveedores->telefonos->ViewValue = $proveedores->telefonos->CurrentValue;
			$proveedores->telefonos->CssStyle = "";
			$proveedores->telefonos->CssClass = "";
			$proveedores->telefonos->ViewCustomAttributes = "";

			// notas
			$proveedores->notas->ViewValue = $proveedores->notas->CurrentValue;
			$proveedores->notas->CssStyle = "";
			$proveedores->notas->CssClass = "";
			$proveedores->notas->ViewCustomAttributes = "";

			// Empresa
			if (strval($proveedores->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($proveedores->Empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$proveedores->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$proveedores->Empresa->ViewValue = $proveedores->Empresa->CurrentValue;
				}
			} else {
				$proveedores->Empresa->ViewValue = NULL;
			}
			$proveedores->Empresa->CssStyle = "";
			$proveedores->Empresa->CssClass = "";
			$proveedores->Empresa->ViewCustomAttributes = "";

			// nombre
			$proveedores->nombre->HrefValue = "";

			// rnc_cedula
			$proveedores->rnc_cedula->HrefValue = "";

			// telefonos
			$proveedores->telefonos->HrefValue = "";

			// notas
			$proveedores->notas->HrefValue = "";

			// Empresa
			$proveedores->Empresa->HrefValue = "";
		} elseif ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$proveedores->nombre->EditCustomAttributes = "";
			$proveedores->nombre->EditValue = ew_HtmlEncode($proveedores->nombre->CurrentValue);

			// rnc_cedula
			$proveedores->rnc_cedula->EditCustomAttributes = "";
			$proveedores->rnc_cedula->EditValue = ew_HtmlEncode($proveedores->rnc_cedula->CurrentValue);

			// telefonos
			$proveedores->telefonos->EditCustomAttributes = "";
			$proveedores->telefonos->EditValue = ew_HtmlEncode($proveedores->telefonos->CurrentValue);

			// notas
			$proveedores->notas->EditCustomAttributes = "";
			$proveedores->notas->EditValue = ew_HtmlEncode($proveedores->notas->CurrentValue);

			// Empresa
			$proveedores->Empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$proveedores->Empresa->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$proveedores->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $proveedores;

		// Initialize
		$gsFormError = "";
		if ($proveedores->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Nombre";
		}
		if ($proveedores->rnc_cedula->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Rnc /cedula";
		}
		if ($proveedores->telefonos->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Telefonos";
		}
		if ($proveedores->notas->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Notas";
		}
		if ($proveedores->Empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
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
		global $conn, $Security, $proveedores;
		if ($proveedores->nombre->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nombre = '" . ew_AdjustSql($proveedores->nombre->CurrentValue) . "')";
			$rsChk = $proveedores->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "nombre", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->nombre->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($proveedores->rnc_cedula->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(rnc_cedula = '" . ew_AdjustSql($proveedores->rnc_cedula->CurrentValue) . "')";
			$rsChk = $proveedores->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "rnc_cedula", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->rnc_cedula->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field nombre
		$proveedores->nombre->SetDbValueDef($proveedores->nombre->CurrentValue, "");
		$rsnew['nombre'] =& $proveedores->nombre->DbValue;

		// Field rnc_cedula
		$proveedores->rnc_cedula->SetDbValueDef($proveedores->rnc_cedula->CurrentValue, "");
		$rsnew['rnc_cedula'] =& $proveedores->rnc_cedula->DbValue;

		// Field telefonos
		$proveedores->telefonos->SetDbValueDef($proveedores->telefonos->CurrentValue, "");
		$rsnew['telefonos'] =& $proveedores->telefonos->DbValue;

		// Field notas
		$proveedores->notas->SetDbValueDef($proveedores->notas->CurrentValue, NULL);
		$rsnew['notas'] =& $proveedores->notas->DbValue;

		// Field Empresa
		$proveedores->Empresa->SetDbValueDef($proveedores->Empresa->CurrentValue, "");
		$rsnew['Empresa'] =& $proveedores->Empresa->DbValue;

		// Call Row Inserting event
		$bInsertRow = $proveedores->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($proveedores->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($proveedores->CancelMessage <> "") {
				$this->setMessage($proveedores->CancelMessage);
				$proveedores->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$proveedores->id_proveedor->setDbValue($conn->Insert_ID());
			$rsnew['id_proveedor'] =& $proveedores->id_proveedor->DbValue;

			// Call Row Inserted event
			$proveedores->Row_Inserted($rsnew);
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
