<?php
$statuses = [
    'activer',
    'désactivé'
];
 
foreach ($statuses as $status) {
    Mage::getModel('bt_mag/status')
        ->setData('name', $status)
        ->save();
}
