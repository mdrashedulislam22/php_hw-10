<?php
include "./backend_inc/header.php";
include "../database/evn.php";
$query = "SELECT id, title, detail, banner_img, status FROM banners ";
$rspons = mysqli_query($conn,$query);
$results = mysqli_fetch_all($rspons,1);
// var_dump($results['banner_img']);
?>
<table class="table table-responsive text-center">
<tr>
    <th>Sr</th>
    <th>Banner imge</th>
    <th>Title</th>
    <th>Detail</th>
    <th>Featured</th>
    <th>Action</th>
</tr>

<?php
foreach ($results as  $key =>$result) {?>
    <tr>
    <td><?= ++$key ?></td>
    <td><img src="<?="../Uploads/Banners/".$result['banner_img']?>" width="80"> </td>
    <td><?= $result['title']?> </td>
    <td><?= $result['detail']?> </td>
    <td >
        <a href="../controller/statusUpdate.php?id=<?= $result['id']?>" class="text-warning"><i  class="<?= $result['status'] == 1 ? "fas" : "far" ?> fa-star"></i></a>
    </td>
    <td>
        <a class="btn btn-primary mr-1" href="#">Edite</a><a class="btn btn-danger deleteBtn" href="../controller/deleteBanners.php?id=<?= $result['id'] ?>">Delete</a>
    </td>
</tr>
<?php
}
?>
</table>



<?php
include "./backend_inc/footer.php";
unset($_SESSION['form_errors']);

?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

$('.deleteBtn').click(function(event){
    event.preventDefault();
    Swal.fire({
  title: 'তুমি কি নিশ্চৎ!',
  text: "তোমার একটুও মায়া হচ্ছেনা!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href =$(this).attr('href');

    // Swal.fire(
    //   'Deleted!',
    //   'Your file has been deleted.',
    //   'success'
    // )
  }
})
})

</script>