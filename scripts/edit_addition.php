<?php
require_once('../crest/crest.php');
require_once('../crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm34Name' => $data['editAdditionName'],
        'ufCrm34Category' => $data['editAdditionCategory'],
        'ufCrm34UnitAmount' => $data['editAdditionUnitAmount'],
    ];

    $result = CRest::call('crm.item.update', [
        'entityTypeId' => PAYROLL_ADDITIONS_ENTITY_TYPE_ID,
        'id' => $data['editAdditionId'],
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
