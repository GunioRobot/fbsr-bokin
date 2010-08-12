<?php $this->pageTitle=Yii::app()->name; ?>

<?php
echo 'Heitustu meðlimir síðustu 7 daga';
echo '<table><tr><td><b>Nafn</b></td><td><b>Klst.</b></td></tr>'; 
foreach($top7 as $row) {
	echo '<tr>';
	echo '<td>'.$row->name.'</td><td>'.$row->delta.'</td>';
	echo '</tr>';
}
echo '</table>';

echo 'Heitustu meðlimir síðustu 30 daga';
echo '<table>'; 
foreach($top30 as $row) {
	echo '<tr>';
	echo '<td>'.$row->name.'</td><td>'.$row->delta.'</td>';
	echo '</tr>';
}
echo '</table>';
?> 