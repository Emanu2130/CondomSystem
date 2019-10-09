<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "ingresos_tiposinfo.php" ?>
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
$ingresos_tipos_addopt = new cingresos_tipos_addopt();
$Page =& $ingresos_tipos_addopt;

// Page init processing
$ingresos_tipos_addopt->Page_Init();

// Page main processing
$ingresos_tipos_addopt->Page_Main();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $ingresos_tipos_addopt->ShowMessage() ?>
<form name="fingresos_tiposaddopt" id="fingresos_tiposaddopt" action="ingresos_tiposaddopt.php" method="post" onsubmit="return ingresos_tipos_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="ingresos_tipos">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td>Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $ingresos_tipos->nombre->EditValue ?>"<?php echo $ingresos_tipos->nombre->EditAttributes() ?>>
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
class cingresos_tipos_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table Name
	var $TableName = 'ingresos_tipos';

	// Page Object Name
	var $PageObjName = 'ingresos_tipos_addopt';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ingresos_tipos;
		if ($ingresos_tipos->UseTokenInUrl) $PageUrl .= "t=" . $ingresos_tipos->TableVar . "&"; // add page token
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
		global $objForm, $ingresos_tipos;
		if ($ingresos_tipos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($ingresos_tipos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ingresos_tipos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cingresos_tipos_addopt() {
		global $conn;

		// Initialize table object
		$GLOBALS["ingresos_tipos"] = new cingresos_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ingresos_tipos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ingresos_tipos;
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
		global $objForm, $gsFormError, $ingresos_tipos;

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$ingresos_tipos->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$ingresos_tipos->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$ingresos_tipos->CurrentAction = "I"; // Display Blank Record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($ingresos_tipos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$ingresos_tipos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("root");
					$XMLDoc->Encoding = "utf-8";
					$XMLDoc->BeginRow("result");
					$XMLDoc->AddField("x_id_ingresos", strval($ingresos_tipos->id_ingresos->DbValue));
					$XMLDoc->AddField("x_nombre", strval($ingresos_tipos->nombre->FormValue));
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
		$ingresos_tipos->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $ingresos_tipos;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $ingresos_tipos;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ingresos_tipos;
		$ingresos_tipos->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$ingresos_tipos->id_ingresos->setFormValue($objForm->GetValue("x_id_ingresos"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $ingresos_tipos;
		$ingresos_tipos->id_ingresos->CurrentValue = $ingresos_tipos->id_ingresos->FormValue;
		$ingresos_tipos->nombre->CurrentValue = $ingresos_tipos->nombre->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ingresos_tipos;
		$sFilter = $ingresos_tipos->KeyFilter();

		// Call Row Selecting event
		$ingresos_tipos->Row_Selecting($sFilter);

		// Load sql based on filter
		$ingresos_tipos->CurrentFilter = $sFilter;
		$sSql = $ingresos_tipos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$ingresos_tipos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $ingresos_tipos;
		$ingresos_tipos->id_ingresos->setDbValue($rs->fields('id_ingresos'));
		$ingresos_tipos->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $ingresos_tipos;

		// Call Row_Rendering event
		$ingresos_tipos->Row_Rendering();

		// Common render codes for all row types
		// nombre

		$ingresos_tipos->nombre->CellCssStyle = "";
		$ingresos_tipos->nombre->CellCssClass = "";
		if ($ingresos_tipos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ingresos
			$ingresos_tipos->id_ingresos->ViewValue = $ingresos_tipos->id_ingresos->CurrentValue;
			$ingresos_tipos->id_ingresos->CssStyle = "";
			$ingresos_tipos->id_ingresos->CssClass = "";
			$ingresos_tipos->id_ingresos->ViewCustomAttributes = "";

			// nombre
			$ingresos_tipos->nombre->ViewValue = $ingresos_tipos->nombre->CurrentValue;
			$ingresos_tipos->nombre->CssStyle = "";
			$ingresos_tipos->nombre->CssClass = "";
			$ingresos_tipos->nombre->ViewCustomAttributes = "";

			// nombre
			$ingresos_tipos->nombre->HrefValue = "";
		} elseif ($ingresos_tipos->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$ingresos_tipos->nombre->EditCustomAttributes = "";
			$ingresos_tipos->nombre->EditValue = ew_HtmlEncode($ingresos_tipos->nombre->CurrentValue);
		}

		// Call Row Rendered event
		$ingresos_tipos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $ingresos_tipos;

		// Initialize
		$gsFormError = "";
		if ($ingresos_tipos->nombre->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $ingresos_tipos;
		$rsnew = array();

		// Field nombre
		$ingresos_tipos->nombre->SetDbValueDef($ingresos_tipos->nombre->CurrentValue, "");
		$rsnew['nombre'] =& $ingresos_tipos->nombre->DbValue;

		// Call Row Inserting event
		$bInsertRow = $ingresos_tipos->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($ingresos_tipos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($ingresos_tipos->CancelMessage <> "") {
				$this->setMessage($ingresos_tipos->CancelMessage);
				$ingresos_tipos->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$ingresos_tipos->id_ingresos->setDbValue($conn->Insert_ID());
			$rsnew['id_ingresos'] =& $ingresos_tipos->id_ingresos->DbValue;

			// Call Row Inserted event
			$ingresos_tipos->Row_Inserted($rsnew);
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
