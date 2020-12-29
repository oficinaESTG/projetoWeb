package com.example.oficinaestg.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.oficinaestg.Modelos.Marcacao;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class MarcacaoJsonParser {

    public static ArrayList<Marcacao> parserJsonMarcacoes(JSONArray response){
        ArrayList<Marcacao> listaMarcacao = new ArrayList<>();
        try{
            for(int i = 0; i < response.length(); i++){
                JSONObject marcacao = (JSONObject) response.get(i);

                int idMarcacoes = marcacao.getInt("idMarcacoes");
                int fk_idPessoa = marcacao.getInt("fk_idPessoa");
                int fk_idCarro= marcacao.getInt("fk_idCarro");
                int fk_idResponsavel = marcacao.getInt("fk_idResponsavel");
                int valorFinal = marcacao.getInt("valorFinal");
                int horasTrabalho = marcacao.getInt("horasTrabalho");
                String tipoMarcacao = marcacao.getString("tipoMarcacao");
                String dataMarcacao = marcacao.getString("dataMarcacao");
                String descricaoMarcacao = marcacao.getString("descricaoMarcacao");
                String estadoMarcacao = marcacao.getString("estadoMarcacao");
                String descricaoFinal = marcacao.getString("descricaoFinal");


                Marcacao marcacaoaux = new Marcacao (idMarcacoes, fk_idPessoa, fk_idCarro, fk_idResponsavel, valorFinal, horasTrabalho,
                        tipoMarcacao,dataMarcacao,descricaoMarcacao,estadoMarcacao,descricaoFinal);

                listaMarcacao.add(marcacaoaux);
            }
        }catch (JSONException e){
            e.printStackTrace();
        }

        return listaMarcacao;
    }




    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm =(ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo nInfo = cm.getActiveNetworkInfo();

        return nInfo!=null && nInfo.isConnected();
    }
}
