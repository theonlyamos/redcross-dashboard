<?php
require_once('connection.php');

$districts = ['SEKONDI - TAKORADI', 'Ahanta West District, AGONA-NKWANTA', 'Aowin/Suaman District, ENCHI', 'Bia District, ESSAM', 'Bibiani/Anhwiaso/Bekwai District, BIBIANI', 'Ellembelle District, NKROFUL', 'Jomoro District, HALF-ASSIN', 'Juaboso District, JUABOSO', 'Wassa East District, DABOASE', 'Nzema East District, AXIM', 'Prestea-Huni Valley District, BOGOSO', 'Sefwi-Wiawso District, WIAWSO', 'Sefwi Akontombra district, SEFWI AKONTOMBRA', 'Shama District, SHAMA', 'Wasa Amenfi East District, WASSA-AKROPONG', 'Wasa Amenfi West District, ASANKRANGWA', 'TARKWA-Nsuaem', 'Bia West, Adabokrom', 'Bia East ,Essam', 'Wassa Amenfi East “Amenfi Central', 'Mpohor Wassa “Mpohor District'];

foreach($districts as $district){
		$district = strtolower($district);
		$query = "INSERT INTO districts(name) VALUES('$district')";
		$result = $conn->query($query);
}
?>
