/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
    $('.updateStatus').click(function(){
       
       $('#modal').modal('show')
               .find('#modalContent')
                   

             .load($(this).attr('value'));
    });
    
     
});