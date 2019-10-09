<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$usuarios_add = new cusuarios_add();
$Page =& $usuarios_add;

// Page init processing
$usuarios_add->Page_Init();

// Page main processing
$usuarios_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_add = new ew_Page("usuarios_add");

// page properties
usuarios_add.PageID = "add"; // page ID
var EW_PAGE_ID = usuarios_add.PageID; // for backward compatibility

// extend page with ValidateForm function
usuarios_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_usuario"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Usuario");
		elm = fobj.elements["x" + infix + "_clave"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Clave");
		elm = fobj.elements["x" + infix + "_Nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
usuarios_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
usuarios_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Usuarios<br><br>
<a href="<?php echo $usuarios->getReturnUrl() ?>">Volver</a></span></p>
<?php $usuarios_add->ShowMessage() ?>
<form name="fusuariosadd" id="fusuariosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuarios_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->usuario->Visible) { // usuario ?>
	<tr<?php echo $usuarios->usuario->RowAttributes ?>>
		<td class="ewTableHeader">Usuario<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>><span id="el_usuario">
<input type="text" name="x_usuario" id="x_usuario" size="30" maxlength="25" value="<?php echo $usuarios->usuario->EditValue ?>"<?php echo $usuarios->usuario->EditAttributes() ?>>
</span><?php echo $usuarios->usuario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->clave->Visible) { // clave ?>
	<tr<?php echo $usuarios->clave->RowAttributes ?>>
		<td class="ewTableHeader">Clave<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $usuarios->clave->CellAttributes() ?>><span id="el_clave">
<input type="password" name="x_clave" id="x_clave" size="30" maxlength="25"<?php echo $usuarios->clave->EditAttributes() ?>>
</span><?php echo $usuarios->clave->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->Nombre->Visible) { // Nombre ?>
	<tr<?php echo $usuarios->Nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>><span id="el_Nombre">
<input type="text" name="x_Nombre" id="x_Nombre" size="30" maxlength="25" value="<?php echo $usuarios->Nombre->EditValue ?>"<?php echo $usuarios->Nombre->EditAttributes() ?>>
</span><?php echo $usuarios->Nombre->CustomMsg ?></td>
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
class cusuarios_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'usuarios';

	// Page Object Name
	var $PageObjName = 'usuarios_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // add page token
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
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cusuarios_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["usuarios"] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $usuarios;
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
		global $objForm, $gsFormError, $usuarios;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["user_id"] != "") {
		  $usuarios->user_id->setQueryStringValue($_GET["user_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $usuarios->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$usuarios->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $usuarios->CurrentAction = "C"; // Copy Record
		  } else {
		    $usuarios->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($usuarios->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("usuarioslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$usuarios->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $usuarios->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "usuariosview.php")
						$sReturnUrl = $usuarios->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$usuarios->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuarios;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $usuarios;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuarios;
		$usuarios->usuario->setFormValue($objForm->GetValue("x_usuario"));
		$usuarios->clave->setFormValue($objForm->GetValue("x_clave"));
		$usuarios->Nombre->setFormValue($objForm->GetValue("x_Nombre"));
		$usuarios->user_id->setFormValue($objForm->GetValue("x_user_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $usuarios;
		$usuarios->user_id->CurrentValue = $usuarios->user_id->FormValue;
		$usuarios->usuario->CurrentValue = $usuarios->usuario->FormValue;
		$usuarios->clave->CurrentValue = $usuarios->clave->FormValue;
		$usuarios->Nombre->CurrentValue = $usuarios->Nombre->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load sql based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$usuarios->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $usuarios;
		$usuarios->user_id->setDbValue($rs->fields('user_id'));
		$usuarios->usuario->setDbValue($rs->fields('usuario'));
		$usuarios->clave->setDbValue($rs->fields('clave'));
		$usuarios->Nombre->setDbValue($rs->fields('Nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $usuarios;

		// Call Row_Rendering event
		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// usuario

		$usuarios->usuario->CellCssStyle = "";
		$usuarios->usuario->CellCssClass = "";

		// clave
		$usuarios->clave->CellCssStyle = "";
		$usuarios->clave->CellCssClass = "";

		// Nombre
		$usuarios->Nombre->CellCssStyle = "";
		$usuarios->Nombre->CellCssClass = "";
		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// user_id
			$usuarios->user_id->ViewValue = $usuarios->user_id->CurrentValue;
			$usuarios->user_id->CssStyle = "";
			$usuarios->user_id->CssClass = "";
			$usuarios->user_id->ViewCustomAttributes = "";

			// usuario
			$usuarios->usuario->ViewValue = $usuarios->usuario->CurrentValue;
			$usuarios->usuario->CssStyle = "";
			$usuarios->usuario->CssClass = "";
			$usuarios->usuario->ViewCustomAttributes = "";

			// clave
			$usuarios->clave->ViewValue = "********";
			$usuarios->clave->CssStyle = "";
			$usuarios->clave->CssClass = "";
			$usuarios->clave->ViewCustomAttributes = "";

			// Nombre
			$usuarios->Nombre->ViewValue = $usuarios->Nombre->CurrentValue;
			$usuarios->Nombre->CssStyle = "";
			$usuarios->Nombre->CssClass = "";
			$usuarios->Nombre->ViewCustomAttributes = "";

			// usuario
			$usuarios->usuario->HrefValue = "";

			// clave
			$usuarios->clave->HrefValue = "";

			// Nombre
			$usuarios->Nombre->HrefValue = "";
		} elseif ($usuarios->RowType == EW_ROWTYPE_ADD) { // Add row

			// usuario
			$usuarios->usuario->EditCustomAttributes = "";
			$usuarios->usuario->EditValue = ew_HtmlEncode($usuarios->usuario->CurrentValue);

			// clave
			$usuarios->clave->EditCustomAttributes = "";
			$usuarios->clave->EditValue = ew_HtmlEncode($usuarios->clave->CurrentValue);

			// Nombre
			$usuarios->Nombre->EditCustomAttributes = "";
			$usuarios->Nombre->EditValue = ew_HtmlEncode($usuarios->Nombre->CurrentValue);
		}

		// Call Row Rendered event
		$usuarios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $usuarios;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($usuarios->usuario->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Usuario";
		}
		if ($usuarios->clave->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Clave";
		}
		if ($usuarios->Nombre->FormValue == "") {
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
		global $conn, $Security, $usuarios;
		$rsnew = array();

		// Field usuario
		$usuarios->usuario->SetDbValueDef($usuarios->usuario->CurrentValue, "");
		$rsnew['usuario'] =& $usuarios->usuario->DbValue;

		// Field clave
		$usuarios->clave->SetDbValueDef($usuarios->clave->CurrentValue, "");
		$rsnew['clave'] =& $usuarios->clave->DbValue;

		// Field Nombre
		$usuarios->Nombre->SetDbValueDef($usuarios->Nombre->CurrentValue, "");
		$rsnew['Nombre'] =& $usuarios->Nombre->DbValue;

		// Call Row Inserting event
		$bInsertRow = $usuarios->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($usuarios->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($usuarios->CancelMessage <> "") {
				$this->setMessage($usuarios->CancelMessage);
				$usuarios->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$usuarios->user_id->setDbValue($conn->Insert_ID());
			$rsnew['user_id'] =& $usuarios->user_id->DbValue;

			// Call Row Inserted event
			$usuarios->Row_Inserted($rsnew);
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
