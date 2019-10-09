<?php

// Arenas 6 configuration for Table ingresos
$ingresos = new cingresos; // Initialize table object

// Define table class
class cingresos {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id_ingreso;
	var $tipo_ingreso;
	var $estado;
	var $Numero_Factura;
	var $Fecha_Factura;
	var $Fecha_Dep;
	var $Descripcion;
	var $Valor_RD;
	var $Valor_US;
	var $Valor_Euros;
	var $Valor_Tarjeta_credito;
	var $Empresa;
	var $tipo_comprobante;
	var $NCF;
	var $locacion;
	var $cuenta_banco;
	var $proveedor;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function cingresos() {
		$this->TableVar = "ingresos";
		$this->TableName = "ingresos";
		$this->SelectLimit = TRUE;
		$this->id_ingreso = new cField('ingresos', 'x_id_ingreso', 'id_ingreso', "`id_ingreso`", 3, -1, FALSE);
		$this->fields['id_ingreso'] =& $this->id_ingreso;
		$this->tipo_ingreso = new cField('ingresos', 'x_tipo_ingreso', 'tipo_ingreso', "`tipo_ingreso`", 3, -1, FALSE);
		$this->fields['tipo_ingreso'] =& $this->tipo_ingreso;
		$this->estado = new cField('ingresos', 'x_estado', 'estado', "`estado`", 200, -1, FALSE);
		$this->fields['estado'] =& $this->estado;
		$this->Numero_Factura = new cField('ingresos', 'x_Numero_Factura', 'Numero_Factura', "`Numero_Factura`", 200, -1, FALSE);
		$this->fields['Numero_Factura'] =& $this->Numero_Factura;
		$this->Fecha_Factura = new cField('ingresos', 'x_Fecha_Factura', 'Fecha_Factura', "`Fecha_Factura`", 133, 7, FALSE);
		$this->fields['Fecha_Factura'] =& $this->Fecha_Factura;
		$this->Fecha_Dep = new cField('ingresos', 'x_Fecha_Dep', 'Fecha_Dep', "`Fecha_Dep`", 133, 7, FALSE);
		$this->fields['Fecha_Dep'] =& $this->Fecha_Dep;
		$this->Descripcion = new cField('ingresos', 'x_Descripcion', 'Descripcion', "`Descripcion`", 201, -1, FALSE);
		$this->fields['Descripcion'] =& $this->Descripcion;
		$this->Valor_RD = new cField('ingresos', 'x_Valor_RD', 'Valor_RD', "`Valor_RD`", 5, -1, FALSE);
		$this->fields['Valor_RD'] =& $this->Valor_RD;
		$this->Valor_US = new cField('ingresos', 'x_Valor_US', 'Valor_US', "`Valor_US`", 5, -1, FALSE);
		$this->fields['Valor_US'] =& $this->Valor_US;
		$this->Valor_Euros = new cField('ingresos', 'x_Valor_Euros', 'Valor_Euros', "`Valor_Euros`", 5, -1, FALSE);
		$this->fields['Valor_Euros'] =& $this->Valor_Euros;
		$this->Valor_Tarjeta_credito = new cField('ingresos', 'x_Valor_Tarjeta_credito', 'Valor_Tarjeta_credito', "`Valor_Tarjeta_credito`", 5, -1, FALSE);
		$this->fields['Valor_Tarjeta_credito'] =& $this->Valor_Tarjeta_credito;
		$this->Empresa = new cField('ingresos', 'x_Empresa', 'Empresa', "`Empresa`", 200, -1, FALSE);
		$this->fields['Empresa'] =& $this->Empresa;
		$this->tipo_comprobante = new cField('ingresos', 'x_tipo_comprobante', 'tipo_comprobante', "`tipo_comprobante`", 200, -1, FALSE);
		$this->fields['tipo_comprobante'] =& $this->tipo_comprobante;
		$this->NCF = new cField('ingresos', 'x_NCF', 'NCF', "`NCF`", 200, -1, FALSE);
		$this->fields['NCF'] =& $this->NCF;
		$this->locacion = new cField('ingresos', 'x_locacion', 'locacion', "`locacion`", 200, -1, FALSE);
		$this->fields['locacion'] =& $this->locacion;
		$this->cuenta_banco = new cField('ingresos', 'x_cuenta_banco', 'cuenta_banco', "`cuenta_banco`", 200, -1, FALSE);
		$this->fields['cuenta_banco'] =& $this->cuenta_banco;
		$this->proveedor = new cField('ingresos', 'x_proveedor', 'proveedor', "`proveedor`", 200, -1, FALSE);
		$this->fields['proveedor'] =& $this->proveedor;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search Highlight Name
	function HighlightName() {
		return "ingresos_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master where clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail where clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_proveedores() {
		return "`id_proveedor`=@id_proveedor@";
	}

	// Detail filter
	function SqlDetailFilter_proveedores() {
		return "`proveedor`='@proveedor@'";
	}

	// Master filter
	function SqlMasterFilter_locaciones() {
		return "`id_locacion`=@id_locacion@";
	}

	// Detail filter
	function SqlDetailFilter_locaciones() {
		return "`locacion`='@locacion@'";
	}

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `ingresos`";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`id_ingreso` DESC";
	}

	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter .= " AND ";
			$sFilter .= $this->CurrentFilter;
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		$sFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF)
						$cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $sFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `ingresos` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `ingresos` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `ingresos` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id_ingreso' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id_ingreso'], $this->id_ingreso->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`id_ingreso` = @id_ingreso@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_ingreso->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_ingreso@", ew_AdjustSql($this->id_ingreso->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return url
	function getReturnUrl() {

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "ingresoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("ingresosview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "ingresosadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("ingresosedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("ingresosadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("ingresosdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_ingreso->CurrentValue)) {
			$sUrl .= "id_ingreso=" . urlencode($this->id_ingreso->CurrentValue);
		} else {
			return "javascript:alert('Registro invalido! la clave es null');";
		}
		return $sUrl;
	}

	// Sort Url
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			($fld->FldType == 205)) { // Unsortable data type
			return "";
		} else {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		}
	}

	// URL parm
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=ingresos" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Function LoadRs
	// - Load rows based on filter
	function LoadRs($sFilter) {
		global $conn;

		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id_ingreso->setDbValue($rs->fields('id_ingreso'));
		$this->tipo_ingreso->setDbValue($rs->fields('tipo_ingreso'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->Numero_Factura->setDbValue($rs->fields('Numero_Factura'));
		$this->Fecha_Factura->setDbValue($rs->fields('Fecha_Factura'));
		$this->Fecha_Dep->setDbValue($rs->fields('Fecha_Dep'));
		$this->Descripcion->setDbValue($rs->fields('Descripcion'));
		$this->Valor_RD->setDbValue($rs->fields('Valor_RD'));
		$this->Valor_US->setDbValue($rs->fields('Valor_US'));
		$this->Valor_Euros->setDbValue($rs->fields('Valor_Euros'));
		$this->Valor_Tarjeta_credito->setDbValue($rs->fields('Valor_Tarjeta_credito'));
		$this->Empresa->setDbValue($rs->fields('Empresa'));
		$this->tipo_comprobante->setDbValue($rs->fields('tipo_comprobante'));
		$this->NCF->setDbValue($rs->fields('NCF'));
		$this->locacion->setDbValue($rs->fields('locacion'));
		$this->cuenta_banco->setDbValue($rs->fields('cuenta_banco'));
		$this->proveedor->setDbValue($rs->fields('proveedor'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_ingreso
		$this->id_ingreso->ViewValue = $this->id_ingreso->CurrentValue;
		$this->id_ingreso->CssStyle = "";
		$this->id_ingreso->CssClass = "";
		$this->id_ingreso->ViewCustomAttributes = "";

		// tipo_ingreso
		if (strval($this->tipo_ingreso->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nombre` FROM `ingresos_tipos` WHERE `id_ingresos` = " . ew_AdjustSql($this->tipo_ingreso->CurrentValue) . "";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->tipo_ingreso->ViewValue = $rswrk->fields('nombre');
				$rswrk->Close();
			} else {
				$this->tipo_ingreso->ViewValue = $this->tipo_ingreso->CurrentValue;
			}
		} else {
			$this->tipo_ingreso->ViewValue = NULL;
		}
		$this->tipo_ingreso->CssStyle = "";
		$this->tipo_ingreso->CssClass = "";
		$this->tipo_ingreso->ViewCustomAttributes = "";

		// estado
		if (strval($this->estado->CurrentValue) <> "") {
			switch ($this->estado->CurrentValue) {
				case "Cobrado":
					$this->estado->ViewValue = "Cobrado";
					break;
				case "Pendiente":
					$this->estado->ViewValue = "Pendiente";
					break;
				default:
					$this->estado->ViewValue = $this->estado->CurrentValue;
			}
		} else {
			$this->estado->ViewValue = NULL;
		}
		$this->estado->CssStyle = "";
		$this->estado->CssClass = "";
		$this->estado->ViewCustomAttributes = "";

		// Numero_Factura
		$this->Numero_Factura->ViewValue = $this->Numero_Factura->CurrentValue;
		$this->Numero_Factura->CssStyle = "";
		$this->Numero_Factura->CssClass = "";
		$this->Numero_Factura->ViewCustomAttributes = "";

		// Fecha_Factura
		$this->Fecha_Factura->ViewValue = $this->Fecha_Factura->CurrentValue;
		$this->Fecha_Factura->ViewValue = ew_FormatDateTime($this->Fecha_Factura->ViewValue, 7);
		$this->Fecha_Factura->CssStyle = "";
		$this->Fecha_Factura->CssClass = "";
		$this->Fecha_Factura->ViewCustomAttributes = "";

		// Fecha_Dep
		$this->Fecha_Dep->ViewValue = $this->Fecha_Dep->CurrentValue;
		$this->Fecha_Dep->ViewValue = ew_FormatDateTime($this->Fecha_Dep->ViewValue, 7);
		$this->Fecha_Dep->CssStyle = "";
		$this->Fecha_Dep->CssClass = "";
		$this->Fecha_Dep->ViewCustomAttributes = "";

		// Valor_RD
		$this->Valor_RD->ViewValue = $this->Valor_RD->CurrentValue;
		$this->Valor_RD->CssStyle = "";
		$this->Valor_RD->CssClass = "";
		$this->Valor_RD->ViewCustomAttributes = "";

		// Valor_US
		$this->Valor_US->ViewValue = $this->Valor_US->CurrentValue;
		$this->Valor_US->CssStyle = "";
		$this->Valor_US->CssClass = "";
		$this->Valor_US->ViewCustomAttributes = "";

		// Valor_Euros
		$this->Valor_Euros->ViewValue = $this->Valor_Euros->CurrentValue;
		$this->Valor_Euros->CssStyle = "";
		$this->Valor_Euros->CssClass = "";
		$this->Valor_Euros->ViewCustomAttributes = "";

		// Valor_Tarjeta_credito
		$this->Valor_Tarjeta_credito->ViewValue = $this->Valor_Tarjeta_credito->CurrentValue;
		$this->Valor_Tarjeta_credito->CssStyle = "";
		$this->Valor_Tarjeta_credito->CssClass = "";
		$this->Valor_Tarjeta_credito->ViewCustomAttributes = "";

		// Empresa
		if (strval($this->Empresa->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($this->Empresa->CurrentValue) . "";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->Empresa->ViewValue = $rswrk->fields('nombre');
				$rswrk->Close();
			} else {
				$this->Empresa->ViewValue = $this->Empresa->CurrentValue;
			}
		} else {
			$this->Empresa->ViewValue = NULL;
		}
		$this->Empresa->CssStyle = "";
		$this->Empresa->CssClass = "";
		$this->Empresa->ViewCustomAttributes = "";

		// tipo_comprobante
		if (strval($this->tipo_comprobante->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nombre_tipo` FROM `comprobantes_tipos` WHERE `nombre_tipo` = '" . ew_AdjustSql($this->tipo_comprobante->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->tipo_comprobante->ViewValue = $rswrk->fields('nombre_tipo');
				$rswrk->Close();
			} else {
				$this->tipo_comprobante->ViewValue = $this->tipo_comprobante->CurrentValue;
			}
		} else {
			$this->tipo_comprobante->ViewValue = NULL;
		}
		$this->tipo_comprobante->CssStyle = "";
		$this->tipo_comprobante->CssClass = "";
		$this->tipo_comprobante->ViewCustomAttributes = "";

		// NCF
		$this->NCF->ViewValue = $this->NCF->CurrentValue;
		$this->NCF->CssStyle = "";
		$this->NCF->CssClass = "";
		$this->NCF->ViewCustomAttributes = "";

		// locacion
		if (strval($this->locacion->CurrentValue) <> "") {
			$arwrk = explode(",", $this->locacion->CurrentValue);
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
				$this->locacion->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$this->locacion->ViewValue .= $rswrk->fields('nombre');
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->locacion->ViewValue = $this->locacion->CurrentValue;
			}
		} else {
			$this->locacion->ViewValue = NULL;
		}
		$this->locacion->CssStyle = "";
		$this->locacion->CssClass = "";
		$this->locacion->ViewCustomAttributes = "";

		// cuenta_banco
		if (strval($this->cuenta_banco->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `Banco`, `numero_cuenta` FROM `cuentas_bancarias` WHERE `id_banco` = " . ew_AdjustSql($this->cuenta_banco->CurrentValue) . "";
			$sSqlWrk .= " ORDER BY `Banco` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->cuenta_banco->ViewValue = $rswrk->fields('Banco');
				$this->cuenta_banco->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('numero_cuenta');
				$rswrk->Close();
			} else {
				$this->cuenta_banco->ViewValue = $this->cuenta_banco->CurrentValue;
			}
		} else {
			$this->cuenta_banco->ViewValue = NULL;
		}
		$this->cuenta_banco->CssStyle = "";
		$this->cuenta_banco->CssClass = "";
		$this->cuenta_banco->ViewCustomAttributes = "";

		// proveedor
		if (strval($this->proveedor->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($this->proveedor->CurrentValue) . "";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->proveedor->ViewValue = $rswrk->fields('nombre');
				$rswrk->Close();
			} else {
				$this->proveedor->ViewValue = $this->proveedor->CurrentValue;
			}
		} else {
			$this->proveedor->ViewValue = NULL;
		}
		$this->proveedor->CssStyle = "";
		$this->proveedor->CssClass = "";
		$this->proveedor->ViewCustomAttributes = "";

		// id_ingreso
		$this->id_ingreso->HrefValue = "";

		// tipo_ingreso
		$this->tipo_ingreso->HrefValue = "";

		// estado
		$this->estado->HrefValue = "";

		// Numero_Factura
		$this->Numero_Factura->HrefValue = "";

		// Fecha_Factura
		$this->Fecha_Factura->HrefValue = "";

		// Fecha_Dep
		$this->Fecha_Dep->HrefValue = "";

		// Valor_RD
		$this->Valor_RD->HrefValue = "";

		// Valor_US
		$this->Valor_US->HrefValue = "";

		// Valor_Euros
		$this->Valor_Euros->HrefValue = "";

		// Valor_Tarjeta_credito
		$this->Valor_Tarjeta_credito->HrefValue = "";

		// Empresa
		$this->Empresa->HrefValue = "";

		// tipo_comprobante
		$this->tipo_comprobante->HrefValue = "";

		// NCF
		$this->NCF->HrefValue = "";

		// locacion
		$this->locacion->HrefValue = "";

		// cuenta_banco
		$this->cuenta_banco->HrefValue = "";

		// proveedor
		$this->proveedor->HrefValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events

	// Row Attribute
	function RowAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . trim($this->RowClientEvents);
			}
		}
		return $sAtt;
	}

	// Field objects
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Deleting event
	function Row_Deleting($rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
