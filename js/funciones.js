function tologin()
{
  document.getElementById('form_login').style.display="block";
  document.getElementById('form_regis').style.display="none";
}

function toregister()
{
  document.getElementById('form_login').style.display="none";
  document.getElementById('form_regis').style.display="block";
}


function validarLogin()
{
  if (document.getElementById('form_login').user.value=="")
  {
    alert("Coloque el usuario");
    document.getElementById('form_login').user.focus();
    return false;
  }

  if (document.getElementById('form_login').passw.value=="")
  {
    alert("Coloque la contrase�a");
    document.getElementById('form_login').passw.focus();
    return false;
  }
}

function validarRegis()
{
  if(document.getElementById('form_regis').nombre.value=="" || document.getElementById('form_regis').email.value=="" || document.getElementById('form_regis').empresa.value=="" || document.getElementById('form_regis').pais.value=="" || document.getElementById('form_regis').usuario.value=="" || document.getElementById('form_regis').pass.value=="" || document.getElementById('form_regis').pass2.value=="" )
  {
    alert("Todos los campos son obligatorios");
    return false;
  }

  if(document.getElementById('form_regis').pass.value.length!=8)
  {
    alert("La contrase�a debe ser de longitud 8");
    document.getElementById('form_regis').pass.focus();
    return false;
  }


  if(document.getElementById('form_regis').pass.value != document.getElementById('form_regis').pass2.value)
  {
    alert("Las constrase�as son incorrectas");
    document.getElementById('form_regis').pass2.focus();
    return false;
  }
}


var x;
x=$(document);
x.ready(inicializarEventos);

function inicializarEventos()
{
  var x;

  x=$("#usuario");
  x.blur(buscarUsuario);
  
  x=$("#nombre");
  x.blur(colocaUsuario);
}

function buscarUsuario()
{
  var x;
  x=$(this);
  
  if(x.val()!="")
  {
    $.ajax(
    {
      type: "POST",
      url: "../php/validarUsuario.php",
      data: "usuario="+x.val(),

      success: function(respuesta)
      {
		if(respuesta!='')
		{
		  alert("Usuario existente! Intente con otro nombre");
		  $("#usuario").val("");
		  $("#usuario").focus();
		}
      }
    });
  }
}

function colocaUsuario()
{
	var x;
  	x = $(this);
	var txt = x.val();
	var str = "";
	
	/* cortamos en 15 digitos y en el 1er nombre */
	var i=0;
	var str2="";
	
	txt=txt.substring(0,15)
	while (i<=txt.length)
	{
		if(txt.charAt(i)!=' ')
		{	
			str = str + txt.charAt(i);
		}
		else
		{
			i = txt.length;		
		}
		i = i+1;
	}
	str = str.toLowerCase();
	$("#usuario").val(str);
	$("#usuario").focus();
	$("#email").focus();
}

var id;
function to(IDFile)
{
	switch(IDFile)
	{
		case "1":
			id="1";
			break;
		case "2":
			id="2";
			break
		case "3":
			id="3";
			break
	}
	updateDonwload();
}

function updateDonwload()
{
	var x;
  	x=$("#IDUsuario");
	
	if (x.val()!="")
	{
		debugger;
		$.ajax(
		{
		  type: "POST",
		  url: "updateDonw.php",
		  data: "IDUsuario="+x.val()+"&IDFile="+id+"&accion=1",
		  success: function(respuesta)
		  {
		  }
		});
		switch (id)
		{
			case "1":
				//window.open('IMAE 2018.ZIP'); Modificado el 06/08/21 por la sgte.versión
				window.open('IMAE2021.rar');
				break;
			case "2":
				window.open('13-12-04_Autodromos Conf IMAE.pdf');
				break;
			case "3":
				window.open('descargas/ESR-PAQ.zip');
				break;
		}
		
	}
}