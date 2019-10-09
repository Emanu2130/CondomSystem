<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "egresosinfo.php" ?>
<?php include "usuariosinfo.php" ?>
<?php include "proveedoresinfo.php" ?>
<?php include "locacionesinfo.php" ?>
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
$egresos_delete = new cegresos_delete();
$Page =& $egresos_delete;

// Page init processing
$egresos_delete->Page_Init();

// Page main processing
$egresos_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_delete = new ew_Page("egresos_delete");

// page properties
egresos_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = egresos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
egresos_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
$rs = $egresos_delete->LoadRecordset();
$egresos_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($egresos_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$egresos_delete->Page_Terminate("egresoslist.php"); // Return to list
}
?>
<p><span class="arenas">Eliminar Modulo: Egresos<br><br>
<a href="<?php echo $egresos->getReturnUrl() ?>">Volver</a></span></p>
<?php $egresos_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="egresos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($egresos_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $egresos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Pago</td>
		<td valign="top">Estado</td>
		<td valign="top">Total Rd</td>
		<td valign="top">Total Us</td>
		<td valign="top">Total Euros</td>
		<td valign="top">Impuestos Pagados</td>
		<td valign="top">Numero Referencia</td>
		<td valign="top">Tipo Comprobante</td>
		<td valign="top">NCF</td>
		<td valign="top">Metodo Pago</td>
		<td valign="top">Proveedor</td>
		<td valign="top">Fecha</td>
		<td valign="top">Tipo egreso</td>
		<td valign="top">Empresa</td>
		<td valign="top">Locacion</td>
		<td valign="top">Cuenta Banco</td>
	</tr>
	</thead>
	<tbody>
<?php
$egresos_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$egresos_delete->lRecCnt++;

	// Set row properties
	$egresos->CssClass = "";
	$egresos->CssStyle = "";
	$egresos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$egresos_delete->LoadRowValues($rs);

	// Render row
	$egresos_delete->RenderRow();
?>
	<tr<?php echo $egresos->RowAttributes() ?>>
		<td<?php echo $egresos->id_pago->CellAttributes() ?>>
<div<?php echo $egresos->id_pago->ViewAttributes() ?>><?php echo $egresos->id_pago->ListViewValue() ?></div></td>
		<td<?php echo $egresos->estado->CellAttributes() ?>>
<div<?php echo $egresos->estado->ViewAttributes() ?>><?php echo $egresos->estado->ListViewValue() ?></div></td>
		<td<?php echo $egresos->total_rd->CellAttributes() ?>>
<div<?php echo $egresos->total_rd->ViewAttributes() ?>><?php echo $egresos->total_rd->ListViewValue() ?></div></td>
		<td<?php echo $egresos->total_us->CellAttributes() ?>>
<div<?php echo $egresos->total_us->ViewAttributes() ?>><?php echo $egresos->total_us->ListViewValue() ?></div></td>
		<td<?php echo $egresos->total_euros->CellAttributes() ?>>
<div<?php echo $egresos->total_euros->ViewAttributes() ?>><?php echo $egresos->total_euros->ListViewValue() ?></div></td>
		<td<?php echo $egresos->Impuestos_pagados->CellAttributes() ?>>
<div<?php echo $egresos->Impuestos_pagados->ViewAttributes() ?>><?php echo $egresos->Impuestos_pagados->ListViewValue() ?></div></td>
		<td<?php echo $egresos->Numero_Referencia->CellAttributes() ?>>
<div<?php echo $egresos->Numero_Referencia->ViewAttributes() ?>><?php echo $egresos->Numero_Referencia->ListViewValue() ?></div></td>
		<td<?php echo $egresos->tipo_comprobante->CellAttributes() ?>>
<div<?php echo $egresos->tipo_comprobante->ViewAttributes() ?>><?php echo $egresos->tipo_comprobante->ListViewValue() ?></div></td>
		<td<?php echo $egresos->Comprobante_fiscal->CellAttributes() ?>>
