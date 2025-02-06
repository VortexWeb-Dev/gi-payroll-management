<?php
require_once('../crest/crest.php');
require_once('../crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $result = CRest::call('crm.item.delete', [
        'entityTypeId' => PAYROLL_ADDITIONS_ENTITY_TYPE_ID,
        'id' => $data['deleteAdditionId']
    ]);

    header('Location: ../payroll.php');
}
