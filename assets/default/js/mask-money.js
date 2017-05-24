var mainJS = function () {
    function initFormStep(){
       var navListItems = $('.step-panel-container a'),
       allWells = $('.setup-content'),
       allNextBtn = $('.btn-next');
       allWells.hide();

       navListItems.click(function (e) {
           e.preventDefault();

           var $target = $($(this).attr('href')),
              $item = $(this);

           if (!$item.hasClass('disabled')) {
               navListItems.removeClass('btn-primary').addClass('btn-default');
               $item.addClass('btn-primary');
               allWells.hide();
               $target.show();
               $target.find('input:eq(0)').focus();
           }
       });
         allNextBtn.click(function(){
               var curStep = $(this).closest(".setup-content"),
               curStepBtn = curStep.attr("id"),
               nextStepWizard = $('.step-panel-container a[href="#' + curStepBtn + '"]').parent().next().children("a"),
               curInputs = curStep.find("input[type='text'],input[type='url']"),
               isValid = true;
               $(".form-group").removeClass("has-error");
               for(var i=0; i<curInputs.length; i++){
                   if (!curInputs[i].validity.valid){
                       isValid = false;
                       $(curInputs[i]).closest(".form-group").addClass("has-error");
                   }
               }

               if (isValid)
                   nextStepWizard.removeAttr('disabled').trigger('click');
               });
             $('.step-panel-container a.btn-primary').trigger('click');
    }
    function initDatePicker(){
      if ($.isFunction($.fn.datepicker)) {
          $(".input-calendar").datepicker({
              format: 'dd/mm/yyyy',
               autoclose: true
          });
      }
    }
    function initMaskMoney(){
      $(".mask-money").maskMoney({
				prefix:'Rp ',
				allowNegative: true,
				thousands:'.',
				decimal:',',
				precision:'0',
				affixesStay: false,
			});
    }
return {
        init: function() {
           initFormStep();
           initDatePicker();
           initMaskMoney();
        }
    };
}();
$(function() {
    "use strict";
    mainJS.init();
});
