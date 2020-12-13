<?php
$targetFolder = '/home2/tonyonth/tott/storage/app/public';
$linkFolder = '/home2/tonyonth/tonyonthetrack.com/storage';

symlink($targetFolder,$linkFolder);

echo 'Symlink completed ' . " From" . $targetFolder . " To " . $linkFolder;
