<?php
$id = @$_GET['id'];
$query = "DELETE FROM artikel WHERE id=?";
$sql = $koneksi->prepare($query);
$sql->bind_param('s', $id);
if ($sql->execute()) {
    echo "<script>window.location.href='?page=artikel'</script>";
}
?>