<?php

// Arenas 6 configuration for Table egresos
$egresos = new cegresos; // Initialize table object

// Define table class
class cegresos {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id_pago;
	var $estado;
	var $total_rd;
	var $total_us;
	var $total_euros;
	var $Impuestos_pagados;
	var $Numero_Referencia;
	var $tipo_comprobante;
	var $Comprobante_fiscal;
	var $Metodo_pago;
	var $proveedor;
	var $fecha;
	var $tipo1;
	var $notas;
	var $Empresa;
	var $locacion;
	var $cuenta_banco;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function cegresos() {
		$this->TableVar = "egresos";
		$this->TableName = "egresos";
		$this->SelectLimit = TRUE;
		$this->id_pago = new cField('egresos', 'x_id_pago', 'id_pago', "`id_pago`", 3, -1, FALSE);
		$this->fields['id_pago'] =& $this->id_pago;
		$this->estado = new cField('egresos', 'x_estado', 'estado', "`estado`", 200, -1, FALSE);
		$this->fields['estado'] =& $this->estado;
		$this->total_rd = new cField('egresos', 'x_total_rd', 'total_rd', "`total_rd`", 5, -1, FALSE);
		$this->fields['total_rd'] =& $this->total_rd;
		$this->total_us = new cField('egresos', 'x_total_us', 'total_us', "`total_us`", 5, -1, FALSE);
		$this->fields['total_us'] =& $this->total_us;
		$this->total_euros = new cField('egresos', 'x_total_euros', 'total_euros', "`total_euros`", 5, -1, FALSE);
		$this->fields['total_euros'] =& $this->total_euros;
		$this->Impuestos_pagados = new cField('egresos', 'x_Impuestos_pagados', 'Impuestos_pagados', "`Impuestos_pagados`", 5, -1, FALSE);
		$this->fields['Impuestos_pagados'] =& $this->Impuestos_pagados;
		$this->Numero_Referencia = new cField('egresos', 'x_Numero_Referencia', 'Numero_Referencia', "`Numero_Referencia`", 200, -1, FALSE);
		$this->fields['Numero_Referencia'] =& $this->Numero_Referencia;
		$this->tipo_comprobante = new cField('egresos', 'x_tipo_comprobante', 'tipo_comprobante', "`tipo_comprobante`", 200, -1, FALSE);
		$this->fields['tipo_comprobante'] =& $this->tipo_comprobante;
		$this->Comprobante_fiscal = new cField('egresos', 'x_Comprobante_fiscal', 'Comprobante_fiscal', "`Comprobante_fiscal`", 200, -1, FALSE);
		$this->fields['Comprobante_fiscal'] =& $this->Comprobante_fiscal;
		$this->Metodo_pago = new cField('egresos', 'x_Metodo_pago', 'Metodo_pago', "`Metodo_pago`", 200, -1, FALSE);
		$this->fields['Metodo_pago'] =& $this->Metodo_pago;
		$this->proveedor = new cField('egresos', 'x_proveedor', 'proveedor', "`proveedor`", 200, -1, FALSE);
		$this->fields['proveedor'] =& $this->proveedor;
		$this->fecha = new cField('egresos', 'x_fecha', 'fecha', "`fecha`", 133, 7, FALSE);
		$this->fields['fecha'] =& $this->fecha;
		$this->tipo1 = new cField('egresos', 'x_tipo1', 'tipo1', "`tipo1`", 200, -1, FALSE);
		$this->fields['tipo1'] =& $this->tipo1;
		$this->notas = new cField('egresos', 'x_notas', 'notas', "`notas`", 201, -1, FALSE);
		$this->fields['notas'] =& $this->notas;
		$this->Empresa = new cField('egresos', 'x_Empresa', 'Empresa', "`Empresa`", 200, -1, FALSE);
		$this->fields['Empresa'] =& $this->Empresa;
		$this->locacion = new cField('egresos', 'x_locacion', 'locacion', "`locacion`", 200, -1, FALSE);
		$this->fields['locacion'] =& $this->locacion;
		$this->cuenta_banco = new cField('egresos', 'x_cuenta_banco', 'cuenta_banco', "`cuenta_banco`", 200, -1, FALSE);
		$this->fields['cuenta_banco'] =& $this->cuenta_banco;
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
		return "egresos_Highlight";
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
		return "SELECT * FROM `egresos`";
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
		return "`id_pago` DESC";
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
		return "INSERT INTO `egresos` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `egresos` SET ";
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
		$SQL = "DELETE FROM `egresos` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id_pago' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id_pago'], $this->id_pago->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`id_pago` = @id_pago@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_pago->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_pago@", ew_AdjustSql($this->id_pago->CurrentValue), $sKeyFilter); // Replace key value
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
			return "egresoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("egresosview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "egresosadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("egresosedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("egresosadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("egresosdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_pago->CurrentValue)) {
			$sUrl .= "id_pago=" . urlencode($this->id_pago->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=egresos" : "";
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
		$this->id_pago->setDbValue($rs->fields('id_pago'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->total_rd->setDbValue($rs->fields('total_rd'));
		$this->total_us->setDbValue($rs->fields('total_us'));
		$this->total_euros->setDbValue($rs->fields('total_euros'));
		$this->Impuestos_pagados->setDbValue($rs->fields('Impuestos_pagados'));
		$this->Numero_Referencia->setDbValue($rs->fields('Numero_Referencia'));
		$this->tipo_comprobante->setDbValue($rs->fields('tipo_comprobante'));
		$this->Comprobante_fiscal->setDbValue($rs->fields('Comprobante_fiscal'));
		$this->Metodo_pago->setDbValue($rs->fields('Metodo_pago'));
		$this->proveedor->setDbValue($rs->fields('proveedor'));
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->tipo1->setDbValue($rs->fields('tipo1'));
		$this->notas->setDbValue($rs->fields('notas'));
		$this->Empresa->setDbValue($rs->fields('Empresa'));
		$this->locacion->setDbValue($rs->fields('locacion'));
		$this->cuenta_banco->setDbValue($rs->fields('cuenta_banco'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_pago
		$this->id_pago->ViewValue = $this->id_pago->CurrentValue;
		$this->id_pago->CssStyle = "";
		$this->id_pago->CssClass = "";
		$this->id_pago->ViewCustomAttributes = "";

		// estado
		if (strval($this->estado->CurrentValue) <> "") {
			switch ($this->estado->CurrentValue) {
				case "Pagado":
					$this->estado->ViewValue = "Pagado";
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

		// total_rd
		$this->total_rd->ViewValue = $this->total_rd->CurrentValue;
		$this->total_rd->CssStyle = "";
		$this->total_rd->CssClass = "";
		$this->total_rd->ViewCustomAttributes = "";

		// total_us
		$this->total_us->ViewValue = $this->total_us->CurrentValue;
		$this->total_us->CssStyle = "";
		$this->total_us->CssClass = "";
		$this->total_us->ViewCustomAttributes = "";

		// total_euros
		$this->total_euros->ViewValue = $this->total_euros->CurrentValue;
		$this->total_euros->CssStyle = "";
		$this->total_euros->CssClass = "";
		$this->total_euros->ViewCustomAttributes = "";

		// Impuestos_pagados
		$this->Impuestos_pagados->ViewValue = $this->Impuestos_pagados->CurrentValue;
		$this->Impuestos_pagados->CssStyle = "";
		$this->Impuestos_pagados->CssClass = "";
		$this->Impuestos_pagados->ViewCustomAttributes = "";

		// Numero_Referencia
		$this->Numero_Referencia->ViewValue = $this->Numero_Referencia->CurrentValue;
		$this->Numero_Referencia->CssStyle = "";
		$this->Numero_Referencia->CssClass = "";
		$this->Numero_Referencia->ViewCustomAttributes = "";

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

		// Comprobante_fiscal
		$this->Comprobante_fiscal->ViewValue = $this->Comprobante_fiscal->CurrentValue;
		$this->Comprobante_fiscal->CssStyle = "";
		$this->Comprobante_fiscal->CssClass = "";
		$this->Comprobante_fiscal->ViewCustomAttributes = "";

		// Metodo_pago
		if (strval($this->Metodo_pago->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `metodo` FROM `metodos_pago` WHERE `id_metodo` = " . ew_AdjustSql($this->Metodo_pago->CurrentValue) . "";
			$sSqlWrk .= " ORDER BY `metodo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->Metodo_pago->ViewValue = $rswrk->fields('metodo');
				$rswrk->Close();
			} else {
				$this->Metodo_pago->ViewValue = $this->Metodo_pago->CurrentValue;
			}
		} else {
			$this->Metodo_pago->ViewValue = NULL;
		}
		$this->Metodo_pago->CssStyle = "";
		$this->Metodo_pago->CssClass = "";
		$this->Metodo_pago->ViewCustomAttributes = "";

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

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewValue = ew_FormatDateTime($this->fecha->ViewValue, 7);
		$this->fecha->CssStyle = "";
		$this->fecha->CssClass = "";
		$this->fecha->ViewCustomAttributes = "";

		// tipo1
		if (strval($this->tipo1->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `tipo` FROM `egresos_tipo1` WHERE `id_tipo` = " . ew_AdjustSql($this->tipo1->CurrentValue) . "";
			$sSqlWrk .= " ORDER BY `tipo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->tipo1->ViewValue = $rswrk->fields('tipo');
				$rswrk->Close();
			} else {
				$this->tipo1->ViewValue = $this->tipo1->CurrentValue;
			}
		} else {
			$this->tipo1->ViewValue = NULL;
		}
		$this->tipo1->CssStyle = "";
		$this->tipo1->CssClass = "";
		$this->tipo1->ViewCustomAttributes = "";

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

		// id_pago
		$this->id_pago->HrefValue = "";

		// estado
		$this->estado->HrefValue = "";

		// total_rd
		$this->total_rd->HrefValue = "";

		// total_us
		$this->total_us->HrefValue = "";

		// total_euros
		$this->total_euros->HrefValue = "";

		// Impuestos_pagados
		$this->Impuestos_pagados->HrefValue = "";

		// Numero_Referencia
		$this->Numero_Referencia->HrefValue = "";

		// tipo_comprobante
		$this->tipo_comprobante->HrefValue = "";

		// Comprobante_fiscal
		$this->Comprobante_fiscal->HrefValue = "";

		// Metodo_pago
		$this->Metodo_pago->HrefValue = "";

		// proveedor
		$this->proveedor->HrefValue = "";

		// fecha
		$this->fecha->HrefValue = "";

		// tipo1
		$this->tipo1->HrefValue = "";

		// Empresa
		$this->Empresa->HrefValue = "";

		// locacion
		$this->locacion->HrefValue = "";

		// cuenta_banco
		$this->cuenta_banco->HrefValue = "";

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
      // Change the row color
 if ($this->estado->ViewValue == "Pagado") {
        $this->CssStyle = "background-color: #00FF33";}
    if ($this->estado->ViewValue == "Pendiente") {
        $this->CssStyle = "background-color: yellow";}
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
