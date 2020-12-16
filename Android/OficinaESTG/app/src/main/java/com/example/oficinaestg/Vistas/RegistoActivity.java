package com.example.oficinaestg.Vistas;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.oficinaestg.Listeners.RegistoListener;
import com.example.oficinaestg.Modelos.Pessoa;
import com.example.oficinaestg.Modelos.User;
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


    private Pessoa pessoa;
    private User user;

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
        int nif = Integer.parseInt(et_rNIF.getText().toString());


        pessoa = new Pessoa(0, nif, 0, nome, morada, null, dataNascimento);
        user = new User(0, 0, username, null, email, 0, 0, null, null, null, password);

        LoginSingleton.getInstance(getApplicationContext()).registarPessoaAPI(pessoa, user, getApplicationContext(), new RegistoListener() {
            @Override
            public void onSuccess(boolean sucesso) {
                Toast.makeText(getApplicationContext(), "Registou com sucesso", Toast.LENGTH_SHORT).show();
            }
        });


    }
}