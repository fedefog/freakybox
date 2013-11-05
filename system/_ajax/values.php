<?
include("../../system.php");?>
<?php include(ABS_PATH."/system/classes/crol/clientes.php");?>
<?php include(ABS_PATH."/system/classes/crol/price.php");?>
<?

//Parametros
$producto		= $_REQUEST['producto'];
$costo			= $_REQUEST['costo'];
$redondear		= $_REQUEST['redondear'];
$moneda_costo	=$_REQUEST['moneda_costo'];

if(!$producto)
	{
	echo "no se especificó producto";
	exit();
	}

$resTAR=msq("SELECT tarifario_id as id, fk_moneda_id as moneda FROM tarifario ORDER BY tarifario_nombre,tarifario_id");

$first=true;
mse("DROP TABLE IF EXISTS temp_values");
mse("CREATE TEMPORARY TABLE `temp_values` (                                           
			`costo` decimal(11,2) NOT NULL,                                  
			`pvb` decimal(11,2) default NULL,                                
			`iva_venta` decimal(11,2) NOT NULL,                              
			
			`divisor_markup` decimal(11,5) NOT NULL,                                  
			`manual` int(1) NOT NULL,
			`redondear` char(1) NOT NULL,
			`modo_iva_venta` char(1) NOT NULL,                                                                                      
			`iva_venta_incluido_markup` int(1) NOT NULL,
			`porcentaje_iva_venta` decimal(6,2) NOT NULL,

			`impuestos` decimal(11,2)  NOT NULL,                                			
			`emision` decimal(11,2)  NOT NULL,
			`moneda` char(3) NOT NULL,
			`moneda_costo` char(3) NOT NULL
         )TYPE = HEAP");

$rowP=mysql_fetch_assoc(msq("SELECT 
modo_iva_venta,
iva_venta_incluido_markup,
porcentaje_iva_venta FROM producto WHERE producto_id=$producto"));

mse("INSERT	INTO temp_values 
			SET	redondear			 = '$redondear',
				manual				 = 0,  # <<  hacer el calculo
				modo_iva_venta		 = '".$rowP['modo_iva_venta']."',
				iva_venta_incluido_markup='".$rowP['iva_venta_incluido_markup']."',
				porcentaje_iva_venta = '".$rowP['porcentaje_iva_venta']."',
				costo				 = '".$costo."'");

while($rowTAR=mysql_fetch_assoc($resTAR))
	{
	if(!$first)
		echo "|";
	else
		$first=false;

	if($costo!=='')//Si hay costo calcular
		{
		$divisor_markup=clientes::divisor_markup($rowTAR['id'],$producto);
		$moneda=$rowTAR['moneda'];
		mse("UPDATE temp_values SET divisor_markup='".$divisor_markup."', moneda='".$rowTAR['moneda']."', moneda_costo='".$moneda_costo."'");

		clientes::_costo_conv("temp_values");//seteamos la tabla para el uso de esta funcion

		$rowVAL=mysql_fetch_assoc(msq("SELECT
					costo,
					iva_venta_incluido_markup,
					".clientes::sql_pvb().",
					".clientes::sql_iva_venta()."
					FROM temp_values"));
		
		$pvb=new price($moneda_costo,$rowVAL['pvb']);
		//if($moneda_costo and $rowTAR['moneda'] and ($moneda_costo != $rowTAR['moneda']))
		//	$pvb=$pvb->convert($rowTAR['moneda']);
				
		//echo $rowTAR['id']."|".$rowTAR['moneda']." ".round($rowVAL['pvb'],2)."|".round($rowVAL['iva_venta'],2);
		echo $rowTAR['id']."|".round($pvb->amount(),2)."|".round($rowVAL['iva_venta'],2);
		}
	else
		echo $rowTAR['id']."||";				
	

	}//end while
?>