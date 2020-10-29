<?php
/**
 * views/categories/index.php
 * View liệt kê danh mục
 */
//echo "<pre>";
//print_r($categories);
//echo "<pre>";
?>
<a href="index.php?controller=category&action=create">
  Thêm mới danh mục
</a>
<table border="1" cellspacing="0" cellpadding="8">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Description</th>
    <th>Status</th>
    <th>Created_at</th>
    <th></th>
  </tr>
  <?php foreach($categories AS $category): ?>
  <tr>
    <td><?php echo $category['id']?></td>
    <td><?php echo $category['name']?></td>
    <td><?php echo $category['description']?></td>
    <td><?php echo $category['status']?></td>
    <td>
<!--      29/10/2020 20:30:00-->
      <?php
      $datetime = date('d/m/Y H:i:s',
          strtotime($category['created_at']));
      echo $datetime;
      ?>
    </td>
    <td>
      <?php
      $url_update =
      "index.php?controller=category&action=update&id=".$category['id'];
      $url_delete =
      "index.php?controller=category&action=delete&id=".$category['id'];
      ?>
      <a href="<?php echo $url_update?>">Sửa</a>
      <a href="<?php echo $url_delete;?>" onclick="return confirm('Xóa?')">Xóa</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
