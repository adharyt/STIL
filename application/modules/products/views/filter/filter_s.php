<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/nestable/nestable.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

<style media="screen">
.dd-list,
.dd-item,
.dd-handle{
    cursor:default;
    margin-top:0px;
    margin-bottom:0px;
    border:0px solid #FFF;
}
.pointerhand{
    cursor: pointer;
  }
.dd-handle:hover{
    /* border:1px solid #f28f16; */
    color:#000000;
    border:0px solid #FFF;
}
.dd-handle a{
    color:#000000;
}
.dd-handle a:hover{
    color:#f28f16;
}
.dd-active a{
  border:0px solid #FFFFFF;
  color:#009245;
}
.dd-active a {
  color:#009245;
}
dd-active:before {
   font-family: "Font Awesome 5 Free";
   content: "\f095";
   display: inline-block;
   padding-right: 3px;
   vertical-align: middle;
   font-weight: 900;
}
.dd-nactive{
  color:#333;
}

.label {
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
.label-info {
    background-color: #5bc0de;
}
.paginationactive{
  background-color: #009245;
  color:white;
}

/* The containers */
.containers {
  display: block;
  position: relative;
  padding-left: 20px;
  margin-top: 12px;
  /*cursor: pointer;*/
  /*font-size: 22px;*/
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.containers input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  cursor:pointer;
  margin-top: 2px;
  position: absolute;
  top: 0;
  left: 0;
  height: 15px;
  width: 15px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.containers:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containers input:checked ~ .checkmark {
  background-color: #009245;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.containers input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.containers .checkmark:after {
  left: 5px;
  top: 2px;
  width: 5px;
  height: 8px;
  border: solid white;
  border-width: 0 2px 2px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

/*Slider*/
.slidecontainer {
  width: 120%;
}

.slider {
  -webkit-appearance: none;
  width: 50%;
  height: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
  transform:rotate(-90deg);
  border-radius:20px;
  margin-left: -70px;
  margin-top: 90px;
  position: absolute;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 15px;
  height: 15px;
  background: #009245;
  border-radius: 50%;
  cursor: pointer;
}

</style>
