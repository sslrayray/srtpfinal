
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Map;

public class kcxxToDB {
	public static String fileWriteLine(String htmlLine){
		String outline = "";
		boolean flag = false;
		if (htmlLine.length()<40) return null;
		char chbefore;
		char ch = 0;
		for (int i = 0; i<htmlLine.length(); i++){
			chbefore = ch;
			ch = htmlLine.charAt(i);
			
			if (ch == '<') flag = false;
			if (ch == '>'){ 
				flag = true;
				if(chbefore!='r')
					outline = outline + " ";
					//System.out.print(" ");
				else
					outline = outline + '|';
					//System.out.print('|');
				continue; 
			}
			if (flag){
				outline = outline + ch;
				//System.out.print(ch);
			}
		}
		
		String regout = "";
		for (int i = 0; i < outline.length(); i++){
			if (outline.charAt(i) == ' ') regout = regout + ' ';  
			while (i < outline.length() && outline.charAt(i)==' ') i++;
			if (i < outline.length())
				regout = regout + outline.charAt(i);
		}
		String outt[] = regout.split(" ");
		regout = "";
		for (int i = 1; i < outt.length-2; i++)
			regout = regout + outt[i] + " ";
		regout = regout + outt[outt.length-2];
		return regout;
	}
	
	public static void getJWBinfo(String kcdm)throws Exception{
		int lineflag = -1;
		
//------------------------------------------------------------
			
		String cookieVal = "ASP.NET_SessionId=35vvfhjdkw5vi1454djznwzq";	
		URL url = new URL("http://jwbinfosys.zju.edu.cn/xscxbm.aspx?xh=3120000408");
		HttpURLConnection connection = (HttpURLConnection)url.openConnection();

		connection.setDoInput(true);
		connection.setDoOutput(true);
		connection.setRequestMethod("POST");
		connection.setUseCaches(false);
		connection.setInstanceFollowRedirects(true);
    	connection.setRequestProperty("Cookie",cookieVal);

		
		connection.connect();
		String content = "__VIEWSTATE=dDwxOTk4MDIzMTIxOztsPENoZWNrQm94MTs%2BPosmcdALuFSBS0cze8Wo4edm8lRO&DropDownList1=kcdm&Dropdownlist_gx1=like&TextBox1="+kcdm+"&kcmc1=Des+%26+Sel+of+Petrol+Proc+Equip&RadioButtonList1=and&Dropdownlist2=kcmc&Dropdownlist_gx2=like&Textbox2=&Button5=%B2%E9%D1%AF%BD%CC%D1%A7%B0%E0";
		DataOutputStream out = new DataOutputStream(connection.getOutputStream());
		out.writeBytes(content);
		out.flush();
		out.close();
		int stat = connection.getResponseCode();
		System.out.println(stat);
		InputStreamReader isr = new InputStreamReader(connection.getInputStream(), "gbk");
		
		
		
		BufferedReader bfr = new BufferedReader(isr);
		String line = bfr.readLine();
		String outline = "";
		FileWriter fw = new FileWriter("output.txt", true); 
		while (line != null){
			lineflag ++;
			if (line.contains("datagridhead")) lineflag = -100;
		
			if (lineflag < 0 && line.contains("\t</tr>") && (line.length()==6)) lineflag = 0;
			if (lineflag > -99 && lineflag < 0){
				outline = fileWriteLine(line);
				if (outline != null )
					fw.write(outline+"\n");
			}
				//fw.write(line+"\n");
			line = bfr.readLine();
		}
		fw.close();
		isr.close();
		connection.disconnect();
	}
	public static void main(String args[])throws Exception{
		BufferedReader br = new BufferedReader(new InputStreamReader(new FileInputStream("kcdm.txt")));
		String line = br.readLine();
		while (line!=null){
			System.out.println(line);
			
			getJWBinfo(line);//数据库
			line = br.readLine();
		}

		br.close();
	} 
}
