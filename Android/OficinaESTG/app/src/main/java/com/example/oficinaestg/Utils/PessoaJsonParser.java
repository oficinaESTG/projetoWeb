package com.example.oficinaestg.Utils;

import android.content.Context;

import com.example.oficinaestg.Modelos.Pessoa;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class PessoaJsonParser {

    public static Pessoa parserJsonPessoa(JSONObject response, Context context){
        Pessoa pessoa = null;
        try {
            int idPessoa = response.getInt("idPessoa");
            int nif= response.getInt("nif");
            int fk_IdUser= response.getInt("fk_IdUser");
            String nome = response.getString("nome");
            String morada = response.getString("morada");
            String tipoPessoa = response.getString("tipoPessoa");
            String dataNascimento = response.getString("dataNascimento");

            pessoa = new Pessoa(idPessoa, nif, fk_IdUser, nome, morada,tipoPessoa, dataNascimento);

        }
        catch(JSONException e) {
            e.printStackTrace();
        }

        return pessoa;
    }

    public static ArrayList<Pessoa> parserJsonPessoaArray(JSONArray response){
        ArrayList<Pessoa> listaPessoa = new ArrayList<>();
        try{
            for(int i = 0; i < response.length(); i++){

                JSONObject pessoa = (JSONObject) response.get(i);

                int idPessoa = pessoa.getInt("idPessoa");
                int nif= pessoa.getInt("nif");
                int fk_IdUser= pessoa.getInt("fk_IdUser");
                String nome = pessoa.getString("nome");
                String morada = pessoa.getString("morada");
                String tipoPessoa = pessoa.getString("tipoPessoa");
                String dataNascimento = pessoa.getString("dataNascimento");

                Pessoa pessoaAux = new Pessoa(idPessoa, nif, fk_IdUser, nome, morada,tipoPessoa, dataNascimento);

                listaPessoa.add(pessoaAux);
            }
        }catch (JSONException e){
            e.printStackTrace();
        }

        return listaPessoa;
    }
}
