<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/seller_center/seller_center_dashboard_styles.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<style media="screen">
/* The containers */
  .containers {
    display: block;
    position: relative;
    padding-left: 20px;
    margin-top: 0px;
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
