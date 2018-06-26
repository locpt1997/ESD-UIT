function deleteProduct(str)
{
	var r = confirm("Bạn muốn xóa!");
    if (r == true) 
    {
        window.location = "?Controller=Product&Action=Index&id_delete=" + str;
    }
}