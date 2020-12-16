package com.example.oficinaestg.Vistas;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;

public class RegistoActivity extends AppCompatActivity {

    private EditText et_rUsername;
    private EditText et_rPassword;
    private EditText et_rEmail;
    private EditText et_rNome;
    private EditText et_rDataNascimento;
    private EditText et_rMorada;
    private EditText et_rNIF;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registo);


        et_rUsername= findViewById(R.id.et_rUsername);
        et_rPassword=findViewById(R.id.et_rPassword);
        et_rEmail=findViewById(R.id.et_rEmail);
        et_rNome=findViewById(R.id.et_rNome);
        et_rDataNascimento=findViewById(R.id.et_rDataNascimento);
        et_rMorada=findViewById(R.id.et_rMorada);
        et_rNIF=findViewById(R.id.et_rNIF);

    }

    public void onClickRegistar(View view) {

        String username = et_rUsername.getText().toString();
        String password = et_rPassword.getText().toString();
        String email = et_rEmail.getText().toString();
        String nome = et_rNome.getText().toString();
        String dataNascimento = et_rDataNascimento.getText().toString();
        String morada = et_rMorada.getText().toString();
        String nif = et_rNIF.getText().toString();

        LoginSingleton.getInstance(getApplicationContext()).registarPessoaAPI(username, password, email, nome, dataNascimento, morada, nif, getApplicationContext());


    }
}