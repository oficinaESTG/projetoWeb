package com.example.oficinaestg.Utils;

import android.content.Context;

import com.android.volley.toolbox.JsonArrayRequest;
import com.example.oficinaestg.Modelos.User;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class UserJsonParser {

    public static User parserJsonUser (JSONObject response, Context context) {
        User user = null;
        try {
            int id =response.getInt("id");
            String username= response.getString("username");
            String auth_key= response.getString("auth_key");
            String email= response.getString("email");
            int created_at= response.getInt("created_at");
            int updated_at= response.getInt("updated_at");
            String password_hash= response.getString("password_hash");
            String password_reset_token= response.getString("password_reset_token");
            String verification_token= response.getString("verification_token");

            user = new User(id, username, auth_key ,email, created_at, updated_at, password_hash, password_reset_token, verification_token);

        }
        catch(JSONException e) {
            e.printStackTrace();
        }

        return user;
    }
}
