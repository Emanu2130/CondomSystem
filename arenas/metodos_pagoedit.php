<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "metodos_pagoinfo.php" ?>
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
$metodos_pago_edit = new cmetodos_pago_edit();
$Page =& $metodos_pago_edit;

// Page init processing
$metodos_pago_edit->Page_Init();

// Page main processing
$metodos_pago_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var metodos_pago_edit = new ew_Page("metodos_pago_edit");

// page properties
metodos_pago_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = metodos_pago_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
metodos_pago_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_metodo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Metodo");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
metodos_pago_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
metodos_pago_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
metodos_pago_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
metodos_pago_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Editar Modulo: Metodos Pago<br><br>
<a href="<?php echo $metodos_pago->getReturnUrl() ?>">Volver</a></span></p>
<?php $metodos_pago_edit->ShowMessage() ?>
<form name="fmetodos_pagoedit" id="fmetodos_pagoedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return metodos_pago_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="metodos_pago">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($metodos_pago->id_metodo->Visible) { // id_metodo ?>
	<tr<?php echo $metodos_pago->id_metodo->RowAttributes ?>>
		<td class="ewTableHeader">Id Metodo</td>
		<td<?php echo $metodos_pago->id_metodo->CellAttributes() ?>><span id="el_id_metodo">
<div<?php echo $metodos_pago->id_metodo->ViewAttributes() ?>><?php echo $metodos_pago->id_metodo->EditValue ?></div><input type="hidden" name="x_id_metodo" id="x_id_metodo" value="<?php echo ew_HtmlEncode($metodos_pago->id_metodo->CurrentValue) ?>">
</span><?php echo $metodos_pago->id_metodo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($metodos_pago->metodo->Visible) { // metodo ?>
	<tr<?php echo $metodos_pago->metodo->RowAttributes ?>>
		<td class="ewTableHeader">Metodo<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $metodos_pago->metodo->CellAttributes() ?>><span id="el_metodo">
<input type="text" name="x_metodo" id="x_metodo" size="30" maxlength="255" value="<?php echo $metodos_pago->metodo->EditValue ?>"<?php echo $metodos_pago->metodo->EditAttributes() ?>>
</span><?php echo $metodos_pago->metodo->CustomMsg ?></td>
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
class cmetodos_pago_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'metodos_pago';

	// Page Object Name
	var $PageObjName = 'metodos_pago_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $metodos_pago;
		if ($metodos_pago->UseTokenInUrl) $PageUrl .= "t=" . $metodos_pago->TableVar . "&"; // add page token
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
		global $objForm, $metodos_pago;
		if ($metodos_pago->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($metodos_pago->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($metodos_pago->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmetodos_pago_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["metodos_pago"] = new cmetodos_pago();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'metodos_pago', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $metodos_pago;
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
		global $objForm, $gsFormError, $metodos_pago;

		// Load key from QueryString
		if (@$_GET["id_metodo"] <> "")
			$metodos_pago->id_metodo->setQueryStringValue($_GET["id_metodo"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$metodos_pago->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$metodos_pago->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else {
			$metodos_pago->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($metodos_pago->id_metodo->CurrentValue == "")
			$this->Page_Terminate("metodos_pagolist.php"); // Invalid key, return to list
		switch ($metodos_pago->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No se encontraron registros"); // No record found
					$this->Page_Terminate("metodos_pagolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$metodos_pago->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Actualizar completado"); // Update success
					$sReturnUrl = $metodos_pago->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "metodos_pagoview.php")
						$sReturnUrl = $metodos_pago->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$metodos_pago->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $metodos_pago;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $metodos_pago;
		$metodos_pago->id_metodo->setFormValue($objForm->GetValue("x_id_metodo"));
		$metodos_pago->metodo->setFormValue($objForm->GetValue("x_metodo"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $metodos_pago;
		$this->LoadRow();
		$metodos_pago->id_metodo->CurrentValue = $metodos_pago->id_metodo->FormValue;
		$metodos_pago->metodo->CurrentValue = $metodos_pago->metodo->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $metodos_pago;
		$sFilter = $metodos_pago->KeyFilter();

		// Call Row Selecting event
		$metodos_pago->Row_Selecting($sFilter);

		// Load sql based on filter
		$metodos_pago->CurrentFilter = $sFilter;
		$sSql = $metodos_pago->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$metodos_pago->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $metodos_pago;
		$metodos_pago->id_metodo->setDbValue($rs->fields('id_metodo'));
		$metodos_pago->metodo->setDbValue($rs->fields('metodo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $metodos_pago;

		// Call Row_Rendering event
		$metodos_pago->Row_Rendering();

		// Common render codes for all row types
		// id_metodo

		$metodos_pago->id_metodo->CellCssStyle = "";
		$metodos_pago->id_metodo->CellCssClass = "";

		// metodo
		$metodos_pago->metodo->CellCssStyle = "";
		$metodos_pago->metodo->CellCssClass = "";
		if ($metodos_pago->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_metodo
			$metodos_pago->id_metodo->ViewValue = $metodos_pago->id_metodo->CurrentValue;
			$metodos_pago->id_metodo->CssStyle = "";
			$metodos_pago->id_metodo->CssClass = "";
			$metodos_pago->id_metodo->ViewCustomAttributes = "";

			// metodo
			$metodos_pago->metodo->ViewValue = $metodos_pago->metodo->CurrentValue;
			$metodos_pago->metodo->CssStyle = "";
			$metodos_pago->metodo->CssClass = "";
			$metodos_pago->metodo->ViewCustomAttributes = "";

			// id_metodo
			$metodos_pago->id_metodo->HrefValue = "";

			// metodo
			$metodos_pago->metodo->HrefValue = "";
		} elseif ($metodos_pago->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_metodo
			$metodos_pago->id_metodo->EditCustomAttributes = "";
			$metodos_pago->id_metodo->EditValue = $metodos_pago->id_metodo->CurrentValue;
			$metodos_pago->id_metodo->CssStyle = "";
			$metodos_pago->id_metodo->CssClass = "";
			$metodos_pago->id_metodo->ViewCustomAttributes = "";

			// metodo
			$metodos_pago->metodo->EditCustomAttributes = "";
			$metodos_pago->metodo->EditValue = ew_HtmlEncode($metodos_pago->metodo->CurrentValue);

			// Edit refer script
			// id_metodo

			$metodos_pago->id_metodo->HrefValue = "";

			// metodo
			$metodos_pago->metodo->HrefValue = "";
		}

		// Call Row Rendered event
		$metodos_pago->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $metodos_pago;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($metodos_pago->metodo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Metodo";
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
		global $conn, $Security, $metodos_pago;
		$sFilter = $metodos_pago->KeyFilter();
		$metodos_pago->CurrentFilter = $sFilter;
		$sSql = $metodos_pago->SQL();
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

			// Field id_metodo
			// Field metodo

			$metodos_pago->metodo->SetDbValueDef($metodos_pago->metodo->CurrentValue, "");
			$rsnew['metodo'] =& $metodos_pago->metodo->DbValue;

			// Call Row Updating event
			$bUpdateRow = $metodos_pago->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($metodos_pago->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($metodos_pago->CancelMessage <> "") {
					$this->setMessage($metodos_pago->CancelMessage);
					$metodos_pago->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$metodos_pago->Row_Updated($rsold, $rsnew);
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
