<?php

// Arenas 6 configuration for Table empleados
$empleados = new cempleados; // Initialize table object

// Define table class
class cempleados {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id_empleado;
	var $id_empresa;
	var $nombre_completo;
	var $cedula;
	var $fecha_ingreso;
	var $ultimas_vacaciones;
	var $proximas_vacaciones;
	var $Posicion;
	var $salario_mensual;
	var $salario_quincenal;
	var $deducible_afp;
	var $deducible_sf;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function cempleados() {
		$this->TableVar = "empleados";
		$this->TableName = "empleados";
		$this->SelectLimit = TRUE;
		$this->id_empleado = new cField('empleados', 'x_id_empleado', 'id_empleado', "`id_empleado`", 3, -1, FALSE);
		$this->fields['id_empleado'] =& $this->id_empleado;
		$this->id_empresa = new cField('empleados', 'x_id_empresa', 'id_empresa', "`id_empresa`", 3, -1, FALSE);
		$this->fields['id_empresa'] =& $this->id_empresa;
		$this->nombre_completo = new cField('empleados', 'x_nombre_completo', 'nombre_completo', "`nombre_completo`", 200, -1, FALSE);
		$this->fields['nombre_completo'] =& $this->nombre_completo;
		$this->cedula = new cField('empleados', 'x_cedula', 'cedula', "`cedula`", 200, -1, FALSE);
		$this->fields['cedula'] =& $this->cedula;
		$this->fecha_ingreso = new cField('empleados', 'x_fecha_ingreso', 'fecha_ingreso', "`fecha_ingreso`", 133, 7, FALSE);
		$this->fields['fecha_ingreso'] =& $this->fecha_ingreso;
		$this->ultimas_vacaciones = new cField('empleados', 'x_ultimas_vacaciones', 'ultimas_vacaciones', "`ultimas_vacaciones`", 200, -1, FALSE);
		$this->fields['ultimas_vacaciones'] =& $this->ultimas_vacaciones;
		$this->proximas_vacaciones = new cField('empleados', 'x_proximas_vacaciones', 'proximas_vacaciones', "`proximas_vacaciones`", 200, -1, FALSE);
		$this->fields['proximas_vacaciones'] =& $this->proximas_vacaciones;
		$this->Posicion = new cField('empleados', 'x_Posicion', 'Posicion', "`Posicion`", 200, -1, FALSE);
		$this->fields['Posicion'] =& $this->Posicion;
		$this->salario_mensual = new cField('empleados', 'x_salario_mensual', 'salario_mensual', "`salario_mensual`", 5, -1, FALSE);
		$this->fields['salario_mensual'] =& $this->salario_mensual;
		$this->salario_quincenal = new cField('empleados', 'x_salario_quincenal', 'salario_quincenal', "`salario_quincenal`", 5, -1, FALSE);
		$this->fields['salario_quincenal'] =& $this->salario_quincenal;
		$this->deducible_afp = new cField('empleados', 'x_deducible_afp', 'deducible_afp', "`deducible_afp`", 5, -1, FALSE);
		$this->fields['deducible_afp'] =& $this->deducible_afp;
		$this->deducible_sf = new cField('empleados', 'x_deducible_sf', 'deducible_sf', "`deducible_sf`", 5, -1, FALSE);
		$this->fields['deducible_sf'] =& $this->deducible_sf;
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
		return "empleados_Highlight";
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
		return "SELECT * FROM `empleados`";
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
		return "INSERT INTO `empleados` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `empleados` SET ";
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
		$SQL = "DELETE FROM `empleados` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id_empleado' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id_empleado'], $this->id_empleado->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`id_empleado` = @id_empleado@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_empleado->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_empleado@", ew_AdjustSql($this->id_empleado->CurrentValue), $sKeyFilter); // Replace key value
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
			return "empleadoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("empleadosview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "empleadosadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("empleadosedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("empleadosadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("empleadosdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_empleado->CurrentValue)) {
			$sUrl .= "id_empleado=" . urlencode($this->id_empleado->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=empleados" : "";
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
		$this->id_empleado->setDbValue($rs->fields('id_empleado'));
		$this->id_empresa->setDbValue($rs->fields('id_empresa'));
		$this->nombre_completo->setDbValue($rs->fields('nombre_completo'));
		$this->cedula->setDbValue($rs->fields('cedula'));
		$this->fecha_ingreso->setDbValue($rs->fields('fecha_ingreso'));
		$this->ultimas_vacaciones->setDbValue($rs->fields('ultimas_vacaciones'));
		$this->proximas_vacaciones->setDbValue($rs->fields('proximas_vacaciones'));
		$this->Posicion->setDbValue($rs->fields('Posicion'));
		$this->salario_mensual->setDbValue($rs->fields('salario_mensual'));
		$this->salario_quincenal->setDbValue($rs->fields('salario_quincenal'));
		$this->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$this->deducible_sf->setDbValue($rs->fields('deducible_sf'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_empleado
		$this->id_empleado->ViewValue = $this->id_empleado->CurrentValue;
		$this->id_empleado->CssStyle = "";
		$this->id_empleado->CssClass = "";
		$this->id_empleado->ViewCustomAttributes = "";

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

		// nombre_completo
		$this->nombre_completo->ViewValue = $this->nombre_completo->CurrentValue;
		$this->nombre_completo->CssStyle = "";
		$this->nombre_completo->CssClass = "";
		$this->nombre_completo->ViewCustomAttributes = "";

		// cedula
		$this->cedula->ViewValue = $this->cedula->CurrentValue;
		$this->cedula->CssStyle = "";
		$this->cedula->CssClass = "";
		$this->cedula->ViewCustomAttributes = "";

		// fecha_ingreso
		$this->fecha_ingreso->ViewValue = $this->fecha_ingreso->CurrentValue;
		$this->fecha_ingreso->ViewValue = ew_FormatDateTime($this->fecha_ingreso->ViewValue, 7);
		$this->fecha_ingreso->CssStyle = "";
		$this->fecha_ingreso->CssClass = "";
		$this->fecha_ingreso->ViewCustomAttributes = "";

		// ultimas_vacaciones
		$this->ultimas_vacaciones->ViewValue = $this->ultimas_vacaciones->CurrentValue;
		$this->ultimas_vacaciones->CssStyle = "";
		$this->ultimas_vacaciones->CssClass = "";
		$this->ultimas_vacaciones->ViewCustomAttributes = "";

		// proximas_vacaciones
		$this->proximas_vacaciones->ViewValue = $this->proximas_vacaciones->CurrentValue;
		$this->proximas_vacaciones->CssStyle = "";
		$this->proximas_vacaciones->CssClass = "";
		$this->proximas_vacaciones->ViewCustomAttributes = "";

		// Posicion
		$this->Posicion->ViewValue = $this->Posicion->CurrentValue;
		$this->Posicion->CssStyle = "";
		$this->Posicion->CssClass = "";
		$this->Posicion->ViewCustomAttributes = "";

		// salario_mensual
		$this->salario_mensual->ViewValue = $this->salario_mensual->CurrentValue;
		$this->salario_mensual->CssStyle = "";
		$this->salario_mensual->CssClass = "";
		$this->salario_mensual->ViewCustomAttributes = "";

		// salario_quincenal
		$this->salario_quincenal->ViewValue = $this->salario_quincenal->CurrentValue;
		$this->salario_quincenal->CssStyle = "";
		$this->salario_quincenal->CssClass = "";
		$this->salario_quincenal->ViewCustomAttributes = "";

		// deducible_afp
		$this->deducible_afp->ViewValue = $this->deducible_afp->CurrentValue;
		$this->deducible_afp->CssStyle = "";
		$this->deducible_afp->CssClass = "";
		$this->deducible_afp->ViewCustomAttributes = "";

		// deducible_sf
		$this->deducible_sf->ViewValue = $this->deducible_sf->CurrentValue;
		$this->deducible_sf->CssStyle = "";
		$this->deducible_sf->CssClass = "";
		$this->deducible_sf->ViewCustomAttributes = "";

		// id_empleado
		$this->id_empleado->HrefValue = "";

		// id_empresa
		$this->id_empresa->HrefValue = "";

		// nombre_completo
		$this->nombre_completo->HrefValue = "";

		// cedula
		$this->cedula->HrefValue = "";

		// fecha_ingreso
		$this->fecha_ingreso->HrefValue = "";

		// ultimas_vacaciones
		$this->ultimas_vacaciones->HrefValue = "";

		// proximas_vacaciones
		$this->proximas_vacaciones->HrefValue = "";

		// Posicion
		$this->Posicion->HrefValue = "";

		// salario_mensual
		$this->salario_mensual->HrefValue = "";

		// salario_quincenal
		$this->salario_quincenal->HrefValue = "";

		// deducible_afp
		$this->deducible_afp->HrefValue = "";

		// deducible_sf
		$this->deducible_sf->HrefValue = "";

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
