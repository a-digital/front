/**
 * Front plugin for Craft CMS
 *
 * Front JS
 *
 * @author    A Digital
 * @copyright Copyright (c) 2019 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     0.0.1
 */

$(document).ready(function(){
    $(".subject-container").click(function(){
        if ($(this).parent().find(".message-recipients").hasClass('hidden')) {
            $(this).parent().find(".message-recipients").removeClass('hidden');
        } else {
            $(this).parent().find(".message-recipients").addClass('hidden');
        }
        if ($(this).parent().find(".message-subject").hasClass('hidden')) {
            $(this).parent().find(".message-subject").removeClass('hidden');
        } else {
            $(this).parent().find(".message-subject").addClass('hidden');
        }
        if ($(this).parent().find(".message-contents").hasClass('hidden')) {
            $(this).parent().find(".message-contents").removeClass('hidden');
        } else {
            $(this).parent().find(".message-contents").addClass('hidden');
        }
        if ($(this).parent().find(".new-message-date").hasClass('hidden')) {
            $(this).parent().find(".new-message-date").removeClass('hidden');
        } else {
            $(this).parent().find(".new-message-date").addClass('hidden');
        }
    });

    $(".reply-prompt").click(function(){
        $(".recipient-container").parent().parent().removeClass('hidden');
    });
});