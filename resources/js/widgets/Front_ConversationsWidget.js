/**
 * Front plugin for Craft CMS
 *
 * Front_ConversationsWidget JS
 *
 * @author    A Digital
 * @copyright Copyright (c) 2019 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     0.0.1
 */

$(document).ready(function(){
    $('#frontWidgetForm').submit(function(e){
        var formBody = $(this).parent();
        var response;
        var submission = new FormData(this);
        $(this).find('input[name="frontSubmit"]').hide();
        $(this).find('div[name="loadingSpinner"]').show();
        $.ajax({
            url : '/actions/front/conversation/submitWidget',
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