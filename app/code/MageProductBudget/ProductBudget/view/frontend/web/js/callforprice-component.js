require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($, modal) {
        jQuery(document).ready(function(){
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                title: 'Contact Form',
                buttons: [{
                    text: $.mage.__('Close'),
                    class: '',
                    click: function () {
                        this.closeModal();
                    }
                }]
            };
            var openModal = modal(options, $('#myModal'));

            jQuery('body').on('click', '.open-contact-form', function(){
                jQuery('.contact-form-popup').show();
                //jQuery('.static-block-message').hide();
                jQuery('#myModal').modal('openModal');
            });

            jQuery('body').on('click', '.submit', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                jQuery.ajax({
                    type: 'post',
                    url: 'contact/index/post',
                    data: jQuery('#contact-form').serialize(),
                    cache: false,
                    showLoader: 'true',
                    success: function(response) {
                        alert('success');
                        jQuery('.contact-form-popup').hide();
                        //jQuery('.static-block-message').show();
                    }
                });
                return false;
            });
        });
    }
);