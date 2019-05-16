
			</div>

			<!--<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.3.6
				</div>
				<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
			</footer>-->

			<div class="control-sidebar-bg"></div>
		
		</div>
		<!-- ./wrapper -->

		<!-- jQuery 2.2.3 -->
		<script src="<?php echo base_url(); ?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
		
		<!-- Bootstrap 3.3.6 -->
		<script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- SlimScroll -->
		<script src="<?php echo base_url(); ?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		
		<!-- FastClick -->
		<script src="<?php echo base_url(); ?>asset/plugins/fastclick/fastclick.js"></script>
		
		<!-- AdminLTE App -->
		<script src="<?php echo base_url(); ?>asset/dist/js/app.min.js"></script>
		
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo base_url(); ?>asset/dist/js/demo.js"></script>
		
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo base_url(); ?>js/common.js"></script>
		
		<script src="<?php echo base_url(); ?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
		
		<script>
		  $(function () {
			$("#userDataTable").DataTable({
				columnDefs: [
					{
						targets: [ 0, 1, 2 ],
						className: 'mdl-data-table__cell--non-numeric'
					}
				]
			});
		  });
		</script>
	
	</body>
	
</html>