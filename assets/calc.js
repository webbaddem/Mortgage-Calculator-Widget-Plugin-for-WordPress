/**
 * Calc
 *
 * @package IO Mortgage Calculator
 * @subpackage JavaScript
 */

jQuery("#mortgageCalc").click(function(){
	
	var L,P,n,c,dp;
	
	n = parseInt(jQuery("#mcTerm").val())*12;c=parseFloat(jQuery("#mcRate").val())/1200;
	L = parseInt(jQuery("#mcPrice").val())- parseFloat(jQuery("#mcDown").val());
	P= (L*(c*Math.pow(1+c,n)))/(Math.pow(1+c,n)-1);
	
	if(!isNaN(P)){
		jQuery("#mcPayment").val(P.toFixed(2));
	} else {
		jQuery("#mcPayment").val('There was an error');
	}	
	return false;
	
});