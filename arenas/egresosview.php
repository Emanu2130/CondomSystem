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
$egresos_view = new cegresos_view();
$Page =& $egresos_view;

// Page init processing
$egresos_view->Page_Init();

// Page main processing
$egresos_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($egresos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_view = new ew_Page("egresos_view");

// page properties
egresos_view.PageID = "view"; // page ID
var EW_PAGE_ID = egresos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
egresos_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_view.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<p><span class="arenas">Vista Modulo: Egresos
<br><br>
<?php if ($egresos->Export == "") { ?>
<a href="egresoslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $egresos_view->ShowMessage() ?>
<p>
<?php if ($egresos->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_view->Pager)) $egresos_view->Pager = new cPrevNextPager($egresos_view->lStartRec, $egresos_view->lDisplayRecs, $egresos_view->lTotalRecs) ?>
<?php if ($egresos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($egresos_view->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($egresos->id_pago->Visible) { // id_pago ?>
	<tr<?php echo $egresos->id_pago->RowAttributes ?>>
		<td class="ewTableHeader">Id Pago</td>
		<td<?php echo $egresos->id_pago->CellAttributes() ?>>
<div<?php echo $egresos->id_pago->ViewAttributes() ?>><?php echo $egresos->id_pago->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->estado->Visible) { // estado ?>
	<tr<?php echo $egresos->estado->RowAttributes ?>>
		<td class="ewTableHeader">Estado</td>
		<td<?php echo $egresos->estado->CellAttributes() ?>>
<div<?php echo $egresos->estado->ViewAttributes() ?>><?php echo $egresos->estado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->total_rd->Visible) { // total_rd ?>
	<tr<?php echo $egresos->total_rd->RowAttributes ?>>
		<td class="ewTableHeader">Total Rd</td>
		<td<?php echo $egresos->total_rd->CellAttributes() ?>>
<div<?php echo $egresos->total_rd->ViewAttributes() ?>><?php echo $egresos->total_rd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->total_us->Visible) { // total_us ?>
	<tr<?php echo $egresos->total_us->RowAttributes ?>>
		<td class="ewTableHeader">Total Us</td>
		<td<?php echo $egresos->total_us->CellAttributes() ?>>
<div<?php echo $egresos->total_us->ViewAttributes() ?>><?php echo $egresos->total_us->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->total_euros->Visible) { // total_euros ?>
	<tr<?php echo $egresos->total_euros->RowAttributes ?>>
		<td class="ewTableHeader">Total Euros</td>
		<td<?php echo $egresos->total_euros->CellAttributes() ?>>
<div<?php echo $egresos->total_euros->ViewAttributes() ?>><?php echo $egresos->total_euros->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->Impuestos_pagados->Visible) { // Impuestos_pagados ?>
	<tr<?php echo $egresos->Impuestos_pagados->RowAttributes ?>>
		<td class="ewTableHeader">Impuestos Pagados</td>
		<td<?php echo $egresos->Impuestos_pagados->CellAttributes() ?>>
<div<?php echo $egresos->Impuestos_pagados->ViewAttributes() ?>><?php echo $egresos->Impuestos_pagados->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->Numero_Referencia->Visible) { // Numero_Referencia ?>
	<tr<?php echo $egresos->Numero_Referencia->RowAttributes ?>>
		<td class="ewTableHeader">Numero Referencia</td>
		<td<?php echo $egresos->Numero_Referencia->CellAttributes() ?>>
<div<?php echo $egresos->Numero_Referencia->ViewAttributes() ?>><?php echo $egresos->Numero_Referencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<tr<?php echo $egresos->tipo_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Comprobante</td>
		<td<?php echo $egresos->tipo_comprobante->CellAttributes() ?>>
<div<?php echo $egresos->tipo_comprobante->ViewAttributes() ?>><?php echo $egresos->tipo_comprobante->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->Comprobante_fiscal->Visible) { // Comprobante_fiscal ?>
	<tr<?php echo $egresos->Comprobante_fiscal->RowAttributes ?>>
		<td class="ewTableHeader">NCF</td>
		<td<?php echo $egresos->Comprobante_fiscal->CellAttributes() ?>>
<div<?php echo $egresos->Comprobante_fiscal->ViewAttributes() ?>><?php echo $egresos->Comprobante_fiscal->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->Metodo_pago->Visible) { // Metodo_pago ?>
	<tr<?php echo $egresos->Metodo_pago->RowAttributes ?>>
		<td class="ewTableHeader">Metodo Pago</td>
		<td<?php echo $egresos->Metodo_pago->CellAttributes() ?>>
<div<?php echo $egresos->Metodo_pago->ViewAttributes() ?>><?php echo $egresos->Metodo_pago->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->proveedor->Visible) { // proveedor ?>
	<tr<?php echo $egresos->proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Proveedor</td>
		<td<?php echo $egresos->proveedor->CellAttributes() ?>>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->fecha->Visible) { // fecha ?>
	<tr<?php echo $egresos->fecha->RowAttributes ?>>
		<td class="ewTableHeader">Fecha</td>
		<td<?php echo $egresos->fecha->CellAttributes() ?>>
<div<?php echo $egresos->fecha->ViewAttributes() ?>><?php echo $egresos->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->tipo1->Visible) { // tipo1 ?>
	<tr<?php echo $egresos->tipo1->RowAttributes ?>>
		<td class="ewTableHeader">Tipo egreso</td>
		<td<?php echo $egresos->tipo1->CellAttributes() ?>>
<div<?php echo $egresos->tipo1->ViewAttributes() ?>><?php echo $egresos->tipo1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->notas->Visible) { // notas ?>
	<tr<?php echo $egresos->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $egresos->notas->CellAttributes() ?>>
<div<?php echo $egresos->notas->ViewAttributes() ?>><?php echo $egresos->notas->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $egresos->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $egresos->Empresa->CellAttributes() ?>>
<div<?php echo $egresos->Empresa->ViewAttributes() ?>><?php echo $egresos->Empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->locacion->Visible) { // locacion ?>
	<tr<?php echo $egresos->locacion->RowAttributes ?>>
		<td class="ewTableHeader">Locacion</td>
		<td<?php echo $egresos->locacion->CellAttributes() ?>>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($egresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<tr<?php echo $egresos->cuenta_banco->RowAttributes ?>>
		<td class="ewTableHeader">Cuenta Banco</td>
		<td<?php echo $egresos->cuenta_banco->CellAttributes() ?>>
<div<?php echo $egresos->cuenta_banco->ViewAttributes() ?>><?php echo $egresos->cuenta_banco->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($egresos->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_view->Pager)) $egresos_view->Pager = new cPrevNextPager($egresos_view->lStartRec, $egresos_view->lDisplayRecs, $egresos_view->lTotalRecs) ?>
<?php if ($egresos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_view->PageUrl() ?>start=<?php echo $egresos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($egresos_view->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
<?php if ($egresos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cegresos_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'egresos';

	// Page Object Name
	var $PageObjName = 'egresos_view';

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
	function cegresos_view() {
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
			define("EW_PAGE_ID", 'view', TRUE);

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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $egresos;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_pago"] <> "") {
				$egresos->id_pago->setQueryStringValue($_GET["id_pago"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$egresos->CurrentAction = "I"; // Display form
			switch ($egresos->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("egresoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($egresos->id_pago->CurrentValue) == strval($rs->fields('id_pago'))) {
								$egresos->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage("No se encontraron registros"); // Set no record message
						$sReturnUrl = "egresoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "egresoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$egresos->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $egresos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$egresos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$egresos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $egresos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$egresos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$egresos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$egresos->setStartRecordNumber($this->lStartRec);
		}
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

		// notas
		$egresos->notas->CellCssStyle = "";
		$egresos->notas->CellCssClass = "";

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

			// notas
			$egresos->notas->ViewValue = $egresos->notas->CurrentValue;
			$egresos->notas->CssStyle = "";
			$egresos->notas->CssClass = "";
			$egresos->notas->ViewCustomAttributes = "";

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

			// notas
			$egresos->notas->HrefValue = "";

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
