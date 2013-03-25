
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
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.StringTokenizer;


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
				data +=URLEncoder.encode(keys.get(i), "UTF-8")+"="+URLEncoder.encode(values.get(i), "UTF-8");
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

	//Récupérer le Hostname
	 public static String getComputerFullName() {
		    String hostName = null;
		    try {
		      final InetAddress addr = InetAddress.getLocalHost();
		      hostName = new String(addr.getHostName());
		    } catch(final Exception e) {
		    }
		    return hostName;
		  }
	
	
	public static void main (String[] args){
		try{
		
		long temps_depart = System.currentTimeMillis();
		long duree = 99999999; // en millisecondes
		while((temps_depart - System.currentTimeMillis()) < duree){
		
		
		
		InetAddress Ip =InetAddress.getLocalHost();
		NetworkInterface ni = NetworkInterface.getByInetAddress(Ip);
		byte [] mac = ni.getHardwareAddress();
		//System.out.println();

		System.out.println("SondeHello : ");
		
		/*affiche nom ordinateur*/
		System.out.println(getComputerFullName());
		 
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
	     System.out.println(dest.toString());      
	     
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
		   
	   //Créer une instance de File sur la partition à analyser
       File file = new File("C:");
       //capacité de la partition
       long totalSpace = file.getTotalSpace();
       //Espace disponible
       long freeSpace = file.getFreeSpace();

       System.out.println("-------- Partition C: ---------");
       long Go1 = totalSpace / (1024 * 1024 * 1024);
       System.out.println("Capacite : " + totalSpace + " octets soit " + Go1 + " Go");
       long Go2 = freeSpace / (1024 * 1024 * 1024);
       System.out.println("Espace libre : " + freeSpace + " octets soit " + Go2 + " Go");
	   String str_Go1 = String.valueOf(Go1);
	   String str_Go2 = String.valueOf(Go2);
	   
	     /*afficher l'heure d'envoi*/
	   Date now = Calendar.getInstance().getTime();
	   DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd kk:mm:ss");
	   String dat = dateFormat.format(now);

	   
	   System.out.println(dat);
	   
	     
	    //création de deux tableaux de list
	     	List<String> keys = new ArrayList<String>();
			List<String> values= new ArrayList<String>();
				     
		//Partie des noms
			
			keys.add("MACAddress");
			keys.add("IPAddress");	
			keys.add("Capacite");
			keys.add("MemDispo");
			keys.add("time");
			keys.add("nom");
			keys.add("typeDev");
			keys.add("hostname");
			keys.add("idAtt");
			keys.add("idDev");
			
			StringBuilder sb = new StringBuilder();
			for (byte b : mac) {
				sb.append(String.format("%02X:", b));
			}
		//enlève le dernier caractère de la chaine
			String s2 = sb.substring(0,(sb.length()>=1)? sb.length()-1 : 0);
			values.add(s2);
			
			values.add(host);
			values.add(str_Go1+"Go");
			values.add(str_Go2 +"Go");
			values.add(dat);
			values.add(net);
			;
			;
			
			String st = new String(dest.toString().split(" ")[4]);
			if (st.equals("Wireless")){
				values.add("Sans-Fil");
			}else{
				values.add("Filaire");
			}
			
			values.add(getComputerFullName());
			/*auto-increment*/
			values.add("");
			values.add("");
			
			
			

			String url = post("http://127.0.0.1/IC4/hello.php",keys,values);
		     System.out.println(url);
		}
		} catch (Exception e){
			e.printStackTrace();
		}
		}
	}
	            
    