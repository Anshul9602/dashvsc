<?= $this->include('admin/common/header') ?>

<div class="content-body">
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
									<th>Type Of <br>Assignment</th>
									<th>Frequency <br>Of Audit </th>
									<th>Professinal Fees</th>
									<th>Last Date of Submission</th>
									<th>Report Date of Submission</th>
									<th>Bill Type</th>
									<th>Bill Date</th>
									<th>UDIN</th>
									<th>UDIN No</th>
									<th>UDIN Trunover</th>
									<th>Invoice Number</th>
									<th>Recovery status</th>
									<th>Security Deposit</th>
									<th>Working Environment</th>
									<th>Completion Certificate Received</th>


									<th>Status</th>
									<th> Date added</th>

								</tr>
							</thead>
							<tbody>

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
		function openModal(taskType, taskData) {
			let tableBody = document.querySelector("#taskTable tbody");
			let modalTitle = document.getElementById("taskModalLabel");

			// Set the title dynamically
			if (taskType === "complete") {
				modalTitle.innerText = "Completed Tasks";
			} else if (taskType === "pending") {
				modalTitle.innerText = "Pending Tasks";
			} else if (taskType === "late") {
				modalTitle.innerText = "Late Completed Tasks";
			}

			// Clear existing table rows
			tableBody.innerHTML = "";

			if (taskData.length > 0) {
				let index = 1;
				taskData.forEach(task => {
					let row = `
                    <tr>
                        <td>${index}</td> 
                        <td>${task.name}</td>
                        <td>${task.branch}</td>
                        <td>${task.type}</td>
                        <td>${task.assignment || "N/A"}</td>
                        <td>${task.audit || "N/A"}</td>
                        <td>${task.fee || "N/A"}</td>
                        <td>${task.submit_date || "N/A"}</td>
                        <td>${task.report_submit_date || "N/A"}</td>
                        <td>${task.bill_type || "N/A"}</td>
                        <td>${task.bill_date || "N/A"}</td>
                        <td>${task.udin || "N/A"}</td>
                        <td>${task.udin_no || "N/A"}</td>
                        <td>${task.udin_trun || "N/A"}</td>
                        <td>${task.invoice_no || "N/A"}</td>
                        <td>${task.recovery_status || "N/A"}</td>
                        <td>${task.security_deposit || "N/A"}</td>
                        <td>${task.working || "N/A"}</td>
                        <td>${task.completion || "N/A"}</td>
                        <td>${task.status == 1 ? "Active" : "Inactive"}</td>
                        <td>${task.created_at}</td>
                    </tr>
                `;
					tableBody.innerHTML += row;
					index++;
				});
			} else {
				tableBody.innerHTML = "<tr><td colspan='16' class='text-center'>No tasks available</td></tr>";
			}

			// Show the modal
			var taskModal = new bootstrap.Modal(document.getElementById("taskModal"));
			taskModal.show();
		}

		// Attach event listeners
		document.getElementById("completedTasksCard").addEventListener("click", function() {
			let completedData = <?php echo json_encode($complete); ?>;
			openModal("complete", completedData);
		});

		document.getElementById("pendingTasksCard").addEventListener("click", function() {
			let pendingData = <?php echo json_encode($pending); ?>;
			openModal("pending", pendingData);
		});

		document.getElementById("lateTasksCard").addEventListener("click", function() {
			let lateData = <?php echo json_encode($late); ?>;
			openModal("late", lateData);
		});
		
	});
</script>


<?= $this->include('admin/common/footer') ?>