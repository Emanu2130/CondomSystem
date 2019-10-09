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
$cuentas_bancarias_addopt = new ccuentas_bancarias_addopt();
$Page =& $cuentas_bancarias_addopt;

// Page init processing
$cuentas_bancarias_addopt->Page_Init();

// Page main processing
$cuentas_bancarias_addopt->Page_Main();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $cuentas_bancarias_addopt->ShowMessage() ?>
<form name="fcuentas_bancariasaddopt" id="fcuentas_bancariasaddopt" action="cuentas_bancariasaddopt.php" method="post" onsubmit="return cuentas_bancarias_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="cuentas_bancarias">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td>Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_id_empresa">
<select id="x_id_empresa" name="x_id_empresa"<?php echo $cuentas_bancarias->id_empresa->EditAttributes() ?>>
<?php
if (is_array($cuentas_bancarias->id_empresa->EditValue)) {
	$arwrk = $cuentas_bancarias->id_empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cuentas_bancarias->id_empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td>Banco<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_Banco">
<input type="text" name="x_Banco" id="x_Banco" size="30" maxlength="255" value="<?php echo $cuentas_bancarias->Banco->EditValue ?>"<?php echo $cuentas_bancarias->Banco->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Numero Cuenta<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_numero_cuenta">
<input type="text" name="x_numero_cuenta" id="x_numero_cuenta" size="30" maxlength="255" value="<?php echo $cuentas_bancarias->numero_cuenta->EditValue ?>"<?php echo $cuentas_bancarias->numero_cuenta->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Ejecutivo Cuenta<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_ejecutivo_cuenta">
<input type="text" name="x_ejecutivo_cuenta" id="x_ejecutivo_cuenta" size="30" maxlength="255" value="<?php echo $cuentas_bancarias->ejecutivo_cuenta->EditValue ?>"<?php echo $cuentas_bancarias->ejecutivo_cuenta->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Telefono Ejecutivo<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_telefono_ejecutivo">
<input type="text" name="x_telefono_ejecutivo" id="x_telefono_ejecutivo" size="30" maxlength="255" value="<?php echo $cuentas_bancarias->telefono_ejecutivo->EditValue ?>"<?php echo $cuentas_bancarias->telefono_ejecutivo->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Tipo Cuenta<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_tipo_cuenta">
<select id="x_tipo_cuenta" name="x_tipo_cuenta"<?php echo $cuentas_bancarias->tipo_cuenta->EditAttributes() ?>>
<?php
if (is_array($cuentas_bancarias->tipo_cuenta->EditValue)) {
	$arwrk = $cuentas_bancarias->tipo_cuenta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cuentas_bancarias->tipo_cuenta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td>Moneda<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_moneda">
<input type="text" name="x_moneda" id="x_moneda" size="30" maxlength="255" value="<?php echo $cuentas_bancarias->moneda->EditValue ?>"<?php echo $cuentas_bancarias->moneda->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td>Notas</td>
		<td><span id="el_notas">
<textarea name="x_notas" id="x_notas" cols="35" rows="4"<?php echo $cuentas_bancarias->notas->EditAttributes() ?>><?php echo $cuentas_bancarias->notas->EditValue ?></textarea>
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
class ccuentas_bancarias_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table Name
	var $TableName = 'cuentas_bancarias';

	// Page Object Name
	var $PageObjName = 'cuentas_bancarias_addopt';

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
	function ccuentas_bancarias_addopt() {
		global $conn;

		// Initialize table object
		$GLOBALS["cuentas_bancarias"] = new ccuentas_bancarias();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

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
		global $objForm, $gsFormError, $cuentas_bancarias;

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$cuentas_bancarias->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$cuentas_bancarias->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$cuentas_bancarias->CurrentAction = "I"; // Display Blank Record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($cuentas_bancarias->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$cuentas_bancarias->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("root");
					$XMLDoc->Encoding = "utf-8";
					$XMLDoc->BeginRow("result");
					$XMLDoc->AddField("x_id_banco", strval($cuentas_bancarias->id_banco->DbValue));
					$XMLDoc->AddField("x_id_empresa", strval($cuentas_bancarias->id_empresa->FormValue));
					$XMLDoc->AddField("x_Banco", strval($cuentas_bancarias->Banco->FormValue));
					$XMLDoc->AddField("x_numero_cuenta", strval($cuentas_bancarias->numero_cuenta->FormValue));
					$XMLDoc->AddField("x_ejecutivo_cuenta", strval($cuentas_bancarias->ejecutivo_cuenta->FormValue));
					$XMLDoc->AddField("x_telefono_ejecutivo", strval($cuentas_bancarias->telefono_ejecutivo->FormValue));
					$XMLDoc->AddField("x_tipo_cuenta", strval($cuentas_bancarias->tipo_cuenta->FormValue));
					$XMLDoc->AddField("x_moneda", strval($cuentas_bancarias->moneda->FormValue));
					$XMLDoc->AddField("x_notas", strval($cuentas_bancarias->notas->FormValue));
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
		$cuentas_bancarias->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $cuentas_bancarias;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $cuentas_bancarias;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $cuentas_bancarias;
		$cuentas_bancarias->id_empresa->setFormValue($objForm->GetValue("x_id_empresa"));
		$cuentas_bancarias->Banco->setFormValue($objForm->GetValue("x_Banco"));
		$cuentas_bancarias->numero_cuenta->setFormValue($objForm->GetValue("x_numero_cuenta"));
		$cuentas_bancarias->ejecutivo_cuenta->setFormValue($objForm->GetValue("x_ejecutivo_cuenta"));
		$cuentas_bancarias->telefono_ejecutivo->setFormValue($objForm->GetValue("x_telefono_ejecutivo"));
		$cuentas_bancarias->tipo_cuenta->setFormValue($objForm->GetValue("x_tipo_cuenta"));
		$cuentas_bancarias->moneda->setFormValue($objForm->GetValue("x_moneda"));
		$cuentas_bancarias->notas->setFormValue($objForm->GetValue("x_notas"));
		$cuentas_bancarias->id_banco->setFormValue($objForm->GetValue("x_id_banco"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $cuentas_bancarias;
		$cuentas_bancarias->id_banco->CurrentValue = $cuentas_bancarias->id_banco->FormValue;
		$cuentas_bancarias->id_empresa->CurrentValue = $cuentas_bancarias->id_empresa->FormValue;
		$cuentas_bancarias->Banco->CurrentValue = $cuentas_bancarias->Banco->FormValue;
		$cuentas_bancarias->numero_cuenta->CurrentValue = $cuentas_bancarias->numero_cuenta->FormValue;
		$cuentas_bancarias->ejecutivo_cuenta->CurrentValue = $cuentas_bancarias->ejecutivo_cuenta->FormValue;
		$cuentas_bancarias->telefono_ejecutivo->CurrentValue = $cuentas_bancarias->telefono_ejecutivo->FormValue;
		$cuentas_bancarias->tipo_cuenta->CurrentValue = $cuentas_bancarias->tipo_cuenta->FormValue;
		$cuentas_bancarias->moneda->CurrentValue = $cuentas_bancarias->moneda->FormValue;
		$cuentas_bancarias->notas->CurrentValue = $cuentas_bancarias->notas->FormValue;
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

		// notas
		$cuentas_bancarias->notas->CellCssStyle = "";
		$cuentas_bancarias->notas->CellCssClass = "";
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

			// notas
			$cuentas_bancarias->notas->ViewValue = $cuentas_bancarias->notas->CurrentValue;
			$cuentas_bancarias->notas->CssStyle = "";
			$cuentas_bancarias->notas->CssClass = "";
			$cuentas_bancarias->notas->ViewCustomAttributes = "";

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

			// notas
			$cuentas_bancarias->notas->HrefValue = "";
		} elseif ($cuentas_bancarias->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_empresa
			$cuentas_bancarias->id_empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$cuentas_bancarias->id_empresa->EditValue = $arwrk;

			// Banco
			$cuentas_bancarias->Banco->EditCustomAttributes = "";
			$cuentas_bancarias->Banco->EditValue = ew_HtmlEncode($cuentas_bancarias->Banco->CurrentValue);

			// numero_cuenta
			$cuentas_bancarias->numero_cuenta->EditCustomAttributes = "";
			$cuentas_bancarias->numero_cuenta->EditValue = ew_HtmlEncode($cuentas_bancarias->numero_cuenta->CurrentValue);

			// ejecutivo_cuenta
			$cuentas_bancarias->ejecutivo_cuenta->EditCustomAttributes = "";
			$cuentas_bancarias->ejecutivo_cuenta->EditValue = ew_HtmlEncode($cuentas_bancarias->ejecutivo_cuenta->CurrentValue);

			// telefono_ejecutivo
			$cuentas_bancarias->telefono_ejecutivo->EditCustomAttributes = "";
			$cuentas_bancarias->telefono_ejecutivo->EditValue = ew_HtmlEncode($cuentas_bancarias->telefono_ejecutivo->CurrentValue);

			// tipo_cuenta
			$cuentas_bancarias->tipo_cuenta->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Ahorros", "Ahorros");
			$arwrk[] = array("Corriente", "Corriente");
			array_unshift($arwrk, array("", "Seleccionar"));
			$cuentas_bancarias->tipo_cuenta->EditValue = $arwrk;

			// moneda
			$cuentas_bancarias->moneda->EditCustomAttributes = "";
			$cuentas_bancarias->moneda->EditValue = ew_HtmlEncode($cuentas_bancarias->moneda->CurrentValue);

			// notas
			$cuentas_bancarias->notas->EditCustomAttributes = "";
			$cuentas_bancarias->notas->EditValue = ew_HtmlEncode($cuentas_bancarias->notas->CurrentValue);
		}

		// Call Row Rendered event
		$cuentas_bancarias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $cuentas_bancarias;

		// Initialize
		$gsFormError = "";
		if ($cuentas_bancarias->id_empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
		}
		if ($cuentas_bancarias->Banco->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Banco";
		}
		if ($cuentas_bancarias->numero_cuenta->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Numero Cuenta";
		}
		if ($cuentas_bancarias->tipo_cuenta->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo Cuenta";
		}
		if ($cuentas_bancarias->moneda->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Moneda";
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
		global $conn, $Security, $cuentas_bancarias;
		$rsnew = array();

		// Field id_empresa
		$cuentas_bancarias->id_empresa->SetDbValueDef($cuentas_bancarias->id_empresa->CurrentValue, 0);
		$rsnew['id_empresa'] =& $cuentas_bancarias->id_empresa->DbValue;

		// Field Banco
		$cuentas_bancarias->Banco->SetDbValueDef($cuentas_bancarias->Banco->CurrentValue, "");
		$rsnew['Banco'] =& $cuentas_bancarias->Banco->DbValue;

		// Field numero_cuenta
		$cuentas_bancarias->numero_cuenta->SetDbValueDef($cuentas_bancarias->numero_cuenta->CurrentValue, "");
		$rsnew['numero_cuenta'] =& $cuentas_bancarias->numero_cuenta->DbValue;

		// Field ejecutivo_cuenta
		$cuentas_bancarias->ejecutivo_cuenta->SetDbValueDef($cuentas_bancarias->ejecutivo_cuenta->CurrentValue, "");
		$rsnew['ejecutivo_cuenta'] =& $cuentas_bancarias->ejecutivo_cuenta->DbValue;

		// Field telefono_ejecutivo
		$cuentas_bancarias->telefono_ejecutivo->SetDbValueDef($cuentas_bancarias->telefono_ejecutivo->CurrentValue, "");
		$rsnew['telefono_ejecutivo'] =& $cuentas_bancarias->telefono_ejecutivo->DbValue;

		// Field tipo_cuenta
		$cuentas_bancarias->tipo_cuenta->SetDbValueDef($cuentas_bancarias->tipo_cuenta->CurrentValue, "");
		$rsnew['tipo_cuenta'] =& $cuentas_bancarias->tipo_cuenta->DbValue;

		// Field moneda
		$cuentas_bancarias->moneda->SetDbValueDef($cuentas_bancarias->moneda->CurrentValue, "");
		$rsnew['moneda'] =& $cuentas_bancarias->moneda->DbValue;

		// Field notas
		$cuentas_bancarias->notas->SetDbValueDef($cuentas_bancarias->notas->CurrentValue, NULL);
		$rsnew['notas'] =& $cuentas_bancarias->notas->DbValue;

		// Call Row Inserting event
		$bInsertRow = $cuentas_bancarias->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($cuentas_bancarias->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($cuentas_bancarias->CancelMessage <> "") {
				$this->setMessage($cuentas_bancarias->CancelMessage);
				$cuentas_bancarias->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$cuentas_bancarias->id_banco->setDbValue($conn->Insert_ID());
			$rsnew['id_banco'] =& $cuentas_bancarias->id_banco->DbValue;

			// Call Row Inserted event
			$cuentas_bancarias->Row_Inserted($rsnew);
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
