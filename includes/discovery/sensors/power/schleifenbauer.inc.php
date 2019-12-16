<?php
echo 'Schleifenbauer ';

foreach ($pre_cache['sdbMgmtCtrlDevUnitAddress'] as $sdbMgmtCtrlDevUnitAddress => $sdbDevIdIndex) {
    foreach ($pre_cache['sdbDevInPowerVoltAmpere'][$sdbDevIdIndex] as $sdbDevInIndex => $sdbDevInPowerVoltAmpere) {
        $name             = trim($pre_cache['sdbDevInName'][$sdbDevIdIndex][$sdbDevInIndex], '"');
        $power_oid        = ".1.3.6.1.4.1.31034.12.1.1.2.6.1.1.9.$sdbDevIdIndex.$sdbDevInIndex";
        $serial_input     = $pre_cache['sdbDevIdSerialNumber'][$sdbDevIdIndex] ."-L". $sdbDevInIndex;
        $descr            = ($name != '' ? $name : "$serial_input Apparent Power");

        // See includes/discovery/entity-physical/schleifenbauer.inc.php for an explanation why we set this as the entPhysicalIndex.
        $entPhysicalIndex = $sdbMgmtCtrlDevUnitAddress * 1000000 + 100000 + $sdbDevInIndex * 1000 + 130;

        discover_sensor($valid['sensor'], 'power', $device, $power_oid, $serial_input, 'schleifenbauer', $descr, '1', '1', null, null, null, null, $sdbDevInPowerVoltAmpere, 'snmp', $entPhysicalIndex);
    }

    foreach ($pre_cache['sdbDevOutMtPowerVoltAmpere'][$sdbDevIdIndex] as $sdbDevOutMtIndex => $sdbDevOutMtPowerVoltAmpere) {
        $name             = trim($pre_cache['sdbDevOutName'][$sdbDevIdIndex][$sdbDevOutMtIndex], '"');
        $power_oid        = ".1.3.6.1.4.1.31034.12.1.1.2.7.2.1.10.$sdbDevIdIndex.$sdbDevOutMtIndex";
        $serial_input     = $pre_cache['sdbDevIdSerialNumber'][$sdbDevIdIndex] ." Outlet ". $sdbDevOutMtIndex;
        $descr            = ($name != '' ? $name : "$serial_input Apparent Power");

        // See includes/discovery/entity-physical/schleifenbauer.inc.php for an explanation why we set this as the entPhysicalIndex.
        $entPhysicalIndex = $sdbMgmtCtrlDevUnitAddress * 1000000 + 100000 + $sdbDevOutMtIndex * 1000 + 130;

        discover_sensor($valid['sensor'], 'power', $device, $power_oid, $serial_input, 'schleifenbauer', $descr, '1', '1', null, null, null, null, $sdbDevOutMtPowerVoltAmpere, 'snmp', $entPhysicalIndex);
    }
}
