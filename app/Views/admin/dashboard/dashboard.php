<?= $this->include('admin/common/header') ?>

<div class="content-body">
	<style>
		.role-f {
			display: none !important;
		}

		table.dataTable.display tbody td {
			border: 1px solid #ddd;
		}

		table.dataTable.display tbody .td {
			border: 1px solid #ddd;
			padding: 8px 10px;
			min-height: 37px;
		}
	</style>
	<div class="container-fluid">
		<div class="row page-titles mx-0">
			<div class="col-sm-6">
				<div class="welcome-text">
					<h4>Hi, welcome back <?php echo session()->get('admin_name') ?: 'Admin'; ?> !</h4>
					<span>Dashboard</span>
				</div>
			</div>
			<div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
				</ol>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="row">

					<div class="col-xl-4 col-xxl-4 col-lg-6 col-sm-6">
						<div class="card">
							<div class="card-header border-0 pb-0">
								<h4 class="card-title">Pending Task</h4>
							</div>
							<div class="card-body ">
								<div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:250px;">
									<ul class="timeline">

										<?php if (!empty($pending)): ?>
											<?php foreach ($pending as $user): ?>
												<?php
												// Extract the first date if multiple dates exist
												$dates = explode(',', $user->submit_date);
												$createdAt = new DateTime(trim($dates[0]));
												$currentDate = new DateTime();

												// Calculate the time difference
												$interval = $currentDate->diff($createdAt);
												$timeAgo = ($interval->d > 0) ? $interval->d . ' days ago' : (($interval->h > 0) ? $interval->h . ' hours ago' : (($interval->i > 0) ? $interval->i . ' minutes ago' : 'Just now'));
												?>
												<li>
													<div class="timeline-badge primary"></div>
													<a class="timeline-panel text-muted" href="#">
														<p>Submission Date <span style="color:red;"><?= htmlspecialchars($timeAgo) ?></span></p>
														<h6 class="mb-0">
															<strong class="text-primary">$<?= htmlspecialchars($user->name) ?></strong>.
														</h6>
														<p class="mb-0">
															Branch: <strong class="text-primary"> <?= htmlspecialchars($user->branch) ?></strong>.
														</p>
													</a>
												</li>
											<?php endforeach; ?>
										<?php else: ?>
											<li>No data found</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-8 col-xxl-8 col-lg-6 col-sm-6">
						<div class="row">
							<div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-6">
								<div class="card bg-primary overflow-hidden">
									<div class="card-body pb-4 px-4 pt-4">
										<div class="row">
											<div class="col text-white">
												<h5 class="text-white mb-1"><?= $total_task; ?></h5>
												<span>New Tasks</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-6">
								<div class="card bg-success overflow-hidden" id="completedTasksCard" style="cursor: pointer;">
									<div class="card-body pb-4 px-4 pt-4">
										<div class="row">
											<div class="col text-white">
												<h5 class="text-white mb-1"><?= $total_task_com; ?></h5>
												<span>Completed Tasks</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-6">
								<div class="card bg-danger overflow-hidden" id="pendingTasksCard" style="cursor: pointer;">
									<div class="card-body pb-4 px-4 pt-4">
										<div class="row">
											<div class="col text-white">
												<h5 class="text-white mb-1"><?= $total_task_pending; ?></h5>
												<span>Pending Tasks</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-6">
								<div class="card bg-danger overflow-hidden" id="lateTasksCard" style="cursor: pointer;">
									<div class="card-body pb-4 px-4 pt-4">
										<div class="row">
											<div class="col text-white">
												<h5 class="text-white mb-1"><?= $total_task_late; ?></h5>
												<span>Late Completed Tasks</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
								<div class="card overflow-hidden">
									<div class="card-body px-4 py-4">
										<h5 class="mb-3"><?= $total_task; ?> / <small class="text-primary">Task Status</small></h5>
										<div class="chart-point">
											<div class="check-point-area">
												<canvas id="ShareProfit2"></canvas>
											</div>
											<ul class="chart-point-list">
												<li><i class="fa fa-circle text-success mr-1"></i><?= $completed_percentage; ?>% Completed (<?= $total_task_com; ?>)</li>
												<li><i class="fa fa-circle text-primary mr-1"></i><?= $pending_percentage; ?>% Pending (<?= $total_task_pending; ?>)</li>
												<li><i class="fa fa-circle text-secondary mr-1"></i><?= $completed_late; ?>% Late Complete (<?= $total_task_late; ?>)</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.modal-lg,
	.modal-xl {
		max-width: 90% !important;
	}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="taskModalLabel">Task Details</h5>

			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<div class="table-responsive" id="taskTable">
						<table id="example3" class="display" style="min-width: 845px">
							<thead>
								<tr>
									<th>
										Sr.No
									</th>
									<th>Name</th>
									<th>Branch</th>
									<th>Type</th>
									<th>Type Of Assignment</th>
									<th>Frequency Of Audit </th>
									<th>Professinal Fees</th>
									<th>Last Date of Submission</th>
									<th>Report Date of Submission</th>
									<th>Bill Date</th>
									
									<th>Invoice Number</th>
									<th>Invoice Amount</th>
									<th>Recovery status</th>
									<th>Security Deposit</th>
									<th>Working Environment</th>
									<th>Completion Certificate Received</th>
									<th>UDIN</th>
									<th>UDIN No</th>
									<th>UDIN Trunover</th>
									<th> Date added</th>
								

								</tr>
							</thead>
							<tbody class="complttt"style="display:none;">
							<?php if ($complete !== null && !empty($complete)): ?>
                                        <?php foreach ($complete as $index => $user): ?>
                                            <?php
                             

                                            $submit_dates = explode(',', $user->submit_date);
                                            $report_dates = explode(',', $user->report_submit_date);
                                            $bill_dates = explode(',', $user->bill_date);
                                            $invoice_no = explode(',', $user->invoice_no);
                                            $invoice_amount = explode(',', $user->invoice_amount);
                                            $recovery_status = explode(',', $user->recovery_status);
                                            $security_deposit = explode(',', $user->security_deposit);
                                            $working = explode(',', $user->working);
                                            $completion = explode(',', $user->completion);
                                            $fee = explode(',', $user->fee);
                                            // Split dates 
                                            ?>

                                            <tr>
                                                <td><?= sprintf("%02d", $index + 1) ?></td>
                                                <td><?= $user->name ?></td>
                                                <td><?= $user->branch ?></td>
                                                <td><?= $user->type ?></td>
                                                <td><?= $user->assignment ?></td>
                                                <td><?= $user->audit ?></td>
                                                <?php 
                                                $autt = $user->audit;
                                                if ($autt == 'monthly'|| $autt =='quarterly' || $autt =='half'): ?>
                                               
                                                <td class="p-0">
                                                    <?php foreach ($fee as $fees): ?>
                                                        <div class="td"> <?= trim($fees) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($submit_dates as $subdate): ?>
                                                        <div class="td"> <?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($report_dates as $subdate): ?>
                                                        <div class="td"> <?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($bill_dates as $subdate): ?>
                                                        <div class="td"><?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($invoice_no as $invoice): ?>
                                                        <div class="td"><?= trim($invoice) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($invoice_amount as $invoice_a): ?>
                                                        <div class="td"><?= trim($invoice_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($recovery_status as $recovery): ?>
                                                        <div class="td"><?= trim($recovery) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($security_deposit as $security): ?>
                                                        <div class="td"><?= trim($security) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($working as $working_a): ?>
                                                        <div class="td"><?= trim($working_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($completion as $completion_a): ?>
                                                        <div class="td"><?= trim($completion_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                            
                                               
                                              
                                                <?php else: ?>
                                                <td><?= $user->fee ?></td>
                                                <td > <?= $user->submit_date ?> </td>
                                                <td ><?= $user->report_submit_date ?> </td>
                                                <td > <?= $user->invoice_no ?></td>
                                                <td><?= $user->invoice_no ?></td>
                                                <td><?= $user->invoice_amount ?></td>
                                                <td><?= $user->recovery_status ?></td>
                                                <td><?= $user->security_deposit ?></td>
                                                <td><?= $user->working ?></td>
                                                <td><?= $user->completion ?></td>
                                                <?php endif; ?>
                                                <td><?= $user->udin ?></td>
                                                <td><?= $user->udin_no ?></td>
                                                <td><?= $user->udin_trun ?></td>
                                               
                                                <td><a href="javascript:void(0);"><strong><?= $user->created_at ?></strong></a></td>
                                               
                                            </tr>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
							</tbody>
							<tbody class="pendinggg"style="display:none;">
							<?php if ($pending !== null && !empty($pending)): ?>
                                        <?php foreach ($pending as $index => $user): ?>
                                            <?php
                             

                                            $submit_dates = explode(',', $user->submit_date);
                                            $report_dates = explode(',', $user->report_submit_date);
                                            $bill_dates = explode(',', $user->bill_date);
                                            $invoice_no = explode(',', $user->invoice_no);
                                            $invoice_amount = explode(',', $user->invoice_amount);
                                            $recovery_status = explode(',', $user->recovery_status);
                                            $security_deposit = explode(',', $user->security_deposit);
                                            $working = explode(',', $user->working);
                                            $completion = explode(',', $user->completion);
                                            $fee = explode(',', $user->fee);
                                            // Split dates 
                                            ?>

                                               <tr>
                                                <td><?= sprintf("%02d", $index + 1) ?></td>
                                                <td><?= $user->name ?></td>
                                                <td><?= $user->branch ?></td>
                                                <td><?= $user->type ?></td>
                                                <td><?= $user->assignment ?></td>
                                                <td><?= $user->audit ?></td>
                                                <?php 
                                                $autt = $user->audit;
                                                if ($autt == 'monthly'|| $autt =='quarterly' || $autt =='half'): ?>
                                               
                                                <td class="p-0">
                                                    <?php foreach ($fee as $fees): ?>
                                                        <div class="td"> <?= trim($fees) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($submit_dates as $subdate): ?>
                                                        <div class="td"> <?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($report_dates as $subdate): ?>
                                                        <div class="td"> <?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($bill_dates as $subdate): ?>
                                                        <div class="td"><?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($invoice_no as $invoice): ?>
                                                        <div class="td"><?= trim($invoice) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($invoice_amount as $invoice_a): ?>
                                                        <div class="td"><?= trim($invoice_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($recovery_status as $recovery): ?>
                                                        <div class="td"><?= trim($recovery) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($security_deposit as $security): ?>
                                                        <div class="td"><?= trim($security) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($working as $working_a): ?>
                                                        <div class="td"><?= trim($working_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($completion as $completion_a): ?>
                                                        <div class="td"><?= trim($completion_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                            
                                               
                                              
                                                <?php else: ?>
                                                <td><?= $user->fee ?></td>
                                                <td > <?= $user->submit_date ?> </td>
                                                <td ><?= $user->report_submit_date ?> </td>
                                                <td > <?= $user->invoice_no ?></td>
                                                <td><?= $user->invoice_no ?></td>
                                                <td><?= $user->invoice_amount ?></td>
                                                <td><?= $user->recovery_status ?></td>
                                                <td><?= $user->security_deposit ?></td>
                                                <td><?= $user->working ?></td>
                                                <td><?= $user->completion ?></td>
                                                <?php endif; ?>
                                                <td><?= $user->udin ?></td>
                                                <td><?= $user->udin_no ?></td>
                                                <td><?= $user->udin_trun ?></td>
                                               
                                                <td><a href="javascript:void(0);"><strong><?= $user->created_at ?></strong></a></td>
                                               
                                            </tr>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
							</tbody>
							<tbody class="lett" style="display:none;">
							<?php if ($late !== null && !empty($late)): ?>
                                        <?php foreach ($late as $index => $user): ?>
                                            <?php
                             

                                            $submit_dates = explode(',', $user->submit_date);
                                            $report_dates = explode(',', $user->report_submit_date);
                                            $bill_dates = explode(',', $user->bill_date);
                                            $invoice_no = explode(',', $user->invoice_no);
                                            $invoice_amount = explode(',', $user->invoice_amount);
                                            $recovery_status = explode(',', $user->recovery_status);
                                            $security_deposit = explode(',', $user->security_deposit);
                                            $working = explode(',', $user->working);
                                            $completion = explode(',', $user->completion);
                                            $fee = explode(',', $user->fee);
                                            // Split dates 
                                            ?>

<tr>
                                                <td><?= sprintf("%02d", $index + 1) ?></td>
                                                <td><?= $user->name ?></td>
                                                <td><?= $user->branch ?></td>
                                                <td><?= $user->type ?></td>
                                                <td><?= $user->assignment ?></td>
                                                <td><?= $user->audit ?></td>
                                                <?php 
                                                $autt = $user->audit;
                                                if ($autt == 'monthly'|| $autt =='quarterly' || $autt =='half'): ?>
                                               
                                                <td class="p-0">
                                                    <?php foreach ($fee as $fees): ?>
                                                        <div class="td"> <?= trim($fees) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($submit_dates as $subdate): ?>
                                                        <div class="td"> <?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($report_dates as $subdate): ?>
                                                        <div class="td"> <?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($bill_dates as $subdate): ?>
                                                        <div class="td"><?= trim($subdate) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($invoice_no as $invoice): ?>
                                                        <div class="td"><?= trim($invoice) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($invoice_amount as $invoice_a): ?>
                                                        <div class="td"><?= trim($invoice_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($recovery_status as $recovery): ?>
                                                        <div class="td"><?= trim($recovery) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($security_deposit as $security): ?>
                                                        <div class="td"><?= trim($security) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($working as $working_a): ?>
                                                        <div class="td"><?= trim($working_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="p-0">
                                                    <?php foreach ($completion as $completion_a): ?>
                                                        <div class="td"><?= trim($completion_a) ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                            
                                               
                                              
                                                <?php else: ?>
                                                <td><?= $user->fee ?></td>
                                                <td > <?= $user->submit_date ?> </td>
                                                <td ><?= $user->report_submit_date ?> </td>
                                                <td > <?= $user->invoice_no ?></td>
                                                <td><?= $user->invoice_no ?></td>
                                                <td><?= $user->invoice_amount ?></td>
                                                <td><?= $user->recovery_status ?></td>
                                                <td><?= $user->security_deposit ?></td>
                                                <td><?= $user->working ?></td>
                                                <td><?= $user->completion ?></td>
                                                <?php endif; ?>
                                                <td><?= $user->udin ?></td>
                                                <td><?= $user->udin_no ?></td>
                                                <td><?= $user->udin_trun ?></td>
                                               
                                                <td><a href="javascript:void(0);"><strong><?= $user->created_at ?></strong></a></td>
                                               
                                            </tr>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap JS (Include jQuery if using Bootstrap 4) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
	const completedPercentage = <?php echo $completed_percentage; ?>;
	const pendingPercentage = <?php echo $pending_percentage; ?>;
	const latePercentage = <?php echo $completed_late; ?>;
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		$('#example3').DataTable();
		// Attach event listeners
		document.getElementById("completedTasksCard").addEventListener("click", function() {
			
			document.querySelector(".complttt").style.display = "table-row-group";
			var taskModal = new bootstrap.Modal(document.getElementById("taskModal"));
			taskModal.show();
			// document.querySelector(".pendinggg").style.display = "none";
			// document.querySelector(".lett").style.display = "none";
		});

		document.getElementById("pendingTasksCard").addEventListener("click", function() {
			document.querySelector(".pendinggg").style.display = "table-row-group";
			var taskModal = new bootstrap.Modal(document.getElementById("taskModal"));
			taskModal.show();
		});

		document.getElementById("lateTasksCard").addEventListener("click", function() {
			document.querySelector(".lett").style.display = "table-row-group";
			var taskModal = new bootstrap.Modal(document.getElementById("taskModal"));
			taskModal.show();
		});

	});</script>


<?= $this->include('admin/common/footer') ?>