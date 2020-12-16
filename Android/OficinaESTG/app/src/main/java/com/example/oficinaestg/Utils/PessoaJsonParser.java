package com.example.oficinaestg.Utils;

import android.content.Context;

import com.example.oficinaestg.Modelos.Pessoa;

import org.json.JSONException;
import org.json.JSONObject;

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
}
