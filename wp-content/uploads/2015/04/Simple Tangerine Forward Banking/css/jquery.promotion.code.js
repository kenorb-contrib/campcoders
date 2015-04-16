  /**
   * Promotion Code validation 
   * called from DepositApplicantPrimary.xsl 
   */ 
  $(function(){
    var defaultTooltipContent = "" ;
    
    /** 
     * dummy validation rule
     */
    $.validator.addMethod(promotionCodeRuleName, function(value, element, param) {
        return true;
    });
    
    $("#"+ promotionCodeField).on({
      'keyup focus' :function(){
        if(defaultTooltipContent == ""){
          defaultTooltipContent = $("#"+ promotionCodeField).attr('data-original-title');
        }
        if ( $(this).val().length >3 ) { 
          if (typeof validationRules[promotionCodeField][promotionCodeRuleName] != 'undefined'){
            getRuleDescriptionTooltipContent(validationRules[promotionCodeField][promotionCodeRuleName]);
          }
        }
        else {
          displayPromotionTooltip(defaultTooltipContent);
        }
      }
    });
    
    /**
     * Get the tooltip associated with promotionCodeField's value
     */
    function getRuleDescriptionTooltipContent(pUrl){    
      var myData = {};
      myData[promotionCodeField] = $("#"+promotionCodeField).val();
      $.ajax({
        url: pUrl,
        dataType: 'json',
        data: myData,
        success: 
          function(data) {
            if(data.ruleDescription == ""){
              displayPromotionTooltip(defaultTooltipContent);
            }
            else{    
              displayPromotionTooltip(data.ruleDescription);
            }
          },
       	error: 
       	  function (request, status, error) {
            //alert(status);
          }
      });
      return true;
    }

    /**
     * Sets the tooltip with the provided text
     */
    function displayPromotionTooltip(content){
      $("#"+ promotionCodeField).attr('data-original-title', content).tooltip('show')
    }
});    

