<?php
$dirs = ['services'=>'services', 'connected_apps'=>'apps', 'skm_data'=>'skmData', 'social_medias'=>'socialMedias'];
foreach($dirs as $dir => $var) {
    $f = 'resources/views/admin/'.$dir.'/index.blade.php';
    $c = file_get_contents($f);
    $c = str_replace('@foreach( as', '@foreach($'.$var.' as', $c);
    file_put_contents($f, $c);
}
