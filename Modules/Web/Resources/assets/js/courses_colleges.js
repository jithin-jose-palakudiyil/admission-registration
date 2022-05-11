//*******SideNav*********//


  /* Close/hide the sidenav */
  
  $("#navClose").click(function(e){
      
    e.preventDefault();
    document.getElementById("nav").style.display = "none";
    $("#navClose").hide();
    $("#navOpen").show();
    
  })
  
  /* Open the sidenav */

$("#navOpen").click(function(e){
e.preventDefault();
document.getElementById("nav").style.display = "block";
$("#navClose").show();
$("#navOpen").hide();

})



window.addEventListener("resize", () => {

    var deviceWidth =  $(window).width()
    if (deviceWidth<600){
        document.getElementById("nav").style.display = "none";
        $("#navClose").hide();
        $("#navOpen").show();
    }else{
        document.getElementById("nav").style.display = "block";
        $("#navClose").show();
        $("#navOpen").hide(); 
    }
});
