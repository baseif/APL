/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $(document).ready(function() {


        $('#Advert').on('show.bs.collapse', function() {
            $('#Glyp-Advert').removeClass('glyphicon glyphicon-chevron-down').addClass('glyphicon glyphicon-chevron-up');
        });
        $('#Advert').on('hide.bs.collapse', function() {
            $('#Glyp-Advert').removeClass('glyphicon glyphicon-chevron-up').addClass('glyphicon glyphicon-chevron-down');
        });
        $('#Advert1').on('show.bs.collapse', function() {
            $('#Glyp-Advert1').removeClass('glyphicon glyphicon-chevron-down').addClass('glyphicon glyphicon-chevron-up');
        });
        $('#Advert1').on('hide.bs.collapse', function() {
            $('#Glyp-Advert1').removeClass('glyphicon glyphicon-chevron-up').addClass('glyphicon glyphicon-chevron-down');
        });
        $('#Advert2').on('show.bs.collapse', function() {
            $('#Glyp-Advert2').removeClass('glyphicon glyphicon-chevron-down').addClass('glyphicon glyphicon-chevron-up');
        });
        $('#Advert2').on('hide.bs.collapse', function() {
            $('#Glyp-Advert2').removeClass('glyphicon glyphicon-chevron-up').addClass('glyphicon glyphicon-chevron-down');
        });
        $('#Advert3').on('show.bs.collapse', function() {
            $('#Glyp-Advert3').removeClass('glyphicon glyphicon-chevron-down').addClass('glyphicon glyphicon-chevron-up');
        });
        $('#Advert3').on('hide.bs.collapse', function() {
            $('#Glyp-Advert3').removeClass('glyphicon glyphicon-chevron-up').addClass('glyphicon glyphicon-chevron-down');
        });

    });



