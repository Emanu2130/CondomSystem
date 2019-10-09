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
$nomina_edit = new cnomina_edit();
$Page =& $nomina_edit;

// Page init processing
$nomina_edit->Page_Init();

// Page main processing
$nomina_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var nomina_edit = new ew_Page("nomina_edit");

// page properties
nomina_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = nomina_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
nomina_edit.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_empleado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Empleado");
		elm = fobj.elements["x" + infix + "_monto_pago"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Pago quincenal");
		elm = fobj.elements["x" + infix + "_deducible_afp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Deducible Afp");
		elm = fobj.elements["x" + infix + "_deducible_sf"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Deducible Sf");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
nomina_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nomina_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nomina_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nomina_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="arenas">Editar Modulo: Nomina<br><br>
<a href="<?php echo $nomina->getReturnUrl() ?>">Volver</a></span></p>
<?php $nomina_edit->ShowMessage() ?>
<form name="fnominaedit" id="fnominaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return nomina_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="nomina">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($nomina->id_nomina->Visible) { // id_nomina ?>
	<tr<?php echo $nomina->id_nomina->RowAttributes ?>>
		<td class="ewTableHeader">Id Nomina</td>
		<td<?php echo $nomina->id_nomina->CellAttributes() ?>><span id="el_id_nomina">
<div<?php echo $nomina->id_nomina->ViewAttributes() ?>><?php echo $nomina->id_nomina->EditValue ?></div><input type="hidden" name="x_id_nomina" id="x_id_nomina" value="<?php echo ew_HtmlEncode($nomina->id_nomina->CurrentValue) ?>">
</span><?php echo $nomina->id_nomina->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $nomina->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Id Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->id_empresa->CellAttributes() ?>><span id="el_id_empresa">
<select id="x_id_empresa" name="x_id_empresa"<?php echo $nomina->id_empresa->EditAttributes() ?>>
<?php
if (is_array($nomina->id_empresa->EditValue)) {
	$arwrk = $nomina->id_empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($nomina->id_empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $nomina->id_empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->empleado->Visible) { // empleado ?>
	<tr<?php echo $nomina->empleado->RowAttributes ?>>
		<td class="ewTableHeader">Empleado<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->empleado->CellAttributes() ?>><span id="el_empleado">
<select id="x_empleado" name="x_empleado" onchange="ew_UpdateOpt('x_monto_pago','x_empleado',nomina_edit.ar_x_monto_pago);ew_UpdateOpt('x_deducible_afp','x_empleado',nomina_edit.ar_x_deducible_afp);ew_UpdateOpt('x_deducible_sf','x_empleado',nomina_edit.ar_x_deducible_sf);"<?php echo $nomina->empleado->EditAttributes() ?>>
<?php
if (is_array($nomina->empleado->EditValue)) {
	$arwrk = $nomina->empleado->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($nomina->empleado->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $nomina->empleado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->monto_pago->Visible) { // monto_pago ?>
	<tr<?php echo $nomina->monto_pago->RowAttributes ?>>
		<td class="ewTableHeader">Pago quincenal<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->monto_pago->CellAttributes() ?>><span id="el_monto_pago">
<select id="x_monto_pago" name="x_monto_pago"<?php echo $nomina->monto_pago->EditAttributes() ?>>
<?php
if (is_array($nomina->monto_pago->EditValue)) {
	$arwrk = $nomina->monto_pago->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($nomina->monto_pago->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($nomina->monto_pago->EditValue)) {
	$arwrk = $nomina->monto_pago->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
nomina_edit.ar_x_monto_pago = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $nomina->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->deducible_afp->Visible) { // deducible_afp ?>
	<tr<?php echo $nomina->deducible_afp->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Afp<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->deducible_afp->CellAttributes() ?>><span id="el_deducible_afp">
<select id="x_deducible_afp" name="x_deducible_afp"<?php echo $nomina->deducible_afp->EditAttributes() ?>>
<?php
if (is_array($nomina->deducible_afp->EditValue)) {
	$arwrk = $nomina->deducible_afp->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($nomina->deducible_afp->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($nomina->deducible_afp->EditValue)) {
	$arwrk = $nomina->deducible_afp->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
nomina_edit.ar_x_deducible_afp = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $nomina->deducible_afp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->deducible_sf->Visible) { // deducible_sf ?>
	<tr<?php echo $nomina->deducible_sf->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Sf<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->deducible_sf->CellAttributes() ?>><span id="el_deducible_sf">
<select id="x_deducible_sf" name="x_deducible_sf"<?php echo $nomina->deducible_sf->EditAttributes() ?>>
<?php
if (is_array($nomina->deducible_sf->EditValue)) {
	$arwrk = $nomina->deducible_sf->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($nomina->deducible_sf->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($nomina->deducible_sf->EditValue)) {
	$arwrk = $nomina->deducible_sf->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
nomina_edit.ar_x_deducible_sf = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $nomina->deducible_sf->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->fecha->Visible) { // fecha ?>
	<tr<?php echo $nomina->fecha->RowAttributes ?>>
		<td class="ewTableHeader">Fecha<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo $nomina->fecha->EditValue ?>"<?php echo $nomina->fecha->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_fecha", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_fecha" // ID of the button
});
</script>
</span><?php echo $nomina->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nomina->notas->Visible) { // notas ?>
	<tr<?php echo $nomina->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $nomina->notas->CellAttributes() ?>><span id="el_notas">
<input type="text" name="x_notas" id="x_notas" size="30" maxlength="225" value="<?php echo $nomina->notas->EditValue ?>"<?php echo $nomina->notas->EditAttributes() ?>>
</span><?php echo $nomina->notas->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Editar  ">
</form>
<script language="JavaScript">
<!--
ew_UpdateOpts([['x_monto_pago','x_empleado',nomina_edit.ar_x_monto_pago],
['x_deducible_afp','x_empleado',nomina_edit.ar_x_deducible_afp],
['x_deducible_sf','x_empleado',nomina_edit.ar_x_deducible_sf]]);

//-->
</script>
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
class cnomina_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'nomina';

	// Page Object Name
	var $PageObjName = 'nomina_edit';

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
	function cnomina_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["nomina"] = new cnomina();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $nomina;

		// Load key from QueryString
		if (@$_GET["id_nomina"] <> "")
			$nomina->id_nomina->setQueryStringValue($_GET["id_nomina"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$nomina->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$nomina->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else {
			$nomina->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($nomina->id_nomina->CurrentValue == "")
			$this->Page_Terminate("nominalist.php"); // Invalid key, return to list
		switch ($nomina->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No se encontraron registros"); // No record found
					$this->Page_Terminate("nominalist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$nomina->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Actualizar completado"); // Update success
					$sReturnUrl = $nomina->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "nominaview.php")
						$sReturnUrl = $nomina->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$nomina->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $nomina;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $nomina;
		$nomina->id_nomina->setFormValue($objForm->GetValue("x_id_nomina"));
		$nomina->id_empresa->setFormValue($objForm->GetValue("x_id_empresa"));
		$nomina->empleado->setFormValue($objForm->GetValue("x_empleado"));
		$nomina->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		$nomina->deducible_afp->setFormValue($objForm->GetValue("x_deducible_afp"));
		$nomina->deducible_sf->setFormValue($objForm->GetValue("x_deducible_sf"));
		$nomina->fecha->setFormValue($objForm->GetValue("x_fecha"));
		$nomina->fecha->CurrentValue = ew_UnFormatDateTime($nomina->fecha->CurrentValue, 7);
		$nomina->notas->setFormValue($objForm->GetValue("x_notas"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $nomina;
		$this->LoadRow();
		$nomina->id_nomina->CurrentValue = $nomina->id_nomina->FormValue;
		$nomina->id_empresa->CurrentValue = $nomina->id_empresa->FormValue;
		$nomina->empleado->CurrentValue = $nomina->empleado->FormValue;
		$nomina->monto_pago->CurrentValue = $nomina->monto_pago->FormValue;
		$nomina->deducible_afp->CurrentValue = $nomina->deducible_afp->FormValue;
		$nomina->deducible_sf->CurrentValue = $nomina->deducible_sf->FormValue;
		$nomina->fecha->CurrentValue = $nomina->fecha->FormValue;
		$nomina->fecha->CurrentValue = ew_UnFormatDateTime($nomina->fecha->CurrentValue, 7);
		$nomina->notas->CurrentValue = $nomina->notas->FormValue;
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
		} elseif ($nomina->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_nomina
			$nomina->id_nomina->EditCustomAttributes = "";
			$nomina->id_nomina->EditValue = $nomina->id_nomina->CurrentValue;
			$nomina->id_nomina->CssStyle = "";
			$nomina->id_nomina->CssClass = "";
			$nomina->id_nomina->ViewCustomAttributes = "";

			// id_empresa
			$nomina->id_empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$nomina->id_empresa->EditValue = $arwrk;

			// empleado
			$nomina->empleado->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empleado`, `nombre_completo`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empleados`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$nomina->empleado->EditValue = $arwrk;

			// monto_pago
			$nomina->monto_pago->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `salario_quincenal`, `salario_quincenal`, '' AS Disp2Fld, `id_empleado` FROM `empleados`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar", ""));
			$nomina->monto_pago->EditValue = $arwrk;

			// deducible_afp
			$nomina->deducible_afp->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `deducible_afp`, `deducible_afp`, '' AS Disp2Fld, `id_empleado` FROM `empleados`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar", ""));
			$nomina->deducible_afp->EditValue = $arwrk;

			// deducible_sf
			$nomina->deducible_sf->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `deducible_sf`, `deducible_sf`, '' AS Disp2Fld, `id_empleado` FROM `empleados`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar", ""));
			$nomina->deducible_sf->EditValue = $arwrk;

			// fecha
			$nomina->fecha->EditCustomAttributes = "";
			$nomina->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($nomina->fecha->CurrentValue, 7));

			// notas
			$nomina->notas->EditCustomAttributes = "";
			$nomina->notas->EditValue = ew_HtmlEncode($nomina->notas->CurrentValue);

			// Edit refer script
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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $nomina;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($nomina->id_empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Id Empresa";
		}
		if ($nomina->empleado->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empleado";
		}
		if ($nomina->monto_pago->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Pago quincenal";
		}
		if ($nomina->deducible_afp->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Deducible Afp";
		}
		if ($nomina->deducible_sf->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Deducible Sf";
		}
		if ($nomina->fecha->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha";
		}
		if (!ew_CheckEuroDate($nomina->fecha->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha";
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
		global $conn, $Security, $nomina;
		$sFilter = $nomina->KeyFilter();
		$nomina->CurrentFilter = $sFilter;
		$sSql = $nomina->SQL();
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

			// Field id_nomina
			// Field id_empresa

			$nomina->id_empresa->SetDbValueDef($nomina->id_empresa->CurrentValue, 0);
			$rsnew['id_empresa'] =& $nomina->id_empresa->DbValue;

			// Field empleado
			$nomina->empleado->SetDbValueDef($nomina->empleado->CurrentValue, 0);
			$rsnew['empleado'] =& $nomina->empleado->DbValue;

			// Field monto_pago
			$nomina->monto_pago->SetDbValueDef($nomina->monto_pago->CurrentValue, 0);
			$rsnew['monto_pago'] =& $nomina->monto_pago->DbValue;

			// Field deducible_afp
			$nomina->deducible_afp->SetDbValueDef($nomina->deducible_afp->CurrentValue, 0);
			$rsnew['deducible_afp'] =& $nomina->deducible_afp->DbValue;

			// Field deducible_sf
			$nomina->deducible_sf->SetDbValueDef($nomina->deducible_sf->CurrentValue, 0);
			$rsnew['deducible_sf'] =& $nomina->deducible_sf->DbValue;

			// Field fecha
			$nomina->fecha->SetDbValueDef(ew_UnFormatDateTime($nomina->fecha->CurrentValue, 7), ew_CurrentDate());
			$rsnew['fecha'] =& $nomina->fecha->DbValue;

			// Field notas
			$nomina->notas->SetDbValueDef($nomina->notas->CurrentValue, "");
			$rsnew['notas'] =& $nomina->notas->DbValue;

			// Call Row Updating event
			$bUpdateRow = $nomina->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($nomina->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($nomina->CancelMessage <> "") {
					$this->setMessage($nomina->CancelMessage);
					$nomina->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$nomina->Row_Updated($rsold, $rsnew);
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
