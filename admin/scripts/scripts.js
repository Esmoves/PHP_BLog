shortcuts = {
    "cg" : "CodeGorilla",
    "vrg" : "Vriendelijke groeten,",
    "hrt" : "hartelijke groeten,",
    "esm" : "Esmeralda Tijhoff,",
    "gea" : "geachte heer/mevrouw ",
    "gro" : "Groningen,",
    "www.es" : "http://www.esmeraldatijhoff.nl ",
    "wwww.wij" : "http://wijzijncodegorilla.nl/esmeraldatijhoff "
}


window.onload = function() {
    var ta = document.getElementById("tekst");
    var timer = 0;
    var re = new RegExp("\\b(" + Object.keys(shortcuts).join("|") + ")\\b", "g");
    

    
    update = function() {
        ta.value = ta.value.replace(re, function($0, $1) {
            return shortcuts[$1.toLowerCase()];
        });
    }
    
    ta.onkeydown = function() {
        clearTimeout(timer);
        timer = setTimeout(update, 200);

    } 

}