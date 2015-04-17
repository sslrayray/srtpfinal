
import java.io.BufferedReader;
import java.io.Console;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.util.ArrayList;

public class DBDemo{
	public static void main(String args[]) throws IOException  {
		Console console = System.console();		
		String passwd = console.readPassword("Input root passwd:").toString();		
		String filename = "kcxq.txt";
		String dbname = "rrdb";
		String user = "root";
		String tableName = "CourseDetail";
		
		ImportDBFile(filename, dbname, user, passwd, tableName);
	}
	
	public static void ImportDBFile(String filename, String dbname, String user, String passwd, String tableName) throws IOException{
		ArrayList<String > tupleStrSet = new ArrayList<String>();
		String tupleStr ;
		BufferedReader br = new BufferedReader(new InputStreamReader(new FileInputStream(filename), "utf-8"));
		tupleStr = br.readLine();
		//System.out.println(tupleStr);
		try{
			while (tupleStr!=null){
				tupleStrSet.add(tupleStr);
				//System.out.println(tupleStr);
				tupleStr = br.readLine();
			}
		}catch(Exception e ){
			System.out.println("nullline");
		}
		br.close();
		insertTuple(tupleStrSet, user,  passwd, tableName);
	}
	
	public static void insertTuple(ArrayList<String> tupleStrSet, String user, String passwd, String tableName) throws UnsupportedEncodingException{
		String url = "jdbc:mysql://localhost:3306/rrdb";
		String driver = "com.mysql.jdbc.Driver";
		String sqlstr;
		int rows;
		Connection con = null;
		Statement stat = null;
		ResultSet rs = null;
		try{
			Class.forName(driver);
			con = DriverManager.getConnection(url, user, passwd);
			stat = con.createStatement();
			for (int rep = 0; rep < tupleStrSet.size(); rep++){
				String tupleStr = tupleStrSet.get(rep);
				System.out.println(tupleStr);
				String[] tupleSet = tupleStr.split(" ");
				String val = "";
				for (int i = 0; i < tupleSet.length; i++ ){
					if (i == 0) val = "(";
				//	System.out.println(tupleSet[i]);
					if (i < (tupleSet.length-1))
						val = val + " '" + tupleSet[i] + "' ,";
					else
						val = val + " '"+tupleSet[i] + "' )";
				}
				sqlstr = "insert into "+ tableName + " values " +  val + ";";
				rows = stat.executeUpdate(sqlstr);
				System.out.println(rows);
			}

		}
		catch(ClassNotFoundException e1){
			System.out.println("DB not Exist!");
			System.out.println(e1.toString());
		}
		catch(SQLException e2){
			System.out.println("DB error");
			System.out.println(e2.toString());
		}
		finally{
			try{
				if (rs!=null) rs.close();
				if (stat!=null) stat.close();
				if (con!=null) con.close();
			}catch(SQLException e){
				System.out.println(e.toString());
			}
		}
	}
}
