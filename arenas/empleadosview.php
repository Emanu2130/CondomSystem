<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "empleadosinfo.php" ?>
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
$empleados_view = new cempleados_view();
$Page =& $empleados_view;

// Page init processing
$empleados_view->Page_Init();

// Page main processing
$empleados_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($empleados->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var empleados_view = new ew_Page("empleados_view");

// page properties
empleados_view.PageID = "view"; // page ID
var EW_PAGE_ID = empleados_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
empleados_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
empleados_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
empleados_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
empleados_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Vista Modulo: Empleados
<br><br>
<?php if ($empleados->Export == "") { ?>
<a href="empleadoslist.php">Volver a la lista</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empleados->AddUrl() ?>">Agregar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empleados->EditUrl() ?>">Editar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empleados->CopyUrl() ?>">Copiar</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $empleados->DeleteUrl() ?>">Eliminar</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $empleados_view->ShowMessage() ?>
<p>
<?php if ($empleados->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empleados_view->Pager)) $empleados_view->Pager = new cPrevNextPager($empleados_view->lStartRec, $empleados_view->lDisplayRecs, $empleados_view->lTotalRecs) ?>
<?php if ($empleados_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empleados_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empleados_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empleados_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empleados_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empleados_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empleados_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($empleados_view->sSrchWhere == "0=101") { ?>
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
<?php if ($empleados->id_empleado->Visible) { // id_empleado ?>
	<tr<?php echo $empleados->id_empleado->RowAttributes ?>>
		<td class="ewTableHeader">Id Empleado</td>
		<td<?php echo $empleados->id_empleado->CellAttributes() ?>>
<div<?php echo $empleados->id_empleado->ViewAttributes() ?>><?php echo $empleados->id_empleado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->id_empresa->Visible) { // id_empresa ?>
	<tr<?php echo $empleados->id_empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $empleados->id_empresa->CellAttributes() ?>>
<div<?php echo $empleados->id_empresa->ViewAttributes() ?>><?php echo $empleados->id_empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->nombre_completo->Visible) { // nombre_completo ?>
	<tr<?php echo $empleados->nombre_completo->RowAttributes ?>>
		<td class="ewTableHeader">Nombre Completo</td>
		<td<?php echo $empleados->nombre_completo->CellAttributes() ?>>
<div<?php echo $empleados->nombre_completo->ViewAttributes() ?>><?php echo $empleados->nombre_completo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->cedula->Visible) { // cedula ?>
	<tr<?php echo $empleados->cedula->RowAttributes ?>>
		<td class="ewTableHeader">Cedula</td>
		<td<?php echo $empleados->cedula->CellAttributes() ?>>
<div<?php echo $empleados->cedula->ViewAttributes() ?>><?php echo $empleados->cedula->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->fecha_ingreso->Visible) { // fecha_ingreso ?>
	<tr<?php echo $empleados->fecha_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Ingreso</td>
		<td<?php echo $empleados->fecha_ingreso->CellAttributes() ?>>
<div<?php echo $empleados->fecha_ingreso->ViewAttributes() ?>><?php echo $empleados->fecha_ingreso->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->ultimas_vacaciones->Visible) { // ultimas_vacaciones ?>
	<tr<?php echo $empleados->ultimas_vacaciones->RowAttributes ?>>
		<td class="ewTableHeader">Ult.Vacaciones</td>
		<td<?php echo $empleados->ultimas_vacaciones->CellAttributes() ?>>
<div<?php echo $empleados->ultimas_vacaciones->ViewAttributes() ?>><?php echo $empleados->ultimas_vacaciones->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->proximas_vacaciones->Visible) { // proximas_vacaciones ?>
	<tr<?php echo $empleados->proximas_vacaciones->RowAttributes ?>>
		<td class="ewTableHeader">Prox.Vacaciones</td>
		<td<?php echo $empleados->proximas_vacaciones->CellAttributes() ?>>
<div<?php echo $empleados->proximas_vacaciones->ViewAttributes() ?>><?php echo $empleados->proximas_vacaciones->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->Posicion->Visible) { // Posicion ?>
	<tr<?php echo $empleados->Posicion->RowAttributes ?>>
		<td class="ewTableHeader">Posicion</td>
		<td<?php echo $empleados->Posicion->CellAttributes() ?>>
<div<?php echo $empleados->Posicion->ViewAttributes() ?>><?php echo $empleados->Posicion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->salario_mensual->Visible) { // salario_mensual ?>
	<tr<?php echo $empleados->salario_mensual->RowAttributes ?>>
		<td class="ewTableHeader">Salario Mensual</td>
		<td<?php echo $empleados->salario_mensual->CellAttributes() ?>>
<div<?php echo $empleados->salario_mensual->ViewAttributes() ?>><?php echo $empleados->salario_mensual->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->salario_quincenal->Visible) { // salario_quincenal ?>
	<tr<?php echo $empleados->salario_quincenal->RowAttributes ?>>
		<td class="ewTableHeader">Salario Quincenal</td>
		<td<?php echo $empleados->salario_quincenal->CellAttributes() ?>>
<div<?php echo $empleados->salario_quincenal->ViewAttributes() ?>><?php echo $empleados->salario_quincenal->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->deducible_afp->Visible) { // deducible_afp ?>
	<tr<?php echo $empleados->deducible_afp->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Afp</td>
		<td<?php echo $empleados->deducible_afp->CellAttributes() ?>>
<div<?php echo $empleados->deducible_afp->ViewAttributes() ?>><?php echo $empleados->deducible_afp->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($empleados->deducible_sf->Visible) { // deducible_sf ?>
	<tr<?php echo $empleados->deducible_sf->RowAttributes ?>>
		<td class="ewTableHeader">Deducible Sf</td>
		<td<?php echo $empleados->deducible_sf->CellAttributes() ?>>
<div<?php echo $empleados->deducible_sf->ViewAttributes() ?>><?php echo $empleados->deducible_sf->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($empleados->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($empleados_view->Pager)) $empleados_view->Pager = new cPrevNextPager($empleados_view->lStartRec, $empleados_view->lDisplayRecs, $empleados_view->lTotalRecs) ?>
<?php if ($empleados_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($empleados_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($empleados_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $empleados_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($empleados_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($empleados_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $empleados_view->PageUrl() ?>start=<?php echo $empleados_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $empleados_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($empleados_view->sSrchWhere == "0=101") { ?>
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
<?php if ($empleados->Export == "") { ?>
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
class cempleados_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'empleados';

	// Page Object Name
	var $PageObjName = 'empleados_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $empleados;
		if ($empleados->UseTokenInUrl) $PageUrl .= "t=" . $empleados->TableVar . "&"; // add page token
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
		global $objForm, $empleados;
		if ($empleados->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($empleados->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($empleados->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cempleados_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["empleados"] = new cempleados();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'empleados', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $empleados;
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
		global $empleados;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_empleado"] <> "") {
				$empleados->id_empleado->setQueryStringValue($_GET["id_empleado"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$empleados->CurrentAction = "I"; // Display form
			switch ($empleados->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No se encontraron registros"); // Set no record message
						$this->Page_Terminate("empleadoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($empleados->id_empleado->CurrentValue) == strval($rs->fields('id_empleado'))) {
								$empleados->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "empleadoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "empleadoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$empleados->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $empleados;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$empleados->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$empleados->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $empleados->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$empleados->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$empleados->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$empleados->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $empleados;

		// Call Recordset Selecting event
		$empleados->Recordset_Selecting($empleados->CurrentFilter);

		// Load list page SQL
		$sSql = $empleados->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$empleados->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $empleados;
		$sFilter = $empleados->KeyFilter();

		// Call Row Selecting event
		$empleados->Row_Selecting($sFilter);

		// Load sql based on filter
		$empleados->CurrentFilter = $sFilter;
		$sSql = $empleados->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$empleados->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $empleados;
		$empleados->id_empleado->setDbValue($rs->fields('id_empleado'));
		$empleados->id_empresa->setDbValue($rs->fields('id_empresa'));
		$empleados->nombre_completo->setDbValue($rs->fields('nombre_completo'));
		$empleados->cedula->setDbValue($rs->fields('cedula'));
		$empleados->fecha_ingreso->setDbValue($rs->fields('fecha_ingreso'));
		$empleados->ultimas_vacaciones->setDbValue($rs->fields('ultimas_vacaciones'));
		$empleados->proximas_vacaciones->setDbValue($rs->fields('proximas_vacaciones'));
		$empleados->Posicion->setDbValue($rs->fields('Posicion'));
		$empleados->salario_mensual->setDbValue($rs->fields('salario_mensual'));
		$empleados->salario_quincenal->setDbValue($rs->fields('salario_quincenal'));
		$empleados->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$empleados->deducible_sf->setDbValue($rs->fields('deducible_sf'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $empleados;

		// Call Row_Rendering event
		$empleados->Row_Rendering();

		// Common render codes for all row types
		// id_empleado

		$empleados->id_empleado->CellCssStyle = "";
		$empleados->id_empleado->CellCssClass = "";

		// id_empresa
		$empleados->id_empresa->CellCssStyle = "";
		$empleados->id_empresa->CellCssClass = "";

		// nombre_completo
		$empleados->nombre_completo->CellCssStyle = "";
		$empleados->nombre_completo->CellCssClass = "";

		// cedula
		$empleados->cedula->CellCssStyle = "";
		$empleados->cedula->CellCssClass = "";

		// fecha_ingreso
		$empleados->fecha_ingreso->CellCssStyle = "";
		$empleados->fecha_ingreso->CellCssClass = "";

		// ultimas_vacaciones
		$empleados->ultimas_vacaciones->CellCssStyle = "";
		$empleados->ultimas_vacaciones->CellCssClass = "";

		// proximas_vacaciones
		$empleados->proximas_vacaciones->CellCssStyle = "";
		$empleados->proximas_vacaciones->CellCssClass = "";

		// Posicion
		$empleados->Posicion->CellCssStyle = "";
		$empleados->Posicion->CellCssClass = "";

		// salario_mensual
		$empleados->salario_mensual->CellCssStyle = "";
		$empleados->salario_mensual->CellCssClass = "";

		// salario_quincenal
		$empleados->salario_quincenal->CellCssStyle = "";
		$empleados->salario_quincenal->CellCssClass = "";

		// deducible_afp
		$empleados->deducible_afp->CellCssStyle = "";
		$empleados->deducible_afp->CellCssClass = "";

		// deducible_sf
		$empleados->deducible_sf->CellCssStyle = "";
		$empleados->deducible_sf->CellCssClass = "";
		if ($empleados->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_empleado
			$empleados->id_empleado->ViewValue = $empleados->id_empleado->CurrentValue;
			$empleados->id_empleado->CssStyle = "";
			$empleados->id_empleado->CssClass = "";
			$empleados->id_empleado->ViewCustomAttributes = "";

			// id_empresa
			if (strval($empleados->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($empleados->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$empleados->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$empleados->id_empresa->ViewValue = $empleados->id_empresa->CurrentValue;
				}
			} else {
				$empleados->id_empresa->ViewValue = NULL;
			}
			$empleados->id_empresa->CssStyle = "";
			$empleados->id_empresa->CssClass = "";
			$empleados->id_empresa->ViewCustomAttributes = "";

			// nombre_completo
			$empleados->nombre_completo->ViewValue = $empleados->nombre_completo->CurrentValue;
			$empleados->nombre_completo->CssStyle = "";
			$empleados->nombre_completo->CssClass = "";
			$empleados->nombre_completo->ViewCustomAttributes = "";

			// cedula
			$empleados->cedula->ViewValue = $empleados->cedula->CurrentValue;
			$empleados->cedula->CssStyle = "";
			$empleados->cedula->CssClass = "";
			$empleados->cedula->ViewCustomAttributes = "";

			// fecha_ingreso
			$empleados->fecha_ingreso->ViewValue = $empleados->fecha_ingreso->CurrentValue;
			$empleados->fecha_ingreso->ViewValue = ew_FormatDateTime($empleados->fecha_ingreso->ViewValue, 7);
			$empleados->fecha_ingreso->CssStyle = "";
			$empleados->fecha_ingreso->CssClass = "";
			$empleados->fecha_ingreso->ViewCustomAttributes = "";

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->ViewValue = $empleados->ultimas_vacaciones->CurrentValue;
			$empleados->ultimas_vacaciones->CssStyle = "";
			$empleados->ultimas_vacaciones->CssClass = "";
			$empleados->ultimas_vacaciones->ViewCustomAttributes = "";

			// proximas_vacaciones
			$empleados->proximas_vacaciones->ViewValue = $empleados->proximas_vacaciones->CurrentValue;
			$empleados->proximas_vacaciones->CssStyle = "";
			$empleados->proximas_vacaciones->CssClass = "";
			$empleados->proximas_vacaciones->ViewCustomAttributes = "";

			// Posicion
			$empleados->Posicion->ViewValue = $empleados->Posicion->CurrentValue;
			$empleados->Posicion->CssStyle = "";
			$empleados->Posicion->CssClass = "";
			$empleados->Posicion->ViewCustomAttributes = "";

			// salario_mensual
			$empleados->salario_mensual->ViewValue = $empleados->salario_mensual->CurrentValue;
			$empleados->salario_mensual->CssStyle = "";
			$empleados->salario_mensual->CssClass = "";
			$empleados->salario_mensual->ViewCustomAttributes = "";

			// salario_quincenal
			$empleados->salario_quincenal->ViewValue = $empleados->salario_quincenal->CurrentValue;
			$empleados->salario_quincenal->CssStyle = "";
			$empleados->salario_quincenal->CssClass = "";
			$empleados->salario_quincenal->ViewCustomAttributes = "";

			// deducible_afp
			$empleados->deducible_afp->ViewValue = $empleados->deducible_afp->CurrentValue;
			$empleados->deducible_afp->CssStyle = "";
			$empleados->deducible_afp->CssClass = "";
			$empleados->deducible_afp->ViewCustomAttributes = "";

			// deducible_sf
			$empleados->deducible_sf->ViewValue = $empleados->deducible_sf->CurrentValue;
			$empleados->deducible_sf->CssStyle = "";
			$empleados->deducible_sf->CssClass = "";
			$empleados->deducible_sf->ViewCustomAttributes = "";

			// id_empleado
			$empleados->id_empleado->HrefValue = "";

			// id_empresa
			$empleados->id_empresa->HrefValue = "";

			// nombre_completo
			$empleados->nombre_completo->HrefValue = "";

			// cedula
			$empleados->cedula->HrefValue = "";

			// fecha_ingreso
			$empleados->fecha_ingreso->HrefValue = "";

			// ultimas_vacaciones
			$empleados->ultimas_vacaciones->HrefValue = "";

			// proximas_vacaciones
			$empleados->proximas_vacaciones->HrefValue = "";

			// Posicion
			$empleados->Posicion->HrefValue = "";

			// salario_mensual
			$empleados->salario_mensual->HrefValue = "";

			// salario_quincenal
			$empleados->salario_quincenal->HrefValue = "";

			// deducible_afp
			$empleados->deducible_afp->HrefValue = "";

			// deducible_sf
			$empleados->deducible_sf->HrefValue = "";
		}

		// Call Row Rendered event
		$empleados->Row_Rendered();
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
