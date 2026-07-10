<br>
<div class="container" style="max-width:90%">

<?php
if(date('Y-m-d H:i:s')<$trans['summary']['payment_expired'] && $trans['summary']['payment_status']==0){
		if($trans['summary']['payment_method']=='bank_transfer'){
			$this->load->view('confirmation/template/bank_transfer');
		}
		$parse['payment_method']=$trans['summary']['payment_method'];
		$this->load->view('confirmation/template/global_right_sidebar',$parse);
	}else{
		redirect('my-account/transaction/'.$trans['summary']['invoice']);
	}
?>
</div>


</div>
<br>
<script>
// Set the date we're counting down to
var lup=document.getElementById("bataswaktu").innerHTML;
var countDownDate = new Date(lup);
countDownDate.setHours( countDownDate.getHours());
countDownDate=countDownDate.getTime();

// Update the count down every 1 second
var x = setInterval(function() {

// Get today's date and time
var now = new Date().getTime();
//alert(now+' '+countDownDate);

// Find the distance between now and the count down date
var distance = countDownDate - now;

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

if(days==0){
	days='';
}else{
	days=days+' hari ';
}
// Display the result in the element with id="demo"
document.getElementById("bataswaktu").innerHTML = days + hours + " jam "
+ minutes + " menit " + seconds + " detik ";

// If the count down is finished, write some text
if (distance < 0) {
	clearInterval(x);
	document.getElementById("bataswaktu").innerHTML = "EXPIRED";
	setTimeout(function(){ location.reload(); }, 3000);
}
}, 1000);

</script>
