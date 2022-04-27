<!-- add modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addMember">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add Member</h4>
			</div>

			<form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">

				<div class="modal-body">
					<div class="messages"></div>

					<div class="form-group">
						<!--/here teh addclass has-error will appear -->
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="Name">
							<!-- here the text will apper -->
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="col-sm-2 control-label">Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="address" name="address" placeholder="Address">
						</div>
					</div>
					<div class="form-group">
						<label for="contact" class="col-sm-2 control-label">Contact</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="contact" name="contact" placeholder="Contact">
						</div>
					</div>
					<div class="form-group">
						<label for="active" class="col-sm-2 control-label">Active</label>
						<div class="col-sm-10">
							<select class="form-control" name="active" id="active">
								<option value="">~~SELECT~~</option>
								<option value="1">Activate</option>
								<option value="2">Deactivate</option>
							</select>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /add modal -->