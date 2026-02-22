<?php
namespace App\Helpers;

class HardwareHelper {
    public static function getFingerprint() {
        // Windows Server/PC အတွက် Hardware ID ယူခြင်း
        $cpu = shell_exec('wmic cpu get processorid');
        $board = shell_exec('wmic baseboard get serialnumber');
        return hash('sha256', trim($cpu) . trim($board));
    }
}