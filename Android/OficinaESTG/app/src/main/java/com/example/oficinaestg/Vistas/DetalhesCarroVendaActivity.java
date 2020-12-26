package com.example.oficinaestg.Vistas;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;

public class DetalhesCarroVendaActivity extends AppCompatActivity {

    public static final String DETALHES_CARROVENDA = "carro";

    private int idCarro;
    private Carro carro;

    private TextView etMarca, etModelo, etQuilometros, etAno, etCombustivel, etMatricula, etPreco, etData, etNota;
    private String Data, Nota, Carro;


    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_carro_venda);

        idCarro =getIntent().getIntExtra(DETALHES_CARROVENDA, 0);
        carro = LoginSingleton.getInstance(getApplicationContext()).getCarro(idCarro);

        etMarca = findViewById(R.id.tv_marca_tx_view);
        etModelo = findViewById(R.id.tv_modelo_tx_view);
        etQuilometros = findViewById(R.id.tv_quilometros_tx_view);
        etAno = findViewById(R.id.tv_ano_tx_view);
        etCombustivel = findViewById(R.id.tv_combustivel_tx_view);
        etMatricula = findViewById(R.id.tv_matricula_tx_view);
        etPreco = findViewById(R.id.tv_preco_tx_view);

        if(carro != null){

            setTitle("Detalhes:" + carro.getMatricula());

            etMarca.setText(carro.getMarcaCarro());
            etModelo.setText(carro.getModeloCarro());
            etQuilometros.setText(""+carro.getQuilometros());
            etAno.setText(""+carro.getAno());
            etCombustivel.setText(carro.getCombustivel());
            etMatricula.setText(carro.getMatricula());
            etPreco.setText(""+carro.getPrecoCarro()+"€");

        }else{
            setTitle("Erro");
        }
    }

    public void marcarvistoria_onClick(View view) {

        etData= findViewById(R.id.et_venda_data);
        etNota= findViewById(R.id.et_venda_notas);

        Data = etData.getText().toString();
        Nota = etNota.getText().toString();
        Carro = ""+carro.getIdCarro();

        if (Data != null && Nota != null){
            LoginSingleton.getInstance(getApplicationContext()).guardarVistoriaMarcacaoAPI(Data, Nota, Carro, getApplicationContext());
        }
    }
}