<?php
use kartik\datecontrol\Module;

return [
    'adminEmail' => 'admin@example.com',
    'dateControlDisplay'=>[
      Module::FORMAT_DATE=>'dd-MM-yyyy',
      Module::FORMAT_TIME=>'hh:mm:ss a',
      Module::FORMAT_DATETIME=>'dd-MM-yyyy hh:mm:ss a',
    ],
    'dateControlSave'=>[
      Module::FORMAT_DATE=>'php:U',
      Module::FORMAT_TIME=>'php:H:i:s',
      Module::FORMAT_DATETIME=>'php:Y-m-d H:i:s',
    ],
    'dateControlDisplayTimezone'=>'America/Mexico_City',
    'dateControlSaveTimezone'=>'America/Mexico_City',
];
