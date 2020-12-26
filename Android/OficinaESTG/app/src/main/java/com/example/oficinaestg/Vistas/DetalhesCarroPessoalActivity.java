package com.example.oficinaestg.Vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;

public class DetalhesCarroPessoalActivity extends AppCompatActivity {

    public static final String DETALHES_CARROPESSOAL = "carro";

    private int idCarro;
    private Carro carro;

    private TextView etMarca, etModelo, etQuilometros, etAno, etCombustivel, etMatricula;
    private Button botao;

    String marca, modelo, matricula, combustivel;
    int ano, quilometros;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_carro_pessoal);

        idCarro =getIntent().getIntExtra(DETALHES_CARROPESSOAL, 0);
        carro = LoginSingleton.getInstance(getApplicationContext()).getCarro(idCarro);

        etMarca = findViewById(R.id.et_Marca_tx);
        etModelo = findViewById(R.id.et_Modelo_tx);
        etQuilometros = findViewById(R.id.et_Quilometros_tx);
        etAno = findViewById(R.id.et_Ano_tx);
        etCombustivel = findViewById(R.id.et_Combustivel_tx);
        etMatricula = findViewById(R.id.et_Matricula_tx);
        botao = findViewById(R.id.btnGravar);


        if(carro != null){

            setTitle("Detalhes:" + carro.getMatricula());

            etMarca.setText(carro.getMarcaCarro());
            etModelo.setText(carro.getModeloCarro());
            etQuilometros.setText(""+carro.getQuilometros());
            etAno.setText(""+carro.getAno());
            etCombustivel.setText(carro.getCombustivel());
            etMatricula.setText(carro.getMatricula());
            botao.setText("Alterar");

        }else{
            setTitle("Adicionar Carro");
            botao.setText("Adicionar");
        }
    }

    public void btnGuardar_onClick(View view) {
        if(carro != null) {

            marca = etMarca.getText().toString();
            modelo = etModelo.getText().toString();
            quilometros = Integer.parseInt(etQuilometros.getText().toString());
            ano = Integer.parseInt(etAno.getText().toString());
            combustivel = etCombustivel.getText().toString();
            matricula = etMatricula.getText().toString();

            Carro carros = new Carro(carro.getIdCarro() ,ano, quilometros, 0, 0, modelo, marca, matricula, null, combustivel,0 );
            LoginSingleton.getInstance(getApplicationContext()).alterarCarroPessoalAPI(carros, getApplicationContext());

        }else{
            marca = etMarca.getText().toString();
            modelo = etModelo.getText().toString();
            quilometros = Integer.parseInt(etQuilometros.getText().toString());
            ano = Integer.parseInt(etAno.getText().toString());
            combustivel = etCombustivel.getText().toString();
            matricula = etMatricula.getText().toString();

            Carro carros = new Carro(0,ano, quilometros, 0, 0, modelo, marca, matricula, null, combustivel,0 );
            LoginSingleton.getInstance(getApplicationContext()).guardarCarroPessoalAPI(carros, getApplicationContext());
        }

    }
}