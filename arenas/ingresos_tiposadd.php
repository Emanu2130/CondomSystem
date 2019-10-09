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
$ingresos_tipos_add = new cingresos_tipos_add();
$Page =& $ingresos_tipos_add;

// Page init processing
$ingresos_tipos_add->Page_Init();

// Page main processing
$ingresos_tipos_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_tipos_add = new ew_Page("ingresos_tipos_add");

// page properties
ingresos_tipos_add.PageID = "add"; // page ID
var EW_PAGE_ID = ingresos_tipos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
ingresos_tipos_add.ValidateForm = function(fobj) {
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

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
ingresos_tipos_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_tipos_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_tipos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_tipos_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Ingresos Tipos<br><br>
<a href="<?php echo $ingresos_tipos->getReturnUrl() ?>">Volver</a></span></p>
<?php $ingresos_tipos_add->ShowMessage() ?>
<form name="fingresos_tiposadd" id="fingresos_tiposadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ingresos_tipos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="ingresos_tipos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($ingresos_tipos->nombre->Visible) { // nombre ?>
	<tr<?php echo $ingresos_tipos->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos_tipos->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $ingresos_tipos->nombre->EditValue ?>"<?php echo $ingresos_tipos->nombre->EditAttributes() ?>>
</span><?php echo $ingresos_tipos->nombre->CustomMsg ?></td>
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
class cingresos_tipos_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'ingresos_tipos';

	// Page Object Name
	var $PageObjName = 'ingresos_tipos_add';

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
	function cingresos_tipos_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["ingresos_tipos"] = new cingresos_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $gsFormError, $ingresos_tipos;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_ingresos"] != "") {
		  $ingresos_tipos->id_ingresos->setQueryStringValue($_GET["id_ingresos"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $ingresos_tipos->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$ingresos_tipos->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $ingresos_tipos->CurrentAction = "C"; // Copy Record
		  } else {
		    $ingresos_tipos->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($ingresos_tipos->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("ingresos_tiposlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$ingresos_tipos->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $ingresos_tipos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "ingresos_tiposview.php")
						$sReturnUrl = $ingresos_tipos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$ingresos_tipos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
