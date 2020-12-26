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
import com.example.oficinaestg.Listeners.CarroPessoalListener;
import com.example.oficinaestg.Listeners.CarroVendaListener;
import com.example.oficinaestg.Listeners.LoginListener;
import com.example.oficinaestg.Listeners.MarcacoesListener;
import com.example.oficinaestg.Listeners.RegistoListener;
import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.Modelos.CarroDBHelp;
import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.Modelos.Pessoa;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Modelos.UserDBHelp;
import com.example.oficinaestg.Utils.CarroJsonParser;
import com.example.oficinaestg.Utils.MarcacaoJsonParser;
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
    private final String mUrlAPICarroPessoal = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/car/carroget";
    private final String mUrlAPIAlterarCarroPessoal = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/car/carroput";
    private final String mUrlAPIAdicionarCarroPessoal = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/car/carrocreate";
    private final String mUrlAPIMarcacaoGet = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/mar/marcacaoget";
    private final String mUrlAPIMarcacaoVendaGet = "http://192.168.1.71/projetoWeb/OficinaESTG/backend/web/api/mar/marcacaovendacreate";

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

    //CarroPessoal
    private ArrayList<Carro> carroPessoal;
    private CarroPessoalListener carroPessoalListener;
    private CarroDBHelp carroPessoalDBHelp;

    //Marcacoes
    private ArrayList<Marcacao>  marcacoes;
    private MarcacoesListener marcacoesListener;
    private UserDBHelp userMarcacoesBDHelper;

    public void setCarrosVendaListener(CarroVendaListener carroListener){
        this.carroListener = carroListener;
    }

    public void setCarrosPessoalListener(CarroPessoalListener carroPessoalListener){
        this.carroPessoalListener = carroPessoalListener;
    }

    public void setMarcacoesListener(MarcacoesListener marcacoesListener){
        this.marcacoesListener = marcacoesListener;
    }

    public void adicionarCarroBD(ArrayList<Carro> carros){
        userBD.removerAllCarroVendaBD();
        for(Carro car : carros){
            userBD.adicionarCarroVendaBD(car);
        }
    }

    public void adicionarPessoalCarroBD(ArrayList<Carro> carros){
        for(Carro car : carros){
            userBD.adicionarCarroVendaBD(car);
        }
    }

    public Carro getCarro(int idCarro){
        for (Carro carro : carrosVenda){
            if(carro.getIdCarro() == idCarro){
                return carro;
            }
        }
        return null;
    }

    public void adicionarMarcacaoBD(ArrayList<Marcacao> marcacoes){
        userBD.removerAllMarcacoesBD();
        for(Marcacao l : marcacoes){
            userBD.adicionarMarcacaoBD(l);
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
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, mUrlAPICarroVenda + "?access-token="+user.getAuth_key(), null, new Response.Listener<JSONArray>() {
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

            carrosVenda =  userBD.getAllCarrosVendaBD();

            if (carroListener != null) {
                carroListener.onRefreshListaCarrosVenda(carrosVenda);
            }

        }
    }

    public void getAllCarrosPessoalAPI(final Context context, boolean isConnected){

        if (isConnected) {
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, mUrlAPICarroPessoal + "?access-token="+user.getAuth_key(), null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    carrosVenda = CarroJsonParser.parserJsonCarro(response);

                    adicionarPessoalCarroBD(carrosVenda);

                    if (carroPessoalListener != null) {
                        carroPessoalListener.onRefreshListaCarrosPessoal(carrosVenda);
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

            carrosVenda =  userBD.getAllCarrosPessoaBD(user.getId());

            if (carroPessoalListener != null) {
                carroPessoalListener.onRefreshListaCarrosPessoal(carrosVenda);
            }

        }
    }

    public void getAllMarcacoesUserLoggadoAPI(final Context context, boolean isConnected){
        if (isConnected) {
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacaoGet +"?access-token="+user.getAuth_key(), null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    marcacoes = MarcacaoJsonParser.parserJsonMarcacoes(response);

                    adicionarMarcacaoBD(marcacoes);

                    if (marcacoesListener != null) {
                        marcacoesListener.onRefreshListaMarcacao(marcacoes);
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

            Toast.makeText(context, "NAO TEM NET", Toast.LENGTH_SHORT).show();

            if(marcacoesListener != null){
                //fazer amanhã o getAllMarcacoes a receber o id da pessoa logada
                //marcacoesListener.onRefreshListaMarcacao(userMarcacoesBDHelper.getAllMarcacoes());
            }

        }
    }

    public void guardarVistoriaMarcacaoAPI(final String data, final String nota, final String idCarro , final Context context){

        RequestQueue queue = Volley.newRequestQueue(context);

        StringRequest request = new StringRequest(Request.Method.POST, mUrlAPIMarcacaoVendaGet + "?access-token="+user.getAuth_key(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("A-->"+response);
                Toast.makeText(context, "Vistoria marcada", Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.toString(), Toast.LENGTH_SHORT).show();

            }
        })
        {
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("dataMarcacao",data);
                params.put("descricaoMarcacao", nota);
                params.put("fk_idCarro", idCarro);

                return  params;
            }
        };

        queue.add(request);

    }

    public void guardarCarroPessoalAPI(final Carro carro , final Context context){

        RequestQueue queue = Volley.newRequestQueue(context);

        StringRequest request = new StringRequest(Request.Method.POST, mUrlAPIAdicionarCarroPessoal + "?access-token="+user.getAuth_key(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("A-->"+response);
                Toast.makeText(context, "Carro inserido", Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.toString(), Toast.LENGTH_SHORT).show();

            }
        })
        {
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("marcaCarro",carro.getMarcaCarro());
                params.put("modeloCarro", carro.getModeloCarro());
                params.put("ano", ""+carro.getAno());
                params.put("matricula", carro.getMatricula());
                params.put("quilometros", ""+carro.getQuilometros());
                params.put("combustivel", carro.getCombustivel());
                params.put("precoCarro", ""+carro.getPrecoCarro());

                return  params;
            }
        };

        queue.add(request);

    }

    public void alterarCarroPessoalAPI(final Carro carro , final Context context){

        RequestQueue queue = Volley.newRequestQueue(context);

        StringRequest request = new StringRequest(Request.Method.PUT, mUrlAPIAlterarCarroPessoal +"/" + carro.getIdCarro() + "?access-token="+user.getAuth_key(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("A-->"+response);
                Toast.makeText(context, "Carro alterado", Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.toString(), Toast.LENGTH_SHORT).show();

            }
        })
        {
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("marcaCarro",carro.getMarcaCarro());
                params.put("modeloCarro", carro.getModeloCarro());
                params.put("ano", ""+carro.getAno());
                params.put("matricula", carro.getMatricula());
                params.put("quilometros", ""+carro.getQuilometros());
                params.put("combustivel", carro.getCombustivel());
                params.put("precoCarro", ""+carro.getPrecoCarro());

                return  params;
            }
        };

        queue.add(request);

    }
}
