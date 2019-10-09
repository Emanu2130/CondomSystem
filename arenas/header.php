<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>ARENAS - Control Ingresos, Egresos & proveedores</title>
<?php if (@$gsExport == "") { ?>
<link rel="stylesheet" type="text/css" href="SpryMenuBarVertical.css" >
<style>

/* Spry Menu Bar */

/* Outermost menu container has no borders on all sides */
ul.MenuBarVertical {
	width: 180px;
	border: 0px;
}
ul.MenuBarVertical li {
	width: 180px;
}
ul.MenuBarVertical ul {
	width: 180px;
}
ul.MenuBarVertical ul li {
	width: 180px;	
}

/* Menu items are a block with padding and no text decoration */
ul.MenuBarVertical a {
	display: block;
	cursor: pointer;
	background-color: #F1F1F1;
	padding: 0.25em 0.50em;
	color: #000;
	text-decoration: none;
}

/* Menu items that have mouse over or focus have the following background and text color */
ul.MenuBarVertical a:hover, ul.MenuBarVertical a:focus {
	background-color: #33C;
	color: #FFF;
}

/* Menu items that are open with submenus are set to MenuBarItemHover with the following background and text color */
ul.MenuBarVertical a.MenuBarItemHover, ul.MenuBarVertical a.MenuBarItemSubmenuHover, ul.MenuBarVertical a.MenuBarSubmenuVisible {
	background-color: #33C;
	color: #FFF;
}
ul.MenuBarVertical a.MenuBarItemSubmenu {
	background-image: url(images/SpryMenuBarRight.gif);
}

/* Menu items that are open with submenus have the class designation MenuBarItemSubmenuHover and are set to use a "hover" background image positioned on the far left (95%) and centered vertically (50%) */
ul.MenuBarVertical a.MenuBarItemSubmenuHover {
	background-image: url(images/SpryMenuBarRightHover.gif);
}
</style>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/button/assets/skins/sam/button.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/container/assets/skins/sam/container.css">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<link rel="stylesheet" type="text/css" href="arenas.css">
<?php } ?>
<meta name="generator" content="Arenas v6.0.0.0">
</head>
<body class="yui-skin-sam">
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/button/button-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/container/container-min.js"></script>
<script type="text/javascript" src="js/SpryMenuBar.js"></script>
<script type="text/javascript">
<!--
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup6.php"; // lookup file name

//var EW_ADD_OPTION_FILE_NAME = ""; // add option file name
var EW_BUTTON_SUBMIT_TEXT = "  Agregar  ";
var EW_BUTTON_CANCEL_TEXT = " Cancelar ";

//-->
</script>
<script type="text/javascript" src="js/ewp6.js"></script>
<script type="text/javascript" src="js/userfn6.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js");
//-->

</script>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
  <div class="ewHeaderRow"><img src="arenalogo.png" alt="" border="0"></div>
	<!-- header (end) -->
	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>	
			<td class="ewMenuColumn">
			<!-- left column (begin) -->
<?php include "ewmenu.php" ?>
			<!-- left column (end) -->
			</td>		
	    <td class="ewContentColumn">
			<!-- right column (begin) -->
				<p class="arenas"><b>ARENAS - Control Ingresos, Egresos & proveedores</b></p>
	<?php } ?>
