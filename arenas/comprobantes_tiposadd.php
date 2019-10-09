<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "comprobantes_tiposinfo.php" ?>
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
$comprobantes_tipos_add = new ccomprobantes_tipos_add();
$Page =& $comprobantes_tipos_add;

// Page init processing
$comprobantes_tipos_add->Page_Init();

// Page main processing
$comprobantes_tipos_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comprobantes_tipos_add = new ew_Page("comprobantes_tipos_add");

// page properties
comprobantes_tipos_add.PageID = "add"; // page ID
var EW_PAGE_ID = comprobantes_tipos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
comprobantes_tipos_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_nombre_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre Tipo");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
comprobantes_tipos_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
comprobantes_tipos_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
comprobantes_tipos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comprobantes_tipos_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Comprobantes Tipos<br><br>
<a href="<?php echo $comprobantes_tipos->getReturnUrl() ?>">Volver</a></span></p>
<?php $comprobantes_tipos_add->ShowMessage() ?>
<form name="fcomprobantes_tiposadd" id="fcomprobantes_tiposadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return comprobantes_tipos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="comprobantes_tipos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($comprobantes_tipos->nombre_tipo->Visible) { // nombre_tipo ?>
	<tr<?php echo $comprobantes_tipos->nombre_tipo->RowAttributes ?>>
		<td class="ewTableHeader">Nombre Tipo<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $comprobantes_tipos->nombre_tipo->CellAttributes() ?>><span id="el_nombre_tipo">
<input type="text" name="x_nombre_tipo" id="x_nombre_tipo" size="30" maxlength="225" value="<?php echo $comprobantes_tipos->nombre_tipo->EditValue ?>"<?php echo $comprobantes_tipos->nombre_tipo->EditAttributes() ?>>
</span><?php echo $comprobantes_tipos->nombre_tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comprobantes_tipos->descripcion->Visible) { // descripcion ?>
	<tr<?php echo $comprobantes_tipos->descripcion->RowAttributes ?>>
		<td class="ewTableHeader">Descripcion</td>
		<td<?php echo $comprobantes_tipos->descripcion->CellAttributes() ?>><span id="el_descripcion">
<textarea name="x_descripcion" id="x_descripcion" cols="35" rows="4"<?php echo $comprobantes_tipos->descripcion->EditAttributes() ?>><?php echo $comprobantes_tipos->descripcion->EditValue ?></textarea>
</span><?php echo $comprobantes_tipos->descripcion->CustomMsg ?></td>
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
class ccomprobantes_tipos_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'comprobantes_tipos';

	// Page Object Name
	var $PageObjName = 'comprobantes_tipos_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comprobantes_tipos;
		if ($comprobantes_tipos->UseTokenInUrl) $PageUrl .= "t=" . $comprobantes_tipos->TableVar . "&"; // add page token
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
		global $objForm, $comprobantes_tipos;
		if ($comprobantes_tipos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($comprobantes_tipos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comprobantes_tipos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccomprobantes_tipos_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["comprobantes_tipos"] = new ccomprobantes_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comprobantes_tipos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $comprobantes_tipos;
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
		global $objForm, $gsFormError, $comprobantes_tipos;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_comprobante"] != "") {
		  $comprobantes_tipos->id_comprobante->setQueryStringValue($_GET["id_comprobante"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $comprobantes_tipos->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$comprobantes_tipos->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $comprobantes_tipos->CurrentAction = "C"; // Copy Record
		  } else {
		    $comprobantes_tipos->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($comprobantes_tipos->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("comprobantes_tiposlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$comprobantes_tipos->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $comprobantes_tipos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "comprobantes_tiposview.php")
						$sReturnUrl = $comprobantes_tipos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$comprobantes_tipos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $comprobantes_tipos;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $comprobantes_tipos;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $comprobantes_tipos;
		$comprobantes_tipos->nombre_tipo->setFormValue($objForm->GetValue("x_nombre_tipo"));
		$comprobantes_tipos->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		$comprobantes_tipos->id_comprobante->setFormValue($objForm->GetValue("x_id_comprobante"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $comprobantes_tipos;
		$comprobantes_tipos->id_comprobante->CurrentValue = $comprobantes_tipos->id_comprobante->FormValue;
		$comprobantes_tipos->nombre_tipo->CurrentValue = $comprobantes_tipos->nombre_tipo->FormValue;
		$comprobantes_tipos->descripcion->CurrentValue = $comprobantes_tipos->descripcion->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comprobantes_tipos;
		$sFilter = $comprobantes_tipos->KeyFilter();

		// Call Row Selecting event
		$comprobantes_tipos->Row_Selecting($sFilter);

		// Load sql based on filter
		$comprobantes_tipos->CurrentFilter = $sFilter;
		$sSql = $comprobantes_tipos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$comprobantes_tipos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $comprobantes_tipos;
		$comprobantes_tipos->id_comprobante->setDbValue($rs->fields('id_comprobante'));
		$comprobantes_tipos->nombre_tipo->setDbValue($rs->fields('nombre_tipo'));
		$comprobantes_tipos->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $comprobantes_tipos;

		// Call Row_Rendering event
		$comprobantes_tipos->Row_Rendering();

		// Common render codes for all row types
		// nombre_tipo

		$comprobantes_tipos->nombre_tipo->CellCssStyle = "";
		$comprobantes_tipos->nombre_tipo->CellCssClass = "";

		// descripcion
		$comprobantes_tipos->descripcion->CellCssStyle = "";
		$comprobantes_tipos->descripcion->CellCssClass = "";
		if ($comprobantes_tipos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_comprobante
			$comprobantes_tipos->id_comprobante->ViewValue = $comprobantes_tipos->id_comprobante->CurrentValue;
			$comprobantes_tipos->id_comprobante->CssStyle = "";
			$comprobantes_tipos->id_comprobante->CssClass = "";
			$comprobantes_tipos->id_comprobante->ViewCustomAttributes = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->ViewValue = $comprobantes_tipos->nombre_tipo->CurrentValue;
			$comprobantes_tipos->nombre_tipo->CssStyle = "";
			$comprobantes_tipos->nombre_tipo->CssClass = "";
			$comprobantes_tipos->nombre_tipo->ViewCustomAttributes = "";

			// descripcion
			$comprobantes_tipos->descripcion->ViewValue = $comprobantes_tipos->descripcion->CurrentValue;
			$comprobantes_tipos->descripcion->CssStyle = "";
			$comprobantes_tipos->descripcion->CssClass = "";
			$comprobantes_tipos->descripcion->ViewCustomAttributes = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->HrefValue = "";

			// descripcion
			$comprobantes_tipos->descripcion->HrefValue = "";
		} elseif ($comprobantes_tipos->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->EditCustomAttributes = "";
			$comprobantes_tipos->nombre_tipo->EditValue = ew_HtmlEncode($comprobantes_tipos->nombre_tipo->CurrentValue);

			// descripcion
			$comprobantes_tipos->descripcion->EditCustomAttributes = "";
			$comprobantes_tipos->descripcion->EditValue = ew_HtmlEncode($comprobantes_tipos->descripcion->CurrentValue);
		}

		// Call Row Rendered event
		$comprobantes_tipos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $comprobantes_tipos;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($comprobantes_tipos->nombre_tipo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Nombre Tipo";
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
		global $conn, $Security, $comprobantes_tipos;
		$rsnew = array();

		// Field nombre_tipo
		$comprobantes_tipos->nombre_tipo->SetDbValueDef($comprobantes_tipos->nombre_tipo->CurrentValue, "");
		$rsnew['nombre_tipo'] =& $comprobantes_tipos->nombre_tipo->DbValue;

		// Field descripcion
		$comprobantes_tipos->descripcion->SetDbValueDef($comprobantes_tipos->descripcion->CurrentValue, NULL);
		$rsnew['descripcion'] =& $comprobantes_tipos->descripcion->DbValue;

		// Call Row Inserting event
		$bInsertRow = $comprobantes_tipos->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($comprobantes_tipos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($comprobantes_tipos->CancelMessage <> "") {
				$this->setMessage($comprobantes_tipos->CancelMessage);
				$comprobantes_tipos->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$comprobantes_tipos->id_comprobante->setDbValue($conn->Insert_ID());
			$rsnew['id_comprobante'] =& $comprobantes_tipos->id_comprobante->DbValue;

			// Call Row Inserted event
			$comprobantes_tipos->Row_Inserted($rsnew);
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
