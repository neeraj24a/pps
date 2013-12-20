<table>
<tr>
<td><b>Date Time:</b></td>
<td><?php echo $survey->CreateDate ?> </td>
</tr>

<tr>
<td><b>Full Name:</b></td>
<td><?php echo $survey->Name ?> </td>
</tr>

<tr>
<td><b>Phone Number:</b></td>
<td><?php echo $survey->Phone ?> </td>
</tr>

<tr>
<td><b>Email:</b></td>
<td><?php echo $survey->Email ?> </td>
</tr>

<tr>
<td><b>Comment:</b></td>
<td><?php echo $survey->Comment ?> </td>
</tr>

<tr>
<?php
	$url = Yii::app()->createAbsoluteUrl("survey/$survey->SessionID");
?>
<td colspan="2"><b><?php echo CHtml::link("View details",$url) ?></b> </td>
</tr>

</table>