<?= $this->section('title'); ?>
Mochachino Co | Customers List
<?= $this->endSection(); ?>
<?php /* ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/components.css">
<?php */ ?>
<style type="text/css">
	body{
		margin: 0;
		font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
		font-size: 0.8rem;
		font-weight: 400;
		line-height: 1.45;
		color: #6b6f82;
		text-align: left;
		/*background-color: #f4f5fa;*/
	}
	.table {
		width: 100%;
		margin-bottom: 1rem;
		color: #6b6f82;
	}
	.table th,
	.table td {
		padding: 0.75rem;
		vertical-align: top;
		border-top: 1px solid #626e82;
	}
	.table thead th {
		vertical-align: bottom;
		border-bottom: 2px solid #626e82;
	}
	.table tbody + tbody {
		border-top: 2px solid #626e82; 
	}
</style>
<table class="table">
    <!-- <thead>
        <tr>
            <th>Customer Name</th>
            <th>Injazat No.</th>
            <th>Acc. No.</th>
            <th>Mobile</th>
            <th>IssueDate</th>
            <th>ExpDate</th>
        </tr>
    </thead>
    <tbody> -->
    	<?php
    	ini_set("pcre.backtrack_limit", "10000000");
    	foreach ($customers as $customer): ?>
    	<tr>
            <td><?=$customer['full_name']?></td>
            <td width=90><?=$customer['injazat_no']?></td>
            <td width=80><?=$customer['acc_no']?></td>
            <td width=90><?=$customer['mobile']?></td>
            <td width=140><?=$customer['updated_at']?></td>
            <td width=100><?=$customer['exp_date']?></td>
        </tr>
    	<?php  endforeach  ?>
    <!-- </tbody>
    <tfoot>
        <tr>
            <th>Customer Name</th>
            <th>Injazat No.</th>
            <th>Acc. No.</th>
            <th>Mobile</th>
            <th>IssueDate</th>
            <th>ExpDate</th>
        </tr>
    </tfoot> -->
</table>