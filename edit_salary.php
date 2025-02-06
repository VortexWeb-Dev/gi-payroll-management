<?php
require_once(__DIR__ . '/crest/crest.php');
require_once(__DIR__ . '/crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    print_r($data);

    $fields = [
        'ufCrm33NetSalary' => $data['employeeSalary'],
        'ufCrm33Basic' => $data['basic'],
        'ufCrm33Tds' => $data['tds'],
        'ufCrm33Da' => $data['da'],
        'ufCrm33Esi' => $data['esi'],
        'ufCrm33Hra' => $data['hra'],
        'ufCrm33Pf' => $data['pf'],
        'ufCrm33Conveyance' => $data['conveyance'],
        'ufCrm33Leave' => $data['leave'],
        'ufCrm33Allowance' => $data['allowance'],
        'ufCrm33ProfTax' => $data['profTax'],
        'ufCrm33MedicalAllowance' => $data['medical'],
        'ufCrm33LabourWelfare' => $data['labourWelfare'],
    ];

    $result = CRest::call('crm.item.update', [
        'entityTypeId' => EMPLOYEE_SALARY_ENTITY_TYPE_ID,
        'id' => $data['editEmployeeId'],
        'fields' => $fields
    ]);

    if ($result['result']) {
        echo 'success';
        header('Location: employee_salary.php');
    }
}
