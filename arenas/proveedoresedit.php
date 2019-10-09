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
$proveedores_edit = new cproveedores_edit();
$Page =& $proveedores_edit;

// Page init processing
$proveedores_edit->Page_Init();

// Page main processing
$proveedores_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var proveedores_edit = new ew_Page("proveedores_edit");

// page properties
proveedores_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = proveedores_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
proveedores_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre");
		elm = fobj.elements["x" + infix + "_rnc_cedula"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Rnc /cedula");
		elm = fobj.elements["x" + infix + "_telefonos"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Telefonos");
		elm = fobj.elements["x" + infix + "_notas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Notas");
		elm = fobj.elements["x" + infix + "_Empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Empresa");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
proveedores_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
proveedores_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
proveedores_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
proveedores_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Editar Modulo: Proveedores<br><br>
<a href="<?php echo $proveedores->getReturnUrl() ?>">Volver</a></span></p>
<?php $proveedores_edit->ShowMessage() ?>
<form name="fproveedoresedit" id="fproveedoresedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return proveedores_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="proveedores">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($proveedores->id_proveedor->Visible) { // id_proveedor ?>
	<tr<?php echo $proveedores->id_proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Id Proveedor</td>
		<td<?php echo $proveedores->id_proveedor->CellAttributes() ?>><span id="el_id_proveedor">
<div<?php echo $proveedores->id_proveedor->ViewAttributes() ?>><?php echo $proveedores->id_proveedor->EditValue ?></div><input type="hidden" name="x_id_proveedor" id="x_id_proveedor" value="<?php echo ew_HtmlEncode($proveedores->id_proveedor->CurrentValue) ?>">
</span><?php echo $proveedores->id_proveedor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($proveedores->nombre->Visible) { // nombre ?>
	<tr<?php echo $proveedores->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $proveedores->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $proveedores->nombre->EditValue ?>"<?php echo $proveedores->nombre->EditAttributes() ?>>
</span><?php echo $proveedores->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($proveedores->rnc_cedula->Visible) { // rnc_cedula ?>
	<tr<?php echo $proveedores->rnc_cedula->RowAttributes ?>>
		<td class="ewTableHeader">Rnc /cedula<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $proveedores->rnc_cedula->CellAttributes() ?>><span id="el_rnc_cedula">
<input type="text" name="x_rnc_cedula" id="x_rnc_cedula" size="30" maxlength="255" value="<?php echo $proveedores->rnc_cedula->EditValue ?>"<?php echo $proveedores->rnc_cedula->EditAttributes() ?>>
</span><?php echo $proveedores->rnc_cedula->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($proveedores->telefonos->Visible) { // telefonos ?>
	<tr<?php echo $proveedores->telefonos->RowAttributes ?>>
		<td class="ewTableHeader">Telefonos<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $proveedores->telefonos->CellAttributes() ?>><span id="el_telefonos">
<input type="text" name="x_telefonos" id="x_telefonos" size="30" maxlength="255" value="<?php echo $proveedores->telefonos->EditValue ?>"<?php echo $proveedores->telefonos->EditAttributes() ?>>
</span><?php echo $proveedores->telefonos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($proveedores->notas->Visible) { // notas ?>
	<tr<?php echo $proveedores->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $proveedores->notas->CellAttributes() ?>><span id="el_notas">
<textarea name="x_notas" id="x_notas" cols="35" rows="4"<?php echo $proveedores->notas->EditAttributes() ?>><?php echo $proveedores->notas->EditValue ?></textarea>
</span><?php echo $proveedores->notas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($proveedores->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $proveedores->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $proveedores->Empresa->CellAttributes() ?>><span id="el_Empresa">
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
&nbsp;<a name="aol_x_Empresa" id="aol_x_Empresa" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:proveedores_edit,lnk:'aol_x_Empresa',el:'x_Empresa',hdr:this.innerHTML, url:'empresasaddopt.php',lf:'x_id_empresa',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Empresa</a>
</span><?php echo $proveedores->Empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Editar  ">
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
class cproveedores_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'proveedores';

	// Page Object Name
	var $PageObjName = 'proveedores_edit';

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
	function cproveedores_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["proveedores"] = new cproveedores();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $proveedores;

		// Load key from QueryString
		if (@$_GET["id_proveedor"] <> "")
			$proveedores->id_proveedor->setQueryStringValue($_GET["id_proveedor"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$proveedores->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$proveedores->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else {
			$proveedores->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($proveedores->id_proveedor->CurrentValue == "")
			$this->Page_Terminate("proveedoreslist.php"); // Invalid key, return to list
		switch ($proveedores->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No se encontraron registros"); // No record found
					$this->Page_Terminate("proveedoreslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$proveedores->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Actualizar completado"); // Update success
					$sReturnUrl = $proveedores->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "proveedoresview.php")
						$sReturnUrl = $proveedores->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$proveedores->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $proveedores;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $proveedores;
		$proveedores->id_proveedor->setFormValue($objForm->GetValue("x_id_proveedor"));
		$proveedores->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$proveedores->rnc_cedula->setFormValue($objForm->GetValue("x_rnc_cedula"));
		$proveedores->telefonos->setFormValue($objForm->GetValue("x_telefonos"));
		$proveedores->notas->setFormValue($objForm->GetValue("x_notas"));
		$proveedores->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $proveedores;
		$this->LoadRow();
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
		// id_proveedor

		$proveedores->id_proveedor->CellCssStyle = "";
		$proveedores->id_proveedor->CellCssClass = "";

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

			// id_proveedor
			$proveedores->id_proveedor->HrefValue = "";

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
		} elseif ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_proveedor
			$proveedores->id_proveedor->EditCustomAttributes = "";
			$proveedores->id_proveedor->EditValue = $proveedores->id_proveedor->CurrentValue;
			$proveedores->id_proveedor->CssStyle = "";
			$proveedores->id_proveedor->CssClass = "";
			$proveedores->id_proveedor->ViewCustomAttributes = "";

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

			// Edit refer script
			// id_proveedor

			$proveedores->id_proveedor->HrefValue = "";

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
		}

		// Call Row Rendered event
		$proveedores->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $proveedores;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $proveedores;
		$sFilter = $proveedores->KeyFilter();
			if ($proveedores->nombre->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(nombre = '" . ew_AdjustSql($proveedores->nombre->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$proveedores->CurrentFilter = $sFilterChk;
			$sSqlChk = $proveedores->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "nombre", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->nombre->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
			if ($proveedores->rnc_cedula->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(rnc_cedula = '" . ew_AdjustSql($proveedores->rnc_cedula->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$proveedores->CurrentFilter = $sFilterChk;
			$sSqlChk = $proveedores->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "rnc_cedula", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->rnc_cedula->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$proveedores->CurrentFilter = $sFilter;
		$sSql = $proveedores->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field id_proveedor
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

			// Call Row Updating event
			$bUpdateRow = $proveedores->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($proveedores->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($proveedores->CancelMessage <> "") {
					$this->setMessage($proveedores->CancelMessage);
					$proveedores->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$proveedores->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
