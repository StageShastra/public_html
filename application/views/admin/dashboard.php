<?php
	include 'includes/header.php';
	include 'includes/nav.php';
?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>DASHBOARD</h2>
		<ol class="breadcrumb">
			<li class="active">
				<a href="<?= base_url() ?>/admin/home/">Home</a>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<!-- <div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Monthly</span>
					<h5>Income</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">40 886,200</h1>
					<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
					<small>Total income</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-info pull-right">Annual</span>
					<h5>Orders</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">275,800</h1>
					<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
					<small>New orders</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-primary pull-right">Today</span>
					<h5>Vistits</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">106,120</h1>
					<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
					<small>New visits</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-danger pull-right">Low value</span>
					<h5>User activity</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">80,600</h1>
					<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
					<small>In first month</small>
				</div>
			</div>
		</div> -->
		<div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Invitation Status <small>Email + SMS invitation</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="graph_flot.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-line-chart-main"></div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<!-- <div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Monthly</span>
					<h5>Income</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">40 886,200</h1>
					<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
					<small>Total income</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-info pull-right">Annual</span>
					<h5>Orders</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">275,800</h1>
					<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
					<small>New orders</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-primary pull-right">Today</span>
					<h5>Vistits</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">106,120</h1>
					<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
					<small>New visits</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-danger pull-right">Low value</span>
					<h5>User activity</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">80,600</h1>
					<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
					<small>In first month</small>
				</div>
			</div>
		</div> -->
		<div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Invitation Status <small>Email Invitation</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="graph_flot.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="graph_flot.html#">Config option 1</a>
                            </li>
                            <li><a href="graph_flot.html#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-line-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Invitation Status <small>SMS Invitation</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="graph_flot.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="graph_flot.html#">Config option 1</a>
                            </li>
                            <li><a href="graph_flot.html#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-line-chart-2"></div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
	var graph = true;
</script>
<?php
	include 'includes/footer.php';
?>