package com.example.oficinaestg.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.oficinaestg.Modelos.Carro;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class CarroJsonParser {

    public static ArrayList<Carro> parserJsonCarro(JSONArray response){
        ArrayList<Carro> listaCarro = new ArrayList<>();
        try{
            for(int i = 0; i < response.length(); i++){
                JSONObject carro = (JSONObject) response.get(i);

                int idCarro = carro.getInt("idCarro");
                String modeloCarro= carro.getString("modeloCarro");
                String marcaCarro= carro.getString("marcaCarro");
                int ano = carro.getInt("ano");
                String matricula = carro.getString("matricula");
                String tipoCarro = carro.getString("tipoCarro");
                int quilometros = carro.getInt("quilometros");
                String combustivel = carro.getString("combustivel");
                int fk_idPessoa = carro.getInt("fk_idPessoa");
                int precoCarro = carro.getInt("precoCarro");
                int vendido = carro.getInt("vendido");

                Carro carroaux = new Carro(idCarro,ano,quilometros, fk_idPessoa, precoCarro,modeloCarro,marcaCarro,matricula,tipoCarro,combustivel,vendido );

                listaCarro.add(carroaux);
            }
        }catch (JSONException e){
            e.printStackTrace();
        }

        return listaCarro;
    }



    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm =(ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo nInfo = cm.getActiveNetworkInfo();

        return nInfo!=null && nInfo.isConnected();
    }
}
