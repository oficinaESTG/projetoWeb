package com.example.oficinaestg.Vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.example.oficinaestg.Listeners.LoginListener;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;

import org.json.JSONObject;

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

        LoginSingleton.getInstance(getApplicationContext()).loginAPI(email, password, getApplicationContext(), new LoginListener() {
            @Override
            public void onSuccess(User user) {
                System.out.println("A-->"+user);

                if (user != null){
                    main(view, user.getEmail());
                }else{
                    Toast.makeText(getApplicationContext(), "Login não efetuado", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    public void main (View view, String email){
        Intent intent = new Intent(this, MenuMainActivity.class);
        intent.putExtra(MenuMainActivity.EMAIL_GESS,email);
        startActivity(intent);
    }
}