<div<?php echo $egresos->Comprobante_fiscal->ViewAttributes() ?>><?php echo $egresos->Comprobante_fiscal->ListViewValue() ?></div></td>
		<td<?php echo $egresos->Metodo_pago->CellAttributes() ?>>
<div<?php echo $egresos->Metodo_pago->ViewAttributes() ?>><?php echo $egresos->Metodo_pago->ListViewValue() ?></div></td>
		<td<?php echo $egresos->proveedor->CellAttributes() ?>>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ListViewValue() ?></div></td>
		<td<?php echo $egresos->fecha->CellAttributes() ?>>
<div<?php echo $egresos->fecha->ViewAttributes() ?>><?php echo $egresos->fecha->ListViewValue() ?></div></td>
		<td<?php echo $egresos->tipo1->CellAttributes() ?>>
<div<?php echo $egresos->tipo1->ViewAttributes() ?>><?php echo $egresos->tipo1->ListViewValue() ?></div></td>
		<td<?php echo $egresos->Empresa->CellAttributes() ?>>
<div<?php echo $egresos->Empresa->ViewAttributes() ?>><?php echo $egresos->Empresa->ListViewValue() ?></div></td>
		<td<?php echo $egresos->locacion->CellAttributes() ?>>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ListViewValue() ?></div></td>
		<td<?php echo $egresos->cuenta_banco->CellAttributes() ?>>
