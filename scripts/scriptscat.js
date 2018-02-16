 $(document).ready(function () {
    $("ul[id*=myid] li").click(function () {
    // set searchresult to hidden  
      $('div#searchresults').css('display', 'none');
         var cat = $(this).text();
  	     $.post('./include/include_category_menu.php', {cat: cat}, function(data){
   		     $('div#maincontent').html(data);
         });
    });
  });


  $(document).ready(function () {
    $("ul[id*=authors] li").click(function () {
        $('#searchresults').css('display', 'none');  
        var author = $(this).text();
        $.post('./include/include_authormenu.php', {author: author}, function(data){
          $('div#maincontent').html(data);
          });
      });
  });

$(function() {
    $(".search_button").click(function() {
        var searchString    = $("#keyword").val();
        var data            = 'keyword='+ searchString;
         
        // if searchString is not empty
        if(searchString) {
            $.ajax({
                type: "POST",
                url: "./include/search.php",
                data: data,
                beforeSend: function(html) { // this happens before actual call
                    $("#results").html(''); 
                    $("#searchresults").show();
                    $(".keyword").html(searchString);
               },
               success: function(html){ // this happens after we get results
                    $("#results").show();
                    $("#results").append(html);
              }
            });    
        }
        return false;
    });
});

 $(document).ready(function () {
    $("ul[id*=archief] li").click(function () {
    // set searchresult to hidden  
      $('div#searchresults').css('display', 'none');
         var cat = $(this).text();
         $.post('./include/include_archief.php', {cat: cat}, function(data){
           $('div#maincontent').html(data);
         });
    });
  });
