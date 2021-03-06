package com.example.oficinaestg.Singleton;

import android.content.Context;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentManager;

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
import com.example.oficinaestg.Listeners.PessoaListener;
import com.example.oficinaestg.Listeners.RegistoListener;
import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.Modelos.CarroDBHelp;
import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.Modelos.Pessoa;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Modelos.UserDBHelp;
import com.example.oficinaestg.Utils.CarroJsonParser;
import com.example.oficinaestg.Utils.MarcacaoJsonParser;
import com.example.oficinaestg.Utils.PessoaJsonParser;
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

    //Endereços ------------------------------------------------------------------------------------

    private final String endereco = "http://192.168.1.74"; //(ver ipconfig)

    private final String mUrlAPILogin = endereco + "/projetoWeb/OficinaESTG/backend/web/api/reg/login";
    private final String mUrlAPIRegisto = endereco + "/projetoWeb/OficinaESTG/backend/web/api/reg/registar";
    private final String mUrlAPICarroVenda = endereco + "/projetoWeb/OficinaESTG/backend/web/api/car/carrovendaget";
    private final String mUrlAPICarroPessoal = endereco + "/projetoWeb/OficinaESTG/backend/web/api/car/carroget";
    private final String mUrlAPIAlterarCarroPessoal = endereco + "/projetoWeb/OficinaESTG/backend/web/api/car/carroput";
    private final String mUrlAPIAdicionarCarroPessoal = endereco + "/projetoWeb/OficinaESTG/backend/web/api/car/carrocreate";
    private final String mUrlAPIEliminarCarroPessoal = endereco + "/projetoWeb/OficinaESTG/backend/web/api/car/carrodel";
    private final String mUrlAPIMarcacaoGet = endereco + "/projetoWeb/OficinaESTG/backend/web/api/mar/marcacaoget";
    private final String mUrlAPIMarcacaoVendaGet = endereco + "/projetoWeb/OficinaESTG/backend/web/api/mar/marcacaovendacreate";
    private final String mUrlAPIMarcacaoAdicionar= endereco + "/projetoWeb/OficinaESTG/backend/web/api/mar/marcacaocreate";
    private final String mUrlAPIPessoaget = endereco + "/projetoWeb/OficinaESTG/backend/web/api/per/pessoaget";
    private final String mUrlAPIPessoaput = endereco + "/projetoWeb/OficinaESTG/backend/web/api/per/pessoaput";

    private FragmentManager fragmentManager;

    //PESSOA
    private Pessoa pessoa;
    private ArrayList<Pessoa> pessoas;
    private PessoaListener pessoaListener;

    //USER
    private User user;
    private UserDBHelp userBD;

    //CARROVENDA
    private ArrayList<Carro> carrosVenda;
    private ArrayList<User> userLogado;
    private CarroVendaListener carroListener;
    private CarroDBHelp carroDBHelp;

    //CARROPESSOAL
    private ArrayList<Carro> carroPessoal;
    private CarroPessoalListener carroPessoalListener;
    private CarroDBHelp carroPessoalDBHelp;
    private String nomeCarro;

    //MARCACOES
    private ArrayList<Marcacao>  marcacoes;
    private MarcacoesListener marcacoesListener;
    private UserDBHelp userMarcacoesBDHelper;

    //Singleton ------------------------------------------------------------------------------------

    public LoginSingleton(Context context) {
        userBD = new UserDBHelp(context);
    }

    public static synchronized LoginSingleton getInstance(Context context) {

        if (instance == null) {
            instance = new LoginSingleton(context);

            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    // Listener's  ---------------------------------------------------------------------------------

    public void setCarrosVendaListener(CarroVendaListener carroListener){
        this.carroListener = carroListener;
    }

    public void setCarrosPessoalListener(CarroPessoalListener carroPessoalListener){
        this.carroPessoalListener = carroPessoalListener;
    }

    public void setMarcacoesListener(MarcacoesListener marcacoesListener){
        this.marcacoesListener = marcacoesListener;
    }

    public void setPessoaListener(PessoaListener pessoaListener){
        this.pessoaListener = pessoaListener;
    }

    //Métodos SQLite  ------------------------------------------------------------------------------

    public void adicionarCarroBD(ArrayList<Carro> carros){
        userBD.removerAllCarroVendaBD();
        for(Carro car : carros){
            userBD.adicionarCarroVendaBD(car);
        }
    }

    public void adicionarPessoalCarroBD(ArrayList<Carro> carros){
        userBD.removerAllCarroPessoalBD();
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

    public Marcacao getMarcacao (int idMarcacao){
        for (Marcacao marcacao : marcacoes){
            if(marcacao.getIdMarcacoes() == idMarcacao){
                return marcacao;
            }
        }
        return null;
    }

    public ArrayList<Carro> getCarroPessoal(int idUser) {
        carroPessoal = userBD.getAllCarrosPessoaBD(idUser);

        return carroPessoal;

    }

    public Pessoa getPessoaBD(int idUser){
        return userBD.getPessoa(idUser);
    }

    public User getUserBD(){
        return userBD.getUser();
    }

    public String getNomeCarroPorID(int idCarro){
        return userBD.getNomeCarro(idCarro);
    }

    public int getIdCarroPorNome(String nomeCarro){
        return userBD.getIdCarro(nomeCarro);
    }

    public void adicionarMarcacaoBD(ArrayList<Marcacao> marcacoes){
        userBD.removerAllMarcacoesBD();
        for(Marcacao m : marcacoes){
            userBD.adicionarMarcacaoBD(m);
        }
    }


    // Métodos API  --------------------------------------------------------------------------------

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
                    //userLogado = UserJsonParser.parserJsonUserArray(response, context, password);
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

    public void getPessoaAPI(final Context context, boolean isConnected){
        if(isConnected){
            RequestQueue queue = Volley.newRequestQueue(context);

            JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.GET, mUrlAPIPessoaget+"?access-token="+user.getAuth_key(), null, new Response.Listener<JSONObject>() {
                @Override
                public void onResponse(JSONObject response) {
                    pessoa = PessoaJsonParser.parserJsonPessoa(response, context);
                    userBD.removerAllPessoasBD();
                    userBD.adicionarPessoaBD(pessoa);
                    pessoaListener.onSuccess();
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    System.out.println("A-->"+error);
                    Toast.makeText(context, "Erro ao fazer o GET da Pessoa", Toast.LENGTH_SHORT).show();
                }
            });

            queue.add(jsonObjectRequest);
        }else{
            userBD.getPessoa(user.getId());
        }

    }

    public void atualizarPessoaPerfilAPI(final Pessoa pessoas , final Context context){

        RequestQueue queue = Volley.newRequestQueue(context);

        StringRequest request = new StringRequest(Request.Method.PUT, mUrlAPIPessoaput +"/" + pessoa.getIdPessoa() + "?access-token="+user.getAuth_key(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("A-->"+response);
                Toast.makeText(context, "Pessoa alterada", Toast.LENGTH_SHORT).show();
                //pessoaListener.onSuccess(true);

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();

            }
        })
        {
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("nome", pessoas.getNome());
                params.put("dataNascimento", pessoas.getDataNascimento());
                params.put("morada", pessoas.getMorada());
                params.put("nif", ""+pessoas.getNif());


                return  params;
            }
        };

        queue.add(request);

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
                Toast.makeText(context, "Registou com sucesso", Toast.LENGTH_SHORT).show();
                registoListener.onSuccess(true);
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
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, mUrlAPICarroPessoal +"?access-token="+user.getAuth_key(), null, new Response.Listener<JSONArray>() {
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
                        marcacoesListener.onRefreshListaMarcacao(marcacoes, user);

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
                marcacoesListener.onRefreshListaMarcacao(userMarcacoesBDHelper.getAllMarcacoes(user.getId()), user);
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
                carroPessoalListener.onActions();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();

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
                carroPessoalListener.onActions();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();

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

    public void removerCarroPessoalAPI(final Carro carro, final Context context){
        StringRequest request = new StringRequest(Request.Method.DELETE, mUrlAPIEliminarCarroPessoal + "/" + carro.getIdCarro()  + "?access-token="+user.getAuth_key(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Toast.makeText(context, "Carro eliminado", Toast.LENGTH_SHORT).show();
                carroPessoalListener.onActions();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "Não é possível eliminar o carro, verificar marcações", Toast.LENGTH_SHORT).show();
                //Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
        volleyQueue.add(request);
    }

    public void adicionarMarcacaoAPI(final Marcacao marcacao , final Context context){

        RequestQueue queue = Volley.newRequestQueue(context);

        StringRequest request = new StringRequest(Request.Method.POST, mUrlAPIMarcacaoAdicionar + "?access-token="+user.getAuth_key(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("A-->"+response);
                Toast.makeText(context, "Marcação Criada", Toast.LENGTH_SHORT).show();
                marcacoesListener.onActions();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println("A-->"+error);
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();

            }
        })
        {
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("dataMarcacao", marcacao.getDataMarcacao());
                params.put("descricaoMarcacao", marcacao.getDescricaoMarcacao());
                params.put("fk_idCarro", ""+marcacao.getFk_idCarro());

                return  params;
            }
        };

        queue.add(request);

    }

}
