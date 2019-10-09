<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "empresasinfo.php" ?>
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
$empresas_add = new cempresas_add();
$Page =& $empresas_add;

// Page init processing
$empresas_add->Page_Init();

// Page main processing
$empresas_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var empresas_add = new ew_Page("empresas_add");

// page properties
empresas_add.PageID = "add"; // page ID
var EW_PAGE_ID = empresas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
empresas_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_rnc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Rnc");
		elm = fobj.elements["x" + infix + "_direccion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Direccion");
		elm = fobj.elements["x" + infix + "_email"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Email");
		elm = fobj.elements["x" + infix + "_Telefono"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Telefono");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
empresas_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empresas_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empresas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empresas_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Empresas<br><br>
<a href="<?php echo $empresas->getReturnUrl() ?>">Volver</a></span></p>
<?php $empresas_add->ShowMessage() ?>
<form name="fempresasadd" id="fempresasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return empresas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="empresas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($empresas->nombre->Visible) { // nombre ?>
	<tr<?php echo $empresas->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empresas->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $empresas->nombre->EditValue ?>"<?php echo $empresas->nombre->EditAttributes() ?>>
</span><?php echo $empresas->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empresas->rnc->Visible) { // rnc ?>
	<tr<?php echo $empresas->rnc->RowAttributes ?>>
		<td class="ewTableHeader">Rnc<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empresas->rnc->CellAttributes() ?>><span id="el_rnc">
<input type="text" name="x_rnc" id="x_rnc" size="30" maxlength="255" value="<?php echo $empresas->rnc->EditValue ?>"<?php echo $empresas->rnc->EditAttributes() ?>>
</span><?php echo $empresas->rnc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empresas->direccion->Visible) { // direccion ?>
	<tr<?php echo $empresas->direccion->RowAttributes ?>>
		<td class="ewTableHeader">Direccion<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empresas->direccion->CellAttributes() ?>><span id="el_direccion">
<input type="text" name="x_direccion" id="x_direccion" size="30" maxlength="255" value="<?php echo $empresas->direccion->EditValue ?>"<?php echo $empresas->direccion->EditAttributes() ?>>
</span><?php echo $empresas->direccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empresas->email->Visible) { // email ?>
	<tr<?php echo $empresas->email->RowAttributes ?>>
		<td class="ewTableHeader">Email<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empresas->email->CellAttributes() ?>><span id="el_email">
<input type="text" name="x_email" id="x_email" size="30" maxlength="255" value="<?php echo $empresas->email->EditValue ?>"<?php echo $empresas->email->EditAttributes() ?>>
</span><?php echo $empresas->email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($empresas->Telefono->Visible) { // Telefono ?>
	<tr<?php echo $empresas->Telefono->RowAttributes ?>>
		<td class="ewTableHeader">Telefono<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $empresas->Telefono->CellAttributes() ?>><span id="el_Telefono">
<input type="text" name="x_Telefono" id="x_Telefono" size="30" maxlength="255" value="<?php echo $empresas->Telefono->EditValue ?>"<?php echo $empresas->Telefono->EditAttributes() ?>>
</span><?php echo $empresas->Telefono->CustomMsg ?></td>
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
class cempresas_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'empresas';

	// Page Object Name
	var $PageObjName = 'empresas_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $empresas;
		if ($empresas->UseTokenInUrl) $PageUrl .= "t=" . $empresas->TableVar . "&"; // add page token
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
		global $objForm, $empresas;
		if ($empresas->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($empresas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($empresas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cempresas_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["empresas"] = new cempresas();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empresas', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $empresas;
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
		global $objForm, $gsFormError, $empresas;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_empresa"] != "") {
		  $empresas->id_empresa->setQueryStringValue($_GET["id_empresa"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $empresas->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$empresas->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $empresas->CurrentAction = "C"; // Copy Record
		  } else {
		    $empresas->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($empresas->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("empresaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$empresas->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $empresas->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "empresasview.php")
						$sReturnUrl = $empresas->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$empresas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $empresas;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $empresas;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $empresas;
		$empresas->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$empresas->rnc->setFormValue($objForm->GetValue("x_rnc"));
		$empresas->direccion->setFormValue($objForm->GetValue("x_direccion"));
		$empresas->email->setFormValue($objForm->GetValue("x_email"));
		$empresas->Telefono->setFormValue($objForm->GetValue("x_Telefono"));
		$empresas->id_empresa->setFormValue($objForm->GetValue("x_id_empresa"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $empresas;
		$empresas->id_empresa->CurrentValue = $empresas->id_empresa->FormValue;
		$empresas->nombre->CurrentValue = $empresas->nombre->FormValue;
		$empresas->rnc->CurrentValue = $empresas->rnc->FormValue;
		$empresas->direccion->CurrentValue = $empresas->direccion->FormValue;
		$empresas->email->CurrentValue = $empresas->email->FormValue;
		$empresas->Telefono->CurrentValue = $empresas->Telefono->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $empresas;
		$sFilter = $empresas->KeyFilter();

		// Call Row Selecting event
		$empresas->Row_Selecting($sFilter);

		// Load sql based on filter
		$empresas->CurrentFilter = $sFilter;
		$sSql = $empresas->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$empresas->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $empresas;
		$empresas->id_empresa->setDbValue($rs->fields('id_empresa'));
		$empresas->nombre->setDbValue($rs->fields('nombre'));
		$empresas->rnc->setDbValue($rs->fields('rnc'));
		$empresas->direccion->setDbValue($rs->fields('direccion'));
		$empresas->email->setDbValue($rs->fields('email'));
		$empresas->Telefono->setDbValue($rs->fields('Telefono'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $empresas;

		// Call Row_Rendering event
		$empresas->Row_Rendering();

		// Common render codes for all row types
		// nombre

		$empresas->nombre->CellCssStyle = "";
		$empresas->nombre->CellCssClass = "";

		// rnc
		$empresas->rnc->CellCssStyle = "";
		$empresas->rnc->CellCssClass = "";

		// direccion
		$empresas->direccion->CellCssStyle = "";
		$empresas->direccion->CellCssClass = "";

		// email
		$empresas->email->CellCssStyle = "";
		$empresas->email->CellCssClass = "";

		// Telefono
		$empresas->Telefono->CellCssStyle = "";
		$empresas->Telefono->CellCssClass = "";
		if ($empresas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_empresa
			$empresas->id_empresa->ViewValue = $empresas->id_empresa->CurrentValue;
			$empresas->id_empresa->CssStyle = "";
			$empresas->id_empresa->CssClass = "";
			$empresas->id_empresa->ViewCustomAttributes = "";

			// nombre
			$empresas->nombre->ViewValue = $empresas->nombre->CurrentValue;
			$empresas->nombre->CssStyle = "";
			$empresas->nombre->CssClass = "";
			$empresas->nombre->ViewCustomAttributes = "";

			// rnc
			$empresas->rnc->ViewValue = $empresas->rnc->CurrentValue;
			$empresas->rnc->CssStyle = "";
			$empresas->rnc->CssClass = "";
			$empresas->rnc->ViewCustomAttributes = "";

			// direccion
			$empresas->direccion->ViewValue = $empresas->direccion->CurrentValue;
			$empresas->direccion->CssStyle = "";
			$empresas->direccion->CssClass = "";
			$empresas->direccion->ViewCustomAttributes = "";

			// email
			$empresas->email->ViewValue = $empresas->email->CurrentValue;
			$empresas->email->CssStyle = "";
			$empresas->email->CssClass = "";
			$empresas->email->ViewCustomAttributes = "";

			// Telefono
			$empresas->Telefono->ViewValue = $empresas->Telefono->CurrentValue;
			$empresas->Telefono->CssStyle = "";
			$empresas->Telefono->CssClass = "";
			$empresas->Telefono->ViewCustomAttributes = "";

			// nombre
			$empresas->nombre->HrefValue = "";

			// rnc
			$empresas->rnc->HrefValue = "";

			// direccion
			$empresas->direccion->HrefValue = "";

			// email
			$empresas->email->HrefValue = "";

			// Telefono
			$empresas->Telefono->HrefValue = "";
		} elseif ($empresas->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$empresas->nombre->EditCustomAttributes = "";
			$empresas->nombre->EditValue = ew_HtmlEncode($empresas->nombre->CurrentValue);

			// rnc
			$empresas->rnc->EditCustomAttributes = "";
			$empresas->rnc->EditValue = ew_HtmlEncode($empresas->rnc->CurrentValue);

			// direccion
			$empresas->direccion->EditCustomAttributes = "";
			$empresas->direccion->EditValue = ew_HtmlEncode($empresas->direccion->CurrentValue);

			// email
			$empresas->email->EditCustomAttributes = "";
			$empresas->email->EditValue = ew_HtmlEncode($empresas->email->CurrentValue);

			// Telefono
			$empresas->Telefono->EditCustomAttributes = "";
			$empresas->Telefono->EditValue = ew_HtmlEncode($empresas->Telefono->CurrentValue);
		}

		// Call Row Rendered event
		$empresas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $empresas;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($empresas->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Nombre";
		}
		if ($empresas->rnc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Rnc";
		}
		if ($empresas->direccion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Direccion";
		}
		if ($empresas->email->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Email";
		}
		if ($empresas->Telefono->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Telefono";
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
		global $conn, $Security, $empresas;
		$rsnew = array();

		// Field nombre
		$empresas->nombre->SetDbValueDef($empresas->nombre->CurrentValue, "");
		$rsnew['nombre'] =& $empresas->nombre->DbValue;

		// Field rnc
		$empresas->rnc->SetDbValueDef($empresas->rnc->CurrentValue, "");
		$rsnew['rnc'] =& $empresas->rnc->DbValue;

		// Field direccion
		$empresas->direccion->SetDbValueDef($empresas->direccion->CurrentValue, "");
		$rsnew['direccion'] =& $empresas->direccion->DbValue;

		// Field email
		$empresas->email->SetDbValueDef($empresas->email->CurrentValue, "");
		$rsnew['email'] =& $empresas->email->DbValue;

		// Field Telefono
		$empresas->Telefono->SetDbValueDef($empresas->Telefono->CurrentValue, "");
		$rsnew['Telefono'] =& $empresas->Telefono->DbValue;

		// Call Row Inserting event
		$bInsertRow = $empresas->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($empresas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($empresas->CancelMessage <> "") {
				$this->setMessage($empresas->CancelMessage);
				$empresas->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$empresas->id_empresa->setDbValue($conn->Insert_ID());
			$rsnew['id_empresa'] =& $empresas->id_empresa->DbValue;

			// Call Row Inserted event
			$empresas->Row_Inserted($rsnew);
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
