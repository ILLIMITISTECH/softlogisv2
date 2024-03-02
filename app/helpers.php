<?php

use App\Models\DocAssigned;

function dateFormat($date,$format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($format);
}

function trimString($string, $repl, $limit)
{
  if(strlen($string) > $limit)
  {
    return substr($string, 0, $limit) . $repl;
  }
  else
  {
    return $string;
  }
}

function truncate($string, $length)
{
    if (strlen($string) > $length) {
        return substr($string, 0, $length - 3) . '...';
    }
    return $string;
}

function Refgenerate($table,$init,$key)
{
    $latest = $table::latest()->first();
    if (! $latest) {
        return $init.'-00001';
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);

    return $init.'-' . sprintf('%05d',$string+1);
}

function countFolderByAgent($uuid)
{
    $folderByAgentCount = DocAssigned::where('etat', 'actif')->where('userUuid', $uuid)->groupBy('userUuid')->count();
      
    return $folderByAgentCount;
}
function countFolderByBackup($uuid)
{
    $folderByBackupCount = DocAssigned::where('etat', 'actif')->where('backupUuid', $uuid)->groupBy('backupUuid')->count();
      
    return $folderByBackupCount;
}

?>
