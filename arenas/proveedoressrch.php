<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "proveedoresinfo.php" ?>
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
$proveedores_search = new cproveedores_search();
$Page =& $proveedores_search;

// Page init processing
$proveedores_search->Page_Init();

// Page main processing
$proveedores_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var proveedores_search = new ew_Page("proveedores_search");

// page properties
proveedores_search.PageID = "search"; // page ID
var EW_PAGE_ID = proveedores_search.PageID; // for backward compatibility

// extend page with validate function for search
proveedores_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id_proveedor"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Entero Incorrecto - Id Proveedor");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	for (var i=0;i<fobj.elements.length;i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
proveedores_search.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
proveedores_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
proveedores_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
proveedores_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Buscar Modulo: Proveedores<br><br>
<a href="<?php echo $proveedores->getReturnUrl() ?>">Volver a la lista</a></span></p>
<?php $proveedores_search->ShowMessage() ?>
<form name="fproveedoressearch" id="fproveedoressearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return proveedores_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="proveedores">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $proveedores->id_proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Id Proveedor</td>
		<td<?php echo $proveedores->id_proveedor->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id_proveedor" id="z_id_proveedor" value="="></span></td>
		<td<?php echo $proveedores->id_proveedor->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_id_proveedor" id="x_id_proveedor" value="<?php echo $proveedores->id_proveedor->EditValue ?>"<?php echo $proveedores->id_proveedor->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $proveedores->nombre->RowAttributes ?>>
		<td class="ewTableHeader">Nombre</td>
		<td<?php echo $proveedores->nombre->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_nombre" id="z_nombre" value="LIKE"></span></td>
		<td<?php echo $proveedores->nombre->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $proveedores->nombre->EditValue ?>"<?php echo $proveedores->nombre->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $proveedores->rnc_cedula->RowAttributes ?>>
		<td class="ewTableHeader">Rnc /cedula</td>
		<td<?php echo $proveedores->rnc_cedula->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_rnc_cedula" id="z_rnc_cedula" value="LIKE"></span></td>
		<td<?php echo $proveedores->rnc_cedula->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_rnc_cedula" id="x_rnc_cedula" size="30" maxlength="255" value="<?php echo $proveedores->rnc_cedula->EditValue ?>"<?php echo $proveedores->rnc_cedula->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $proveedores->telefonos->RowAttributes ?>>
		<td class="ewTableHeader">Telefonos</td>
		<td<?php echo $proveedores->telefonos->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_telefonos" id="z_telefonos" value="LIKE"></span></td>
		<td<?php echo $proveedores->telefonos->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_telefonos" id="x_telefonos" size="30" maxlength="255" value="<?php echo $proveedores->telefonos->EditValue ?>"<?php echo $proveedores->telefonos->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $proveedores->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $proveedores->notas->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_notas" id="z_notas" value="LIKE"></span></td>
		<td<?php echo $proveedores->notas->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<textarea name="x_notas" id="x_notas" cols="35" rows="4"<?php echo $proveedores->notas->EditAttributes() ?>><?php echo $proveedores->notas->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $proveedores->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $proveedores->Empresa->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_Empresa" id="z_Empresa" value="LIKE"></span></td>
		<td<?php echo $proveedores->Empresa->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_Empresa" name="x_Empresa"<?php echo $proveedores->Empresa->EditAttributes() ?>>
<?php
if (is_array($proveedores->Empresa->EditValue)) {
	$arwrk = $proveedores->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($proveedores->Empresa->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span></td>
			</tr></table>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="  Buscar  ">
<input type="button" name="Reset" id="Reset" value=" Reiniciar " onclick="ew_ClearForm(this.form);">
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
class cproveedores_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'proveedores';

	// Page Object Name
	var $PageObjName = 'proveedores_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $proveedores;
		if ($proveedores->UseTokenInUrl) $PageUrl .= "t=" . $proveedores->TableVar . "&"; // add page token
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
		global $objForm, $proveedores;
		if ($proveedores->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($proveedores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($proveedores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproveedores_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["proveedores"] = new cproveedores();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'proveedores', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $proveedores;
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
		global $objForm, $gsSearchError, $proveedores;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$proveedores->CurrentAction = $objForm->GetValue("a_search");
			switch ($proveedores->CurrentAction) {
				case "S": // Get Search Criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $proveedores->UrlParm($sSrchStr);
						$this->Page_Terminate("proveedoreslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$proveedores->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $proveedores;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $proveedores->id_proveedor); // id_proveedor
	$this->BuildSearchUrl($sSrchUrl, $proveedores->nombre); // nombre
	$this->BuildSearchUrl($sSrchUrl, $proveedores->rnc_cedula); // rnc_cedula
	$this->BuildSearchUrl($sSrchUrl, $proveedores->telefonos); // telefonos
	$this->BuildSearchUrl($sSrchUrl, $proveedores->notas); // notas
	$this->BuildSearchUrl($sSrchUrl, $proveedores->Empresa); // Empresa
	return $sSrchUrl;
}

// Function to build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $Fld->FldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $Fld->FldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

	// Convert search value for date
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
			$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		return $Value;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $proveedores;

		// Load search values
		$proveedores->id_proveedor->AdvancedSearch->SearchValue = $objForm->GetValue("x_id_proveedor");
		$proveedores->nombre->AdvancedSearch->SearchValue = $objForm->GetValue("x_nombre");
		$proveedores->rnc_cedula->AdvancedSearch->SearchValue = $objForm->GetValue("x_rnc_cedula");
		$proveedores->telefonos->AdvancedSearch->SearchValue = $objForm->GetValue("x_telefonos");
		$proveedores->notas->AdvancedSearch->SearchValue = $objForm->GetValue("x_notas");
		$proveedores->Empresa->AdvancedSearch->SearchValue = $objForm->GetValue("x_Empresa");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $proveedores;

		// Call Row_Rendering event
		$proveedores->Row_Rendering();

		// Common render codes for all row types
		// id_proveedor

		$proveedores->id_proveedor->CellCssStyle = "";
		$proveedores->id_proveedor->CellCssClass = "";

		// nombre
		$proveedores->nombre->CellCssStyle = "";
		$proveedores->nombre->CellCssClass = "";

		// rnc_cedula
		$proveedores->rnc_cedula->CellCssStyle = "";
		$proveedores->rnc_cedula->CellCssClass = "";

		// telefonos
		$proveedores->telefonos->CellCssStyle = "";
		$proveedores->telefonos->CellCssClass = "";

		// notas
		$proveedores->notas->CellCssStyle = "";
		$proveedores->notas->CellCssClass = "";

		// Empresa
		$proveedores->Empresa->CellCssStyle = "";
		$proveedores->Empresa->CellCssClass = "";
		if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_proveedor
			$proveedores->id_proveedor->ViewValue = $proveedores->id_proveedor->CurrentValue;
			$proveedores->id_proveedor->CssStyle = "";
			$proveedores->id_proveedor->CssClass = "";
			$proveedores->id_proveedor->ViewCustomAttributes = "";

			// nombre
			$proveedores->nombre->ViewValue = $proveedores->nombre->CurrentValue;
			$proveedores->nombre->CssStyle = "";
			$proveedores->nombre->CssClass = "";
			$proveedores->nombre->ViewCustomAttributes = "";

			// rnc_cedula
			$proveedores->rnc_cedula->ViewValue = $proveedores->rnc_cedula->CurrentValue;
			$proveedores->rnc_cedula->CssStyle = "";
			$proveedores->rnc_cedula->CssClass = "";
			$proveedores->rnc_cedula->ViewCustomAttributes = "";

			// telefonos
			$proveedores->telefonos->ViewValue = $proveedores->telefonos->CurrentValue;
			$proveedores->telefonos->CssStyle = "";
			$proveedores->telefonos->CssClass = "";
			$proveedores->telefonos->ViewCustomAttributes = "";

			// notas
			$proveedores->notas->ViewValue = $proveedores->notas->CurrentValue;
			$proveedores->notas->CssStyle = "";
			$proveedores->notas->CssClass = "";
			$proveedores->notas->ViewCustomAttributes = "";

			// Empresa
			if (strval($proveedores->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($proveedores->Empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$proveedores->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$proveedores->Empresa->ViewValue = $proveedores->Empresa->CurrentValue;
				}
			} else {
				$proveedores->Empresa->ViewValue = NULL;
			}
			$proveedores->Empresa->CssStyle = "";
			$proveedores->Empresa->CssClass = "";
			$proveedores->Empresa->ViewCustomAttributes = "";

			// id_proveedor
			$proveedores->id_proveedor->HrefValue = "";

			// nombre
			$proveedores->nombre->HrefValue = "";

			// rnc_cedula
			$proveedores->rnc_cedula->HrefValue = "";

			// telefonos
			$proveedores->telefonos->HrefValue = "";

			// notas
			$proveedores->notas->HrefValue = "";

			// Empresa
			$proveedores->Empresa->HrefValue = "";
		} elseif ($proveedores->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_proveedor
			$proveedores->id_proveedor->EditCustomAttributes = "";
			$proveedores->id_proveedor->EditValue = ew_HtmlEncode($proveedores->id_proveedor->AdvancedSearch->SearchValue);

			// nombre
			$proveedores->nombre->EditCustomAttributes = "";
			$proveedores->nombre->EditValue = ew_HtmlEncode($proveedores->nombre->AdvancedSearch->SearchValue);

			// rnc_cedula
			$proveedores->rnc_cedula->EditCustomAttributes = "";
			$proveedores->rnc_cedula->EditValue = ew_HtmlEncode($proveedores->rnc_cedula->AdvancedSearch->SearchValue);

			// telefonos
			$proveedores->telefonos->EditCustomAttributes = "";
			$proveedores->telefonos->EditValue = ew_HtmlEncode($proveedores->telefonos->AdvancedSearch->SearchValue);

			// notas
			$proveedores->notas->EditCustomAttributes = "";
			$proveedores->notas->EditValue = ew_HtmlEncode($proveedores->notas->AdvancedSearch->SearchValue);

			// Empresa
			$proveedores->Empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$proveedores->Empresa->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$proveedores->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $proveedores;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($proveedores->id_proveedor->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Entero Incorrecto - Id Proveedor";
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $proveedores;
		$proveedores->id_proveedor->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_id_proveedor");
		$proveedores->nombre->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_nombre");
		$proveedores->rnc_cedula->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_rnc_cedula");
		$proveedores->telefonos->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_telefonos");
		$proveedores->notas->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_notas");
		$proveedores->Empresa->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_Empresa");
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
