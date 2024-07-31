<?php
require_once 'PHPModbus/ModbusMasterTcp.php';

// Create Modbus object
$modbus = new ModbusMasterTcp("192.168.2.78", "1502");

$register=<<<REGISTER
0x400|1024|Battery charge power (AC) setpoint|W|S16|1|WO|0x06
0x401|1025|Power Scale Factor|-|S16|1|RO|0x03
0x402|1026|Battery charge power (AC) setpoint, absolute|W|Float|2|RW|0x03/0x10
0x404|1028|Battery charge current (DC) setpoint, relative|%|Float|2|RW|0x03/0x10
0x406|1030|Battery charge power (AC) setpoint, relative|%|Float|2|RW|0x03/0x10
0x408|1032|Battery charge current (DC) setpoint, absolute|A|Float|2|RW|0x03/0x10
0x40A|1034|Battery charge power (DC) setpoint, absolute|W|Float|2|RW|0x03/0x10
0x40C|1036|Battery charge power (DC) setpoint, relative|%|Float|2|RW|0x03/0x10
0x40E|1038|Battery max. charge power limit, absolute|W|Float|2|RW|0x03/0x10
0x410|1040|Battery max. discharge power limit, absolute|W|Float|2|RW|0x03/0x10
0x412|1042|Minimum SOC|%|Float|2|RW|0x03/0x10
0x414|1044|Maximum SOC|%|Float|2|RW|0x03/0x10
0x416|1046|Total DC charge energy (DC-side to battery)|Wh|Float|2|RO|0x03
0x418|1048|Total DC discharge energy (DC-side from battery)|Wh|Float|2|RO|0x03
0x41A|1050|Total AC charge energy (AC-side to battery)|Wh|Float|2|RO|0x03
0x41C|1052|Total AC discharge energy (battery to grid)|Wh|Float|2|RO|0x03
0x41E|1054|Total AC charge energy (grid to battery)|Wh|Float|2|RO|0x03
0x420|1056|Total DC PV energy (sum of all PV inputs)|Wh|Float|2|RO|0x03
0x422|1058|Total DC energy from PV1|Wh|Float|2|RO|0x03
0x424|1060|Total DC energy from PV2|Wh|Float|2|RO|0x03
0x426|1062|Total DC energy from PV3|Wh|Float|2|RO|0x03
0x428|1064|Total energy AC-side to grid|Wh|Float|2|RO|0x03
0x42A|1066|Total DC power (sum of all PV inputs)W|Float|2|RO|0x03
0x42C|1068|Battery work capacity|Wh|Float|2|RO|0x03
0x42E|1070|Battery serial number|-|U32|2|RO|0x03
0x430|1072|Reserved|-|-|2|RO|0x03
0x432|1074|Reserved|-|-|2|RO|0x03
0x434|1076|Maximum charge power limit (read-out from battery)|W|Float|2|RO|0x03
0x436|1078|Maximum discharge power limit (read-out from battery)|W|Float|2|RO|0x03
0x438|1080|Battery management mode|-|U8|1|RO|0x03
0x439|1081|reserved|-|-|1|RO|0x03
0x43A|1082|Installed sensor type|-|U8|1|RO|0x03
REGISTER;

$lines=explode("\n",$register);
$addr=array();
$type=array();
$name=array();
$unit=array();
$num_reg=array();

foreach($lines as $l){
  $tmp=str_getcsv($l,'|');
  $addr[]=intval($tmp[1]);
  $name[]=$tmp[2];
  $unit[]=$tmp[3];
  $type[]=$tmp[4];
  $num_reg[]=intval($tmp[5]);
}

$start=min($addr);
$end=max($addr);
$num=($end-$start)+end($num_reg);

try {
    // FC 3
    $recData = $modbus->readMultipleRegisters(71, $start, $num);
}
catch (Exception $e) {
    // Print error information if any
    echo $modbus;
    echo $e;
    exit;
}

// Print status information
#echo "Status:" . $modbus . "\n";

// Print read data
echo "Data: ";
print_r($recData); 
echo "\n";

for($i=0;$i<count($addr);$i++){
  $offset=($addr[$i]-$start)*2;
  $num_bytes=$num_reg[$i]*2;
  echo $addr[$i]." ".$name[$i]." [".$unit[$i]."]: ";
  $data=array_slice($recData,$offset,$num_bytes);
  switch($type[$i]){
    case 'Float':
    	echo PhpType::bytes2float($data) . "\n";
     	break;
    case 'U32':
 	echo PhpType::bytes2unsignedInt(array_reverse($data),1) . "\n";
     	break;
    case 'S16':
    case 'U8':
    	echo PhpType::bytes2signedInt($data) . "\n";
     	break;
    case 'String':
    	echo PhpType::bytes2string($data,1) . "\n";
     	break;
    default:
        echo "unknown type $type[$i]\n";     	
  }
}





?>
