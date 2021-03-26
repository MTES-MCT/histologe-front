function rectangle1(cible, nb)
{
  var canvas = document.getElementById(cible); 
  var context = canvas.getContext("2d");
  context.beginPath();
  context.strokeStyle="#134284";   
  context.lineWidth="2";   
  context.rect(10,10,80,60);
  context.font = "20pt Verdana";
  context.fillStyle = "#134284";
  context.fillText(nb, 20, 45);
  context.stroke();
}
