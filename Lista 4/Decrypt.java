import java.awt.Toolkit;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.util.Base64;
import java.util.Base64.Decoder;
import java.util.Base64.Encoder;
import java.util.Date;

import javax.crypto.Cipher;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;


public class Decrypt {

    public class Decrypter implements Runnable{

        byte[] iv = IV("94b852e8bd1acb339c291a0848047a00");
        String b64 = "tZDeMdtgDQo5l4uNGkGZV4Vnh4sL8Hnh++uQ7goc1HdoGg9lgnGSE6n/yF1avxIatWr0k7+uPVzsN2YNw3LlAg4wbuxhxui5Siv98k8wd6jf59HtICpTK7VQpFpXjTncWLuOw8qjeVZHrFNNHvRSBA==";
        // String keysuff = "7b8cdfd2a7a8436d896d3ff2f958ca6ae8a4f149af98b2fabc08d082692ce";
        String keysuff = "2a7a8436d896d3ff2f958ca6ae8a4f149af98b2fabc08d082692ce";
        //a0a7b8cd
        Decoder dec = Base64.getDecoder();
        byte[] decoded = dec.decode(b64.getBytes());
        IvParameterSpec ivs = new IvParameterSpec(iv);
        volatile Cipher c;
        int charToFind = 64-keysuff.length();
        long id = 0;

        public Decrypter(){
            try {
                c = Cipher.getInstance("AES/CBC/PKCS5Padding");
            } catch (NoSuchAlgorithmException | NoSuchPaddingException e2) {
                e2.printStackTrace();
            }
        }


        public synchronized void decodeMsg(String key) throws NoSuchAlgorithmException, NoSuchPaddingException, InvalidKeyException, InvalidAlgorithmParameterException{

            byte[] kv = hexStringToByteArray(key);

            SecretKeySpec sks = new SecretKeySpec(kv, "AES");

            c.init(Cipher.DECRYPT_MODE, sks, ivs);

            byte[] end = c.update(decoded);
            if(check(end)){
                Toolkit.getDefaultToolkit().beep();
                printb(end);
                System.out.println("found for key: " + key);
                System.out.println(new Date());
            }

        }

        public byte[] hexStringToByteArray(String s) {
            int len = s.length();
            byte[] data = new byte[len / 2];
            for (int i = 0; i < len; i += 2) {
                data[i / 2] = (byte) ((Character.digit(s.charAt(i), 16) << 4)
                        + Character.digit(s.charAt(i+1), 16));
            }
            return data;
        }

        private boolean check(byte[] end) {
            int max = end.length >> 4;
            int counter = 0;
            for(int i = 0; i < end.length; ++i){

                if(end[i] > 0)
                    continue;
                else if (counter > max)
                    return false;
                else
                    counter++;
            }
            return true;
        }

        public void printb(byte[] b){
            for(int i = 0; i < b.length; ++i){
                System.out.print((char)b[i] + " ");

            }
            System.out.println();
        }

        private byte[] IV(String iv){

            byte[] result = new byte[iv.length() / 2];

            for(int i = 0; i < result.length; ++i){
                result[i] = (byte) Integer.parseInt(iv.substring(2*i, 2*i + 2) , 16);
            }

            return result;
        }

        public String formatHex(String s, int len) {
            if (s.length()>len) {
                return s;
            }
            while(s.length() < len) {
                s = "0" + s;
            }
            return s;
        }

        public synchronized long getAndIncID(){
            return id++;
        }


        @Override
        public void run() {
            while(true){
                long localID = getAndIncID();
                if (localID > Math.pow(16, charToFind)-1) break;
                String key = Long.toHexString(localID) + keysuff;
                key = String.format("%64s", key).replace(" ", "0");
                try {
                    decodeMsg(key);
                }
                catch (InvalidKeyException | NoSuchAlgorithmException | NoSuchPaddingException | InvalidAlgorithmParameterException e1) {
                    e1.printStackTrace();
                
                }
            }
        }
    }

    public void test(){
        int n=10000;
        Thread[] threads = new Thread[n];
        Decrypter decrypter = new Decrypter();
        for(int i = 0; i < n; i++){
            threads[i] = new Thread(decrypter);
        }
        for(int i = 0; i < n; i++){
            threads[i].start();
        }
    }
}