function AddClass(obj)
{
	var rowIndex = obj.parentNode.parentNode.rowIndex;
	var tb = document.getElementById("ssjg");
	var className = tb.rows[rowIndex].cells[2].innerHTML;
	var class_no = tb.rows[rowIndex].cells[1].textContent;
	var class_add = document.getElementById("class_add");
	var total = className+ ";" + class_no + ";";
	var string = class_add.value;
	var repetition = false;
	while(string != "")
	{
		var n1 = string.indexOf(";");
		string = string.substr(n1+1);
		n1 = string.indexOf(";");
		var str2 = string.slice(0,n1);
		if(str2 == class_no)
		{
			repetition = true;
			break;
		}
	}
	if(repetition == false)
		class_add.value += total;
	else
	{
		alert("你已经添加了这门课！");
	}
}

function scrollwindow()
{
	window.scroll(0,250);
	Chose(document.getElementById('Dropdownlist1'));
	Chose( document.getElementById('Dropdownlist2'));
}

function Chose(obj)
{
	  var str=obj.id;
	 // alert(str);
	 
	
	  //alert( document.getElementById("DropDownList1").value);
	  if (str=="DropDownList1")
	  {
		  
			if ( document.getElementById("DropDownList1").value=="sksj")
			{
				document.getElementById("Db_xqj1").style.display="inline";
			}
			else
			{
				document.getElementById("Db_xqj1").style.display="none";
			}
			if ( document.getElementById("DropDownList1").value=="kclb")
			{
				document.getElementById("Db_kclb1").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kclb1").style.display="none";
			}
			if ( document.getElementById("DropDownList1").value=="kcmc")
			{
				document.getElementById("Db_kcmc1").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kcmc1").style.display="none";
			}				        
	  } 
	  else 
	  {
			if ( document.getElementById("DropDownList2").value=="sksj")
			{
				document.getElementById("Db_xqj2").style.display="inline";
			}
			else
			{
				document.getElementById("Db_xqj2").style.display="none";
			}
			if ( document.getElementById("DropDownList2").value=="kclb")
			{
				document.getElementById("Db_kclb2").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kclb2").style.display="none";
			}
			if ( document.getElementById("DropDownList2").value=="kcmc")
			{
				document.getElementById("Db_kcmc2").style.display="inline";
			}
			else
			{
				document.getElementById("Db_kcmc2").style.display="none";
			}
	  }
	  
}
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "row1";
			}else{
				rows[i].className = "row2";
			}      
		}
	}
}
window.location.onload=function(){
	alert("yes");
	altRows('ssjg');
}
