/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var $zrblog = $zrblog || {};

"use strict";

(function($) {

    $zrblog.Admin = {};

    $zrblog.Admin.PostForm = function()
    {
        
        this.init = function(){
            var mainHandler = this;
            
            var selectVal = $('#appbundle_post_status').val();
                if (selectVal == 3){
                    mainHandler.setIsRequired(true);
                }else{
                    mainHandler.setIsRequired(false);
                }
            
            
            $('#appbundle_post_status').on('change', function() {
                if (this.value == 3){
                    mainHandler.setIsRequired(true);
                }else{
                    mainHandler.setIsRequired(false);
                }
            })
        };
        
        this.setIsRequired = function(select){
            $('#appbundle_post_publish_date_year').prop('required',select);
            $('#appbundle_post_publish_date_month').prop('required',select);
            $('#appbundle_post_publish_date_day').prop('required',select);
            $('#appbundle_post_publish_date_hour').prop('required',select);
            $('#appbundle_post_publish_date_minute').prop('required',select);
            if (select == false){
                $('#appbundle_post_publish_date_year').val(null);
                $('#appbundle_post_publish_date_month').val(null);
                $('#appbundle_post_publish_date_day').val(null);
                $('#appbundle_post_publish_date_hour').val(null);
                $('#appbundle_post_publish_date_minute').val(null);
            }
        };

        this.init();
    };

})(jQuery);


jQuery(document).ready(function () {
    var adminFormControll = new $zrblog.Admin.PostForm();
});
