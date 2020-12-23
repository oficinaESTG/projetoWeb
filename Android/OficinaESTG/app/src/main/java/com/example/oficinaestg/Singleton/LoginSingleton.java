package com.example.oficinaestg.Singleton;

import android.content.Context;
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
import com.example.oficinaestg.Listeners.CarroVendaListener;
import com.example.oficinaestg.Listeners.LoginListener;
import com.example.oficinaestg.Listeners.RegistoListener;
import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.Modelos.CarroDBHelp;
import com.example.oficinaestg.Modelos.Pessoa;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Modelos.UserDBHelp;
import com.example.oficinaestg.Utils.CarroJsonParser;
import com.example.oficinaestg.Utils.UserJsonParser;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class LoginSingleton extends AppCompatActivity {
    
    private static LoginSingleton instance = null;
    private static RequestQueue volleyQueue;

    private final String mUrlAPILogin = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/reg/login";
    private final String mUrlAPIRegisto = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/reg/registar";
    private final String mUrlAPICarroVenda = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/car/carrovendaget";

    public LoginSingleton(Context context) {
        userBD = new UserDBHelp(context);
    }

    //USER
    private User user;
    private UserDBHelp userBD;

    //CarroVenda
    private ArrayList<Carro> carrosVenda;
    private CarroVendaListener carroListener;
    private CarroDBHelp carroDBHelp;

    public void setCarrosVendaListener(CarroVendaListener carroListener){
        this.carroListener = carroListener;
    }

    public void adicionarCarroBD(ArrayList<Carro> livros){
        userBD.removerAllCarroVendaBD();
        for(Carro l : livros){
            userBD.adicionarCarroVendaBD(l);
        }
    }


    public static synchronized LoginSingleton getInstance(Context context) {

        if (instance == null) {
            instance = new LoginSingleton(context);

            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    public void loginAPI(final String email, final String password, final Context context, boolean isConnected, LoginListener loginListener) {
        if (isConnected){

            RequestQueue queue = Volley.newRequestQueue(context);

            JSONObject postData = new JSONObject();

            String eemail = "secretaria";
            String ppassword = "1234567890";

            try {
                postData.put("username", email);
                postData.put("password", password);

            } catch (JSONException e) {
                System.out.println("A-->"+e);
            }


            JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.POST, mUrlAPILogin, postData,new Response.Listener<JSONObject>() {
                @Override
                public void onResponse(JSONObject response) {
                    user = UserJsonParser.parserJsonUser(response, context, password);
                    //remover todos os que existem
                    userBD.removerAllUserBD();
                    //adicionar o user
                    userBD.adicionarUserBD(user);
                    loginListener.onSuccess(user);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("A-->"+error);
                    Toast.makeText(context, "Erro a fazer Login", Toast.LENGTH_SHORT).show();
                }
            });

            queue.add(jsonObjectRequest);
        }
        else{
            Boolean verifica = false;

            user = userBD.getUserBDbyNome(email, password);

            if (user!= null){
                verifica=true;
                loginListener.onSemNet(user, verifica);
            }else{
                loginListener.onSemNet(null, verifica);
            }

        }

    }

    public void registarPessoaAPI(final Pessoa pessoa, final User user, final Context context, RegistoListener registoListener){

        RequestQueue queue = Volley.newRequestQueue(context);

        StringRequest request = new StringRequest(Request.Method.POST, mUrlAPIRegisto, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("A-->"+response);
                Toast.makeText(context, "Registou com sucesso", Toast.LENGTH_SHORT).show();
                registoListener.onSuccess(true);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, "Erro ao fazer o Registo", Toast.LENGTH_SHORT).show();
            }
        })
        {
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("username", user.getUsername());
                params.put("email", user.getEmail());
                params.put("password", user.getPassword());
                params.put("nome", pessoa.getNome());
                params.put("dataNascimento", pessoa.getDataNascimento());
                params.put("morada", pessoa.getMorada());
                params.put("nif", String.valueOf(pessoa.getNif()));

                return  params;
            }
        };

        queue.add(request);

    }

    public void getAllCarrosVendaAPI(final Context context, boolean isConnected){
        if (isConnected) {
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, mUrlAPICarroVenda + "?access-token=2zVOIyuuJG_7rU0d8kjwIkg1DyUwA5av", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    carrosVenda = CarroJsonParser.parserJsonCarro(response);

                    adicionarCarroBD(carrosVenda);

                    if (carroListener != null) {
                        carroListener.onRefreshListaCarrosVenda(carrosVenda);
                    }

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(request);
        }else{
            //falta fazer
        }
    }
}
