function anadirCarro(CodProducto) {
  var DiasDuracionCookie=1;
  var NombreCookieCarrito="CarritoTiendaPepe";
  var CompraPrevia=getCookie(NombreCookieCarrito);    
  var d = new Date();
  d.setTime(d.getTime() + (DiasDuracionCookie*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  //---
  if (ComprobarSiProductoExisteEnCarritoYa(CompraPrevia,CodProducto)=="NoExiste"){
    var cvalue=CompraPrevia + "["+CodProducto+",1]@@@";
  }
  else{
    var cvalue=ComprobarSiProductoExisteEnCarritoYa(CompraPrevia,CodProducto);
  }      
  //---   
  document.cookie = NombreCookieCarrito + "=" + cvalue + ";" + expires + ";path=/";

  ListarCarroCompraUsandoAjax();
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function ComprobarSiProductoExisteEnCarritoYa(CompraPrevia,CodProducto){     
  var itemsEnCarro = CompraPrevia.split("@@@");    
  for (x=0;x<itemsEnCarro.length;x++){
    var Tupla_ArticuloComprado_Unidades=itemsEnCarro[x].replace("[","").replace("]","").split(",");     
    if (Tupla_ArticuloComprado_Unidades[0]==CodProducto) {
      Tupla_ArticuloComprado_Unidades[1]=parseInt(Tupla_ArticuloComprado_Unidades[1])+1;
      Tupla_ArticuloComprado_Unidades.join();
      Tupla_ArticuloComprado_Unidades="["+Tupla_ArticuloComprado_Unidades+"]";
      itemsEnCarro[x]=Tupla_ArticuloComprado_Unidades;
      itemsEnCarro=itemsEnCarro.join("@@@");
      return itemsEnCarro;
    }      
  }
  return "NoExiste"; 
}

function ListarCarroCompraUsandoAjax(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("CarritoCompra").style.display='block';
      document.getElementById("CarritoCompra").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "ResumenCompra.php", true);
  xmlhttp.send();
}

function VaciarCarritoCompra(){
  var NombreCookieCarrito="CarritoTiendaPepe";
  document.cookie = NombreCookieCarrito + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  ListarCarroCompraUsandoAjax();
}