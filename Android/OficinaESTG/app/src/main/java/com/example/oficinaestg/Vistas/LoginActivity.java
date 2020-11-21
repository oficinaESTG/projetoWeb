package com.example.oficinaestg.Vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;

import com.example.oficinaestg.R;

public class LoginActivity extends AppCompatActivity {

    //declaração dos objetos
    private EditText edit_login;
    private EditText edit_password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        edit_login= findViewById(R.id.edit_email);
        edit_password=findViewById(R.id.edit_password);
    }

    public void onClickLogin(View view) {
        String email = edit_login.getText().toString();
        String password = edit_password.getText().toString();

        //Para testes não verifica
        /*if (!isEmailValido(email)){z
            edit_login.setError(getString(R.string.email_invalido));
            return;
        }
        if (!isPasswordValida(password)){
            edit_password.setError(getString(R.string.password_invalida));
            return;
        }*/

        Intent intent = new Intent(this, MenuMainActivity.class);
        intent.putExtra(MenuMainActivity.EMAIL_GESS,email);
        startActivity(intent);
    }

    // verifica o email se é válido
    private boolean isEmailValido(String email){
        if (email==null){
            return false;
        }
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }
    //verifica se a password tem no minimo 4 caracteres
    private boolean isPasswordValida(String password){
        if (password==null){
            return false;
        }
        return password.length()>=4;
    }
}