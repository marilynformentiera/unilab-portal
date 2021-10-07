<?php
include '_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['createItem'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $categoryId = $_POST["categoryId"];
        $price = $_POST["price"];
        $uom = $_POST["uomid"];

        $sql = "INSERT INTO drugs (drugsName, drugsPrice, drugsDesc,UOM, drugsdivisionId) VALUES ('$name', '$price', '$description', '$uom','$categoryId')";
        $result = mysqli_query($conn, $sql);
        $drugsId = $conn->insert_id;
        if ($result) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {

                $newName = 'drugs-' . $drugsId;
                $newfilename = $newName . ".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('Uploaded Successfully');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('Upload Failed');
                            window.location=document.referrer;
                        </script>";
                }
            } else {
                echo '<script>alert("Please select an image file to upload.");
                        window.location=document.referrer;
                    </script>';
            }
        } else {
            echo "<script>alert('Upload Failed');
                    window.location=document.referrer;
                </script>";
        }
    }
    if (isset($_POST['removeItem'])) {
        $drugsId = $_POST["drugsId"];
        $sql = "DELETE FROM `drugs` WHERE `drugsId`='$drugsId'";
        $result = mysqli_query($conn, $sql);
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/img/drugs-" . $drugsId . ".jpg";
        if ($result) {
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>alert('Item Removed');
                window.location=document.referrer;
            </script>";
        } else {
            echo "<script>alert('Deletion Failed');
            window.location=document.referrer;
            </script>";
        }
    }
    if (isset($_POST['but_delete'])) {
        if (!empty($_POST['delete'])) {
            foreach ($_POST['delete'] as $drugsId) {
                $deletedrugs = "DELETE from drugs WHERE drugsId=" . $drugsId;
                $result = mysqli_query($conn, $deletedrugs);
                $filename = $_SERVER['DOCUMENT_ROOT'] . "../img/drugs-" . $drugsId . ".jpg";
                if ($result) {
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                    echo "<script>alert('Removed');
                        window.location=document.referrer;
                    </script>";
                } else {
                    echo "<script>alert('Error occured');
                    window.location=document.referrer;
                    </script>";
                }
            }
        } else {
            echo "<script>alert('Please Select at least one before deleting.');
            window.location=document.referrer;
            </script>";
        }
    }
    if (isset($_POST['updateItem'])) {
        $drugsId = $_POST["drugsId"];
        $drugsName = $_POST["name"];
        $drugsDesc = $_POST["desc"];
        $drugsPrice = $_POST["price"];
        $drugsdivisionId = $_POST["catId"];
        $drugsUOM = $_POST["uomid"];

        $sql = "UPDATE `drugs` SET `drugsName`='$drugsName', `drugsPrice`='$drugsPrice', `drugsDesc`='$drugsDesc',`UOM`='$drugsUOM', `drugsdivisionId`='$drugsdivisionId' WHERE `drugsId`='$drugsId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Updated Successfully');
                window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('Update Failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if (isset($_POST['updateItemPhoto'])) {
        $drugsId = $_POST["drugsId"];
        $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
        if ($check !== false) {
            $newName = 'drugs-' . $drugsId;
            $newfilename = $newName . ".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Uploaded Successfully');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('Upload Failed');
                        window.location=document.referrer;
                    </script>";
            }
        } else {
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
