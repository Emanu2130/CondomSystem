<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "ingresosinfo.php" ?>
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
$ingresos_view = new cingresos_view();
$Page =& $ingresos_view;

// Page init processing
$ingresos_view->Page_Init();

// Page main processing
$ingresos_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($ingresos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_view = new ew_Page("ingresos_view");

// page properties
ingresos_view.PageID = "view"; // page ID
var EW_PAGE_ID = ingresos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
ingresos_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Ingresos
<br><br>
<?php if ($ingresos->Export == "") { ?>
<a href="ingresoslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $ingresos_view->ShowMessage() ?>
<p>
<?php if ($ingresos->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ingresos_view->Pager)) $ingresos_view->Pager = new cPrevNextPager($ingresos_view->lStartRec, $ingresos_view->lDisplayRecs, $ingresos_view->lTotalRecs) ?>
<?php if ($ingresos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($ingresos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ingresos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ingresos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ingresos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ingresos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $ingresos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($ingresos_view->sSrchWhere == "0=101") { ?>
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
<?php if ($ingresos->id_ingreso->Visible) { // id_ingreso ?>
	<tr<?php echo $ingresos->id_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Id Ingreso</td>
		<td<?php echo $ingresos->id_ingreso->CellAttributes() ?>>
<div<?php echo $ingresos->id_ingreso->ViewAttributes() ?>><?php echo $ingresos->id_ingreso->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->tipo_ingreso->Visible) { // tipo_ingreso ?>
	<tr<?php echo $ingresos->tipo_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Ingreso</td>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>>
<div<?php echo $ingresos->tipo_ingreso->ViewAttributes() ?>><?php echo $ingresos->tipo_ingreso->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->estado->Visible) { // estado ?>
	<tr<?php echo $ingresos->estado->RowAttributes ?>>
		<td class="ewTableHeader">Estado</td>
		<td<?php echo $ingresos->estado->CellAttributes() ?>>
<div<?php echo $ingresos->estado->ViewAttributes() ?>><?php echo $ingresos->estado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Numero_Factura->Visible) { // Numero_Factura ?>
	<tr<?php echo $ingresos->Numero_Factura->RowAttributes ?>>
		<td class="ewTableHeader">Numero Factura</td>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>>
<div<?php echo $ingresos->Numero_Factura->ViewAttributes() ?>><?php echo $ingresos->Numero_Factura->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Fecha_Factura->Visible) { // Fecha_Factura ?>
	<tr<?php echo $ingresos->Fecha_Factura->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Factura</td>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>>
<div<?php echo $ingresos->Fecha_Factura->ViewAttributes() ?>><?php echo $ingresos->Fecha_Factura->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Fecha_Dep->Visible) { // Fecha_Dep ?>
	<tr<?php echo $ingresos->Fecha_Dep->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Deposito</td>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>>
<div<?php echo $ingresos->Fecha_Dep->ViewAttributes() ?>><?php echo $ingresos->Fecha_Dep->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Descripcion->Visible) { // Descripcion ?>
	<tr<?php echo $ingresos->Descripcion->RowAttributes ?>>
		<td class="ewTableHeader">Descripcion</td>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>>
<div<?php echo $ingresos->Descripcion->ViewAttributes() ?>><?php echo $ingresos->Descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_RD->Visible) { // Valor_RD ?>
	<tr<?php echo $ingresos->Valor_RD->RowAttributes ?>>
		<td class="ewTableHeader">Valor RD</td>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>>
<div<?php echo $ingresos->Valor_RD->ViewAttributes() ?>><?php echo $ingresos->Valor_RD->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_US->Visible) { // Valor_US ?>
	<tr<?php echo $ingresos->Valor_US->RowAttributes ?>>
		<td class="ewTableHeader">Valor US</td>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>>
<div<?php echo $ingresos->Valor_US->ViewAttributes() ?>><?php echo $ingresos->Valor_US->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_Euros->Visible) { // Valor_Euros ?>
	<tr<?php echo $ingresos->Valor_Euros->RowAttributes ?>>
		<td class="ewTableHeader">Valor Euros</td>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>>
<div<?php echo $ingresos->Valor_Euros->ViewAttributes() ?>><?php echo $ingresos->Valor_Euros->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_Tarjeta_credito->Visible) { // Valor_Tarjeta_credito ?>
	<tr<?php echo $ingresos->Valor_Tarjeta_credito->RowAttributes ?>>
		<td class="ewTableHeader">Valor Tarjeta Credito</td>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>>
<div<?php echo $ingresos->Valor_Tarjeta_credito->ViewAttributes() ?>><?php echo $ingresos->Valor_Tarjeta_credito->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $ingresos->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>>
<div<?php echo $ingresos->Empresa->ViewAttributes() ?>><?php echo $ingresos->Empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<tr<?php echo $ingresos->tipo_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Comprobante</td>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>>
<div<?php echo $ingresos->tipo_comprobante->ViewAttributes() ?>><?php echo $ingresos->tipo_comprobante->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->NCF->Visible) { // NCF ?>
	<tr<?php echo $ingresos->NCF->RowAttributes ?>>
		<td class="ewTableHeader">NCF</td>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>>
<div<?php echo $ingresos->NCF->ViewAttributes() ?>><?php echo $ingresos->NCF->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->locacion->Visible) { // locacion ?>
	<tr<?php echo $ingresos->locacion->RowAttributes ?>>
		<td class="ewTableHeader">Locacion</td>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>>
<div<?php echo $ingresos->locacion->ViewAttributes() ?>><?php echo $ingresos->locacion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<tr<?php echo $ingresos->cuenta_banco->RowAttributes ?>>
		<td class="ewTableHeader">Cuenta Banco</td>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>>
<div<?php echo $ingresos->cuenta_banco->ViewAttributes() ?>><?php echo $ingresos->cuenta_banco->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ingresos->proveedor->Visible) { // proveedor ?>
	<tr<?php echo $ingresos->proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Proveedor</td>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>>
<div<?php echo $ingresos->proveedor->ViewAttributes() ?>><?php echo $ingresos->proveedor->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($ingresos->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ingresos_view->Pager)) $ingresos_view->Pager = new cPrevNextPager($ingresos_view->lStartRec, $ingresos_view->lDisplayRecs, $ingresos_view->lTotalRecs) ?>
<?php if ($ingresos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($ingresos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ingresos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ingresos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ingresos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ingresos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_view->PageUrl() ?>start=<?php echo $ingresos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $ingresos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($ingresos_view->sSrchWhere == "0=101") { ?>
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
<?php if ($ingresos->Export == "") { ?>
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
class cingresos_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'ingresos';

	// Page Object Name
	var $PageObjName = 'ingresos_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ingresos;
		if ($ingresos->UseTokenInUrl) $PageUrl .= "t=" . $ingresos->TableVar . "&"; // add page token
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
		global $objForm, $ingresos;
		if ($ingresos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($ingresos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ingresos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cingresos_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["ingresos"] = new cingresos();

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
			define("EW_TABLE_NAME", 'ingresos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ingresos;
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
		global $ingresos;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_ingreso"] <> "") {
				$ingresos->id_ingreso->setQueryStringValue($_GET["id_ingreso"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$ingresos->CurrentAction = "I"; // Display form
			switch ($ingresos->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("ingresoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($ingresos->id_ingreso->CurrentValue) == strval($rs->fields('id_ingreso'))) {
								$ingresos->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "ingresoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "ingresoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$ingresos->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $ingresos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$ingresos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$ingresos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $ingresos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$ingresos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$ingresos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$ingresos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $ingresos;

		// Call Recordset Selecting event
		$ingresos->Recordset_Selecting($ingresos->CurrentFilter);

		// Load list page SQL
		$sSql = $ingresos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$ingresos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ingresos;
		$sFilter = $ingresos->KeyFilter();

		// Call Row Selecting event
		$ingresos->Row_Selecting($sFilter);

		// Load sql based on filter
		$ingresos->CurrentFilter = $sFilter;
		$sSql = $ingresos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$ingresos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $ingresos;
		$ingresos->id_ingreso->setDbValue($rs->fields('id_ingreso'));
		$ingresos->tipo_ingreso->setDbValue($rs->fields('tipo_ingreso'));
		$ingresos->estado->setDbValue($rs->fields('estado'));
		$ingresos->Numero_Factura->setDbValue($rs->fields('Numero_Factura'));
		$ingresos->Fecha_Factura->setDbValue($rs->fields('Fecha_Factura'));
		$ingresos->Fecha_Dep->setDbValue($rs->fields('Fecha_Dep'));
		$ingresos->Descripcion->setDbValue($rs->fields('Descripcion'));
		$ingresos->Valor_RD->setDbValue($rs->fields('Valor_RD'));
		$ingresos->Valor_US->setDbValue($rs->fields('Valor_US'));
		$ingresos->Valor_Euros->setDbValue($rs->fields('Valor_Euros'));
		$ingresos->Valor_Tarjeta_credito->setDbValue($rs->fields('Valor_Tarjeta_credito'));
		$ingresos->Empresa->setDbValue($rs->fields('Empresa'));
		$ingresos->tipo_comprobante->setDbValue($rs->fields('tipo_comprobante'));
		$ingresos->NCF->setDbValue($rs->fields('NCF'));
		$ingresos->locacion->setDbValue($rs->fields('locacion'));
		$ingresos->cuenta_banco->setDbValue($rs->fields('cuenta_banco'));
		$ingresos->proveedor->setDbValue($rs->fields('proveedor'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $ingresos;

		// Call Row_Rendering event
		$ingresos->Row_Rendering();

		// Common render codes for all row types
		// id_ingreso

		$ingresos->id_ingreso->CellCssStyle = "";
		$ingresos->id_ingreso->CellCssClass = "";

		// tipo_ingreso
		$ingresos->tipo_ingreso->CellCssStyle = "";
		$ingresos->tipo_ingreso->CellCssClass = "";

		// estado
		$ingresos->estado->CellCssStyle = "";
		$ingresos->estado->CellCssClass = "";

		// Numero_Factura
		$ingresos->Numero_Factura->CellCssStyle = "";
		$ingresos->Numero_Factura->CellCssClass = "";

		// Fecha_Factura
		$ingresos->Fecha_Factura->CellCssStyle = "";
		$ingresos->Fecha_Factura->CellCssClass = "";

		// Fecha_Dep
		$ingresos->Fecha_Dep->CellCssStyle = "";
		$ingresos->Fecha_Dep->CellCssClass = "";

		// Descripcion
		$ingresos->Descripcion->CellCssStyle = "";
		$ingresos->Descripcion->CellCssClass = "";

		// Valor_RD
		$ingresos->Valor_RD->CellCssStyle = "";
		$ingresos->Valor_RD->CellCssClass = "";

		// Valor_US
		$ingresos->Valor_US->CellCssStyle = "";
		$ingresos->Valor_US->CellCssClass = "";

		// Valor_Euros
		$ingresos->Valor_Euros->CellCssStyle = "";
		$ingresos->Valor_Euros->CellCssClass = "";

		// Valor_Tarjeta_credito
		$ingresos->Valor_Tarjeta_credito->CellCssStyle = "";
		$ingresos->Valor_Tarjeta_credito->CellCssClass = "";

		// Empresa
		$ingresos->Empresa->CellCssStyle = "";
		$ingresos->Empresa->CellCssClass = "";

		// tipo_comprobante
		$ingresos->tipo_comprobante->CellCssStyle = "";
		$ingresos->tipo_comprobante->CellCssClass = "";

		// NCF
		$ingresos->NCF->CellCssStyle = "";
		$ingresos->NCF->CellCssClass = "";

		// locacion
		$ingresos->locacion->CellCssStyle = "";
		$ingresos->locacion->CellCssClass = "";

		// cuenta_banco
		$ingresos->cuenta_banco->CellCssStyle = "";
		$ingresos->cuenta_banco->CellCssClass = "";

		// proveedor
		$ingresos->proveedor->CellCssStyle = "";
		$ingresos->proveedor->CellCssClass = "";
		if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ingreso
			$ingresos->id_ingreso->ViewValue = $ingresos->id_ingreso->CurrentValue;
			$ingresos->id_ingreso->CssStyle = "";
			$ingresos->id_ingreso->CssClass = "";
			$ingresos->id_ingreso->ViewCustomAttributes = "";

			// tipo_ingreso
			if (strval($ingresos->tipo_ingreso->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `ingresos_tipos` WHERE `id_ingresos` = " . ew_AdjustSql($ingresos->tipo_ingreso->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->tipo_ingreso->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->tipo_ingreso->ViewValue = $ingresos->tipo_ingreso->CurrentValue;
				}
			} else {
				$ingresos->tipo_ingreso->ViewValue = NULL;
			}
			$ingresos->tipo_ingreso->CssStyle = "";
			$ingresos->tipo_ingreso->CssClass = "";
			$ingresos->tipo_ingreso->ViewCustomAttributes = "";

			// estado
			if (strval($ingresos->estado->CurrentValue) <> "") {
				switch ($ingresos->estado->CurrentValue) {
					case "Cobrado":
						$ingresos->estado->ViewValue = "Cobrado";
						break;
					case "Pendiente":
						$ingresos->estado->ViewValue = "Pendiente";
						break;
					default:
						$ingresos->estado->ViewValue = $ingresos->estado->CurrentValue;
				}
			} else {
				$ingresos->estado->ViewValue = NULL;
			}
			$ingresos->estado->CssStyle = "";
			$ingresos->estado->CssClass = "";
			$ingresos->estado->ViewCustomAttributes = "";

			// Numero_Factura
			$ingresos->Numero_Factura->ViewValue = $ingresos->Numero_Factura->CurrentValue;
			$ingresos->Numero_Factura->CssStyle = "";
			$ingresos->Numero_Factura->CssClass = "";
			$ingresos->Numero_Factura->ViewCustomAttributes = "";

			// Fecha_Factura
			$ingresos->Fecha_Factura->ViewValue = $ingresos->Fecha_Factura->CurrentValue;
			$ingresos->Fecha_Factura->ViewValue = ew_FormatDateTime($ingresos->Fecha_Factura->ViewValue, 7);
			$ingresos->Fecha_Factura->CssStyle = "";
			$ingresos->Fecha_Factura->CssClass = "";
			$ingresos->Fecha_Factura->ViewCustomAttributes = "";

			// Fecha_Dep
			$ingresos->Fecha_Dep->ViewValue = $ingresos->Fecha_Dep->CurrentValue;
			$ingresos->Fecha_Dep->ViewValue = ew_FormatDateTime($ingresos->Fecha_Dep->ViewValue, 7);
			$ingresos->Fecha_Dep->CssStyle = "";
			$ingresos->Fecha_Dep->CssClass = "";
			$ingresos->Fecha_Dep->ViewCustomAttributes = "";

			// Descripcion
			$ingresos->Descripcion->ViewValue = $ingresos->Descripcion->CurrentValue;
			$ingresos->Descripcion->CssStyle = "";
			$ingresos->Descripcion->CssClass = "";
			$ingresos->Descripcion->ViewCustomAttributes = "";

			// Valor_RD
			$ingresos->Valor_RD->ViewValue = $ingresos->Valor_RD->CurrentValue;
			$ingresos->Valor_RD->CssStyle = "";
			$ingresos->Valor_RD->CssClass = "";
			$ingresos->Valor_RD->ViewCustomAttributes = "";

			// Valor_US
			$ingresos->Valor_US->ViewValue = $ingresos->Valor_US->CurrentValue;
			$ingresos->Valor_US->CssStyle = "";
			$ingresos->Valor_US->CssClass = "";
			$ingresos->Valor_US->ViewCustomAttributes = "";

			// Valor_Euros
			$ingresos->Valor_Euros->ViewValue = $ingresos->Valor_Euros->CurrentValue;
			$ingresos->Valor_Euros->CssStyle = "";
			$ingresos->Valor_Euros->CssClass = "";
			$ingresos->Valor_Euros->ViewCustomAttributes = "";

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->ViewValue = $ingresos->Valor_Tarjeta_credito->CurrentValue;
			$ingresos->Valor_Tarjeta_credito->CssStyle = "";
			$ingresos->Valor_Tarjeta_credito->CssClass = "";
			$ingresos->Valor_Tarjeta_credito->ViewCustomAttributes = "";

			// Empresa
			if (strval($ingresos->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($ingresos->Empresa->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->Empresa->ViewValue = $ingresos->Empresa->CurrentValue;
				}
			} else {
				$ingresos->Empresa->ViewValue = NULL;
			}
			$ingresos->Empresa->CssStyle = "";
			$ingresos->Empresa->CssClass = "";
			$ingresos->Empresa->ViewCustomAttributes = "";

			// tipo_comprobante
			if (strval($ingresos->tipo_comprobante->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_tipo` FROM `comprobantes_tipos` WHERE `nombre_tipo` = '" . ew_AdjustSql($ingresos->tipo_comprobante->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->tipo_comprobante->ViewValue = $rswrk->fields('nombre_tipo');
					$rswrk->Close();
				} else {
					$ingresos->tipo_comprobante->ViewValue = $ingresos->tipo_comprobante->CurrentValue;
				}
			} else {
				$ingresos->tipo_comprobante->ViewValue = NULL;
			}
			$ingresos->tipo_comprobante->CssStyle = "";
			$ingresos->tipo_comprobante->CssClass = "";
			$ingresos->tipo_comprobante->ViewCustomAttributes = "";

			// NCF
			$ingresos->NCF->ViewValue = $ingresos->NCF->CurrentValue;
			$ingresos->NCF->CssStyle = "";
			$ingresos->NCF->CssClass = "";
			$ingresos->NCF->ViewCustomAttributes = "";

			// locacion
			if (strval($ingresos->locacion->CurrentValue) <> "") {
				$arwrk = explode(",", $ingresos->locacion->CurrentValue);
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
					$ingresos->locacion->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$ingresos->locacion->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $ingresos->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$ingresos->locacion->ViewValue = $ingresos->locacion->CurrentValue;
				}
			} else {
				$ingresos->locacion->ViewValue = NULL;
			}
			$ingresos->locacion->CssStyle = "";
			$ingresos->locacion->CssClass = "";
			$ingresos->locacion->ViewCustomAttributes = "";

			// cuenta_banco
			if (strval($ingresos->cuenta_banco->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `Banco`, `numero_cuenta` FROM `cuentas_bancarias` WHERE `id_banco` = " . ew_AdjustSql($ingresos->cuenta_banco->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `Banco` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->cuenta_banco->ViewValue = $rswrk->fields('Banco');
					$ingresos->cuenta_banco->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('numero_cuenta');
					$rswrk->Close();
				} else {
					$ingresos->cuenta_banco->ViewValue = $ingresos->cuenta_banco->CurrentValue;
				}
			} else {
				$ingresos->cuenta_banco->ViewValue = NULL;
			}
			$ingresos->cuenta_banco->CssStyle = "";
			$ingresos->cuenta_banco->CssClass = "";
			$ingresos->cuenta_banco->ViewCustomAttributes = "";

			// proveedor
			if (strval($ingresos->proveedor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($ingresos->proveedor->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->proveedor->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->proveedor->ViewValue = $ingresos->proveedor->CurrentValue;
				}
			} else {
				$ingresos->proveedor->ViewValue = NULL;
			}
			$ingresos->proveedor->CssStyle = "";
			$ingresos->proveedor->CssClass = "";
			$ingresos->proveedor->ViewCustomAttributes = "";

			// id_ingreso
			$ingresos->id_ingreso->HrefValue = "";

			// tipo_ingreso
			$ingresos->tipo_ingreso->HrefValue = "";

			// estado
			$ingresos->estado->HrefValue = "";

			// Numero_Factura
			$ingresos->Numero_Factura->HrefValue = "";

			// Fecha_Factura
			$ingresos->Fecha_Factura->HrefValue = "";

			// Fecha_Dep
			$ingresos->Fecha_Dep->HrefValue = "";

			// Descripcion
			$ingresos->Descripcion->HrefValue = "";

			// Valor_RD
			$ingresos->Valor_RD->HrefValue = "";

			// Valor_US
			$ingresos->Valor_US->HrefValue = "";

			// Valor_Euros
			$ingresos->Valor_Euros->HrefValue = "";

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->HrefValue = "";

			// Empresa
			$ingresos->Empresa->HrefValue = "";

			// tipo_comprobante
			$ingresos->tipo_comprobante->HrefValue = "";

			// NCF
			$ingresos->NCF->HrefValue = "";

			// locacion
			$ingresos->locacion->HrefValue = "";

			// cuenta_banco
			$ingresos->cuenta_banco->HrefValue = "";

			// proveedor
			$ingresos->proveedor->HrefValue = "";
		}

		// Call Row Rendered event
		$ingresos->Row_Rendered();
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
