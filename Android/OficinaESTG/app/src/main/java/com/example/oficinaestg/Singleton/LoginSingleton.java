package com.example.oficinaestg.Singleton;

import android.content.Context;
import android.content.Intent;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.oficinaestg.Listeners.LoginListener;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Utils.UserJsonParser;
import com.example.oficinaestg.Vistas.MenuMainActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.UnknownServiceException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class LoginSingleton extends AppCompatActivity {
    
    private static LoginSingleton instance = null;
    private static RequestQueue volleyQueue;

    private final String mUrlAPILogin = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/reg/login";

    private User user;

    public LoginSingleton(Context context) {
    }

    public static synchronized LoginSingleton getInstance(Context context) {

        if (instance == null) {
            instance = new LoginSingleton(context);

            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    public void loginAPI(final String email, final String password, final Context context, LoginListener loginListener) {

        RequestQueue queue = Volley.newRequestQueue(context);

        JSONObject postData = new JSONObject();

        try {
            postData.put("username", email);
            postData.put("password", password);

        } catch (JSONException e) {
            System.out.println("A-->"+e);
        }


        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.POST, mUrlAPILogin, postData,new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                user = UserJsonParser.parserJsonUser(response, context);
                loginListener.onSuccess(user);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Erro a fazer Login", Toast.LENGTH_SHORT).show();
            }
        });

        queue.add(jsonObjectRequest);
    }


}
