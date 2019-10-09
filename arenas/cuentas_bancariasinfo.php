<?php

// Arenas 6 configuration for Table cuentas_bancarias
$cuentas_bancarias = new ccuentas_bancarias; // Initialize table object

// Define table class
class ccuentas_bancarias {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id_banco;
	var $id_empresa;
	var $Banco;
	var $numero_cuenta;
	var $ejecutivo_cuenta;
	var $telefono_ejecutivo;
	var $tipo_cuenta;
	var $moneda;
	var $notas;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function ccuentas_bancarias() {
		$this->TableVar = "cuentas_bancarias";
		$this->TableName = "cuentas_bancarias";
		$this->SelectLimit = TRUE;
		$this->id_banco = new cField('cuentas_bancarias', 'x_id_banco', 'id_banco', "`id_banco`", 3, -1, FALSE);
		$this->fields['id_banco'] =& $this->id_banco;
		$this->id_empresa = new cField('cuentas_bancarias', 'x_id_empresa', 'id_empresa', "`id_empresa`", 3, -1, FALSE);
		$this->fields['id_empresa'] =& $this->id_empresa;
		$this->Banco = new cField('cuentas_bancarias', 'x_Banco', 'Banco', "`Banco`", 200, -1, FALSE);
		$this->fields['Banco'] =& $this->Banco;
		$this->numero_cuenta = new cField('cuentas_bancarias', 'x_numero_cuenta', 'numero_cuenta', "`numero_cuenta`", 200, -1, FALSE);
		$this->fields['numero_cuenta'] =& $this->numero_cuenta;
		$this->ejecutivo_cuenta = new cField('cuentas_bancarias', 'x_ejecutivo_cuenta', 'ejecutivo_cuenta', "`ejecutivo_cuenta`", 200, -1, FALSE);
		$this->fields['ejecutivo_cuenta'] =& $this->ejecutivo_cuenta;
		$this->telefono_ejecutivo = new cField('cuentas_bancarias', 'x_telefono_ejecutivo', 'telefono_ejecutivo', "`telefono_ejecutivo`", 200, -1, FALSE);
		$this->fields['telefono_ejecutivo'] =& $this->telefono_ejecutivo;
		$this->tipo_cuenta = new cField('cuentas_bancarias', 'x_tipo_cuenta', 'tipo_cuenta', "`tipo_cuenta`", 200, -1, FALSE);
		$this->fields['tipo_cuenta'] =& $this->tipo_cuenta;
		$this->moneda = new cField('cuentas_bancarias', 'x_moneda', 'moneda', "`moneda`", 200, -1, FALSE);
		$this->fields['moneda'] =& $this->moneda;
		$this->notas = new cField('cuentas_bancarias', 'x_notas', 'notas', "`notas`", 201, -1, FALSE);
		$this->fields['notas'] =& $this->notas;
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
		return "cuentas_bancarias_Highlight";
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

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `cuentas_bancarias`";
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
		return "";
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
		return "INSERT INTO `cuentas_bancarias` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `cuentas_bancarias` SET ";
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
		$SQL = "DELETE FROM `cuentas_bancarias` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id_banco' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id_banco'], $this->id_banco->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`id_banco` = @id_banco@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_banco->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_banco@", ew_AdjustSql($this->id_banco->CurrentValue), $sKeyFilter); // Replace key value
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
			return "cuentas_bancariaslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("cuentas_bancariasview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "cuentas_bancariasadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("cuentas_bancariasedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("cuentas_bancariasadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("cuentas_bancariasdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_banco->CurrentValue)) {
			$sUrl .= "id_banco=" . urlencode($this->id_banco->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=cuentas_bancarias" : "";
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
		$this->id_banco->setDbValue($rs->fields('id_banco'));
		$this->id_empresa->setDbValue($rs->fields('id_empresa'));
		$this->Banco->setDbValue($rs->fields('Banco'));
		$this->numero_cuenta->setDbValue($rs->fields('numero_cuenta'));
		$this->ejecutivo_cuenta->setDbValue($rs->fields('ejecutivo_cuenta'));
		$this->telefono_ejecutivo->setDbValue($rs->fields('telefono_ejecutivo'));
		$this->tipo_cuenta->setDbValue($rs->fields('tipo_cuenta'));
		$this->moneda->setDbValue($rs->fields('moneda'));
		$this->notas->setDbValue($rs->fields('notas'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_banco
		$this->id_banco->ViewValue = $this->id_banco->CurrentValue;
		$this->id_banco->CssStyle = "";
		$this->id_banco->CssClass = "";
		$this->id_banco->ViewCustomAttributes = "";

		// id_empresa
		if (strval($this->id_empresa->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($this->id_empresa->CurrentValue) . "";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->id_empresa->ViewValue = $rswrk->fields('nombre');
				$rswrk->Close();
			} else {
				$this->id_empresa->ViewValue = $this->id_empresa->CurrentValue;
			}
		} else {
			$this->id_empresa->ViewValue = NULL;
		}
		$this->id_empresa->CssStyle = "";
		$this->id_empresa->CssClass = "";
		$this->id_empresa->ViewCustomAttributes = "";

		// Banco
		$this->Banco->ViewValue = $this->Banco->CurrentValue;
		$this->Banco->CssStyle = "";
		$this->Banco->CssClass = "";
		$this->Banco->ViewCustomAttributes = "";

		// numero_cuenta
		$this->numero_cuenta->ViewValue = $this->numero_cuenta->CurrentValue;
		$this->numero_cuenta->CssStyle = "";
		$this->numero_cuenta->CssClass = "";
		$this->numero_cuenta->ViewCustomAttributes = "";

		// ejecutivo_cuenta
		$this->ejecutivo_cuenta->ViewValue = $this->ejecutivo_cuenta->CurrentValue;
		$this->ejecutivo_cuenta->CssStyle = "";
		$this->ejecutivo_cuenta->CssClass = "";
		$this->ejecutivo_cuenta->ViewCustomAttributes = "";

		// telefono_ejecutivo
		$this->telefono_ejecutivo->ViewValue = $this->telefono_ejecutivo->CurrentValue;
		$this->telefono_ejecutivo->CssStyle = "";
		$this->telefono_ejecutivo->CssClass = "";
		$this->telefono_ejecutivo->ViewCustomAttributes = "";

		// tipo_cuenta
		if (strval($this->tipo_cuenta->CurrentValue) <> "") {
			switch ($this->tipo_cuenta->CurrentValue) {
				case "Ahorros":
					$this->tipo_cuenta->ViewValue = "Ahorros";
					break;
				case "Corriente":
					$this->tipo_cuenta->ViewValue = "Corriente";
					break;
				default:
					$this->tipo_cuenta->ViewValue = $this->tipo_cuenta->CurrentValue;
			}
		} else {
			$this->tipo_cuenta->ViewValue = NULL;
		}
		$this->tipo_cuenta->CssStyle = "";
		$this->tipo_cuenta->CssClass = "";
		$this->tipo_cuenta->ViewCustomAttributes = "";

		// moneda
		$this->moneda->ViewValue = $this->moneda->CurrentValue;
		$this->moneda->CssStyle = "";
		$this->moneda->CssClass = "";
		$this->moneda->ViewCustomAttributes = "";

		// id_banco
		$this->id_banco->HrefValue = "";

		// id_empresa
		$this->id_empresa->HrefValue = "";

		// Banco
		$this->Banco->HrefValue = "";

		// numero_cuenta
		$this->numero_cuenta->HrefValue = "";

		// ejecutivo_cuenta
		$this->ejecutivo_cuenta->HrefValue = "";

		// telefono_ejecutivo
		$this->telefono_ejecutivo->HrefValue = "";

		// tipo_cuenta
		$this->tipo_cuenta->HrefValue = "";

		// moneda
		$this->moneda->HrefValue = "";

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
