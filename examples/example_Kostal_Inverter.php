<?php
require_once 'PHPModbus/ModbusMasterTcp.php';

// Create Modbus object
$modbus = new ModbusMasterTcp("192.168.2.78", "1502");



$register=<<<REGISTER
0x02|2|MODBUS Enable|-|Bool|1|R/W|0x03/0x06
0x04|4|MODBUS Unit-ID|-|U16|1|R/W|0x03/0x06
0x05|5|MODBUS Byte Order Note7|-|U16|1|R/W|0x03/0x06
0x06|6|Inverter article number|-|String|8|RO|0x03
0x0E|14|Inverter serial number|-|String|8|RO|0x03
0x1E|30|Number of bidirectional converter|-|U16|1|RO|0x03
0x20|32|Number of AC phases|-|U16|1|RO|0x03
0x22|34|Number of PV strings|-|U16|1|RO|0x03
0x24|36|Hardware-Version|-|U16|2|RO|0x03
0x26|38|Software-Version Maincontroller (MC)|-|String|8|RO|0x03
0x2E|46|Software-Version IO-Controller (IOC)|-|String|8|RO|0x03
0x36|54|Power-ID|-|U16|2|RO|0x03
0x38|56|Inverter state2|-|U16|2|RO|0x03
0x62|98|Temperature of controller PCB|°C|Float|2|RO|0x03
0x64|100|Total DC power|W|Float|2|RO|0x03
0x68|104|State of energy manager3|-|U32|2|RO|0x03
0x6A|106|Home own consumption from battery|W|Float|2|RO|0x03
0x6C|108|Home own consumption from grid|W|Float|2|RO|0x03
0x6E|110|Total home consumption Battery|Wh|Float|2|RO|0x03
0x70|112|Total home consumption Grid|Wh|Float|2|RO|0x03
0x72|114|Total home consumption PV|Wh|Float|2|RO|0x03
0x74|116|Home own consumption from PV|W|Float|2|RO|0x03
0x76|118|Total home consumption|Wh|Float|2|RO|0x03
0x78|120|Isolation resistance|Ohm|Float|2|RO|0x03
0x7A|122|Power limit from EVU|%|Float|2|RO|0x03
0x7C|124|Total home consumption rate|%|Float|2|RO|0x03
0x90|144|Worktime|s|Float|2|RO|0x03
0x96|150|Actual cos φ|-|Float|2|RO|0x03
0x98|152|Grid frequency|Hz|Float|2|RO|0x03
0x9A|154|Current Phase 1|A|Float|2|RO|0x03
0x9C|156|Active power Phase 1|W|Float|2|RO|0x03
0x9E|158|Voltage Phase 1|V|Float|2|RO|0x03
0xA0|160|Current Phase 2|A|Float|2|RO|0x03
0xA2|162|Active power Phase 2|W|Float|2|RO|0x03
0xA4|164|Voltage Phase 2|V|Float|2|RO|0x03
0xA6|166|Current Phase 3|A|Float|2|RO|0x03
0xA8|168|Active power Phase 3|W|Float|2|RO|0x03
0xAA|170|Voltage Phase 3|V|Float|2|RO|0x03
0xAC|172|Total AC active power|W|Float|2|RO|0x03
0xAE|174|Total AC reactive power|Var|Float|2|RO|0x03
0xB2|178|Total AC apparent power|VA|Float|2|RO|0x03
0xBE|190|Battery charge current|A|Float|2|RO|0x03
0xC2|194|Number of battery cycles|-|Float|2|RO|0x03
0xC8|200|Actual battery charge (-) / discharge (+) current|A|Float|2|RO|0x03
0xCA|202|PSSB fuse state5|-|Float|2|RO|0x03
0xD0|208|Battery ready flag|-|Float|2|RO|0x03
0xD2|210|Act. state of charge|%|Float|2|RO|0x03
0xD6|214|Battery temperature|°C|Float|2|RO|0x03
0xD8|216|Battery voltage|V|Float|2|RO|0x03
0xDA|218|Cos φ (powermeter)|-|Float|2|RO|0x03
0xDC|220|Frequency (powermeter)|Hz|Float|2|RO|0x03
0xDE|222|Current phase 1 (powermeter)|A|Float|2|RO|0x03
0xE0|224|Active power phase 1 (powermeter)|W|Float|2|RO|0x03
0xE2|226|Reactive power phase 1 (powermeter)|Var|Float|2|RO|0x03
0xE4|228|Apparent power phase 1 (powermeter)|VA|Float|2|RO|0x03
0xE6|230|Voltage phase 1 (powermeter)|V|Float|2|RO|0x03
0xE8|232|Current phase 2 (powermeter)|A|Float|2|RO|0x03
0xEA|234|Active power phase 2 (powermeter)|W|Float|2|RO|0x03
0xEC|236|Reactive power phase 2 (powermeter)|Var|Float|2|RO|0x03
0xEE|238|Apparent power phase 2 (powermeter)|VA|Float|2|RO|0x03
0xF0|240|Voltage phase 2 (powermeter)|V|Float|2|RO|0x03
0xF2|242|Current phase 3 (powermeter)|A|Float|2|RO|0x03
0xF4|244|Active power phase 3 (powermeter)|W|Float|2|RO|0x03
0xF6|246|Reactive power phase 3 (powermeter)|Var|Float|2|RO|0x03
0xF8|248|Apparent power phase 3 (powermeter)|VA|Float|2|RO|0x03
0xFA|250|Voltage phase 3 (powermeter)|V|Float|2|RO|0x03
0xFC|252|Total active power (powermeter)|W|Float|2|RO|0x03
0xFE|254|Total reactive power (powermeter)|Var|Float|2|RO|0x03
0x100|256|Total apparent power (powermeter)|VA|Float|2|RO|0x03
0x102|258|Current DC1|A|Float|2|RO|0x03
0x104|260|Power DC1|W|Float|2|RO|0x03
0x10A|266|Voltage DC1|V|Float|2|RO|0x03
0x10C|268|Current DC2|A|Float|2|RO|0x03
0x10E|270|Power DC2|W|Float|2|RO|0x03
0x114|276|Voltage DC2|V|Float|2|RO|0x03
0x116|278|Current DC3|A|Float|2|RO|0x03
0x118|280|Power DC3|W|Float|2|RO|0x03
0x11E|286|Voltage DC3|V|Float|2|RO|0x03
0x140|320|Total yield|Wh|Float|2|RO|0x03
0x142|322|Daily yield|Wh|Float|2|RO|0x03
0x144|324|Yearly yield|Wh|Float|2|RO|0x03
0x146|326|Monthly yield|Wh|Float|2|RO|0x03
0x180|384|Inverter network name|-|String|32|RO|0x03
0x1A0|416|IP enable|-|U16|1|RO|0x03
0x1A2|418|Manual IP / Auto-IP|-|U16|1|RO|0x03
0x1A4|420|IP-address|-|String|8|RO|0x03
0x1AC|428|IP-subnetmask|-|String|8|RO|0x03
0x1B4|436|IP-gateway|-|String|8|RO|0x03
0x1BC|444|IP-auto-DNS|-|U16|1|RO|0x03
0x1BE|446|IP-DNS1|-|String|8|RO|0x03
0x1C6|454|IP-DNS2|-|String|8|RO|0x03
0x200|512|Battery gross capacity|Ah|U32|2|RO|0x03
0x202|514|Battery actual SOC|%|U16|1|RO|0x03
0x203|515|Firmware Maincontroller (MC)|-|U32|2|RO|0x03
0x205|517|Battery Manufacturer|-|String|8|RO|0x03
0x20D|525|Battery Model ID|-|U32|2|RO|0x03
0x20F|527|Battery Serial Number|-|U32|2|RO|0x03
0x211|529|Work Capacity|Wh|U32|2|RO|0x03
0x213|531|Inverter Max Power|W|U16|1|RO|0x03
0x214|532|Inverter Max Power Scale Factor4|-|-|1|RO|0x03
0x215|533|Active Power Setpoint|%|U16|1|RW|0x03/0x06
0x217|535|Inverter Manufacturer|-|String|16|RO|0x03
0x22F|559|Inverter Serial Number|-|String|16|RO|0x03
0x23F|575|Inverter Generation Power (actual)|W|S16|1|RO|0x03
0x240|576|Power Scale Factor|-|-|1|RO|0x03
0x241|577|Generation Energy|Wh|U32|2|RO|0x3
0x243|579|Energy Scale Factor4|-|-|1|RO|0x03
0x246|582|Actual battery charge/discharge power|W|S16|1|RO|0x03
0x247|583|Reactive Power Setpoint|%|S16|1|RW|0x03/0x06
0x249|585|Delta-cos φ Setpoint|-|S16|1|RW|0x03/0x06
0x24A|586|Battery Firmware|-|U32|2|RO|0x03
0x24C|588|Battery Type6|-|U16|1|RO|0x03
0x300|768|Productname (e.g. PLENTICORE plus)|-|String|32|RO|0x03
0x320|800|Power class (e.g. 10)|-|String|32|RO|0x03
REGISTER;

