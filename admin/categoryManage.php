<div class="container-fluid " style="margin-top:98px">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="card">
                        <div class="card-header" style="background-color:#48adea;">
                            Create New Division
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Division Name: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label">Division Description: </label>
                                <input type="text" class="form-control" name="desc">
                            </div><br>
                            <div class="form-group">
                                <label for="image" class="control-label">Image:</label>
                                <input type="file" name="image" id="image" accept="all" class="form-control" required style="border:none;">
                            </div><br>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="createCategory" class="btn btn-sm btn-primary col-sm-3 offset-md-4"> Create </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                        <table id="anothertable" class="table table-bordered table-hover mb-0">
                            <thead style="background-color: #48adea;">
                                <tr>
                                    <th class="text-center" style="width:7%;">ID</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center" style="width:58%;">Division Detail</th>
                                    <th class="text-center" style="width:18%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `division`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $catId = $row['divisionId'];
                                    $catName = $row['divisionName'];
                                    $catDesc = $row['divisionDesc'];
                                ?>
                                    <tr>
                                        <td class="text-center"><b>' . $catId . '</b></td>
                                        <td><img class="w-100" src="/img/card-' . $catId . '.jpg?" alt="Image for this Division"></td>
                                        <td>
                                            <p>Name : <b>' . $catName . '</b></p>
                                            <p>Description : <b class="truncate">' . $catDesc . '</b></p>
                                        </td>
                                        <td class="text-center">
                                            <div class="row mx-auto d-flex justify-content-center">
                                                <button class="btn btn-sm btn-primary edit_cat" style="width:100px" stype="button" data-bs-toggle="modal" data-bs-target="#updateCat' . $catId . '">Edit</button>
                                                <form action="partials/_categoryManage.php" method="POST"></br>
                                                    <button typr="button" name="removeCategory" class="btn btn-sm btn-danger" onClick="return confirm(" Please confirm deletion");" style="width:100px">Delete</button>
                                                    <input type="hidden" name="catId" value="' . $catId . '">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>';
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>


<?php
$catsql = "SELECT * FROM `division`";
$catResult = mysqli_query($conn, $catsql);
while ($catRow = mysqli_fetch_assoc($catResult)) {
    $catId = $catRow['divisionId'];
    $catName = $catRow['divisionName'];
    $catDesc = $catRow['divisionDesc'];
?>

    <!-- Modal -->
    <div class="modal fade" id="updateCat<?php echo $catId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateCat<?php echo $catId; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #48adea;">
                    <h5 class="modal-title" id="updateCat<?php echo $catId; ?>">Category Id: <b><?php echo $catId; ?></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data">
                        <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
                            <div class="form-group col-md-8">
                                <b><label for="image">Image:</label></b>
                                <input type="file" name="catimage" id="catimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
                                <input type="hidden" id="catId" name="catId" value="<?php echo $catId; ?>">
                                <button type="submit" class="btn btn-success my-1" name="updateCatPhoto">Update Img</button>
                            </div>
                            <div class="form-group col-md-4">
                                <img src="/img/card-<?php echo $catId; ?>.jpg?" id="itemPhoto" name="itemPhoto" alt="Category image" width="100" height="100">
                            </div>
                        </div>
                    </form>
                    <form action="partials/_categoryManage.php" method="post">
                        <div class="text-left my-2">
                            <b><label for="name">Name</label></b>
                            <input class="form-control" id="name" name="name" value="<?php echo $catName; ?>" type="text" required>
                        </div>
                        <div class="text-left my-2">
                            <b><label for="desc">Description</label></b>
                            <textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php echo $catDesc; ?></textarea>
                        </div>
                        <input type="hidden" id="catId" name="catId" value="<?php echo $catId; ?>">
                        <button type="submit" class="btn btn-success" name="updateCategory">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
}
    ?>s