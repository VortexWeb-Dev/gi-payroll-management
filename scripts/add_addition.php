<?php
require_once('../crest/crest.php');
require_once('../crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm34Name' => $data['newAdditionName'],
        'ufCrm34Category' => $data['newAdditionCategory'],
        'ufCrm34UnitAmount' => $data['newAdditionUnitAmount'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => PAYROLL_ADDITIONS_ENTITY_TYPE_ID,
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
