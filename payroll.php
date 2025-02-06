<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Items</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .action-btn {
            margin: 0 5px;
        }

        .modal-body form .form-group {
            margin-bottom: 15px;
        }

        .modal-footer {
            border-top: none;
        }

        .radio-group label {
            margin-right: 10px;
        }

        .modal-body form .form-group {
            margin-bottom: 15px;
        }

        .modal-footer {
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-1">Payroll Items</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payroll Items</li>
            </ol>
        </nav>
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="additions-tab" data-toggle="tab" href="#additions" role="tab" aria-controls="additions" aria-selected="true">Additions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="overtime-tab" data-toggle="tab" href="#overtime" role="tab" aria-controls="overtime" aria-selected="false">Overtime</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="deductions-tab" data-toggle="tab" href="#deductions" role="tab" aria-controls="deductions" aria-selected="false">Deductions</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Additions -->
            <div class="tab-pane fade show active" id="additions" role="tabpanel" aria-labelledby="additions-tab">
                <div class="d-flex justify-content-between mt-3">
                    <h4>Additions</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addAdditionModal">Add
                        Addition</button>
                </div>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Default/Unit Amount</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $additions = include('additions.php');

                        if (!empty($additions)) {
                            foreach ($additions as $addition) {
                                echo "<tr>
                                    <td>{$addition['ufCrm34Name']}</td>
                                    <td>{$addition['ufCrm34Category']}</td>
                                    <td>{$addition['ufCrm34UnitAmount']}</td>
                                    <td class='text-right'>
                                        <button class='btn btn-warning btn-sm action-btn addition-edit-btn' data-toggle='modal'
                                            data-target='#editAdditionModal' data-edit-addition-id='{$addition['id']}'>Edit</button>
                                        <button class='btn btn-danger btn-sm action-btn addition-delete-btn' data-toggle='modal'
                                            data-target='#deleteAdditionModal' data-delete-addition-id='{$addition['id']}'>Delete</button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-center">No additions found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Overtimes -->
            <div class="tab-pane fade" id="overtime" role="tabpanel" aria-labelledby="overtime-tab">
                <div class="d-flex justify-content-between mt-3">
                    <h4>Overtime</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addOvertimeModal">Add
                        Overtime</button>
                </div>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Rate</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $overtimes = include('overtimes.php');

                        if (!empty($overtimes)) {
                            foreach ($overtimes as $overtime) {
                                echo "<tr>
                                    <td>{$overtime['ufCrm35Name']}</td>
                                    <td>{$overtime['ufCrm35Category']}</td>
                                    <td>{$overtime['ufCrm35Rate']}</td>
                                    <td class='text-right'>
                                        <button class='btn btn-warning btn-sm action-btn overtime-edit-btn' data-toggle='modal'
                                            data-target='#editOvertimeModal' data-edit-overtime-id='{$overtime['id']}'>Edit</button>
                                        <button class='btn btn-danger btn-sm action-btn overtime-delete-btn' data-toggle='modal'
                                            data-target='#deleteOvertimeModal' data-delete-overtime-id='{$overtime['id']}'>Delete</button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-center">No overtimes found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Deductions -->
            <div class="tab-pane fade" id="deductions" role="tabpanel" aria-labelledby="deductions-tab">
                <div class="d-flex justify-content-between mt-3">
                    <h4>Deductions</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addDeductionModal">Add
                        Deduction</button>
                </div>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Default/Unit Amount</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $deductions = include('deductions.php');

                        if (!empty($deductions)) {
                            foreach ($deductions as $deduction) {
                                echo "<tr>
                                    <td>{$deduction['ufCrm36Name']}</td>
                                    <td>{$deduction['ufCrm36UnitAmount']}</td>
                                    <td class='text-right'>
                                        <button class='btn btn-warning btn-sm action-btn deduction-edit-btn' data-toggle='modal'
                                            data-target='#editDeductionModal' data-edit-deduction-id='{$deduction['id']}'>Edit</button>
                                        <button class='btn btn-danger btn-sm action-btn deduction-delete-btn' data-toggle='modal'
                                            data-target='#deleteDeductionModal' data-delete-deduction-id='{$deduction['id']}'>Delete</button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-center">No deductions found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modals for Addition -->
    <div class="modal fade" id="addAdditionModal" tabindex="-1" role="dialog" aria-labelledby="addAdditionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdditionModalLabel">Add Addition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addAdditionForm" action="./scripts/add_addition.php" method="POST">
                        <div class="form-group">
                            <label for="newAdditionName">Name</label>
                            <input type="text" class="form-control" id="newAdditionName" name="newAdditionName">
                        </div>
                        <div class="form-group">
                            <label for="newAdditionCategory">Category</label>
                            <select name="newAdditionCategory" id="newAdditionCategory" class="form-control">
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newAdditionUnitAmount">Unit Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">AED</span>
                                </div>
                                <input type="text" class="form-control" id="newAdditionUnitAmount" name="newAdditionUnitAmount">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label>Assignee</label>
                            <div class="radio-group">
                                <label>
                                    <input type="radio" name="assignee" value="noAssignee" id="noAssignee"> No Assignee
                                </label>
                                <label>
                                    <input type="radio" name="assignee" value="allEmployees" id="allEmployees"> All Employees
                                </label>
                                <label>
                                    <input type="radio" name="assignee" value="selectEmployee" id="selectEmployee"> Select Employee
                                </label>
                            </div>
                            <div class="form-group mt-2 employeeSelectContainer" style="display: none;">
                                <label for="employeeSelect">Select Employee</label>
                                <select name="employeeSelect" id="employeeSelect" class="form-control">
                                    <?php
                                    // $employees = include('employees.php');
                                    // foreach ($employees as $employee) {
                                    //     echo "<option value=\"{$employee['id']}\">{$employee['name']}</option>";
                                    // }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modals for Overtime -->
    <div class="modal fade" id="addOvertimeModal" tabindex="-1" role="dialog" aria-labelledby="addOvertimeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOvertimeModalLabel">Add Overtime</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addOvertimeForm" action="./scripts/add_overtime.php" method="POST">
                        <div class="form-group">
                            <label for="newOvertimeName">Name</label>
                            <input type="text" class="form-control" id="newOvertimeName" name="newOvertimeName">
                        </div>
                        <div class="form-group">
                            <label for="newOvertimeCategory">Category</label>
                            <select name="newOvertimeCategory" id="newOvertimeCategory" class="form-control">
                                <option value="Hourly">Hourly</option>
                                <option value="Daily">Daily</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newOvertimeRate">Rate</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">AED</span>
                                </div>
                                <input type="text" class="form-control" id="newOvertimeRate" name="newOvertimeRate">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modals for Deduction -->
    <div class="modal fade" id="addDeductionModal" tabindex="-1" role="dialog" aria-labelledby="addDeductionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeductionModalLabel">Add Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addDeductionForm" action="./scripts/add_deduction.php" method="POST">
                        <div class="form-group">
                            <label for="newDeductionName">Name</label>
                            <input type="text" class="form-control" id="newDeductionName" name="newDeductionName">
                        </div>
                        <div class="form-group">
                            <label for="newDeductionUnitAmount">Default/ UnitAmount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">AED</span>
                                </div>
                                <input type="text" class="form-control" id="newDeductionUnitAmount" name="newDeductionUnitAmount">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal for Addition -->
    <div class="modal fade" id="editAdditionModal" tabindex="-1" role="dialog" aria-labelledby="editAdditionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit form content (to be filled based on the specific item type) -->
                    <form id="editAdditionForm" method="POST" action="./scripts/edit_addition.php">
                        <input type="hidden" id="editAdditionId" name="editAdditionId">
                        <div class="form-group">
                            <label for="editAdditionName">Name</label>
                            <input type="text" class="form-control" id="editAdditionName" name="editAdditionName">
                        </div>
                        <div class="form-group">
                            <label for="editAdditionCategory">Category</label>
                            <select name="editAdditionCategory" id="editAdditionCategory" class="form-control">
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editAdditionUnitAmount">Default/Unit Amount</label>
                            <input type="text" class="form-control" id="editAdditionUnitAmount" name="editAdditionUnitAmount">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal for Overtime -->
    <div class="modal fade" id="editOvertimeModal" tabindex="-1" role="dialog" aria-labelledby="editOvertimeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit form content (to be filled based on the specific item type) -->
                    <form id="editOvertimeForm" method="POST" action="./scripts/edit_overtime.php">
                        <input type="hidden" id="editOvertimeId" name="editOvertimeId">
                        <div class="form-group">
                            <label for="editOvertimeName">Name</label>
                            <input type="text" class="form-control" id="editOvertimeName" name="editOvertimeName">
                        </div>
                        <div class="form-group">
                            <label for="editOvertimeCategory">Category</label>
                            <select name="editOvertimeCategory" id="editOvertimeCategory" class="form-control">
                                <option value="Hourly">Hourly</option>
                                <option value="Daily">Daily</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editOvertimeRate">Rate</label>
                            <input type="text" class="form-control" id="editOvertimeRate" name="editOvertimeRate">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal for Deduction -->
    <div class="modal fade" id="editDeductionModal" tabindex="-1" role="dialog" aria-labelledby="editDeductionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit form content (to be filled based on the specific item type) -->
                    <form id="editDeductionForm" method="POST" action="./scripts/edit_deduction.php">
                        <input type="hidden" id="editDeductionId" name="editDeductionId">
                        <div class="form-group">
                            <label for="editDeductionName">Name</label>
                            <input type="text" class="form-control" id="editDeductionName" name="editDeductionName">
                        </div>
                        <div class="form-group">
                            <label for="editDeductionUnitAmount">Default/ Unit Amount</label>
                            <input type="text" class="form-control" id="editDeductionUnitAmount" name="editDeductionUnitAmount">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  Delete Modal for Addition -->
    <div class="modal fade" id="deleteAdditionModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdditionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="./scripts/delete_addition.php" class="modal-content">
                <input type="hidden" id="deleteAdditionId" name="deleteAdditionId">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!--  Delete Modal for Overtime -->
    <div class="modal fade" id="deleteOvertimeModal" tabindex="-1" role="dialog" aria-labelledby="deleteOvertimeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="./scripts/delete_overtime.php" class="modal-content">
                <input type="hidden" id="deleteOvertimeId" name="deleteOvertimeId">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!--  Delete Modal for Deduction -->
    <div class="modal fade" id="deleteDeductionModal" tabindex="-1" role="dialog" aria-labelledby="deleteDeductionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="./scripts/delete_deduction.php" class="modal-content">
                <input type="hidden" id="deleteDeductionId" name="deleteDeductionId">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const PAYROLL_ADDITIONS_ENTITY_TYPE_ID = 1072;
        const PAYROLL_OVERTIMES_ENTITY_TYPE_ID = 1076;
        const PAYROLL_DEDUCTIONS_ENTITY_TYPE_ID = 1080;
        const WEBHOOK_BASE_URL = 'https://gicrm.ae/rest/1945/7mnw3te56u363prw/'

        $(document).ready(function() {

            $('input[name="assignee"]').on('change', function() {
                if ($('#selectEmployee').is(':checked')) {
                    $('.employeeSelectContainer').show();
                } else {
                    $('.employeeSelectContainer').hide();
                }
            });

            // Fill Addition Edit Modal
            $('.addition-edit-btn').click(async function() {
                var editAdditionId = $(this).data('edit-addition-id');

                await fetch(`${WEBHOOK_BASE_URL}crm.item.get.json?entityTypeId=${PAYROLL_ADDITIONS_ENTITY_TYPE_ID}&id=${Number(editAdditionId)}`)
                    .then(response => response.json())
                    .then(data => data.result.item)
                    .then(item => {
                        document.getElementById('editAdditionName').value = item.ufCrm34Name;
                        document.getElementById('editAdditionCategory').value = item.ufCrm34Category;
                        document.getElementById('editAdditionUnitAmount').value = item.ufCrm34UnitAmount;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                $('#editAdditionId').val(editAdditionId);
            });
            // Fill Overtime Edit Modal
            $('.overtime-edit-btn').click(async function() {
                var editOvertimeId = $(this).data('edit-overtime-id');

                await fetch(`${WEBHOOK_BASE_URL}crm.item.get.json?entityTypeId=${PAYROLL_OVERTIMES_ENTITY_TYPE_ID}&id=${Number(editOvertimeId)}`)
                    .then(response => response.json())
                    .then(data => data.result.item)
                    .then(item => {
                        document.getElementById('editOvertimeName').value = item.ufCrm35Name;
                        document.getElementById('editOvertimeCategory').value = item.ufCrm35Category;
                        document.getElementById('editOvertimeRate').value = item.ufCrm35Rate;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                $('#editOvertimeId').val(editOvertimeId);
            });
            // Fill Deduction Edit Modal
            $('.deduction-edit-btn').click(async function() {
                var editDeductionId = $(this).data('edit-deduction-id');

                await fetch(`${WEBHOOK_BASE_URL}crm.item.get.json?entityTypeId=${PAYROLL_DEDUCTIONS_ENTITY_TYPE_ID}&id=${Number(editDeductionId)}`)
                    .then(response => response.json())
                    .then(data => data.result.item)
                    .then(item => {
                        document.getElementById('editDeductionName').value = item.ufCrm36Name;
                        document.getElementById('editDeductionUnitAmount').value = item.ufCrm36UnitAmount;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                $('#editDeductionId').val(editDeductionId);
            });
            // Fill Addition Delete Modal
            $('.addition-delete-btn').click(async function() {
                var deleteAdditionId = $(this).data('delete-addition-id');
                $('#deleteAdditionId').val(deleteAdditionId);
            });
            // Fill Overtime Delete Modal
            $('.overtime-delete-btn').click(async function() {
                var deleteOvertimeId = $(this).data('delete-overtime-id');
                $('#deleteOvertimeId').val(deleteOvertimeId);
            });
            // Fill Deduction Delete Modal
            $('.deduction-delete-btn').click(async function() {
                var deleteDeductionId = $(this).data('delete-deduction-id');
                $('#deleteDeductionId').val(deleteDeductionId);
            });
        });
    </script>
</body>

</html>