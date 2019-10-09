<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "egresos_tipo1info.php" ?>
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
$egresos_tipo1_edit = new cegresos_tipo1_edit();
$Page =& $egresos_tipo1_edit;

// Page init processing
$egresos_tipo1_edit->Page_Init();

// Page main processing
$egresos_tipo1_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_tipo1_edit = new ew_Page("egresos_tipo1_edit");

// page properties
egresos_tipo1_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = egresos_tipo1_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
egresos_tipo1_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
egresos_tipo1_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_tipo1_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_tipo1_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_tipo1_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Editar Modulo: Egresos Tipo 1<br><br>
<a href="<?php echo $egresos_tipo1->getReturnUrl() ?>">Volver</a></span></p>
<?php $egresos_tipo1_edit->ShowMessage() ?>
<form name="fegresos_tipo1edit" id="fegresos_tipo1edit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return egresos_tipo1_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="egresos_tipo1">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($egresos_tipo1->id_tipo->Visible) { // id_tipo ?>
	<tr<?php echo $egresos_tipo1->id_tipo->RowAttributes ?>>
		<td class="ewTableHeader">Id Tipo</td>
		<td<?php echo $egresos_tipo1->id_tipo->CellAttributes() ?>><span id="el_id_tipo">
<div<?php echo $egresos_tipo1->id_tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->id_tipo->EditValue ?></div><input type="hidden" name="x_id_tipo" id="x_id_tipo" value="<?php echo ew_HtmlEncode($egresos_tipo1->id_tipo->CurrentValue) ?>">
</span><?php echo $egresos_tipo1->id_tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos_tipo1->tipo->Visible) { // tipo ?>
	<tr<?php echo $egresos_tipo1->tipo->RowAttributes ?>>
		<td class="ewTableHeader">Tipo<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos_tipo1->tipo->CellAttributes() ?>><span id="el_tipo">
<input type="text" name="x_tipo" id="x_tipo" size="30" maxlength="255" value="<?php echo $egresos_tipo1->tipo->EditValue ?>"<?php echo $egresos_tipo1->tipo->EditAttributes() ?>>
</span><?php echo $egresos_tipo1->tipo->CustomMsg ?></td>
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
class cegresos_tipo1_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'egresos_tipo1';

	// Page Object Name
	var $PageObjName = 'egresos_tipo1_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $egresos_tipo1;
		if ($egresos_tipo1->UseTokenInUrl) $PageUrl .= "t=" . $egresos_tipo1->TableVar . "&"; // add page token
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
		global $objForm, $egresos_tipo1;
		if ($egresos_tipo1->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($egresos_tipo1->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($egresos_tipo1->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cegresos_tipo1_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos_tipo1"] = new cegresos_tipo1();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'egresos_tipo1', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $egresos_tipo1;
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
		global $objForm, $gsFormError, $egresos_tipo1;

		// Load key from QueryString
		if (@$_GET["id_tipo"] <> "")
			$egresos_tipo1->id_tipo->setQueryStringValue($_GET["id_tipo"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$egresos_tipo1->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$egresos_tipo1->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else {
			$egresos_tipo1->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($egresos_tipo1->id_tipo->CurrentValue == "")
			$this->Page_Terminate("egresos_tipo1list.php"); // Invalid key, return to list
		switch ($egresos_tipo1->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No se encontraron registros"); // No record found
					$this->Page_Terminate("egresos_tipo1list.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$egresos_tipo1->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Actualizar completado"); // Update success
					$sReturnUrl = $egresos_tipo1->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "egresos_tipo1view.php")
						$sReturnUrl = $egresos_tipo1->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$egresos_tipo1->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $egresos_tipo1;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $egresos_tipo1;
		$egresos_tipo1->id_tipo->setFormValue($objForm->GetValue("x_id_tipo"));
		$egresos_tipo1->tipo->setFormValue($objForm->GetValue("x_tipo"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $egresos_tipo1;
		$this->LoadRow();
		$egresos_tipo1->id_tipo->CurrentValue = $egresos_tipo1->id_tipo->FormValue;
		$egresos_tipo1->tipo->CurrentValue = $egresos_tipo1->tipo->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $egresos_tipo1;
		$sFilter = $egresos_tipo1->KeyFilter();

		// Call Row Selecting event
		$egresos_tipo1->Row_Selecting($sFilter);

		// Load sql based on filter
		$egresos_tipo1->CurrentFilter = $sFilter;
		$sSql = $egresos_tipo1->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$egresos_tipo1->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $egresos_tipo1;
		$egresos_tipo1->id_tipo->setDbValue($rs->fields('id_tipo'));
		$egresos_tipo1->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $egresos_tipo1;

		// Call Row_Rendering event
		$egresos_tipo1->Row_Rendering();

		// Common render codes for all row types
		// id_tipo

		$egresos_tipo1->id_tipo->CellCssStyle = "";
		$egresos_tipo1->id_tipo->CellCssClass = "";

		// tipo
		$egresos_tipo1->tipo->CellCssStyle = "";
		$egresos_tipo1->tipo->CellCssClass = "";
		if ($egresos_tipo1->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_tipo
			$egresos_tipo1->id_tipo->ViewValue = $egresos_tipo1->id_tipo->CurrentValue;
			$egresos_tipo1->id_tipo->CssStyle = "";
			$egresos_tipo1->id_tipo->CssClass = "";
			$egresos_tipo1->id_tipo->ViewCustomAttributes = "";

			// tipo
			$egresos_tipo1->tipo->ViewValue = $egresos_tipo1->tipo->CurrentValue;
			$egresos_tipo1->tipo->CssStyle = "";
			$egresos_tipo1->tipo->CssClass = "";
			$egresos_tipo1->tipo->ViewCustomAttributes = "";

			// id_tipo
			$egresos_tipo1->id_tipo->HrefValue = "";

			// tipo
			$egresos_tipo1->tipo->HrefValue = "";
		} elseif ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_tipo
			$egresos_tipo1->id_tipo->EditCustomAttributes = "";
			$egresos_tipo1->id_tipo->EditValue = $egresos_tipo1->id_tipo->CurrentValue;
			$egresos_tipo1->id_tipo->CssStyle = "";
			$egresos_tipo1->id_tipo->CssClass = "";
			$egresos_tipo1->id_tipo->ViewCustomAttributes = "";

			// tipo
			$egresos_tipo1->tipo->EditCustomAttributes = "";
			$egresos_tipo1->tipo->EditValue = ew_HtmlEncode($egresos_tipo1->tipo->CurrentValue);

			// Edit refer script
			// id_tipo

			$egresos_tipo1->id_tipo->HrefValue = "";

			// tipo
			$egresos_tipo1->tipo->HrefValue = "";
		}

		// Call Row Rendered event
		$egresos_tipo1->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $egresos_tipo1;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($egresos_tipo1->tipo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo";
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
		global $conn, $Security, $egresos_tipo1;
		$sFilter = $egresos_tipo1->KeyFilter();
		$egresos_tipo1->CurrentFilter = $sFilter;
		$sSql = $egresos_tipo1->SQL();
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

			// Field id_tipo
			// Field tipo

			$egresos_tipo1->tipo->SetDbValueDef($egresos_tipo1->tipo->CurrentValue, "");
			$rsnew['tipo'] =& $egresos_tipo1->tipo->DbValue;

			// Call Row Updating event
			$bUpdateRow = $egresos_tipo1->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($egresos_tipo1->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($egresos_tipo1->CancelMessage <> "") {
					$this->setMessage($egresos_tipo1->CancelMessage);
					$egresos_tipo1->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$egresos_tipo1->Row_Updated($rsold, $rsnew);
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
