function addquantity()
{
	var count = document.getElementById('quantity').value;
	var instock = parseInt(document.getElementById('instock').innerHTML) ;

	if (count < instock) 
	{
		count ++;
	}
	document.getElementById('quantity').value = count;
}
function minusquantity()
{
	var count = document.getElementById('quantity').value;

	if (count > 1) 
	{
		count--;
	}
	document.getElementById('quantity').value = count;
}
function validateQuantity()
{
	var count = parseInt(document.getElementById('quantity').value);
	var instock = parseInt(document.getElementById('instock').innerHTML);

	if ( count > instock ) 
	{
		document.getElementById('quantity').value = instock;
	}
	else
		if ( count < 0 ) 
		{
			document.getElementById('quantity').value = 1;
		}

}
function muangay() 
{
	document.getElementById('mua_ngay').submit();
}


