<div class="widget-content" >
<table border="0" align="center" cellpadding="0" cellspacing="0" class="items table table-striped table-bordered table-condensed" >
<head>
<tr  >
<th rowspan="2">Technican</th>
<th rowspan="2" >Total sessions</th>
<th colspan="2">Excellent</th>
<th colspan="2">Good</th>
<th colspan="2">Mediocre</th>
<th colspan="2">Disappointing</th>
</tr>

<tr>
<th>Num</th>
<th>%</th>
<th>Num</th>
<th>%</th>
<th>Num</th>
<th>%</th>
<th>Num</th>
<th>%</th>
</tr>
</head>
<body>


<?php
$total=array();
$total["Total"]=0;
$total["Excellent"]=0;
$total["Good"]=0;
$total["Mediocre"]=0;
$total["Disappointing"]=0;
	foreach($model as $item)
    {
        $total["Total"] +=$item["Total"];
        $total["Excellent"] +=$item["Excellent"];
        $total["Good"] +=$item["Good"];
        $total["Mediocre"] +=$item["Mediocre"];
        $total["Disappointing"] +=$item["Disappointing"];
        
        echo "<tr>";
        echo "<td class='name'>".$item['TechName']."</td>";
        echo "<td>".$item['Total']."</td>";
        echo "<td>".$item['Excellent']."</td>";
        echo "<td>".number_format($item['Excellent']/$item['Total']*100,0)."%</td>";
        echo "<td>".$item['Good']."</td>";
        echo "<td>".number_format($item['Good']/$item['Total']*100,0)."%</td>";
        echo "<td>".$item['Mediocre']."</td>";
        echo "<td>".number_format($item['Mediocre']/$item['Total']*100,0)."%</td>";
        echo "<td>".$item['Disappointing']."</td>";
        echo "<td>".number_format($item['Disappointing']/$item['Total']*100,0)."%</td>";
        echo "</tr>";
    }
?>

</body>
<?php
	if($total['Total']==0)
    $total['Total']=1;
?>
<tr style="font-weight: bold;" >
<td>Total</td>
<td><?php echo $total["Total"];?></td>
<td><?php echo $total["Excellent"];?></td>
<td><?php echo number_format($total['Excellent']/$total['Total']*100,0); ?>%</td>
<td><?php echo $total["Good"];?></td>
<td><?php echo number_format($total['Good']/$total['Total']*100,0); ?>%</td>
<td><?php echo $total["Mediocre"];?></td>
<td><?php echo number_format($total['Mediocre']/$total['Total']*100,0); ?>%</td>
<td><?php echo $total["Disappointing"];?></td>
<td><?php echo number_format($total['Disappointing']/$total['Total']*100,0); ?>%</td>
</tr>
</table>
<?php 
//var_dump($model);

 ?>
</div>