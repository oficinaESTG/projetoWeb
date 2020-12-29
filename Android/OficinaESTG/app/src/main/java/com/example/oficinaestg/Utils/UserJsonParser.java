package com.example.oficinaestg.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.oficinaestg.Modelos.User;

import org.json.JSONException;
import org.json.JSONObject;

public class UserJsonParser {

    public static User parserJsonUser (JSONObject response, Context context, String password) {
        User user = null;
        try {

            int id =response.getInt("id");
            String username= response.getString("username");
            int status= response.getInt("status");
            String auth_key= response.getString("auth_key");
            String email= response.getString("email");
            int created_at= response.getInt("created_at");
            int updated_at= response.getInt("updated_at");
            String password_hash= response.getString("password_hash");
            String password_reset_token= response.getString("password_reset_token");
            String verification_token= response.getString("verification_token");

            user = new User(id,status, username, auth_key ,email, created_at, updated_at, password_hash, password_reset_token, verification_token, password);

        }
        catch(JSONException e) {
            e.printStackTrace();
        }

        return user;
    }

  /*  public static ArrayList<User> parserJsonUserArray(JSONArray response, Context context, String password){
        ArrayList<User> listaUser = new ArrayList<>();
        try{
            for(int i = 0; i < response.length(); i++){
                JSONObject user = (JSONObject) response.get(i);

                int id =user.getInt("id");
                String username= user.getString("username");
                int status= user.getInt("status");
                String auth_key= user.getString("auth_key");
                String email= user.getString("email");
                int created_at= user.getInt("created_at");
                int updated_at= user.getInt("updated_at");
                String password_hash= user.getString("password_hash");
                String password_reset_token= user.getString("password_reset_token");
                String verification_token= user.getString("verification_token");

                User useraux = new User(id,status, username, auth_key ,email, created_at, updated_at, password_hash, password_reset_token, verification_token, password);

                listaUser.add(useraux);
            }
        }catch (JSONException e){
            e.printStackTrace();
        }

        return listaUser;
    } */

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm =(ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo nInfo = cm.getActiveNetworkInfo();

        return nInfo!=null && nInfo.isConnected();
    }
}