$lines=explode("\n",$register);
$addr=array();
$type=array();
$name=array();
$unit=array();
$num_reg=array();

foreach($lines as $l){
  if(strlen($l)<5) continue;
  $tmp=str_getcsv($l,'|');
  $addr[]=intval($tmp[1]);
  $name[]=$tmp[2];
  $unit[]=$tmp[3];
  $type[]=$tmp[4];
  $num_reg[]=intval($tmp[5]);
}


// 0 - 12 # 
// 13 - 50 #Inverter
// 51 - 77 #Powermeter
// 78 - 81 #Yield counter
// 82 - 90 #Network
// 91 - 111 #Batterie
// 112 - 113 # Namen

$start_is=array(0,13,51,78,82,91,112);
$end_is=array(12,50,77,81,90,111,113);


for($j=0;$j<count($start_is);$j++){

$start_i=$start_is[$j];
$end_i=$end_is[$j];

$start=$addr[$start_i];
$end=$addr[$end_i];
$num=($end-$start)+$num_reg[$end_i];

echo "Start $start -- End $end -- Num $num\n";

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
#echo "Data: ";
#print_r($recData); 
#echo "\n";

for($i=$start_i;$i<=$end_i;$i++){
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
    	echo PhpType::bytes2signedInt($data) . "\n";
     	break;
    case 'Bool':
    case 'U8':
    case 'U16':
    	echo PhpType::bytes2unsignedInt($data) . "\n";
     	break;
    case 'String':
    	echo PhpType::bytes2string($data,1) . "\n";
     	break;
    default:
        echo "unknown type $type[$i]\n";     	
  }
}

}



?>
