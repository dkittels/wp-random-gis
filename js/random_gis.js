obj = jQuery.ajax({
    url : 'https://www.googleapis.com/customsearch/v1',
    type : 'GET',
    data : {
    	'q' : random_gis_vars.searchterms,
        'num' : 1,
        'start' : random_gis_vars.offset,
        'imgSize' : 'medium',
        'searchType' : 'image',
        'key' : random_gis_vars.api_key,
        'cx' : random_gis_vars.cx
    },
    dataType:'json',
    success : function(data) {
    	jQuery('#random_gis_image').attr("src", data.items[0].link);
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

console.log(obj);