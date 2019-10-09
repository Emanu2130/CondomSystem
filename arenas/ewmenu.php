<?php

// Menu
define("EW_MENUBAR_VERTICAL_CLASSNAME", "MenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "MenuBarItemSubmenu", TRUE);
define("EW_MENUBAR_RIGHTHOVER_IMAGE", "images/SpryMenuBarRightHover.gif", TRUE);
?>
<?php

/**
 * Menu class
 */

class cMenu {
	var $Id;
	var $IsRoot = FALSE;
	var $NoItem = NULL;
	var $ItemData = array();

	function cMenu($id) {
		$this->Id = $id;
	}

	// Add a menu item
	function AddMenuItem($id, $text, $url, $parentid) {
		$item = new cMenuItem($id, $text, $url, $parentid);
		if (!MenuItem_Adding($item)) return;
		if ($item->ParentId < 0) {
			$this->AddItem($item);
		} else {
			if ($oParentMenu =& $this->FindItem($item->ParentId))
				$oParentMenu->AddItem($item);
		}
	}

	// Add item to internal array
	function AddItem($item) {
		$this->ItemData[] = $item;
	}

	// Find item
	function &FindItem($id) {
		$cnt = count($this->ItemData);
		for ($i = 0; $i < $cnt; $i++) {
			$item =& $this->ItemData[$i];
			if ($item->Id == $id) {
				return $item;
			} elseif (!is_null($item->SubMenu)) {
				if ($subitem =& $item->SubMenu->FindItem($id))
					return $subitem;
			}
		}
		return $this->NoItem;
	}

	// Render the menu
	function Render() {
		echo "<ul";
		if ($this->Id <> "") {
			if (is_numeric($this->Id)) {
				echo " id=\"menu_" . $this->Id . "\"";
			} else {
				echo " id=\"" . $this->Id . "\"";
			}
		}
		if ($this->IsRoot)
			echo " class=\"" . EW_MENUBAR_VERTICAL_CLASSNAME . "\"";
		echo ">\n";
		foreach ($this->ItemData as $item) {
			echo "<li><a";
			if (!is_null($item->SubMenu))
				echo " class=\"" . EW_MENUBAR_SUBMENU_CLASSNAME . "\"";
			if ($item->Url <> "")
				echo " href=\"" . htmlspecialchars(strval($item->Url)) . "\"";
			echo ">" . $item->Text . "</a>\n";
			if (!is_null($item->SubMenu))
				$item->SubMenu->Render();
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}

// Menu item class
class cMenuItem {
	var $Id;
	var $Text;
	var $Url;
	var $ParentId; 
	var $SubMenu = NULL; // Data type = cMenu

	function cMenuItem($id, $text, $url, $parentid) {
		$this->Id = $id;
		$this->Text = $text;
		$this->Url = $url;
		$this->ParentId = $parentid;
	}

	function AddItem($item) { // Add submenu item
		if (is_null($this->SubMenu))
			$this->SubMenu = new cMenu($this->Id);
		$this->SubMenu->AddItem($item);
	}
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="arenas">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(17, "MODULOS", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(20, "Egresos", "egresoslist.php?cmd=resetall", 17);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(18, "Ingresos", "ingresoslist.php?cmd=resetall", 17);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(22, "Proveedores", "proveedoreslist.php", 17);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(24, "Empresas", "empresaslist.php", 17);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(25, "Locaciones", "locacioneslist.php", 17);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(26, "Cuentas Bancarias", "cuentas_bancariaslist.php", 17);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(29, "Nomina", "nominalist.php", 17);
}
$RootMenu->AddMenuItem(8, "PARAMETROS", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(28, "Ingresos Tipos", "ingresos_tiposlist.php", 8);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(21, "Egresos Tipo 1", "egresos_tipo1list.php", 8);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(23, "Metodos Pago", "metodos_pagolist.php", 8);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(19, "Usuarios", "usuarioslist.php", 8);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(27, "Empleados", "empleadoslist.php", 8);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(30, "Comprobantes Tipos", "comprobantes_tiposlist.php", 8);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(0xFFFFFFFF, "Salir", "logout.php", -1);
} elseif (substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php") {
	$RootMenu->AddMenuItem(0xFFFFFFFF, "Acceso", "login.php", -1);
}
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--
var RootMenu = new Spry.Widget.MenuBar("RootMenu", {imgRight: "<?php echo EW_MENUBAR_RIGHTHOVER_IMAGE ?>"}); // Main menu 

//-->
</script>
