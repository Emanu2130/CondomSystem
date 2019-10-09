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
$empleados_add = new cempleados_add();
$Page =& $empleados_add;

// Page init processing
$empleados_add->Page_Init();

// Page main processing
$empleados_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var empleados_add = new ew_Page("empleados_add");

// page properties
empleados_add.PageID = "add"; // page ID
var EW_PAGE_ID = empleados_add.PageID; // for backward compatibility

// extend page with ValidateForm function
empleados_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, "Ingrese el campo requerido - Empresa");
		elm = fobj.elements["x" + infix + "_nombre_completo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre Completo");
		elm = fobj.elements["x" + infix + "_cedula"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Cedula");
		elm = fobj.elements["x" + infix + "_fecha_ingreso"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha Ingreso");
		elm = fobj.elements["x" + infix + "_fecha_ingreso"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Ingreso");
		elm = fobj.elements["x" + infix + "_ultimas_vacaciones"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Ult.Vacaciones");
		elm = fobj.elements["x" + infix + "_proximas_vacaciones"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Prox.Vacaciones");
		elm = fobj.elements["x" + infix + "_Posicion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Posicion");
		elm = fobj.elements["x" + infix + "_salario_mensual"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Salario Mensual");
		elm = fobj.elements["x" + infix + "_salario_mensual"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Salario Mensual");
		elm = fobj.elements["x" + infix + "_salario_quincenal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Salario Quincenal");
		elm = fobj.elements["x" + infix + "_salario_quincenal"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Salario Quincenal");
		elm = fobj.elements["x" + infix + "_deducible_afp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Deducible Afp");
		elm = fobj.elements["x" + infix + "_deducible_afp"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Deducible Afp");
		elm = fobj.elements["x" + infix + "_deducible_sf"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Deducible Sf");
		elm = fobj.elements["x" + infix + "_deducible_sf"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Deducible Sf");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
empleados_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empleados_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empleados_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empleados_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Empleados<br><br>
<a href="<?php echo $empleados->getReturnUrl() ?>">Volver</a></span></p>
<?php $empleados_add->ShowMessage() ?>
<form name="fempleadosadd" id="fempleadosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return empleados_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="empleados">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($empleados->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $empleados->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->id_empresa->CellAttributes() ?>><span id="el_id_empresa">
<select id="x_id_empresa" name="x_id_empresa"<?php echo $empleados->id_empresa->EditAttributes() ?>>
<?php
if (is_array($empleados->id_empresa->EditValue)) {
	$arwrk = $empleados->id_empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($empleados->id_empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $empleados->id_empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->nombre_completo->Visible) { // nombre_completo ?>
	<tr<?php echo $empleados->nombre_completo->RowAttributes ?>>
		<td class="ewTableHeader">Nombre Completo<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->nombre_completo->CellAttributes() ?>><span id="el_nombre_completo">
<input type="text" name="x_nombre_completo" id="x_nombre_completo" size="30" maxlength="255" value="<?php echo $empleados->nombre_completo->EditValue ?>"<?php echo $empleados->nombre_completo->EditAttributes() ?>>
</span><?php echo $empleados->nombre_completo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->cedula->Visible) { // cedula ?>
	<tr<?php echo $empleados->cedula->RowAttributes ?>>
		<td class="ewTableHeader">Cedula<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->cedula->CellAttributes() ?>><span id="el_cedula">
<input type="text" name="x_cedula" id="x_cedula" size="30" maxlength="255" value="<?php echo $empleados->cedula->EditValue ?>"<?php echo $empleados->cedula->EditAttributes() ?>>
</span><?php echo $empleados->cedula->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->fecha_ingreso->Visible) { // fecha_ingreso ?>
	<tr<?php echo $empleados->fecha_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Ingreso<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->fecha_ingreso->CellAttributes() ?>><span id="el_fecha_ingreso">
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo $empleados->fecha_ingreso->EditValue ?>"<?php echo $empleados->fecha_ingreso->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_fecha_ingreso" name="cal_x_fecha_ingreso" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_fecha_ingreso", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_fecha_ingreso" // ID of the button
});
</script>
</span><?php echo $empleados->fecha_ingreso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->ultimas_vacaciones->Visible) { // ultimas_vacaciones ?>
	<tr<?php echo $empleados->ultimas_vacaciones->RowAttributes ?>>
		<td class="ewTableHeader">Ult.Vacaciones<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->ultimas_vacaciones->CellAttributes() ?>><span id="el_ultimas_vacaciones">
<input type="text" name="x_ultimas_vacaciones" id="x_ultimas_vacaciones" size="30" maxlength="255" value="<?php echo $empleados->ultimas_vacaciones->EditValue ?>"<?php echo $empleados->ultimas_vacaciones->EditAttributes() ?>>
</span><?php echo $empleados->ultimas_vacaciones->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->proximas_vacaciones->Visible) { // proximas_vacaciones ?>
	<tr<?php echo $empleados->proximas_vacaciones->RowAttributes ?>>
		<td class="ewTableHeader">Prox.Vacaciones<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->proximas_vacaciones->CellAttributes() ?>><span id="el_proximas_vacaciones">
<input type="text" name="x_proximas_vacaciones" id="x_proximas_vacaciones" size="30" maxlength="255" value="<?php echo $empleados->proximas_vacaciones->EditValue ?>"<?php echo $empleados->proximas_vacaciones->EditAttributes() ?>>
</span><?php echo $empleados->proximas_vacaciones->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->Posicion->Visible) { // Posicion ?>
	<tr<?php echo $empleados->Posicion->RowAttributes ?>>
		<td class="ewTableHeader">Posicion<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->Posicion->CellAttributes() ?>><span id="el_Posicion">
<input type="text" name="x_Posicion" id="x_Posicion" size="30" maxlength="225" value="<?php echo $empleados->Posicion->EditValue ?>"<?php echo $empleados->Posicion->EditAttributes() ?>>
</span><?php echo $empleados->Posicion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->salario_mensual->Visible) { // salario_mensual ?>
	<tr<?php echo $empleados->salario_mensual->RowAttributes ?>>
		<td class="ewTableHeader">Salario Mensual<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->salario_mensual->CellAttributes() ?>><span id="el_salario_mensual">
<input type="text" name="x_salario_mensual" id="x_salario_mensual" size="30" value="<?php echo $empleados->salario_mensual->EditValue ?>"<?php echo $empleados->salario_mensual->EditAttributes() ?>>
</span><?php echo $empleados->salario_mensual->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->salario_quincenal->Visible) { // salario_quincenal ?>
	<tr<?php echo $empleados->salario_quincenal->RowAttributes ?>>
		<td class="ewTableHeader">Salario Quincenal<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->salario_quincenal->CellAttributes() ?>><span id="el_salario_quincenal">
<input type="text" name="x_salario_quincenal" id="x_salario_quincenal" size="30" value="<?php echo $empleados->salario_quincenal->EditValue ?>"<?php echo $empleados->salario_quincenal->EditAttributes() ?>>
</span><?php echo $empleados->salario_quincenal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->deducible_afp->Visible) { // deducible_afp ?>
	<tr<?php echo $empleados->deducible_afp->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Afp<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->deducible_afp->CellAttributes() ?>><span id="el_deducible_afp">
<input type="text" name="x_deducible_afp" id="x_deducible_afp" size="30" value="<?php echo $empleados->deducible_afp->EditValue ?>"<?php echo $empleados->deducible_afp->EditAttributes() ?>>
</span><?php echo $empleados->deducible_afp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empleados->deducible_sf->Visible) { // deducible_sf ?>
	<tr<?php echo $empleados->deducible_sf->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Sf<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empleados->deducible_sf->CellAttributes() ?>><span id="el_deducible_sf">
<input type="text" name="x_deducible_sf" id="x_deducible_sf" size="30" value="<?php echo $empleados->deducible_sf->EditValue ?>"<?php echo $empleados->deducible_sf->EditAttributes() ?>>
</span><?php echo $empleados->deducible_sf->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Agregar  ">
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
class cempleados_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'empleados';

	// Page Object Name
	var $PageObjName = 'empleados_add';

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
	function cempleados_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["empleados"] = new cempleados();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $empleados;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_empleado"] != "") {
		  $empleados->id_empleado->setQueryStringValue($_GET["id_empleado"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $empleados->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$empleados->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $empleados->CurrentAction = "C"; // Copy Record
		  } else {
		    $empleados->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($empleados->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("empleadoslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$empleados->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $empleados->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "empleadosview.php")
						$sReturnUrl = $empleados->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$empleados->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $empleados;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $empleados;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $empleados;
		$empleados->id_empresa->setFormValue($objForm->GetValue("x_id_empresa"));
		$empleados->nombre_completo->setFormValue($objForm->GetValue("x_nombre_completo"));
		$empleados->cedula->setFormValue($objForm->GetValue("x_cedula"));
		$empleados->fecha_ingreso->setFormValue($objForm->GetValue("x_fecha_ingreso"));
		$empleados->fecha_ingreso->CurrentValue = ew_UnFormatDateTime($empleados->fecha_ingreso->CurrentValue, 7);
		$empleados->ultimas_vacaciones->setFormValue($objForm->GetValue("x_ultimas_vacaciones"));
		$empleados->proximas_vacaciones->setFormValue($objForm->GetValue("x_proximas_vacaciones"));
		$empleados->Posicion->setFormValue($objForm->GetValue("x_Posicion"));
		$empleados->salario_mensual->setFormValue($objForm->GetValue("x_salario_mensual"));
		$empleados->salario_quincenal->setFormValue($objForm->GetValue("x_salario_quincenal"));
		$empleados->deducible_afp->setFormValue($objForm->GetValue("x_deducible_afp"));
		$empleados->deducible_sf->setFormValue($objForm->GetValue("x_deducible_sf"));
		$empleados->id_empleado->setFormValue($objForm->GetValue("x_id_empleado"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $empleados;
		$empleados->id_empleado->CurrentValue = $empleados->id_empleado->FormValue;
		$empleados->id_empresa->CurrentValue = $empleados->id_empresa->FormValue;
		$empleados->nombre_completo->CurrentValue = $empleados->nombre_completo->FormValue;
		$empleados->cedula->CurrentValue = $empleados->cedula->FormValue;
		$empleados->fecha_ingreso->CurrentValue = $empleados->fecha_ingreso->FormValue;
		$empleados->fecha_ingreso->CurrentValue = ew_UnFormatDateTime($empleados->fecha_ingreso->CurrentValue, 7);
		$empleados->ultimas_vacaciones->CurrentValue = $empleados->ultimas_vacaciones->FormValue;
		$empleados->proximas_vacaciones->CurrentValue = $empleados->proximas_vacaciones->FormValue;
		$empleados->Posicion->CurrentValue = $empleados->Posicion->FormValue;
		$empleados->salario_mensual->CurrentValue = $empleados->salario_mensual->FormValue;
		$empleados->salario_quincenal->CurrentValue = $empleados->salario_quincenal->FormValue;
		$empleados->deducible_afp->CurrentValue = $empleados->deducible_afp->FormValue;
		$empleados->deducible_sf->CurrentValue = $empleados->deducible_sf->FormValue;
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
		} elseif ($empleados->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_empresa
			$empleados->id_empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$empleados->id_empresa->EditValue = $arwrk;

			// nombre_completo
			$empleados->nombre_completo->EditCustomAttributes = "";
			$empleados->nombre_completo->EditValue = ew_HtmlEncode($empleados->nombre_completo->CurrentValue);

			// cedula
			$empleados->cedula->EditCustomAttributes = "";
			$empleados->cedula->EditValue = ew_HtmlEncode($empleados->cedula->CurrentValue);

			// fecha_ingreso
			$empleados->fecha_ingreso->EditCustomAttributes = "";
			$empleados->fecha_ingreso->EditValue = ew_HtmlEncode(ew_FormatDateTime($empleados->fecha_ingreso->CurrentValue, 7));

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->EditCustomAttributes = "";
			$empleados->ultimas_vacaciones->EditValue = ew_HtmlEncode($empleados->ultimas_vacaciones->CurrentValue);

			// proximas_vacaciones
			$empleados->proximas_vacaciones->EditCustomAttributes = "";
			$empleados->proximas_vacaciones->EditValue = ew_HtmlEncode($empleados->proximas_vacaciones->CurrentValue);

			// Posicion
			$empleados->Posicion->EditCustomAttributes = "";
			$empleados->Posicion->EditValue = ew_HtmlEncode($empleados->Posicion->CurrentValue);

			// salario_mensual
			$empleados->salario_mensual->EditCustomAttributes = "";
			$empleados->salario_mensual->EditValue = ew_HtmlEncode($empleados->salario_mensual->CurrentValue);

			// salario_quincenal
			$empleados->salario_quincenal->EditCustomAttributes = "";
			$empleados->salario_quincenal->EditValue = ew_HtmlEncode($empleados->salario_quincenal->CurrentValue);

			// deducible_afp
			$empleados->deducible_afp->EditCustomAttributes = "";
			$empleados->deducible_afp->EditValue = ew_HtmlEncode($empleados->deducible_afp->CurrentValue);

			// deducible_sf
			$empleados->deducible_sf->EditCustomAttributes = "";
			$empleados->deducible_sf->EditValue = ew_HtmlEncode($empleados->deducible_sf->CurrentValue);
		}

		// Call Row Rendered event
		$empleados->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $empleados;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($empleados->id_empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
		}
		if ($empleados->nombre_completo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Nombre Completo";
		}
		if ($empleados->cedula->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Cedula";
		}
		if ($empleados->fecha_ingreso->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha Ingreso";
		}
		if (!ew_CheckEuroDate($empleados->fecha_ingreso->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Ingreso";
		}
		if ($empleados->ultimas_vacaciones->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Ult.Vacaciones";
		}
		if ($empleados->proximas_vacaciones->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Prox.Vacaciones";
		}
		if ($empleados->Posicion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Posicion";
		}
		if ($empleados->salario_mensual->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Salario Mensual";
		}
		if (!ew_CheckNumber($empleados->salario_mensual->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Salario Mensual";
		}
		if ($empleados->salario_quincenal->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Salario Quincenal";
		}
		if (!ew_CheckNumber($empleados->salario_quincenal->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Salario Quincenal";
		}
		if ($empleados->deducible_afp->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Deducible Afp";
		}
		if (!ew_CheckNumber($empleados->deducible_afp->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Deducible Afp";
		}
		if ($empleados->deducible_sf->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Deducible Sf";
		}
		if (!ew_CheckNumber($empleados->deducible_sf->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Deducible Sf";
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
		global $conn, $Security, $empleados;
		$rsnew = array();

		// Field id_empresa
		$empleados->id_empresa->SetDbValueDef($empleados->id_empresa->CurrentValue, 0);
		$rsnew['id_empresa'] =& $empleados->id_empresa->DbValue;

		// Field nombre_completo
		$empleados->nombre_completo->SetDbValueDef($empleados->nombre_completo->CurrentValue, "");
		$rsnew['nombre_completo'] =& $empleados->nombre_completo->DbValue;

		// Field cedula
		$empleados->cedula->SetDbValueDef($empleados->cedula->CurrentValue, "");
		$rsnew['cedula'] =& $empleados->cedula->DbValue;

		// Field fecha_ingreso
		$empleados->fecha_ingreso->SetDbValueDef(ew_UnFormatDateTime($empleados->fecha_ingreso->CurrentValue, 7), ew_CurrentDate());
		$rsnew['fecha_ingreso'] =& $empleados->fecha_ingreso->DbValue;

		// Field ultimas_vacaciones
		$empleados->ultimas_vacaciones->SetDbValueDef($empleados->ultimas_vacaciones->CurrentValue, "");
		$rsnew['ultimas_vacaciones'] =& $empleados->ultimas_vacaciones->DbValue;

		// Field proximas_vacaciones
		$empleados->proximas_vacaciones->SetDbValueDef($empleados->proximas_vacaciones->CurrentValue, "");
		$rsnew['proximas_vacaciones'] =& $empleados->proximas_vacaciones->DbValue;

		// Field Posicion
		$empleados->Posicion->SetDbValueDef($empleados->Posicion->CurrentValue, "");
		$rsnew['Posicion'] =& $empleados->Posicion->DbValue;

		// Field salario_mensual
		$empleados->salario_mensual->SetDbValueDef($empleados->salario_mensual->CurrentValue, 0);
		$rsnew['salario_mensual'] =& $empleados->salario_mensual->DbValue;

		// Field salario_quincenal
		$empleados->salario_quincenal->SetDbValueDef($empleados->salario_quincenal->CurrentValue, 0);
		$rsnew['salario_quincenal'] =& $empleados->salario_quincenal->DbValue;

		// Field deducible_afp
		$empleados->deducible_afp->SetDbValueDef($empleados->deducible_afp->CurrentValue, 0);
		$rsnew['deducible_afp'] =& $empleados->deducible_afp->DbValue;

		// Field deducible_sf
		$empleados->deducible_sf->SetDbValueDef($empleados->deducible_sf->CurrentValue, 0);
		$rsnew['deducible_sf'] =& $empleados->deducible_sf->DbValue;

		// Call Row Inserting event
		$bInsertRow = $empleados->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($empleados->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($empleados->CancelMessage <> "") {
				$this->setMessage($empleados->CancelMessage);
				$empleados->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$empleados->id_empleado->setDbValue($conn->Insert_ID());
			$rsnew['id_empleado'] =& $empleados->id_empleado->DbValue;

			// Call Row Inserted event
			$empleados->Row_Inserted($rsnew);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
