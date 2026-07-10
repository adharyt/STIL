<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/utils.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/chart.min.js"></script>

<!-- Seller Center Dashboard JQuery -->
<script>

    var feedback=$('#feedbackPercentage').text().replace('%','');
    var circle = document.getElementById("circleBar");
    var radius = circle.r.baseVal.value;
    var circumference = radius * 2 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = `${circumference}`;
    // Set Progress Circle
    setProgress(feedback);

    function setProgress(percent) {
        const offset = circumference - percent / 100 * circumference;
        circle.style.strokeDashoffset = offset;
    }

    // input.addEventListener('change', function(e) {
    //     if (input.value < 101 && input.value > -1) {
    //         setProgress(input.value);
    //     }
    // })
</script>

<script type="text/javascript">

		var config = {
			type: 'line',
			data: {
				labels: ['<?php $temp_day=array();foreach($sales7day as $day){array_push($temp_day,$day['date']);} echo implode($temp_day,"','"); ?>'],
				datasets: [{
					label: 'Penjualan',
					backgroundColor: '#099245',
					borderColor: '#099245',
					data: [
						<?php $temp_amount=array();foreach($sales7day as $day){array_push($temp_amount,$day['amount']);} echo implode($temp_amount,","); ?>
					],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Total Penjualan Kotor 7 Hari Terakhir'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Tanggal'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Nominal Penjualan (Rupiah)'
						},
            ticks: {
                suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                // OR //
                beginAtZero: true   // minimum value will be 0.
            }
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('sales7day').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
</script>

</body>
</html>
