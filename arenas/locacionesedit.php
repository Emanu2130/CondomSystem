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
$locaciones_edit = new clocaciones_edit();
$Page =& $locaciones_edit;

// Page init processing
$locaciones_edit->Page_Init();

// Page main processing
$locaciones_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var locaciones_edit = new ew_Page("locaciones_edit");

// page properties
locaciones_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = locaciones_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
locaciones_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_id_empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Id Empresa");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
locaciones_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
locaciones_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
locaciones_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
locaciones_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Editar Modulo: Locaciones<br><br>
<a href="<?php echo $locaciones->getReturnUrl() ?>">Volver</a></span></p>
<?php $locaciones_edit->ShowMessage() ?>
<form name="flocacionesedit" id="flocacionesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return locaciones_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="locaciones">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($locaciones->id_locacion->Visible) { // id_locacion ?>
	<tr<?php echo $locaciones->id_locacion->RowAttributes ?>>
		<td class="ewTableHeader">Id Locacion</td>
		<td<?php echo $locaciones->id_locacion->CellAttributes() ?>><span id="el_id_locacion">
<div<?php echo $locaciones->id_locacion->ViewAttributes() ?>><?php echo $locaciones->id_locacion->EditValue ?></div><input type="hidden" name="x_id_locacion" id="x_id_locacion" value="<?php echo ew_HtmlEncode($locaciones->id_locacion->CurrentValue) ?>">
</span><?php echo $locaciones->id_locacion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($locaciones->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $locaciones->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Id Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $locaciones->id_empresa->CellAttributes() ?>><span id="el_id_empresa">
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
</span><?php echo $locaciones->id_empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($locaciones->nombre->Visible) { // nombre ?>
	<tr<?php echo $locaciones->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $locaciones->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $locaciones->nombre->EditValue ?>"<?php echo $locaciones->nombre->EditAttributes() ?>>
</span><?php echo $locaciones->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($locaciones->notas->Visible) { // notas ?>
	<tr<?php echo $locaciones->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $locaciones->notas->CellAttributes() ?>><span id="el_notas">
<input type="text" name="x_notas" id="x_notas" size="30" maxlength="255" value="<?php echo $locaciones->notas->EditValue ?>"<?php echo $locaciones->notas->EditAttributes() ?>>
</span><?php echo $locaciones->notas->CustomMsg ?></td>
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
class clocaciones_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'locaciones';

	// Page Object Name
	var $PageObjName = 'locaciones_edit';

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
	function clocaciones_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["locaciones"] = new clocaciones();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $gsFormError, $locaciones;

		// Load key from QueryString
		if (@$_GET["id_locacion"] <> "")
			$locaciones->id_locacion->setQueryStringValue($_GET["id_locacion"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$locaciones->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$locaciones->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else {
			$locaciones->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($locaciones->id_locacion->CurrentValue == "")
			$this->Page_Terminate("locacioneslist.php"); // Invalid key, return to list
		switch ($locaciones->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No se encontraron registros"); // No record found
					$this->Page_Terminate("locacioneslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$locaciones->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Actualizar completado"); // Update success
					$sReturnUrl = $locaciones->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "locacionesview.php")
						$sReturnUrl = $locaciones->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$locaciones->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $locaciones;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $locaciones;
		$locaciones->id_locacion->setFormValue($objForm->GetValue("x_id_locacion"));
		$locaciones->id_empresa->setFormValue($objForm->GetValue("x_id_empresa"));
		$locaciones->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$locaciones->notas->setFormValue($objForm->GetValue("x_notas"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $locaciones;
		$this->LoadRow();
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
		// id_locacion

		$locaciones->id_locacion->CellCssStyle = "";
		$locaciones->id_locacion->CellCssClass = "";

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

			// id_locacion
			$locaciones->id_locacion->HrefValue = "";

			// id_empresa
			$locaciones->id_empresa->HrefValue = "";

			// nombre
			$locaciones->nombre->HrefValue = "";

			// notas
			$locaciones->notas->HrefValue = "";
		} elseif ($locaciones->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_locacion
			$locaciones->id_locacion->EditCustomAttributes = "";
			$locaciones->id_locacion->EditValue = $locaciones->id_locacion->CurrentValue;
			$locaciones->id_locacion->CssStyle = "";
			$locaciones->id_locacion->CssClass = "";
			$locaciones->id_locacion->ViewCustomAttributes = "";

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

			// Edit refer script
			// id_locacion

			$locaciones->id_locacion->HrefValue = "";

			// id_empresa
			$locaciones->id_empresa->HrefValue = "";

			// nombre
			$locaciones->nombre->HrefValue = "";

			// notas
			$locaciones->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$locaciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $locaciones;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $locaciones;
		$sFilter = $locaciones->KeyFilter();
			if ($locaciones->nombre->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(nombre = '" . ew_AdjustSql($locaciones->nombre->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$locaciones->CurrentFilter = $sFilterChk;
			$sSqlChk = $locaciones->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "nombre", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $locaciones->nombre->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$locaciones->CurrentFilter = $sFilter;
		$sSql = $locaciones->SQL();
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

			// Field id_locacion
			// Field id_empresa

			$locaciones->id_empresa->SetDbValueDef($locaciones->id_empresa->CurrentValue, 0);
			$rsnew['id_empresa'] =& $locaciones->id_empresa->DbValue;

			// Field nombre
			$locaciones->nombre->SetDbValueDef($locaciones->nombre->CurrentValue, "");
			$rsnew['nombre'] =& $locaciones->nombre->DbValue;

			// Field notas
			$locaciones->notas->SetDbValueDef($locaciones->notas->CurrentValue, NULL);
			$rsnew['notas'] =& $locaciones->notas->DbValue;

			// Call Row Updating event
			$bUpdateRow = $locaciones->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($locaciones->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($locaciones->CancelMessage <> "") {
					$this->setMessage($locaciones->CancelMessage);
					$locaciones->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$locaciones->Row_Updated($rsold, $rsnew);
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
