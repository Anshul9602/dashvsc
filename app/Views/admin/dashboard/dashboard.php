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
								<h4 class="card-title">Notice Board</h4>
							</div>
							<div class="card-body ">
								<div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:250px;">
									<ul class="timeline ">
										<?php if ($users !== null && !empty($users)):


										?>

											<?php foreach ($pending as $index => $user): ?>
												<?php
												// Parse created_at into a DateTime object
												$createdAt = new DateTime($user->submit_date);
												$currentDate = new DateTime(); // Current date and time

												// Calculate the difference
												$interval = $currentDate->diff($createdAt);

												// Format the difference into a human-readable string
												if ($interval->d > 0) {
													$timeAgo = $interval->d . ' days ago';
												} elseif ($interval->h > 0) {
													$timeAgo = $interval->h . ' hours ago';
												} elseif ($interval->i > 0) {
													$timeAgo = $interval->i . ' minutes ago';
												} else {
													$timeAgo = 'Just now';
												}
												?>
												<li>
													<div class="timeline-badge primary"></div>
													<a class="timeline-panel text-muted" href="#">
												<p>Submission Date<span style="color:red;"><?= htmlspecialchars($timeAgo) ?></span></p>
														
														<h6 class="mb-0">
															<strong class="text-primary">$<?= htmlspecialchars($user->name) ?></strong>.
														</h6>
														<p class="mb-0">
														Branch:<strong class="text-primary"> <?= htmlspecialchars($user->branch) ?></strong>.
														</p>
													</a>
												</li>
											<?php endforeach; ?>
										<?php else: ?>
											No data found
										<?php endif; ?>

									</ul>

								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-xxl-8 col-lg-6 col-sm-6">
						<div class="row">

							<div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
								<div class="card bg-primary overflow-hidden">
									<div class="card-body pb-0 px-4 pt-4">
										<div class="row">
											<div class="col text-white">
												<h5 class="text-white mb-1"><?php echo $total_task; ?></h5>
												<span>New Tasks</span>
											</div>
										</div>
									</div>
									<div class="chart-wrapper px-2">
										<canvas id="chart_widget_2" height="100"></canvas>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
								<div class="card overflow-hidden">
									<div class="card-body px-4 py-4">
										<h5 class="mb-3"><?php echo $total_task; ?>/ <small class="text-primary">Task Status</small></h5>
										<div class="chart-point">
											<div class="check-point-area">
												<canvas id="ShareProfit2"></canvas>
											</div>
											<ul class="chart-point-list">
												<li><i class="fa fa-circle text-success mr-1"></i><?php echo $completed_percentage; ?>% Completed</li>
												<li><i class="fa fa-circle  text-primary mr-1"></i><?php echo $pending_percentage; ?>% Pending</li>

											</ul>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 d-none">
								<div class="card ">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Task Assiged to me</h4>
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

<script>
	const completedPercentage = <?php echo $completed_percentage; ?>;
	const pendingPercentage = <?php echo $pending_percentage; ?>;
</script>

<?= $this->include('admin/common/footer') ?>