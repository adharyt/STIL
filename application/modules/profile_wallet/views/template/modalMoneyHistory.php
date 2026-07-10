<table>
<tr>
  <th>
    Tanggal
  </th>
  <th>
    Aksi
  </th>
  <th>
    Uang Sebelumnya
  </th>
  <th>
    Jumlah
  </th>
  <th>
    Uang Sekarang
  </th>
</tr>
<?php foreach($moneyHistory as $history){ ?>
  <tr>
    <td>
      <?php echo $history['lup'];?>
    </td>
    <td>
      <?php echo $history['node'];?>
    </td>
    <td>
      <?php echo $history['amount_before'];?>
    </td>
    <td>
      <?php echo $history['amount_transfer'];?>
    </td>
    <td>
      <?php echo $history['amount_after'];?>
    </td>
  </tr>
<?php } ?>
</table>