<div<?php echo $egresos->cuenta_banco->ViewAttributes() ?>><?php echo $egresos->cuenta_banco->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="Confirmar Eliminar">
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
class cegresos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'egresos';

	// Page Object Name
	var $PageObjName = 'egresos_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $egresos;
		if ($egresos->UseTokenInUrl) $PageUrl .= "t=" . $egresos->TableVar . "&"; // add page token
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
		global $objForm, $egresos;
		if ($egresos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($egresos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($egresos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cegresos_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos"] = new cegresos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Initialize other table object
		$GLOBALS['proveedores'] = new cproveedores();

		// Initialize other table object
		$GLOBALS['locaciones'] = new clocaciones();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'egresos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $egresos;
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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $egresos;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_pago"] <> "") {
			$egresos->id_pago->setQueryStringValue($_GET["id_pago"]);
			if (!is_numeric($egresos->id_pago->QueryStringValue))
				$this->Page_Terminate("egresoslist.php"); // Prevent SQL injection, exit
			$sKey .= $egresos->id_pago->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("egresoslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("egresoslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_pago`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in egresos class, egresosinfo.php

		$egresos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$egresos->CurrentAction = $_POST["a_delete"];
		} else {
			$egresos->CurrentAction = "I"; // Display record
		}
		switch ($egresos->CurrentAction) {
			case "D": // Delete
				$egresos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Eliminar completado"); // Set up success message
					$this->Page_Terminate($egresos->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $egresos;
		$DeleteRows = TRUE;
		$sWrkFilter = $egresos->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in egresos class, egresosinfo.php

		$egresos->CurrentFilter = $sWrkFilter;
		$sSql = $egresos->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("No se encontraron registros"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $egresos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_pago'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($egresos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($egresos->CancelMessage <> "") {
				$this->setMessage($egresos->CancelMessage);
				$egresos->CancelMessage = "";
			} else {
				$this->setMessage("Eliminar cancelado");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$egresos->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $egresos;

		// Call Recordset Selecting event
		$egresos->Recordset_Selecting($egresos->CurrentFilter);

		// Load list page SQL
		$sSql = $egresos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$egresos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $egresos;
		$sFilter = $egresos->KeyFilter();

		// Call Row Selecting event
		$egresos->Row_Selecting($sFilter);

		// Load sql based on filter
		$egresos->CurrentFilter = $sFilter;
		$sSql = $egresos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$egresos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $egresos;
		$egresos->id_pago->setDbValue($rs->fields('id_pago'));
		$egresos->estado->setDbValue($rs->fields('estado'));
		$egresos->total_rd->setDbValue($rs->fields('total_rd'));
		$egresos->total_us->setDbValue($rs->fields('total_us'));
		$egresos->total_euros->setDbValue($rs->fields('total_euros'));
		$egresos->Impuestos_pagados->setDbValue($rs->fields('Impuestos_pagados'));
		$egresos->Numero_Referencia->setDbValue($rs->fields('Numero_Referencia'));
		$egresos->tipo_comprobante->setDbValue($rs->fields('tipo_comprobante'));
		$egresos->Comprobante_fiscal->setDbValue($rs->fields('Comprobante_fiscal'));
		$egresos->Metodo_pago->setDbValue($rs->fields('Metodo_pago'));
		$egresos->proveedor->setDbValue($rs->fields('proveedor'));
		$egresos->fecha->setDbValue($rs->fields('fecha'));
		$egresos->tipo1->setDbValue($rs->fields('tipo1'));
		$egresos->notas->setDbValue($rs->fields('notas'));
		$egresos->Empresa->setDbValue($rs->fields('Empresa'));
		$egresos->locacion->setDbValue($rs->fields('locacion'));
		$egresos->cuenta_banco->setDbValue($rs->fields('cuenta_banco'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $egresos;

		// Call Row_Rendering event
		$egresos->Row_Rendering();

		// Common render codes for all row types
		// id_pago

		$egresos->id_pago->CellCssStyle = "";
		$egresos->id_pago->CellCssClass = "";

		// estado
		$egresos->estado->CellCssStyle = "";
		$egresos->estado->CellCssClass = "";

		// total_rd
		$egresos->total_rd->CellCssStyle = "";
		$egresos->total_rd->CellCssClass = "";

		// total_us
		$egresos->total_us->CellCssStyle = "";
		$egresos->total_us->CellCssClass = "";

		// total_euros
		$egresos->total_euros->CellCssStyle = "";
		$egresos->total_euros->CellCssClass = "";

		// Impuestos_pagados
		$egresos->Impuestos_pagados->CellCssStyle = "";
		$egresos->Impuestos_pagados->CellCssClass = "";

		// Numero_Referencia
		$egresos->Numero_Referencia->CellCssStyle = "";
		$egresos->Numero_Referencia->CellCssClass = "";

		// tipo_comprobante
		$egresos->tipo_comprobante->CellCssStyle = "";
		$egresos->tipo_comprobante->CellCssClass = "";

		// Comprobante_fiscal
		$egresos->Comprobante_fiscal->CellCssStyle = "";
		$egresos->Comprobante_fiscal->CellCssClass = "";

		// Metodo_pago
		$egresos->Metodo_pago->CellCssStyle = "";
		$egresos->Metodo_pago->CellCssClass = "";

		// proveedor
		$egresos->proveedor->CellCssStyle = "";
		$egresos->proveedor->CellCssClass = "";

		// fecha
		$egresos->fecha->CellCssStyle = "";
		$egresos->fecha->CellCssClass = "";

		// tipo1
		$egresos->tipo1->CellCssStyle = "";
		$egresos->tipo1->CellCssClass = "";

		// Empresa
		$egresos->Empresa->CellCssStyle = "";
		$egresos->Empresa->CellCssClass = "";

		// locacion
		$egresos->locacion->CellCssStyle = "";
		$egresos->locacion->CellCssClass = "";

		// cuenta_banco
		$egresos->cuenta_banco->CellCssStyle = "";
		$egresos->cuenta_banco->CellCssClass = "";
		if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_pago
			$egresos->id_pago->ViewValue = $egresos->id_pago->CurrentValue;
			$egresos->id_pago->CssStyle = "";
			$egresos->id_pago->CssClass = "";
			$egresos->id_pago->ViewCustomAttributes = "";

			// estado
			if (strval($egresos->estado->CurrentValue) <> "") {
				switch ($egresos->estado->CurrentValue) {
					case "Pagado":
						$egresos->estado->ViewValue = "Pagado";
						break;
					case "Pendiente":
						$egresos->estado->ViewValue = "Pendiente";
						break;
					default:
						$egresos->estado->ViewValue = $egresos->estado->CurrentValue;
				}
			} else {
				$egresos->estado->ViewValue = NULL;
			}
			$egresos->estado->CssStyle = "";
			$egresos->estado->CssClass = "";
			$egresos->estado->ViewCustomAttributes = "";

			// total_rd
			$egresos->total_rd->ViewValue = $egresos->total_rd->CurrentValue;
			$egresos->total_rd->CssStyle = "";
			$egresos->total_rd->CssClass = "";
			$egresos->total_rd->ViewCustomAttributes = "";

			// total_us
			$egresos->total_us->ViewValue = $egresos->total_us->CurrentValue;
			$egresos->total_us->CssStyle = "";
			$egresos->total_us->CssClass = "";
			$egresos->total_us->ViewCustomAttributes = "";

			// total_euros
			$egresos->total_euros->ViewValue = $egresos->total_euros->CurrentValue;
			$egresos->total_euros->CssStyle = "";
			$egresos->total_euros->CssClass = "";
			$egresos->total_euros->ViewCustomAttributes = "";

			// Impuestos_pagados
			$egresos->Impuestos_pagados->ViewValue = $egresos->Impuestos_pagados->CurrentValue;
			$egresos->Impuestos_pagados->CssStyle = "";
			$egresos->Impuestos_pagados->CssClass = "";
			$egresos->Impuestos_pagados->ViewCustomAttributes = "";

			// Numero_Referencia
			$egresos->Numero_Referencia->ViewValue = $egresos->Numero_Referencia->CurrentValue;
			$egresos->Numero_Referencia->CssStyle = "";
			$egresos->Numero_Referencia->CssClass = "";
			$egresos->Numero_Referencia->ViewCustomAttributes = "";

			// tipo_comprobante
			if (strval($egresos->tipo_comprobante->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_tipo` FROM `comprobantes_tipos` WHERE `nombre_tipo` = '" . ew_AdjustSql($egresos->tipo_comprobante->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->tipo_comprobante->ViewValue = $rswrk->fields('nombre_tipo');
					$rswrk->Close();
				} else {
					$egresos->tipo_comprobante->ViewValue = $egresos->tipo_comprobante->CurrentValue;
				}
			} else {
				$egresos->tipo_comprobante->ViewValue = NULL;
			}
			$egresos->tipo_comprobante->CssStyle = "";
			$egresos->tipo_comprobante->CssClass = "";
			$egresos->tipo_comprobante->ViewCustomAttributes = "";

			// Comprobante_fiscal
			$egresos->Comprobante_fiscal->ViewValue = $egresos->Comprobante_fiscal->CurrentValue;
			$egresos->Comprobante_fiscal->CssStyle = "";
			$egresos->Comprobante_fiscal->CssClass = "";
			$egresos->Comprobante_fiscal->ViewCustomAttributes = "";

			// Metodo_pago
			if (strval($egresos->Metodo_pago->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `metodo` FROM `metodos_pago` WHERE `id_metodo` = " . ew_AdjustSql($egresos->Metodo_pago->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `metodo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->Metodo_pago->ViewValue = $rswrk->fields('metodo');
					$rswrk->Close();
				} else {
					$egresos->Metodo_pago->ViewValue = $egresos->Metodo_pago->CurrentValue;
				}
			} else {
				$egresos->Metodo_pago->ViewValue = NULL;
			}
			$egresos->Metodo_pago->CssStyle = "";
			$egresos->Metodo_pago->CssClass = "";
			$egresos->Metodo_pago->ViewCustomAttributes = "";

			// proveedor
			if (strval($egresos->proveedor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($egresos->proveedor->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->proveedor->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$egresos->proveedor->ViewValue = $egresos->proveedor->CurrentValue;
				}
			} else {
				$egresos->proveedor->ViewValue = NULL;
			}
			$egresos->proveedor->CssStyle = "";
			$egresos->proveedor->CssClass = "";
			$egresos->proveedor->ViewCustomAttributes = "";

			// fecha
			$egresos->fecha->ViewValue = $egresos->fecha->CurrentValue;
			$egresos->fecha->ViewValue = ew_FormatDateTime($egresos->fecha->ViewValue, 7);
			$egresos->fecha->CssStyle = "";
			$egresos->fecha->CssClass = "";
			$egresos->fecha->ViewCustomAttributes = "";

			// tipo1
			if (strval($egresos->tipo1->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `tipo` FROM `egresos_tipo1` WHERE `id_tipo` = " . ew_AdjustSql($egresos->tipo1->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `tipo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->tipo1->ViewValue = $rswrk->fields('tipo');
					$rswrk->Close();
				} else {
					$egresos->tipo1->ViewValue = $egresos->tipo1->CurrentValue;
				}
			} else {
				$egresos->tipo1->ViewValue = NULL;
			}
			$egresos->tipo1->CssStyle = "";
			$egresos->tipo1->CssClass = "";
			$egresos->tipo1->ViewCustomAttributes = "";

			// Empresa
			if (strval($egresos->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($egresos->Empresa->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$egresos->Empresa->ViewValue = $egresos->Empresa->CurrentValue;
				}
			} else {
				$egresos->Empresa->ViewValue = NULL;
			}
			$egresos->Empresa->CssStyle = "";
			$egresos->Empresa->CssClass = "";
			$egresos->Empresa->ViewCustomAttributes = "";

			// locacion
			if (strval($egresos->locacion->CurrentValue) <> "") {
				$arwrk = explode(",", $egresos->locacion->CurrentValue);
				$sSqlWrk = "SELECT `nombre` FROM `locaciones` WHERE ";
				$sWhereWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sWhereWrk <> "") $sWhereWrk .= " OR ";
					$sWhereWrk .= "`id_locacion` = " . ew_AdjustSql(trim($wrk)) . "";
				}
				if ($sWhereWrk <> "") $sSqlWrk .= "(" . $sWhereWrk . ")";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->locacion->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$egresos->locacion->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $egresos->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$egresos->locacion->ViewValue = $egresos->locacion->CurrentValue;
				}
			} else {
				$egresos->locacion->ViewValue = NULL;
			}
			$egresos->locacion->CssStyle = "";
			$egresos->locacion->CssClass = "";
			$egresos->locacion->ViewCustomAttributes = "";

			// cuenta_banco
			if (strval($egresos->cuenta_banco->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `Banco`, `numero_cuenta` FROM `cuentas_bancarias` WHERE `id_banco` = " . ew_AdjustSql($egresos->cuenta_banco->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `Banco` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->cuenta_banco->ViewValue = $rswrk->fields('Banco');
					$egresos->cuenta_banco->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('numero_cuenta');
					$rswrk->Close();
				} else {
					$egresos->cuenta_banco->ViewValue = $egresos->cuenta_banco->CurrentValue;
				}
			} else {
				$egresos->cuenta_banco->ViewValue = NULL;
			}
			$egresos->cuenta_banco->CssStyle = "";
			$egresos->cuenta_banco->CssClass = "";
			$egresos->cuenta_banco->ViewCustomAttributes = "";

			// id_pago
			$egresos->id_pago->HrefValue = "";

			// estado
			$egresos->estado->HrefValue = "";

			// total_rd
			$egresos->total_rd->HrefValue = "";

			// total_us
			$egresos->total_us->HrefValue = "";

			// total_euros
			$egresos->total_euros->HrefValue = "";

			// Impuestos_pagados
			$egresos->Impuestos_pagados->HrefValue = "";

			// Numero_Referencia
			$egresos->Numero_Referencia->HrefValue = "";

			// tipo_comprobante
			$egresos->tipo_comprobante->HrefValue = "";

			// Comprobante_fiscal
			$egresos->Comprobante_fiscal->HrefValue = "";

			// Metodo_pago
			$egresos->Metodo_pago->HrefValue = "";

			// proveedor
			$egresos->proveedor->HrefValue = "";

			// fecha
			$egresos->fecha->HrefValue = "";

			// tipo1
			$egresos->tipo1->HrefValue = "";

			// Empresa
			$egresos->Empresa->HrefValue = "";

			// locacion
			$egresos->locacion->HrefValue = "";

			// cuenta_banco
			$egresos->cuenta_banco->HrefValue = "";
		}

		// Call Row Rendered event
		$egresos->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
