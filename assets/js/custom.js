
$(".alert-danger").alert();

window.setTimeout(function(){
    $(".alert-danger").alert("close");
},2000);


$("#menu-toggle").click(function(e){
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});