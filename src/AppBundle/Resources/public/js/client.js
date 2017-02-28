/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var $zrblog = $zrblog || {};

"use strict";

(function($) {

    $zrblog.Client = {};

    $zrblog.Client.CommentForm = function()
    {
        
        this.init = function(){
            var mainHandler = this;
            $('#comment_form').submit(function(event){
                event.preventDefault();
                var queryString = $('#comment_form').serialize();
                console.log(queryString);
                
                $.ajax({
                    type: 'get',
                    url: 'comment/add',
                    data: $('#comment_form').serialize(),
                 });
            });
        };
        
        this.init();
    };

})(jQuery);


jQuery(document).ready(function () {
    var commentForm = new $zrblog.Client.CommentForm();
});
