<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script> 
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>

<!-- Seller Center Dashboard JQuery -->
<script>
    function restock() {
        $('#restock').css({"border-color":"#009245", "color": "#009245"});
        $('#otherReason').css({"border-color":"black", "color": "black"});
        $('#vacation').css({"border-color":"black", "color": "black"});
        $('#newStore').css({"border-color":"black", "color": "black"});
        $('#otherMarketplace').css({"border-color":"black", "color": "black"});
        $('#inputOtherMarketplace').hide();
        $('#inputOtherReason').hide();
        $('#inputNewStore').hide();
        $('#btnSave').prop("disabled", false);
    }

    function otherMarketplace() {
        $('#otherMarketplace').css({"border-color":"#009245", "color": "#009245"});
        $('#otherReason').css({"border-color":"black", "color": "black"});
        $('#vacation').css({"border-color":"black", "color": "black"});
        $('#newStore').css({"border-color":"black", "color": "black"});
        $('#restock').css({"border-color":"black", "color": "black"});
        $('#inputOtherMarketplace').show();
        $('#inputOtherReason').hide();
        $('#inputNewStore').hide();
    }

    function newStore() {
        $('#newStore').css({"border-color":"#009245", "color": "#009245"});
        $('#otherReason').css({"border-color":"black", "color": "black"});
        $('#vacation').css({"border-color":"black", "color": "black"});
        $('#otherMarketplace').css({"border-color":"black", "color": "black"});
        $('#restock').css({"border-color":"black", "color": "black"});
        $('#inputOtherMarketplace').hide();
        $('#inputOtherReason').hide();
        $('#inputNewStore').show();
    }

    function vacation() {
        $('#vacation').css({"border-color":"#009245", "color": "#009245"});
        $('#otherReason').css({"border-color":"black", "color": "black"});
        $('#newStore').css({"border-color":"black", "color": "black"});
        $('#otherMarketplace').css({"border-color":"black", "color": "black"});
        $('#restock').css({"border-color":"black", "color": "black"});
        $('#inputOtherMarketplace').hide();
        $('#inputOtherReason').hide();
        $('#inputNewStore').hide();
        $('#btnSave').prop("disabled", false);
    }

    function otherReason() {
        $('#otherReason').css({"border-color":"#009245", "color": "#009245"});
        $('#vacation').css({"border-color":"black", "color": "black"});
        $('#newStore').css({"border-color":"black", "color": "black"});
        $('#otherMarketplace').css({"border-color":"black", "color": "black"});
        $('#restock').css({"border-color":"black", "color": "black"});
        $('#inputOtherMarketplace').hide();
        $('#inputOtherReason').show();
        $('#inputNewStore').hide();
    }

</script>

</body>
</html>
