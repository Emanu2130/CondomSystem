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
$egresos_tipo1_add = new cegresos_tipo1_add();
$Page =& $egresos_tipo1_add;

// Page init processing
$egresos_tipo1_add->Page_Init();

// Page main processing
$egresos_tipo1_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_tipo1_add = new ew_Page("egresos_tipo1_add");

// page properties
egresos_tipo1_add.PageID = "add"; // page ID
var EW_PAGE_ID = egresos_tipo1_add.PageID; // for backward compatibility

// extend page with ValidateForm function
egresos_tipo1_add.ValidateForm = function(fobj) {
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
egresos_tipo1_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_tipo1_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_tipo1_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_tipo1_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Egresos Tipo 1<br><br>
<a href="<?php echo $egresos_tipo1->getReturnUrl() ?>">Volver</a></span></p>
<?php $egresos_tipo1_add->ShowMessage() ?>
<form name="fegresos_tipo1add" id="fegresos_tipo1add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return egresos_tipo1_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="egresos_tipo1">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
class cegresos_tipo1_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'egresos_tipo1';

	// Page Object Name
	var $PageObjName = 'egresos_tipo1_add';

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
	function cegresos_tipo1_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos_tipo1"] = new cegresos_tipo1();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $egresos_tipo1;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_tipo"] != "") {
		  $egresos_tipo1->id_tipo->setQueryStringValue($_GET["id_tipo"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $egresos_tipo1->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$egresos_tipo1->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $egresos_tipo1->CurrentAction = "C"; // Copy Record
		  } else {
		    $egresos_tipo1->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($egresos_tipo1->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("egresos_tipo1list.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$egresos_tipo1->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $egresos_tipo1->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "egresos_tipo1view.php")
						$sReturnUrl = $egresos_tipo1->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$egresos_tipo1->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $egresos_tipo1;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $egresos_tipo1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $egresos_tipo1;
		$egresos_tipo1->tipo->setFormValue($objForm->GetValue("x_tipo"));
		$egresos_tipo1->id_tipo->setFormValue($objForm->GetValue("x_id_tipo"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $egresos_tipo1;
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

			// tipo
			$egresos_tipo1->tipo->HrefValue = "";
		} elseif ($egresos_tipo1->RowType == EW_ROWTYPE_ADD) { // Add row

			// tipo
			$egresos_tipo1->tipo->EditCustomAttributes = "";
			$egresos_tipo1->tipo->EditValue = ew_HtmlEncode($egresos_tipo1->tipo->CurrentValue);
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

	// Add record
	function AddRow() {
		global $conn, $Security, $egresos_tipo1;
		$rsnew = array();

		// Field tipo
		$egresos_tipo1->tipo->SetDbValueDef($egresos_tipo1->tipo->CurrentValue, "");
		$rsnew['tipo'] =& $egresos_tipo1->tipo->DbValue;

		// Call Row Inserting event
		$bInsertRow = $egresos_tipo1->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($egresos_tipo1->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($egresos_tipo1->CancelMessage <> "") {
				$this->setMessage($egresos_tipo1->CancelMessage);
				$egresos_tipo1->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$egresos_tipo1->id_tipo->setDbValue($conn->Insert_ID());
			$rsnew['id_tipo'] =& $egresos_tipo1->id_tipo->DbValue;

			// Call Row Inserted event
			$egresos_tipo1->Row_Inserted($rsnew);
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
