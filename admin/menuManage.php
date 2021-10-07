<div class="container-fluid Item_Created" style="margin-top:98px;">
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
					<div class="card mb-3">
						<div class="card-header" style="background-color: #48adea;">
							Create New Item
						</div>
						<div class="card-body">
							<div class="form-group">
								<label class="control-label">Name: </label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label class="control-label">Description: </label>
								<textarea cols="30" rows="3" class="form-control" name="description" required></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" class="form-control" name="price" required min="1" step="any">
							</div>
							<div class="form-group">
								<label class="control-label">Division: </label>
								<select name="categoryId" id="categoryId" class="custom-select form-control browser-default" required>
									<option hidden disabled selected value class="form-control">None</option>
									<?php
									$catsql = "SELECT * FROM `division`";
									$catresult = mysqli_query($conn, $catsql);
									while ($row = mysqli_fetch_assoc($catresult)) {
										$catId = $row['divisionId'];
										$catName = $row['divisionName'];
										echo '<option value="' . $catId . '">' . $catName . '</option>';
									}
									?>
								</select>
							</div>
							</br>
							<div class="form-group">
								<label class="control-label">UOM: </label>
								<select name="uomid" id="uomid" class="custom-select form-control browser-default" required>
									<option hidden disabled selected value>None</option>
									<?php
									$uomsql = "SELECT distinct(UOM) FROM `drugs`";
									$uomres = mysqli_query($conn, $uomsql);
									while ($row = mysqli_fetch_assoc($uomres)) {
										$uom = $row['UOM'];
										echo '<option value="' . $uom . '">' . $uom . '</option>';
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
							</div>
						</div>

						<div class="card-footer">
							<div class="row">
								<div class="mx-auto">
									<button type="submit" name="createItem" class="btn btn-sm btn-primary"> Create </button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<form method='post' action='partials/_menuManage.php'>
							<input type="submit" value='Delete selected' name='but_delete' class="btn btn-danger" style="display:none" id="otherValue" onClick="return confirm('Please confirm deletion');" /><br><br>
							<table id="myTable" class="table table-bordered table-hover mb-0">
								<thead style="background-color: #48adea;">
									<tr>
										<th class="text-center" style="width:7%;"></th>
										<th class="text-center" style="width:7%;">Division</th>
										<th class="text-center">Img</th>
										<th class="text-center" style="width:58%;">Item Detail</th>
										<th class="text-center" style="width:18%;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT a.drugsId,a.drugsName,a.drugsPrice,a.drugsDesc,a.UOM,b.divisionName FROM drugs a join division b where a.drugsdivisionId=b.divisionId order by drugsid desc";
									$result = mysqli_query($conn, $sql);
									while ($row = mysqli_fetch_assoc($result)) {
									?>
										<tr id='tr_<?php echo $row["drugsId"] ?>'>
											<td><input type="checkbox" name='delete[]' value='<?php echo $row['drugsId']; ?>' id="other" onclick="myFunction()"></td>
											<td class="text-center"><?php echo $row["divisionName"]; ?></td>
											<td>
												<img src="/img/drugs-<?php echo $row["drugsId"]; ?>.jpg?" alt="image for this item" width="150px" height="150px">
											</td>
											<td>
												<p>Name : <b><?php echo $row["drugsName"]; ?></b></p>
												<p>Description : <b class="truncate"><?php echo $row["drugsDesc"]; ?></b></p>
												<p>UOM : <b><?php echo $row["UOM"]; ?></b></p>
												<p>Price : <b><?php echo $row["drugsPrice"]; ?></b></p>
											</td>
											<td class="text-center">
												<div class="row mx-auto d-flex justify-content-center">
													<button class="btn btn-sm btn-primary " style="width:100px" type="button" data-bs-toggle="modal" data-bs-target="#updateItem<?php echo $row["drugsId"]; ?>">Edit</button>
													<form action="partials/_menuManage.php" method="POST"></br>
														<button name="removeItem" class="btn btn-sm btn-danger" style="width:100px" onClick="return confirm('Please confirm deletion');">Delete</button>
														<input type="hidden" name="drugsId" value="<?php echo $row["drugsId"]; ?>">
													</form>
												</div>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>
</div>

<?php
$drugssql = "SELECT * FROM `drugs`";
$drugsResult = mysqli_query($conn, $drugssql);
while ($drugsRow = mysqli_fetch_assoc($drugsResult)) {
	$drugsId = $drugsRow['drugsId'];
	$drugsName = $drugsRow['drugsName'];
	$drugsPrice = $drugsRow['drugsPrice'];
	$drugsdivisionId = $drugsRow['drugsdivisionId'];
	$drugsDesc = $drugsRow['drugsDesc'];
	$drugsUOM = $drugsRow['UOM'];
?>
	<?php $divisionsql = "SELECT * FROM division";
	$divres = mysqli_query($conn, $divisionsql);
	?>
	<?php
	$uomsql = "SELECT distinct(UOM) FROM `drugs`";
	$uomres = mysqli_query($conn, $uomsql);
	?>
	<!-- Modal -->
	<div class="modal fade" id="updateItem<?php echo $drugsId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItem<?php echo $drugsId; ?>" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #48adea;">
					<h5 class="modal-title" id="updateItem<?php echo $drugsId; ?>">Item Id: <?php echo $drugsId; ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
						<div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
							<div class="form-group col-md-8">
								<b><label for="image">Image</label></b>
								<input type="file" name="itemimage" id="itemimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
								<input type="hidden" id="drugsId" name="drugsId" value="<?php echo $drugsId; ?>">
								<button type="submit" class="btn btn-success my-1" name="updateItemPhoto">Update Image</button>
							</div>
							<div class="form-group col-md-4">
								<img src="../img/drugs-<?php echo $drugsId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="item image" width="100" height="100">
							</div>
						</div>
					</form>
					<form action="partials/_menuManage.php" method="post">
						<div class="text-left my-2">
							<b><label for="name">Name</label></b>
							<input class="form-control" id="name" name="name" value="<?php echo $drugsName; ?>" type="text" required>
						</div>
						<div class="text-left my-2 row">
							<div class="form-group col-md-3">
								<b><label for="price">Price</label></b>
								<input class="form-control" id="price" name="price" value="<?php echo $drugsPrice; ?>" type="number" min="1" required>
							</div>
							<div class="form-group col-md-6">
								<b><label for="catId">Division</label></b>
								<select class='form-control' name='catId'>
									<option value='' disabled selected hidden>Select Division</option>
									<?php while ($division = mysqli_fetch_array($divres)) { ?>
										<option value="<?php echo $division['divisionId']; ?>" <?php echo ($drugsRow['drugsdivisionId'] == $division['divisionId'] ? 'selected' : ""); ?>><?php echo $division['divisionName']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<b><label for="catId">UOM</label></b>
								<select class='form-control' name='uomid'>
									<option value='' disabled selected hidden>Select UOM</option>
									<?php while ($uom = mysqli_fetch_array($uomres)) { ?>
										<option value="<?php echo $uom['UOM']; ?>" <?php echo ($drugsRow['UOM'] == $uom['UOM'] ? 'selected' : ""); ?>><?php echo $uom['UOM']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="text-left my-2">
							<b><label for="desc">Description</label></b>
							<textarea class="form-control" id="desc" name="desc" rows="2" required minlength="3"><?php echo $drugsDesc; ?></textarea>
						</div>
						<input type="hidden" id="drugsId" name="drugsId" value="<?php echo $drugsId; ?>">
						<button type="submit" class="btn btn-success" name="updateItem">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>