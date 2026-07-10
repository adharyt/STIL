<center>
<br>
Feedback untuk transaksi <b><?php echo $trans['id_trans']; ?></b> di <b><?php echo $trans['store_name']; ?></b>
<br>
<br>
<input type='hidden' name='id_trans' value='<?php echo $trans['id_trans']; ?>'/>
Feedback:<br>
<input type='radio' name='response' value='1' checked>Good</input>
<br>
<input type='radio' name='response' value='0'>Bad</input><br><br>
Komentar:<br>
<textarea name='response_detail'></textarea>
<br><br>
<button onClick='submitFeedback();'>Submit</button>
<br><br>&nbsp;
</center>
