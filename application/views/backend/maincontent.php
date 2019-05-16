<?php

	include_once("modules/topbar.php");
	
	switch ( $doAction ) {
		
		case "" :
		
			?><!-- Content Header (Page header) -->
			<link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/datatables/dataTables.bootstrap.css">
			<section class="content-header">
				<h1>
					Blank page
					<small>it all starts here</small>
				</h1>
				<ol class="breadcrumb">
					<li>
						<a href="#">
							<i class="fa fa-dashboard"></i> Home
						</a>
					</li>
					<li>
						<a href="#">Examples</a>
					</li>
					<li class="active">Blank page</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				
				<!-- Default box -->	
				<div class="box-body">
					<form action="" method="post" name="frmSearch" id="frmSearch" enctype="multipart/form-data">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Search Box</h3>
									</div>
									<div class="box-body table-responsive">
										<div class="form-group"><?php
											if ( !isset($arrSearchParams['txtSearch']) ) {
												$arrSearchParams['txtSearch'] = "";
											}
											?><input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="Search By Name Email and Username" value="<?php print $arrSearchParams['txtSearch']; ?>" />
										</div>
										<div class="form-group">
											<button type="button" onClick="javascript:frmSearchSubmit(this.form)" class="btn btn-info">Search</button>
											<button type="button" onClick="javascript:frmRemoveSearchSubmit(this.form)" class="btn btn-info">Remove Search</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-xs-11">
						</div>
						<div class="col-xs-1">
							<a type="button" href="<?php print $add; ?>" class="btn btn-block btn-primary" >Add</a>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Responsive Hover Table</h3>

									<div class="box-tools">
										<div class="input-group input-group-sm" style="width: 150px;">
											
										</div>
									</div>
								</div>
			   
								<!-- /.box-header -->
								<div class="box-body">
									<div class="box-body">
										<table class="table table-hover" id="userDataTable">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th>Name</th>
													<th>Email</th>
													<th class="text-center">Status</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody><?php
												$count = 1;
												foreach ( $arrUserDetails as $userId => $arrUserInfo ){
												
													?><tr>
														
														<td class="text-center"><?php 
															print $count; 
														?></td>
														
														<td><?php 
															print $arrUserInfo["firstname"] . " " . $arrUserInfo["lastname"];
														?></td>
														
														<td><?php 
															print $arrUserInfo["email"];
														?></td>
														
														<td class="text-center">
															<a href="<?php print $arrUserInfo["status"]; ?>"><?php
																print $arrUserInfo["strStatus"];
															?></a>
														</td>
														
														<td align="center">
															<a href="<?php print $arrUserInfo["edit"]; ?>">Edit</a>
															&nbsp;&nbsp;
															<a href="<?php print $arrUserInfo["delete"]; ?>">Delete</a>
														</td>
														
													</tr><?php
													
													$count++;
												}
											?></tbody>
										</table>
									</div>
								</div>
								<!-- /.box-body -->
				
							</div>
							<!-- /.box -->
						</div>
					</div>
				</div>
				<!-- /.box -->

			</section>
			<script>
				function frmSearchSubmit(objForm) {
					objForm.submit();
				}
				
				function frmRemoveSearchSubmit(objForm) {
					$("#frmSearch #txtSearch").val("");
					objForm.submit();
				}
			</script><?php
		
		break;
		
		case "addEdit" :
			?><!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Blank page
					<small>it all starts here</small>
				</h1>
				<ol class="breadcrumb">
					<li>
						<a href="#">
							<i class="fa fa-dashboard"></i> Home
						</a>
					</li>
					<li>
						<a href="#">Examples</a>
					</li>
					<li class="active">Blank page</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<form name="frmLevel01" method="post" action="<?php print $addRecord; ?>" enctype="multipart/form-data" onSubmit="javascript:return frmLevel01Submit(this);">
					<!-- Default box -->	
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Search Box</h3>
									</div>
									<div class="box-body table-responsive no-padding">
									
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<!-- /.box-header -->
									<div class="box-body table-responsive no-padding">
										<table class="table table-hover">
											<tr>
												<td class="tblTD1"	>
													<span class="text-Label">First name</span> 
												</td>
												<td>
													<div>
														<input type="text" name="txtFirstName" id="txtFirstName" class="form-control" placeholder="Enter ..." size="25" maxlength="100" value="<?php print $arrUserDetails["firstname"]; ?>">
													</div>
												</td>
											</tr>
											<tr>
												<td class="tblTD1"	>
													<span class="text-Label">Last name</span> 
												</td>
												<td>
													<div>
														<input type="text" name="txtLastName" id="txtLastName" class="form-control" placeholder="Enter ..." size="25" maxlength="100" value="<?php print $arrUserDetails["lastname"]; ?>">
													</div>
												</td>
											</tr>
											<tr>
												<td class="tblTD1"	>
													<span class="text-Label">User name</span> 
												</td>
												<td>
													<div>
														<input type="text" class="form-control" name="txtUserName" id="txtUserName" placeholder="Enter ..." size="25" maxlength="100" value="<?php print $arrUserDetails["username"]; ?>">
													</div>
												</td>
											</tr>
											<tr>
												<td class="tblTD1"	>
													<span class="text-Label">Email</span> 
												</td>
												<td>
													<div>
														<input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Enter ..." size="25" maxlength="255" value="<?php print $arrUserDetails["email"]; ?>">
													</div>
												</td>
											</tr><?php
											
											if ( empty($userId) ) {
											
												?><tr>
													<td class="tblTD1"	>
														<span class="text-Label">Password</span> 
													</td>
													<td>
														<div>
															<input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Enter ..." size="25" maxlength="255" value="">
														</div>
													</td>
												</tr>
												<tr>
													<td class="tblTD1"	>
														<span class="text-Label">Confirm Password</span> 
													</td>
													<td>
														<div>
															<input type="password" class="form-control" name="txtConfirmPassword" id="txtConfirmPassword" placeholder="Enter ..." size="25" maxlength="255" value="">
														</div>
													</td>
												</tr><?php
												
											}
										?></table>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
						</div>
						<div class="row">
							<div class="col-xs-1">
							<input type="hidden" name="hidUserId" id="hidUserId" class="btn btn-block btn-primary" value="<?php print $userId ?>" />
							<input type="submit" class="btn btn-block btn-primary" value="<?php print $button; ?>" />
							</div>
						</div>
					</div>
				</form>
			</section>
			<script>
				function frmLevel01Submit(objForm) {
					
					var flagSubmit = true;
					
					var flagSubmit = checkValue(objForm, 'txtFirstName', 'First Name', false);
					if ( !flagSubmit ) return false;
					
					var flagSubmit = checkValue(objForm, 'txtLastName', 'Last Name', false);
					if ( !flagSubmit ) return false; 
					
					var flagSubmit = checkValue(objForm, 'txtUserName', 'Username', false);
					if ( !flagSubmit ) return false;
					
					var flagSubmit = checkEmail(objForm, 'txtEmail');
					if ( !flagSubmit ) return false; 
					
					if ( objForm.hidUserId.value == "" && objForm.hidUserId.value == 0 && objForm.hidUserId.value == "0" ) {
					
						var flagSubmit = checkValue(objForm, 'txtPassword', 'Password', false);
						if ( !flagSubmit ) return false; 
					
						var flagSubmit = checkValue(objForm, 'txtConfirmPassword', 'Confirm Password', false);
						if ( !flagSubmit ) return false; 
						
						if ( objForm.txtPassword.value != objForm.txtConfirmPassword.value ) {
							alert("Password not match.");
							return false;
						}
					}
					objForm.submit();
				}
			</script><?php
		break;
		
		default :
		
		break;
	}
	
	
	
	include_once("modules/footer.php");

?>