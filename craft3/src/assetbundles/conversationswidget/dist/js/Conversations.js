/**
 * Front plugin for Craft CMS
 *
 * Conversations Widget JS
 *
 * @author    A Digital
 * @copyright Copyright (c) 2018 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     1.0.0
 */

$(document).ready(function(){
    $('#frontWidgetForm').submit(function(e){
        var formBody = $(this).parent();
        var response;
        var submission = new FormData(this);
        $(this).find('input[name="frontSubmit"]').hide();
        $(this).find('div[name="loadingSpinner"]').show();
        $.ajax({
            url : '/actions/front/conversation/submit-widget',
            type: 'POST',
            data : submission,
            processData: false,
            contentType: false,
            success:function(data, textStatus, jqXHR){
                response = data;
                formBody.html(response);
            },
            error: function(jqXHR, textStatus, errorThrown){
                response = '<p>Error: We are sorry but your ticket was not submitted correctly.</p>';
                formBody.html(response);
            }
        });
        e.preventDefault();
    });
});