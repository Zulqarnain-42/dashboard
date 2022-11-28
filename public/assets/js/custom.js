$(function(){
    window.FakeLoader.init({
        auto_hide: true
    });
});


$(document).ready(function(){
    $(document).on("contextmenu",function(e){
        if(e.target.nodeName != "INPUT" && e.target.nodeName != "TEXTAREA")
             e.preventDefault();
     });
 });
