//-------------------------cart modal ----------------------------------------
// Get the modal
var cartModal = document.getElementById("myModal");
// Get the button that opens the modal
var btn = document.getElementById("myCart");
// var btn = document.getElementsByClassName("myCart");
// Get the <span> element that closes the modal
var cartModalClose = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal
btn.onclick = function() {
    console.log('modal toggle');
    cartModal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
cartModalClose.onclick = function() {
    cartModal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == cartModal) {
    cartModal.style.display = "none";
  }
}

var readModal = $("#readModal");
var coverImg = $("#cover-img");
var readModalClose = $("#readModalClose");


coverImg.on("click",function(){
    readModal.css("display","block");
});
readModalClose.on("click",function(){
    readModal.css("display","none");
});




// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == cartModal) {
    cartModal.style.display = "none";
  }
  if (event.target == readModal) {
    readModal.style.display = "none";
}
}
