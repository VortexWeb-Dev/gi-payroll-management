<?php
require_once(__DIR__ . '/crest/crest.php');
require_once(__DIR__ . '/crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    echo $data['deleteEmployeeId'];


    $result = CRest::call('crm.item.delete', [
        'entityTypeId' => EMPLOYEE_SALARY_ENTITY_TYPE_ID,
        'id' => $data['deleteEmployeeId']
    ]);

    if (!$result['error']) {
        echo 'success';
        header('Location: employee_salary.php');
    }
}
