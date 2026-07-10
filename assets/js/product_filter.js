function setFilter(){
  var cour_total=0;
  $.each($("input[name=courier]"), function(){
    cour_total++;
  });

  var couriers=[];
  $.each($("input[name=courier]:checked"), function(){
    couriers.push($(this).val());
  });

  if(couriers.length>0 && couriers.length!=cour_total){
    var courier=couriers.join(",");
  }else{
    var courier='all';
  }
  var price_min=$("input[name=search_price_min]").val();
  var price_max=$("input[name=search_price_max]").val();
  var province=$("#provinsi option:selected").val();
  var city=$("#kota option:selected").val();
  if($('input[name=search_is_discount]').is(':checked')) {
    var is_discount='1';
  } else {
    var is_discount='0';
  }
  if($('input[name=search_is_wholesale]').is(':checked')) {
    var is_wholesale='1';
  } else {
    var is_wholesale='0';
  }
  if($('input[name=search_is_condition_new]').is(':checked')) {
    var is_condition_new='1';
  } else {
    var is_condition_new='0';
  }
  if($('input[name=search_is_condition_second]').is(':checked')) {
    var is_condition_second='1';
  } else {
    var is_condition_second='0';
  }
  var keyword=$('#search_keyword').val();
  var minimum_rating=$("input[name=search_minimum_rating]").val();
  window.location.href="?search_keyword="+keyword+"&search_price_min="+price_min+"&search_price_max="+price_max+"&search_is_discount="+is_discount+"&search_is_wholesale="+is_wholesale+"&search_is_condition_new="+is_condition_new+"&search_is_condition_second="+is_condition_second+"&search_minimum_rating="+minimum_rating+"&search_province="+province+"&search_city="+city+"&courier="+courier;
}

$('#myRange').on("change mousemove", function () {
    var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));

    $(this).css('background-image',
                '-webkit-gradient(linear, left top, right top, '
                + 'color-stop(' + val + ', rgb(77, 179, 125)), '
                + 'color-stop(' + val + ', #d3d3db)'
                + ')'
                );
});

function toggleDetailPencarian(){
  $('#detailPencarian').toggle();
  if($('#detailPencarianText').text()=='Tampilkan filter pencarian'){
    $('#detailPencarianText').text('Sembunyikan filter pencarian');
  }else{
    $('#detailPencarianText').text('Tampilkan filter pencarian');
  }
}
