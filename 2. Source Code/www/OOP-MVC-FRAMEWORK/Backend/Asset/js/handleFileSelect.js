// Show Upload file
function handleFileSelect(evt) {
    document.getElementById('image-input-context').setAttribute('style','color:#fff');
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb-image" src="', e.target.result,
          '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('show-image').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('link').addEventListener('change', handleFileSelect, false);
  //////////////////////////////////////////////////////////
    function validateProductId(str)
  {
    if (str == '') 
    { 
      document.getElementById("Validate_Product_Id").setAttribute("style","display:block");
    }

  }
  function validateProductName(str)
  {
    if (str == '') 
    { 
      document.getElementById("Validate_Product_Name").setAttribute("style","display:block");
    }
  }
  function validateProductCost(str)
  {
    if (str == '') 
    { 
      document.getElementById("Validate_Product_Cost").setAttribute("style","display:block");
    }
  }
  function validateProductInstock(str)
  {
    if (str == '') 
    { 
      document.getElementById("Validate_Product_Instock").setAttribute("style","display:block");
    }
  }
  function validateProductDescription(str)
  {
    if (str == '') 
    { 
      document.getElementById("Validate_Product_Description").setAttribute("style","display:block");
    }

  }
  function hideWarningProductId()
  {
    document.getElementById("Validate_Product_Id").setAttribute("style","display:none");
  }
   function hideWarningProductName()
  {
    document.getElementById("Validate_Product_Name").setAttribute("style","display:none");
  }
   function hideWarningProductCost()
  {
    document.getElementById("Validate_Product_Cost").setAttribute("style","display:none");
  }
   function hideWarningProductInstock()
  {
    document.getElementById("Validate_Product_Instock").setAttribute("style","display:none");
  }
   function hideWarningProductDescription()
  {
    document.getElementById("Validate_Product_Description").setAttribute("style","display:none");
  }
  function submitForm()
  {
    var Product_Id = document.getElementById("Product_Id").value;
    var Product_Name = document.getElementById("Product_Name").value;
    var Product_Cost = document.getElementById("Product_Cost").value;
    var Product_Instock = document.getElementById("Product_Instock").value;
    var Product_Description = document.getElementById("Product_Description").value;
    var flag = 1;

    if ( Product_Id == '') 
    {
      document.getElementById("Validate_Product_Id").setAttribute("style","display:block");
      flag = 0;
    }
    if ( Product_Name == '') 
    {
      document.getElementById("Validate_Product_Name").setAttribute("style","display:block");
      flag = 0;
    }
    if ( Product_Cost == '') 
    {
      document.getElementById("Validate_Product_Cost").setAttribute("style","display:block");
      flag = 0;
    }
    if ( Product_Instock == '') 
    {
      document.getElementById("Validate_Product_Instock").setAttribute("style","display:block");
      flag = 0;
    }
    if ( Product_Description == '') 
    {
      document.getElementById("Validate_Product_Description").setAttribute("style","display:block");
      flag = 0;
    }
    if (flag == 1) 
    {
      document.getElementById("Form-Product").submit();
    }
  }
// Delete Images
function deleteImage(str1,str2)
{
    var r = confirm("Bạn muốn xóa!");
    if (r == true) 
    {
        window.location = "?Controller=Product&Action=ProductDetail&Id=" + str1 + "&ImageLink=" + str2;
    }

}