
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


public class SondeHello {
	
	public static String post(String adress,List<String> keys,List<String> values) throws IOException{
		String result = "";
		OutputStreamWriter writer = null;
		BufferedReader reader = null;
		try {	
		//encodage des paramètres de la requête en fonction des List<string>
			String data="";
			for(int i=0;i<keys.size();i++){
				if (i!=0) data += "&";
				data +=URLEncoder.encode(keys.get(i), "UTF-8")+"="+URLEncoder.encode(values.get(i), "UTF-8");
				}
		//création de la connection avec le serveur web
			URL url = new URL(adress);
			URLConnection conn = (URLConnection) url.openConnection();
			conn.setDoOutput(true);
		//envoi de la requête POsT
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

	// Classe pour Récupérer le nom de l'ordinateur
	public static String getComputerFullName() {
		String hostName = null;
		try {
			final InetAddress addr = InetAddress.getLocalHost();
			hostName = new String(addr.getHostName());
			} catch(final Exception e) {
		    	}
		return hostName;
	}
	 
	// Classe pour Récupérer l'adresse IP de la machine
	 public static String getIpAddress(){
		 String IpAddress = null;
		 try {
			 IpAddress = InetAddress.getLocalHost().toString().split("/")[1];
		 } catch (final Exception e){
			 }
		 return IpAddress;
	 }
	 
	 // Classe pour récupérer l'adresse Mac
	 public static String getMACAddress(){
		 String MacAddress = null;
		 try{
			 InetAddress Ip =InetAddress.getLocalHost();
			 NetworkInterface ni = NetworkInterface.getByInetAddress(Ip);
			 byte [] mac = ni.getHardwareAddress();
			 if (mac!=null) {		
				 // Et si elle existe on la formate afin de la rendre lisible :
						StringBuilder sb = new StringBuilder();
						for (byte b : mac) {
							sb.append(String.format("%02X:", b));
						}
				//enlève le dernier caractère de la chaine
						MacAddress = sb.substring(0, sb.length()-1);
					}
		 }catch(final Exception e){	 
		 }
		 return MacAddress;
	 }
	 
	 //Classe pour Récupérer le nom de l'interface connecté
	 public static String getIface(){
		 String Interface = null;
		 try{
			 final InetAddress addr = InetAddress.getLocalHost();
			 NetworkInterface dest = NetworkInterface.getByInetAddress(addr);   
		     Interface = ((NetworkInterface) dest).getName();
		 } catch(final Exception e){
		 }
		 return Interface;
	 }
	
	 //Récupérer la capacité total du disque dur
	 public static String getTotalspace(){
		 String TotalSpace = null;
		 try{
			   File[] racines = File.listRoots();

			   long sum = 0;
			   for (int i = 0; i < racines.length; i++){
				   sum += racines[i].getTotalSpace()/(1024 * 1024 * 1024);
				   TotalSpace = String.valueOf(sum);
			   }
		 }catch(final Exception e){
		 }
		 return TotalSpace;
	 }
	 
	 //récupérer l'espace libre du disque dur
	 public static String getFreespace(){
		 String FreeSpace = null;
		 try{
			   File[] racines = File.listRoots();
			   long sum = 0;
			   for (int i = 0; i < racines.length; i++){
				   sum += racines[i].getFreeSpace()/(1024 * 1024 * 1024);
				   FreeSpace = String.valueOf(sum);
			   }
		 }catch(final Exception e){
		 }
		 return FreeSpace;
	 }
	 
	 //récupérer la date d'envoi du post
	 public static String getDate(){
		 String Date = null;
		 try{
			 Date now = Calendar.getInstance().getTime();
			 DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd kk:mm:ss");
			 Date = dateFormat.format(now);	 
		 }catch(final Exception e){
		 }
		 return Date;
	 }
	
	public static void main (String[] args){
		try{
		
		long temps_depart = System.currentTimeMillis();
		long duree = 99999999; // en millisecondes
		while((temps_depart - System.currentTimeMillis()) < duree){
		
		
		InetAddress Ip =InetAddress.getLocalHost();
		System.out.println("SondeHello : ");
		
		/*affiche nom ordinateur*/
		System.out.println(getComputerFullName());
		 
		 /* afficher l'adresse MAC*/
		System.out.print("Mac : " +getMACAddress());
		 
		 /*afficher l'adresse IP */
		System.out.println("\nIP : "+getIpAddress());
	     
	     /*affiche l'interface et le matériel connécté*/
	     NetworkInterface dest = NetworkInterface.getByInetAddress(Ip);   
	     System.out.println("Interface : "+getIface()); /*en String*/
	   
	   
	   	/*afficher la capacité mémoire disque*/
	   
	   File[] racines = File.listRoots();
	   
	   for (int i = 0; i < racines.length; i++){
		   
		   if (racines[i].getTotalSpace()!=0){
			   System.out.print(racines[i]);
			   System.out.println("Taille du disque: "+ racines[i].getTotalSpace()/1000000000+"GB");
		   }
	   }
       
       System.out.println("-------- capacité total---------");
       System.out.println("Capacite : " + getTotalspace()+" Go");
       System.out.println("Espace libre : " + getFreespace()+ " Go");

	     /*afficher l'heure d'envoi*/ 
	   System.out.println("Send: "+getDate());
	   
	     
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
			
		//Parties des valeurs
			values.add(getMACAddress());
			values.add(getIpAddress());
			values.add(getTotalspace()+"Go");
			values.add(getFreespace() +"Go");
			values.add(getDate());
			values.add(getIface());
	
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
			
			
		// envoi à l'adresse du serveur
			String url = post("http://127.0.0.1/IC4/hello.php",keys,values);
		     System.out.println(url);
		}
		} catch (Exception e){
			e.printStackTrace();
		}
		}
	}
	            
    