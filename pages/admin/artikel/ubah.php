<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Artikel</h1>
</div>
<?php
$id = @$_GET['id'];
$query = "SELECT * FROM artikel WHERE id=$id";
$sql = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($sql);
$post = @$_POST;
$error = ['display' => 'd-none', 'type' => 'danger', 'msg' => ''];
if(isset($post['submit'])) {
    if (empty($post['judul'])) {
        $error = ['display' => '', 'type' => 'danger', 'msg' => 'Judul tidak boleh kosong'];
    } elseif (empty($post['artikel'])) {
        $error = ['display' => '', 'type' => 'danger', 'msg' => 'Isi artikel tidak boleh kosong'];
    } else {
        $error = ['display' => 'd-none', 'msg' => ''];
        $uploadOk = true;
        $filename = null;
        if (!empty($_FILES['foto']['name'])) {
            $folder = "../../uploads/";
            $fileType = strtolower(pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION));
            $filename = date('dmYHis') . '.' . $fileType;
            $file = $folder . $filename;
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $file)) {
                    $query = "UPDATE artikel SET judul=?, artikel=?, foto=? WHERE id=?";
                    $sql= $koneksi->prepare($query);
                    $sql->bind_param("ssss", $post['judul'], $post['artikel'], $filename, $id);
                } else {
                    $uploadOk = false;
                    $error = ['display' => '', 'type' => 'danger', 'msg' => 'Ada masalah saat mengupload foto'];
                }
            } else {
                $uploadOk = false;
                $error = ['display' => '', 'type' => 'danger', 'msg' => 'File bukan gambar'];
            }
        } else {
            $query = "UPDATE artikel SET judul=?, artikel=? WHERE id=?";
            $sql= $koneksi->prepare($query);
            $sql->bind_param("sss", $post['judul'], $post['artikel'], $id);
        }
        if ($uploadOk) {
            if ($sql->execute()) {
                $error = ['display' => '', 'type' => 'success', 'msg' => 'Artikel berhasil diupdate'];
                $data = $post;
                $post =[];
            }
        }
    }
}
?>

<div class="alert alert-<?= $error['type']?> <?= $error['display']?>" role="alert">
    <?= $error['msg'] ?>
</div>
<!-- Content Row -->
<div class="row">
  <div class="col">
    <div class="card shadow p-4">
      <form method='POST' action='' enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul artikel" value="<?=@$data['judul']?>">
        </div>
        <div class="form-group">
            <label for="artikel">Isi Artikel</label>
            <textarea class="form-control" id="artikel" name="artikel" rows="5"><?=@$data['artikel']?></textarea>
        </div>
        <div class="form-group">
            <label for="foto">Foto Thumbnail</label>
            <input type="file" class="form-control-file" id="foto" name="foto" accept='image/x-png,image/gif,image/jpeg'>
        </div>
        <div>
            <a href="?page=artikel" class="btn btn-secondary">Kembali</a>
            <button type="submit" name='submit' class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>
