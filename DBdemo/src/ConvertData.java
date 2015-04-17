import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;


public class ConvertData {
	public static void main(String args[]) throws IOException{
		BufferedReader br = new BufferedReader(new FileReader("kcxq.txt"));
		FileWriter fw = new FileWriter("output.txt");

		String line;
		while ((line = br.readLine())!=null){
			String[] linearr = line.split(" ");
			switch (linearr[3]){
				case "一":
					linearr[3] = "1";
					break;
				case "二":
					linearr[3] = "2";
					break;
				case "三":
					linearr[3] = "3";
					break;
				case "四":
					linearr[3] = "4";
					break;
			}
			String newline = "";
			for (String unit : linearr)
				newline = newline + " " + unit;
			fw.write(newline+"\n");
			
		}	
		fw.close();
		br.close();
	}
}
