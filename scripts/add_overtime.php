<?php
require_once('../crest/crest.php');
require_once('../crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm35Name' => $data['newOvertimeName'],
        'ufCrm35Category' => $data['newOvertimeCategory'],
        'ufCrm35Rate' => $data['newOvertimeRate'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => PAYROLL_OVERTIMES_ENTITY_TYPE_ID,
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
