<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/animate.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/cart_responsive.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500);

* {
  box-sizing: border-box;
}

.shopping-cart {
  width: 100%;
  height: auto;
  margin: 80px auto;
  background: #FFFFFF;
  box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
  border-radius: 6px;

  display: flex;
  flex-direction: column;
}

.title {
  height: 60px;
  border-bottom: 1px solid #E1E8EE;
  padding: 20px 30px;
  color: #5E6977;
  font-size: 18px;
  font-weight: 400;
}

.item {
  padding: 20px 30px;
  height: auto;
  display: flex;
}

.item:nth-child(3) {
  border-top:  1px solid #E1E8EE;
  border-bottom:  1px solid #E1E8EE;
}

/* Buttons -  Delete and Like */
.buttons {
  position: relative;
  padding-top: 30px;
  margin-right: 60px;
}



.like-btn {
  position: absolute;
  top: 0px;
  left: 10px;
  display: inline-block;
  background: url('<?php echo base_url();?>assets/images/icon-img/twitter-heart.png');
  width: 60px;
  height: 60px;
  background-size: 2900%;
  background-repeat: no-repeat;
  cursor: pointer;
}

.delete-btn {
  position: absolute;
  top: 00px;
  left: 00px;
  display: inline-block;
  cursor: pointer;
  width: 18px;
  height: 17px;
  background: url("<?php echo base_url();?>assets/images/icon-img/delete-icn.svg") no-repeat center;
  margin-right: 20px;
}

.is-active {
  animation-name: animate;
  animation-duration: .8s;
  animation-iteration-count: 1;
  animation-timing-function: steps(28);
  animation-fill-mode: forwards;
}

@keyframes animate {
  0%   { background-position: left;  }
  50%  { background-position: right; }
  100% { background-position: right; }
}

/* Product Image */
.image {
  text-align:center;
  margin-right: 50px;
  width:12%;
}

/* Product Description */
.description {
  padding-top: 0px;
  margin-right: 60px;
  width: 25%;
}

.description span {
  display: block;
  font-size: 14px;
  color: #43484D;
  font-weight: 400;
}

.description span:first-child {
  margin-bottom: 5px;
}
.description span:last-child {
  font-weight: 300;
  margin-top: 8px;
  color: #86939E;
}

/* Product Quantity */
.quantity {


}
.quantity input {
  -webkit-appearance: none;
  border: none;
  text-align: center;
  width: 80px;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}
.quantity input::-webkit-inner-spin-button,
.quantity input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

button[class*=btn] {
  width: 30px;
  height: 30px;
  background-color: #E1E8EE;
  border-radius: 6px;
  border: none;
  cursor: pointer;
}
.minus-btn img {
  margin-bottom: 3px;
}
.plus-btn img {
  margin-top: 2px;
}
button:focus,
input:focus {
  outline:0;
}

/* Total Price */
.total-price {
  text-align:left;
  width: 10%;
  padding-top: 27px;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}

.checkboxcoy {
  width: 5%;
  padding-top: 27px;
  text-align: center;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}

/* Responsive */
@media (max-width: 800px) {
  .shopping-cart {
    width: 100%;
    height: auto;
    overflow: hidden;
  }
  .item {
    height: auto;
    flex-wrap: wrap;
    justify-content: center;
  }
  .image img {
    width: 50%;
  }
  .image,
  .quantity,
  .description {
    width: 100%;
    text-align: center;
    margin: 6px 0;
  }
  .buttons {
    margin-right: 20px;
  }
}

/* Checkbox */
</style>
