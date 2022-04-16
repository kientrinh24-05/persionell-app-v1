<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

  Redirect::url('admin/account/login.php');
}

$sql = "SELECT nhanvien.*, phongban.tenphongban From nhanvien join phongban on nhanvien.maPB = phongban.id";
$data = $DB->query($sql);

// print_r($data);
// die();
$title = "Danh sách nhân viên";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
  <h4>Danh sách nhân viên </h4>
  <a href="<?= url('admin/employment/create.php') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
</div>
<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">#ID
      </th>
      <th class="th-sm">Tên nhân viên </th>
      <th class="th-sm">Ngày sinh </th>
      <th class="th-sm">Giới tính </th>
      <th class="th-sm">Số điện thoại</th>
      <th class="th-sm">Địa chỉ </th>
      <th class="th-sm">Số CCCD</th>
      <th class="th-sm">Tên phòng ban </th>
      <th class="th-sm">Hệ số lương </th>
      <th class="th-sm">trình độ </th>
      <th class="th-sm">Chức vụ </th>
      <!-- <th class="th-sm">Lưu trữ </th> -->

      <th class="th-sm text-center" colspan="2">Hành động</th>
    </tr>
  </thead>
  <tbody>

    <?php if(is_array($data)): ?>
      <?php $i = 1 ?>
      <?php foreach($data as $item): ?>
    <tr>
      <td style="width: 30px"><?= $i ?></td>
      <td><?= $item->tennhanvien ?></td>
      <td><?= $item->ngaysinh ?></td>
      <td><?= $item->gioitinh ?></td>
      <td><?= $item->sodienthoai ?></td>
      <td>
        <?= strlen($item->diachi) > 50 ?  substr($item->diachi, 0, 50).' ...' : $item->diachi ?>
      </td>
      <td><?= $item->cccd ?></td> 
      <td><?= $item->tenphongban ?></td> 
      <td><?= $item->Hesoluong ?></td>    
      <td><?= $item->trinhdo ?></td>
      <td><?= $item->chucvu ?></td>
      
      <td class="text-center" style="width:50px">
        <a href="<?= url("admin/employment/update.php?id=$item->id") ?>"><b class='badge badge-warning status-Content'>Sửa</b></a>
      </td>
      <td class="text-center" style="width:50px">
      <a href="#"><b class='badge badge-danger status-Content' type="button" data-toggle="modal" data-target="#exampleModal-<?= $item->id ?>">Lưu trữ</b></a>
      </td>
    </tr>
      <?php $i++ ?>
    <?php endforeach ?>
    <?php endif ?>
  </tbody>
</table>

    <?php if(is_array($data)): ?>
      <?php foreach($data as $item): ?>
        <div class="modal fade" id="exampleModal-<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Bạn có muốn xóa danh mục không ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <a href="<?= url("admin/employment/delete.php?id=$item->id") ?>" class="btn btn-primary">Xóa</a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
    <?php endif ?>

<?php
include('../../layouts/admin/footer.php');
?>

<script>
  $(document).ready(function() {
    $('#dtBasicExample').DataTable({
      "order": [
        [0, "desc"]
      ]
    }, );
    $('.dataTables_length').addClass('bs-select');
  });
</script>
<script>
  // change status contact while click show content 


  let showContents = document.querySelectorAll('.show-Content');
  let statusContent = document.querySelectorAll('.status-Content');

  showContents.forEach(function(item, index) {
    item.addEventListener('click', function() {
      let idContact = this.dataset.target.slice(19);

      let url = "/admin/contact/update-status/" + idContact;

      fetch(url)
        .then(response => response.json())
        .then(data => {
          statusContent[index].className = 'badge badge-success status-Content';
          statusContent[index].innerText = 'Đã xem';
        })
        .catch(err => {
          console.log(err);
        })
    })
  })
</script>