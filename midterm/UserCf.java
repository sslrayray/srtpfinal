import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;


public class UserCf {
	final static int ITEMNUM = 134;
	final static int USERNUM = 20;
	static double M[][] = new double[USERNUM][USERNUM];
	static double M2[][] = new double[USERNUM][ITEMNUM];
	static boolean UserItem[][] = new boolean[USERNUM+1][ITEMNUM+1];
	static String[] classSet = new String[ITEMNUM];
	static int[] classNum = new int[ITEMNUM];
	static int[] resultclassNum = new int[ITEMNUM];
	static void init(){
		for (int i = 0; i < USERNUM+1; i++)
			for (int j = 0; j < ITEMNUM+1; j++){
				UserItem[i][j] = false;
			}
		for (int i = 0; i < ITEMNUM; i++)
			classNum[i] = 0;
		for (int i = 0; i < ITEMNUM; i++)
			resultclassNum[i] = 0;
	}
	static void addclass(String cl){
		for (int i = 0; i<ITEMNUM; i++){
			if (classSet[i].equals(cl))
				classNum[i]++;
		}
	}
	
	static void resultaddclass(String cl){
		for (int i = 0; i<ITEMNUM; i++){
			if (classSet[i].equals(cl))
				resultclassNum[i]++;
		}
	}
	public static void main(String args[]) throws IOException{
		BufferedReader brr = new BufferedReader(new FileReader("class.txt"));
		
		for (int i = 0; i < ITEMNUM; i++){
			String str = brr.readLine();
			classSet[i] = str;
		}
		brr.close();
		String filename = "";
		BufferedReader br = null;
		init();
		for (int u = 0; u< USERNUM; u++){
			filename = "1_"+ (u+1) +".txt";
			br = new BufferedReader(new FileReader(filename));
			String line;
			try {
				line = br.readLine();
				
				while (line!=null){
					String st[]= line.split(" ");
					addclass(st[0]);
					int num = Integer.parseInt(st[1]);
					UserItem[u][num] = true;
					line = br.readLine();
				}
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
//			for (int i = 0; i < ITEMNUM; i++ ){
//				System.out.print(UserItem[u][i]+" "); // UserItem Matrix
//			}
//			System.out.println();
			
		}
		// input end
		//get similar matrix 
		for (int u1 = 0; u1 < USERNUM; u1++){
			for (int u2 = 0; u2 < USERNUM; u2++){
				double conjoin = 0;
				int u1ItemNum = 0;
				int u2ItemNum = 0;
				for (int i = 0; i < ITEMNUM; i++){
					if (UserItem[u1][i]) u1ItemNum ++;
					if (UserItem[u2][i]) u2ItemNum ++;
					if (UserItem[u1][i] && UserItem[u2][i]){
						conjoin += 1.0;//Math.log(1+classNum[i]);
					}
				}
				M[u1][u2] = conjoin*1.0 / Math.sqrt(u1ItemNum*u2ItemNum);
				//System.out.print(String.format("%.2f",M[u1][u2])+" ");
			}
			//System.out.println();
		}
		int CourseNo[]= new int[ITEMNUM];
		int Num = 0;
		for ( int u1 = 0; u1 < USERNUM; u1++ ){
			for (int i = 0; i < ITEMNUM; i++)
				CourseNo[i] = i;
			for (int inum = 0; inum < ITEMNUM; inum ++){
				double si = 0;
				for (int u2 = 0; u2 < USERNUM; u2++)
					if ( UserItem[u2][inum])
						si = si + M[u1][u2];
				//M2[u1][inum] = si;
				if (!UserItem[u1][inum]) M2[u1][inum] = si;
					else M2[u1][inum] = 0;
				//System.out.print(String.format("%.2f", si)+" ");
			}
			for (int i = 0; i < ITEMNUM; i++)
				for (int j = i+1; j < ITEMNUM; j++){
					//System.out.println(M2[u1][i] + " " + M2[u1][j]);
					if (M2[u1][i] < M2[u1][j]){
						double t = M2[u1][i];
						M2[u1][i] = M2[u1][j];
						M2[u1][j] = t;
						
						int tt = CourseNo[i];
						CourseNo[i] = CourseNo[j];
						CourseNo[j] = tt;
					}
				}
			System.out.println("List for Student " + u1 + ":");
			System.out.println(CourseNo[0] + " " + classSet[CourseNo[0]] +" " + String.format("%.2f",M2[u1][0])  + "\r\n"  
				+ CourseNo[1] + " " + classSet[CourseNo[1]] +" " + String.format("%.2f",M2[u1][1])   + "\r\n"
					+ CourseNo[2] + " " + classSet[CourseNo[2]]+" " + String.format("%.2f",M2[u1][2])  + "\r\n");
			resultaddclass(classSet[CourseNo[0]]);
			resultaddclass(classSet[CourseNo[1]]);
			resultaddclass(classSet[CourseNo[2]]);
			
			System.out.println();
		}
		for (int i = 0; i < ITEMNUM; i++)
			for (int j = i+1; j < ITEMNUM; j++)
				if (resultclassNum[i]<resultclassNum[j]){
					int t = resultclassNum[i];
					resultclassNum[i] = resultclassNum[j];
					resultclassNum[j] = t;
					
					String st = classSet[i];
					classSet[i] = classSet[j];
					classSet[j] = st;
				}
		for (int i = 0; i < 200; i++){
			System.out.println(classSet[i] + " " + resultclassNum[i]);
			if (resultclassNum[i] == 0) break;
		}
	}
}
