<?php
require_once('../crest/crest.php');
require_once('../crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm36Name' => $data['newDeductionName'],
        'ufCrm36UnitAmount' => $data['newDeductionUnitAmount'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => PAYROLL_DEDUCTIONS_ENTITY_TYPE_ID,
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
