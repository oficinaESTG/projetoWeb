package com.example.oficinaestg.Vistas;

import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Modelos.UserDBHelp;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;

import java.util.ArrayList;

public class DetalhesMarcacaoActivity extends AppCompatActivity {

    public static final String DETALHES_MARCACAO = "marcacao";
    public static final String DETALHES_USER = "user";
    private int idUser;
    private Spinner spinner_carro;
    private TextView et_data, et_descricao;
    private UserDBHelp carrosPessoa;
    private User user;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_marcacao);

        idUser = getIntent().getIntExtra(DETALHES_USER, 0);
        user = LoginSingleton.getInstance(getApplicationContext()).getUser(idUser);

        et_data = findViewById(R.id.et_data_tx);
        et_descricao = findViewById(R.id.et_descricao_tx);
        spinner_carro = findViewById(R.id.spinner_carro);

        ArrayList<Carro> carros = new ArrayList<>();
        carros = carrosPessoa.getAllCarrosPessoaBD(user.getId());

        ArrayAdapter<Carro> adapter = new ArrayAdapter<Carro>(this, android.R.layout.simple_spinner_item, carros);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        spinner_carro.setAdapter(adapter);
    }

    public void btnGuardar_onClick(View view) {


        String data = et_data.getText().toString();
        String descricao = et_descricao.getText().toString();



    }
}