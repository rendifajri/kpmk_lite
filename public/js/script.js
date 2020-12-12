function format_ele_int(ele){
	var ele_value = format_to_number($(ele).val());
	console.log(isInt(ele_value));
	if(isInt(ele_value))
		$(ele).val(int_to_format(ele_value));
	else
		$(ele).val(0);
}
function isInt(n){
    return Number(n) == n && n % 1 === 0;
}

function isFloat(n){
    return Number(n) == n && n % 1 !== 0;
}
function format_to_number(n){
	//return n.replace(/\,/g,'');
	return n.replace(/\D/g,'');
}
function int_to_format(n){
	//return $('.quantity:eq(' +index+ ')').val((+parseFloat(quantity).toFixed(2)).toLocaleString(undefined, { maximumFractionDigits: 2 }));
	return Number(n).toLocaleString('id-ID', { maximumFractionDigits: 2 });
}


function numberWithCommas(x) {
	var parts = x.toString().split(".");
	parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	return parts.join(".");
}