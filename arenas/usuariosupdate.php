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
$usuarios_update = new cusuarios_update();
$Page =& $usuarios_update;

// Page init processing
$usuarios_update->Page_Init();

// Page main processing
$usuarios_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_update = new ew_Page("usuarios_update");

// page properties
usuarios_update.PageID = "update"; // page ID
var EW_PAGE_ID = usuarios_update.PageID; // for backward compatibility

// extend page with ValidateForm function
usuarios_update.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert('No se ha seleccionado campo a actualizar');
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_usuario"];
		uelm = fobj.elements["u" + infix + "_usuario"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Usuario");
		}
		elm = fobj.elements["x" + infix + "_clave"];
		uelm = fobj.elements["u" + infix + "_clave"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Clave");
		}
		elm = fobj.elements["x" + infix + "_Nombre"];
		uelm = fobj.elements["u" + infix + "_Nombre"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
usuarios_update.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
usuarios_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_update.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Actualizar Modulo: Usuarios<br><br>
<a href="<?php echo $usuarios->getReturnUrl() ?>">Volver a la lista</a></span></p>
<?php $usuarios_update->ShowMessage() ?>
<form name="fusuariosupdate" id="fusuariosupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuarios_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $usuarios_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($usuarios_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Actualizar<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Nombre del campo</td>
		<td>Nuevo valor</td>
	</tr>
<?php if ($usuarios->usuario->Visible) { // usuario ?>
	<tr<?php echo $usuarios->usuario->RowAttributes ?>>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>>
<input type="checkbox" name="u_usuario" id="u_usuario" value="1"<?php echo ($usuarios->usuario->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>>Usuario</td>
		<td<?php echo $usuarios->usuario->CellAttributes() ?>><span id="el_usuario">
<input type="text" name="x_usuario" id="x_usuario" size="30" maxlength="25" value="<?php echo $usuarios->usuario->EditValue ?>"<?php echo $usuarios->usuario->EditAttributes() ?>>
</span><?php echo $usuarios->usuario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->clave->Visible) { // clave ?>
	<tr<?php echo $usuarios->clave->RowAttributes ?>>
		<td<?php echo $usuarios->clave->CellAttributes() ?>>
<input type="checkbox" name="u_clave" id="u_clave" value="1"<?php echo ($usuarios->clave->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $usuarios->clave->CellAttributes() ?>>Clave</td>
		<td<?php echo $usuarios->clave->CellAttributes() ?>><span id="el_clave">
<input type="password" name="x_clave" id="x_clave" value="<?php echo $usuarios->clave->EditValue ?>" size="30" maxlength="25"<?php echo $usuarios->clave->EditAttributes() ?>>
</span><?php echo $usuarios->clave->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->Nombre->Visible) { // Nombre ?>
	<tr<?php echo $usuarios->Nombre->RowAttributes ?>>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>>
<input type="checkbox" name="u_Nombre" id="u_Nombre" value="1"<?php echo ($usuarios->Nombre->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>>Nombre</td>
		<td<?php echo $usuarios->Nombre->CellAttributes() ?>><span id="el_Nombre">
<input type="text" name="x_Nombre" id="x_Nombre" size="30" maxlength="25" value="<?php echo $usuarios->Nombre->EditValue ?>"<?php echo $usuarios->Nombre->EditAttributes() ?>>
</span><?php echo $usuarios->Nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="Actualizar">
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
class cusuarios_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'usuarios';

	// Page Object Name
	var $PageObjName = 'usuarios_update';

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
	function cusuarios_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["usuarios"] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

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
	var $nKeySelected;
	var $arRecKeys;
	var $sDisabled;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $usuarios;

		// Try to load keys from list form
		$this->nKeySelected = 0;
		if (ew_IsHttpPost()) {
			if (isset($_POST["key_m"])) { // Key count > 0
				$this->nKeySelected = count($_POST["key_m"]); // Get number of keys
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
				$this->LoadMultiUpdateValues(); // Load initial values to form
			}
		}

		// Try to load key from update form
		if ($this->nKeySelected == 0) {
			$this->arRecKeys = array();

			// Create form object
			$objForm = new cFormObj();
			if (@$_POST["a_update"] <> "") {

				// Get action
				$usuarios->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$usuarios->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("usuarioslist.php"); // No records selected, return to list
		switch ($usuarios->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Actualizar completado"); // Set update success message
					$this->Page_Terminate($usuarios->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$usuarios->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $usuarios;
		$usuarios->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$usuarios->usuario->setDbValue($rs->fields('usuario'));
				$usuarios->clave->setDbValue($rs->fields('clave'));
				$usuarios->Nombre->setDbValue($rs->fields('Nombre'));
			} else {
				if (!ew_CompareValue($usuarios->usuario->DbValue, $rs->fields('usuario')))
					$usuarios->usuario->CurrentValue = NULL;
				if (!ew_CompareValue($usuarios->clave->DbValue, $rs->fields('clave')))
					$usuarios->clave->CurrentValue = NULL;
				if (!ew_CompareValue($usuarios->Nombre->DbValue, $rs->fields('Nombre')))
					$usuarios->Nombre->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $usuarios;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $usuarios->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}
		}
		return $sWrkFilter;
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $usuarios;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$usuarios->user_id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $usuarios;
		$conn->BeginTrans();

		// Get old recordset
		$usuarios->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $usuarios->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$usuarios->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuarios;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuarios;
		$usuarios->usuario->setFormValue($objForm->GetValue("x_usuario"));
		$usuarios->usuario->MultiUpdate = $objForm->GetValue("u_usuario");
		$usuarios->clave->setFormValue($objForm->GetValue("x_clave"));
		$usuarios->clave->MultiUpdate = $objForm->GetValue("u_clave");
		$usuarios->Nombre->setFormValue($objForm->GetValue("x_Nombre"));
		$usuarios->Nombre->MultiUpdate = $objForm->GetValue("u_Nombre");
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

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuarios;

		// Call Recordset Selecting event
		$usuarios->Recordset_Selecting($usuarios->CurrentFilter);

		// Load list page SQL
		$sSql = $usuarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$usuarios->Recordset_Selected($rs);
		return $rs;
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
		} elseif ($usuarios->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// usuario
			$usuarios->usuario->EditCustomAttributes = "";
			$usuarios->usuario->EditValue = ew_HtmlEncode($usuarios->usuario->CurrentValue);

			// clave
			$usuarios->clave->EditCustomAttributes = "";
			$usuarios->clave->EditValue = ew_HtmlEncode($usuarios->clave->CurrentValue);

			// Nombre
			$usuarios->Nombre->EditCustomAttributes = "";
			$usuarios->Nombre->EditValue = ew_HtmlEncode($usuarios->Nombre->CurrentValue);

			// Edit refer script
			// usuario

			$usuarios->usuario->HrefValue = "";

			// clave
			$usuarios->clave->HrefValue = "";

			// Nombre
			$usuarios->Nombre->HrefValue = "";
		}

		// Call Row Rendered event
		$usuarios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $usuarios;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($usuarios->usuario->MultiUpdate == "1") $lUpdateCnt++;
		if ($usuarios->clave->MultiUpdate == "1") $lUpdateCnt++;
		if ($usuarios->Nombre->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No se ha seleccionado campo a actualizar";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($usuarios->usuario->MultiUpdate <> "" && $usuarios->usuario->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Usuario";
		}
		if ($usuarios->clave->MultiUpdate <> "" && $usuarios->clave->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Clave";
		}
		if ($usuarios->Nombre->MultiUpdate <> "" && $usuarios->Nombre->FormValue == "") {
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
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

			// Field usuario
			if ($usuarios->usuario->MultiUpdate == "1") {
			$usuarios->usuario->SetDbValueDef($usuarios->usuario->CurrentValue, "");
			$rsnew['usuario'] =& $usuarios->usuario->DbValue;
			}

			// Field clave
			if ($usuarios->clave->MultiUpdate == "1") {
			$usuarios->clave->SetDbValueDef($usuarios->clave->CurrentValue, "");
			$rsnew['clave'] =& $usuarios->clave->DbValue;
			}

			// Field Nombre
			if ($usuarios->Nombre->MultiUpdate == "1") {
			$usuarios->Nombre->SetDbValueDef($usuarios->Nombre->CurrentValue, "");
			$rsnew['Nombre'] =& $usuarios->Nombre->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $usuarios->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($usuarios->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($usuarios->CancelMessage <> "") {
					$this->setMessage($usuarios->CancelMessage);
					$usuarios->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$usuarios->Row_Updated($rsold, $rsnew);
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
