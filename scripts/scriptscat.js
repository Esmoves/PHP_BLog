 $(document).ready(function () {
            $("ul[id*=myid] li").click(function () {
                var cat = $(this).text();
          	   $.post('./include/include_category_menu.php', {cat: cat}, function(data){
           		$('div#maincontent').html(data);
                 });
            });
        });


  $(document).ready(function () {
            $("ul[id*=authors] li").click(function () {
                //alert($(this).html()); // gets innerHTML of clicked li
                var author = $(this).text();
               $.post('./include/include_authormenu.php', {author: author}, function(data){
                $('div#maincontent').html(data);
                 });
            });
        });

  $(document).ready(function () {
            $("form[id*=search] input").click(function () {
                //alert($(this).html()); // gets innerHTML of clicked li
                var author = $(this).text();
               $.post('./include/search.php', {author: author}, function(data){
                $('div#maincontent').html(data);
                 });
            });
        });