<!--Modal voor de reactie-->
<div class="modal fade" id="respondPopup" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">

				<form method="POST" action="../POST/respond.php">

					<input class="respondModalInput" name="jobTitle" type="text" value="" readonly hidden>

					<div class="form-group">
						<label for="Bericht">Bericht</label>
						<textarea class="form-control" id="Bericht" rows="3" maxlength="750" name="Bericht"></textarea>
					</div>

					<button type="submit" class="btn btn-success btn-block"><span
								class="glyphicon glyphicon-off"></span> Verzend
					</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>
					Cancel
				</button>
			</div>
		</div>
	</div>
</div>
