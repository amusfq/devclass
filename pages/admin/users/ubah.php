<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah User</h1>
</div>
<?php
$id = @$_GET['id'];
$query = "SELECT * FROM user WHERE id=$id";
$sql = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($sql);
$post = @$_POST;
$error = ['display' => 'd-none', 'type' => 'danger', 'msg' => ''];
if(isset($post['submit'])) {
    if (empty($post['nama'])) {
        $error = ['display' => '', 'type' => 'danger', 'msg' => 'Nama tidak boleh kosong'];
    } elseif (empty($post['email'])) {
        $error = ['display' => '', 'type' => 'danger', 'msg' => 'Email tidak boleh kosong'];
    } elseif ($post['password'] !== $post['konfirmasi_password']) {
        $error = ['display' => '', 'type' => 'danger', 'msg' => 'Konfirmasi password tidak sesuai'];
    } else {
        $error = ['display' => 'd-none', 'msg' => ''];
        $uploadOk = true;
        $nama = $post['nama'];
        $email = $post['email'];
        if (!empty($post['password'])) {
            if ($post['password'] !== $post['konfirmasi_password']) {
                $uploadOk = false;
                $error = ['display' => '', 'type' => 'danger', 'msg' => 'Konfirmasi password tidak sesuai'];
            } else {
                $uploadOk = true;
                $password = password_hash($post['password'], PASSWORD_DEFAULT);
                $query = "UPDATE user SET nama=?, email=?, password=? WHERE id=?";
                $sql= $koneksi->prepare($query);
                $sql->bind_param("ssss", $nama, $email, $password, $id);
            }
        } else {
            $query = "UPDATE user SET nama=?, email=? WHERE id=?";
            $sql= $koneksi->prepare($query);
            $sql->bind_param("sss", $nama, $email, $id);
        }

        if ($uploadOk) {
            if ($sql->execute()) {
                $error = ['display' => '', 'type' => 'success', 'msg' => 'User berhasil diupdate'];
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
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?=@$data['nama']?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email Pengguna" value="<?=@$data['email']?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="******">
        </div>
        <div class="form-group">
            <label for="password">Konfirmasi Password</label>
            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi password">
        </div>
        <div>
            <a href="?page=users" class="btn btn-secondary">Kembali</a>
            <button type="submit" name='submit' class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>
