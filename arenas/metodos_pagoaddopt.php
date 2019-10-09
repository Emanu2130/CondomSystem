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
$metodos_pago_addopt = new cmetodos_pago_addopt();
$Page =& $metodos_pago_addopt;

// Page init processing
$metodos_pago_addopt->Page_Init();

// Page main processing
$metodos_pago_addopt->Page_Main();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $metodos_pago_addopt->ShowMessage() ?>
<form name="fmetodos_pagoaddopt" id="fmetodos_pagoaddopt" action="metodos_pagoaddopt.php" method="post" onsubmit="return metodos_pago_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="metodos_pago">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td>Metodo<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_metodo">
<input type="text" name="x_metodo" id="x_metodo" size="30" maxlength="255" value="<?php echo $metodos_pago->metodo->EditValue ?>"<?php echo $metodos_pago->metodo->EditAttributes() ?>>
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
class cmetodos_pago_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table Name
	var $TableName = 'metodos_pago';

	// Page Object Name
	var $PageObjName = 'metodos_pago_addopt';

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
	function cmetodos_pago_addopt() {
		global $conn;

		// Initialize table object
		$GLOBALS["metodos_pago"] = new cmetodos_pago();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

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
		global $objForm, $gsFormError, $metodos_pago;

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$metodos_pago->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$metodos_pago->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$metodos_pago->CurrentAction = "I"; // Display Blank Record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($metodos_pago->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$metodos_pago->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("root");
					$XMLDoc->Encoding = "utf-8";
					$XMLDoc->BeginRow("result");
					$XMLDoc->AddField("x_id_metodo", strval($metodos_pago->id_metodo->DbValue));
					$XMLDoc->AddField("x_metodo", strval($metodos_pago->metodo->FormValue));
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
		$metodos_pago->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $metodos_pago;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $metodos_pago;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $metodos_pago;
		$metodos_pago->metodo->setFormValue($objForm->GetValue("x_metodo"));
		$metodos_pago->id_metodo->setFormValue($objForm->GetValue("x_id_metodo"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $metodos_pago;
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

			// metodo
			$metodos_pago->metodo->HrefValue = "";
		} elseif ($metodos_pago->RowType == EW_ROWTYPE_ADD) { // Add row

			// metodo
			$metodos_pago->metodo->EditCustomAttributes = "";
			$metodos_pago->metodo->EditValue = ew_HtmlEncode($metodos_pago->metodo->CurrentValue);
		}

		// Call Row Rendered event
		$metodos_pago->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $metodos_pago;

		// Initialize
		$gsFormError = "";
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

	// Add record
	function AddRow() {
		global $conn, $Security, $metodos_pago;
		$rsnew = array();

		// Field metodo
		$metodos_pago->metodo->SetDbValueDef($metodos_pago->metodo->CurrentValue, "");
		$rsnew['metodo'] =& $metodos_pago->metodo->DbValue;

		// Call Row Inserting event
		$bInsertRow = $metodos_pago->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($metodos_pago->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($metodos_pago->CancelMessage <> "") {
				$this->setMessage($metodos_pago->CancelMessage);
				$metodos_pago->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$metodos_pago->id_metodo->setDbValue($conn->Insert_ID());
			$rsnew['id_metodo'] =& $metodos_pago->id_metodo->DbValue;

			// Call Row Inserted event
			$metodos_pago->Row_Inserted($rsnew);
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
