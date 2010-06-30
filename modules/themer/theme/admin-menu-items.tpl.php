<h2>Menu Items - <?php print $menuName ?></h2>
<p>Use the table below to edit the menu items for the <b><?php print $menuName ?></b> menu.</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<a class='fm-button' href='<?php print $agave->base_url."admin/menus/$menuKey/items/add" ?>'>Add Item</a>
</div>
<?php 
function throughMenuArray($menuArray, $pathsofar, $menuKey){
	global $agave;
	foreach($menuArray as $key=>$value){
		if(!isProp($key)){
			print "<tr>";
			print "<td>".$pathsofar."/".$key."</td>";
			print "<td>".$value['^weight']."</td>";
			print "<td>".$value['^desc']."</td>";
			print "<td>".$value['^href']."</td>";
			print "<td>".$value['^visible']."</td>";
			print "<td>".$value['^expanded']."</td>";
			print "<td>".$value['^access']."</td>";
			print "<td><a href='".$agave->base_url."admin/menus/$menuKey/items/edit/&menupath=".$pathsofar."/".$key."'>EDIT</a>&nbsp;<a href='".$agave->base_url."admin/menus/$menuKey/items/delete/&menupath=".$pathsofar."/".$key."'>DELETE</a></td>";
			print "</tr>";
			throughMenuArray($value,$pathsofar."/".$key,$menuKey);
		}
	}
}
/*function isProp($key){
	if(!(strpos($key,"^")===FALSE)) {
		return true;
	}
	else {
		return false;
	}
}*/
?>
<table>
	<thead>
		<th>Path</th>
		<th>Weight</th>
		<th>Description</th>
		<th>HREF</th>
		<th>Visible</th>
		<th>Expanded</th>
		<th>Access</th>
		<th>Actions</th>
	</thead>
	<tbody>
	<?php throughMenuArray(unserialize($menuArray), "", $menuKey);?>
	</tbody>
</table>