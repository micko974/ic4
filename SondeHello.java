
import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;


public class SondeHello {
	
	public static String post(String adress,List<String> keys,List<String> values) throws IOException{
		String result = "";
		OutputStreamWriter writer = null;
		BufferedReader reader = null;

		try {
			
		//encodage des paramètres de la requête
			String data="";
			for(int i=0;i<keys.size();i++){
				if (i!=0) data += "&";
				data += URLEncoder.encode(keys.get(i), "UTF-8")+"="+URLEncoder.encode(values.get(i), "UTF-8");
	
				}

		//création de la connection
			URL url = new URL(adress);
			URLConnection conn = (URLConnection) url.openConnection();
			conn.setDoOutput(true);
			
		//envoi de la requête
			writer = new OutputStreamWriter(conn.getOutputStream());
			writer.write(data);
			writer.flush();

		//lecture de la réponse
			reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
			String ligne;
			while ((ligne = reader.readLine()) != null) {
				result+=ligne;
			}
		}catch (Exception e) {
			e.printStackTrace();
		}
		return result;
	}

	
	
	public static void main (String[] args){
		
		try{
		
		InetAddress Ip =InetAddress.getLocalHost();
		NetworkInterface ni = NetworkInterface.getByInetAddress(Ip);
		byte [] mac = ni.getHardwareAddress();
		//System.out.println();

		System.out.println("SondeHello : ");
		 
		 /* afficher l'adresse MAC*/
		
		System.out.print("Mac : ");
	 
		if (mac!=null) {
		// Et si elle existe on la formate afin de la rendre plus lisible :
			StringBuilder sb = new StringBuilder();
			for (byte b : mac) {
				sb.append(String.format("%02X:", b));
			}
		//enlève le dernier caractère de la chaine
			String s2 = sb.substring(0,(sb.length()>=1)? sb.length()-1 : 0);
			System.out.format(s2);
		}
		 
		 /*afficher l'adresse IP */
	    String host = InetAddress.getLocalHost().toString().split("/")[1];
		System.out.println("\nIP : "+host);
	     
	     /*affiche l'interface et le matériel connécté*/
	     
	     NetworkInterface dest = NetworkInterface.getByInetAddress(Ip);
	     System.out.println(dest);      
	     
	     /*afficher l'interface*/
	  
	   String net = ((NetworkInterface) dest).getName();
	   System.out.println("Interface : "+net); /*en String*/
	   
	   
	   	/*afficher la capacité mémoire disque*/
	   
	   File[] racines = File.listRoots();
	   
	   for (int i = 0; i < racines.length; i++){
		   
		   if (racines[i].getTotalSpace()!=0){
			   System.out.print(racines[i]);
			   System.out.println("Taille du disque: "+ racines[i].getTotalSpace()/1000000000+"GB");
		   }
	   }
		   

	   
	   
	     /*afficher l'heure d'envoi*/
	   Calendar now = Calendar.getInstance();
	   
	    System.out.println("Date complete : " + (now.get(Calendar.DATE) + 1) + "-"
	        + now.get(Calendar.MONTH) + "-" + now.get(Calendar.YEAR) + " "
	        + now.get(Calendar.HOUR_OF_DAY) + ":" + now.get(Calendar.MINUTE) + ":"
	        + now.get(Calendar.SECOND) + "." + now.get(Calendar.MILLISECOND));
	   
	     
	    //création de deux tableaux de list
	     	List<String> keys = new ArrayList<String>();
			List<String> values= new ArrayList<String>();
		 
		//Partie des noms
			keys.add("IPAddress");
			values.add(host); 
			keys.add("MACAddress");
			StringBuilder sb = new StringBuilder();
			for (byte b : mac) {
				sb.append(String.format("%02X:", b));
			}
		//enlève le dernier caractère de la chaine
			String s2 = sb.substring(0,(sb.length()>=1)? sb.length()-1 : 0);
			values.add(s2);
		
			keys.add("Capacite");
			values.add("capacite");
			
			keys.add("MemDispo");
			values.add("memdisp");
			
			keys.add("time");
			values.add("date");
			
			keys.add("nom");
			values.add(net);
			
			keys.add("typeDev");
			if (net.equals("eth3")){
				values.add("interface LAN");
			}else{values.add("interface WIFI");}
			
			keys.add("idAtt");
			values.add("");
			
			
			keys.add("idDev");
			values.add(""); 
			values.add(""); 

			
		//Partie des valeurs
			//values.add(host); 
			//if (mac!=null) {
			// Et si elle existe on la formate afin de la rendre plus lisible :
				/*StringBuilder sb = new StringBuilder();
				for (byte b : mac) {
					sb.append(String.format("%02X:", b));
				}
			//enlève le dernier caractère de la chaine
				String s2 = sb.substring(0,(sb.length()>=1)? sb.length()-1 : 0);
				values.add(s2);
			}*/
			 
			//values.add("capacite");
			//values.add("memdisp");
			//values.add("date");
			//values.add(net);
			//envoi du type:
			/*if (net.equals("eth3")){
				values.add("interface");
			}
			/*auto-incrementation*/
			/*values.add(""); 
			values.add("");*/
			

			String url = post("http://127.0.0.1/IC4/hello.php",keys,values);
		     System.out.println(url);
		} catch (Exception e){
			e.printStackTrace();
		}

	} 
	            

}	 	     