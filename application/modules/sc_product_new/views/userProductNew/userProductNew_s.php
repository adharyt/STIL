<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/seller_center/seller_center_dashboard_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/product_responsive.css">
<link href="<?php echo base_url();?>files/assets/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>files/assets/fastselect/dist/fastselect.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/croppie/croppie.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<style media="screen">
.input-icons i {
    position: absolute;
}
.icon {
    padding: 10px;
    color: grey;
    min-width: 50px;
    text-align: center;
}
.paginationactive{
  background-color: #009245;
  color:white;
}
.label {
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
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

.label-warning {
    background-color: #f0ad4e;
}
.label-info {
    background-color: #5bc0de;
}
.no-product {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.img-no-product {
    width: 30%;
	height: auto;
    align-self: center;
    justify-self: center;
}
</style>
<style media="screen">
.btn-group-xs>.btn, .btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
		background-color:#f28f16;
		border-color:#f28f16;
}
button.btn.btn-primary.btn-xs:hover {
    background-color: #e49637;
    border-color: #e49637;
    cursor: pointer;
}
.input-group>.input-group-append>.btn, .input-group>.input-group-append>.input-group-text, .input-group>.input-group-prepend:first-child>.btn:not(:first-child), .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child), .input-group>.input-group-prepend:not(:first-child)>.btn, .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	.input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle), .input-group>.input-group-append:last-child>.input-group-text:not(:last-child), .input-group>.input-group-append:not(:last-child)>.btn, .input-group>.input-group-append:not(:last-child)>.input-group-text, .input-group>.input-group-prepend>.btn, .input-group>.input-group-prepend>.input-group-text {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
	.input-group-text {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			padding: .375rem .75rem;
			margin-bottom: 0;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			text-align: center;
			white-space: nowrap;
			background-color: #e9ecef;
			border: 1px solid #ced4da;
			border-radius: .25rem;
	}
	.form-control {
    color: black;
}
.form-check-input {
    position: absolute;
    margin-top: .25rem;
    margin-left: 0px;
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
</style>
