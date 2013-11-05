function fcn_deleteconfirm(delurl)
{
	var deleteconfirm = confirm('¿Está seguro que desea borrar este elemento?');
	if ( !deleteconfirm ) 
	{
		/*NOP*/
	}else
	{
		window.open(delurl,"_self");
	}
}

function clone_confirm(clone_url)
{
    var clone_confirm = confirm('¿Está seguro que desea clonar este elemento?');
    if ( !clone_confirm ) 
    {
        /*NOP*/
    }else
    {
        window.open(clone_url,"_self");
    }
}

var fields=new Array();
var varindex=0;


function printvalidation(value,field_name,requiretype)
{    
    switch (value)
    {
        case "texto":
            switch (requiretype)
            {
                case "R":
                var texto = document.getElementById(field_name);
                if (texto.value.length > 0)
                {
                    return (true);
                }
                else
                {
                    return (false);
                }
                break;
                case "RN":
                var texto = document.getElementById(field_name);
                try
                {
                    parseInt(texto.value);
                    return (true);
                }
                catch(err)
                {
                    return (false);
                }
                break;
                case "RE":
                var texto = document.getElementById(field_name);
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(texto.value)){
                    return (true)
                }
                else
                {
                    return (false);
                }
                break;
            }
        break;
        case "lista":
        var listoption = document.getElementById(field_name);
            if (listoption.selectedIndex !=-1)
            {
                return (true);
            }
            else
            {
                return (false);
            }
        break;
        case "password":
        var texto = document.getElementById(field_name);
            if (texto.value.length > 0)
            {
                return (true);
            }
            else
            {
                return (false);
            }
        
        break;
        case "listbox":
        if (validatelist(field_name))
        {
                return (true)
        }
        else
        {
                return (false)
        }       
        break;
        case "hexa":
            var texto = document.getElementById(field_name);
            if (texto.value.length > 0)
            {
                return (true);
            }
            else
            {
                texto.value = "ffffff";
                return (true);
            }
        break;
        }    
}
function validation()
{
    var errors = 0;
    var errorstring ="";
    for (var i = 0;i<fields.length;i++)
    {
        if ((fields[i][3]=="R")||(fields[i][3]=="RN")||(fields[i][3]=="RE"))
        {
            if (!printvalidation(fields[i][1],fields[i][0],fields[i][3]))
            {
                errors++;
                if (errorstring.length == 0)
                {
                    errorstring = "<?=$GLOBALS['cfg_validationerror']?> \n"+ fields[i][2];
                }
                else
                {
                    errorstring+= ","+ fields[i][2];
                }
            }    
        }        
    }
    if (errors > 0)
    {
        alert(errorstring);
        return (false);
    }
}





