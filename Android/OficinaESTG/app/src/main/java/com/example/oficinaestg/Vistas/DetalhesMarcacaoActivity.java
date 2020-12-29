package com.example.oficinaestg.Vistas;

import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Modelos.UserDBHelp;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;
import com.example.oficinaestg.Utils.UserJsonParser;

import java.util.ArrayList;

public class DetalhesMarcacaoActivity extends AppCompatActivity {

    public static final String DETALHES_MARCACAO = "marcacao";
    public static final String DETALHES_USER = "user";
    private int idUser, idMarcacao;

    private Spinner spinner_carro;
    private Button botao;
    private TextView et_data, et_descricao, et_preco, et_descricaoFinal, et_horasTrabalho, et_carro, et_estado, et_tipo ;
    private UserDBHelp bdHelper;
    private User user;
    private Marcacao marcacao;
    String nomeCarros[];
    int valoresCarros[];

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_marcacao);

        et_data = findViewById(R.id.et_data_tx);
        et_descricao = findViewById(R.id.et_descricao_tx);
        spinner_carro = findViewById(R.id.spinner_carro);
        et_estado = findViewById(R.id.et_estado_tx);
        et_carro = findViewById(R.id.et_carro_tx);
        et_preco = findViewById(R.id.et_preco_tx);
        et_tipo = findViewById(R.id.et_tipo_tx);
        et_descricaoFinal = findViewById(R.id.et_descricaoTrabalho_tx);
        et_horasTrabalho = findViewById(R.id.et_horasTrabalhadas_tx);

        botao = findViewById(R.id.btnGravar);

        //ter o id do user quando clico no fabAdicionar
        idUser = getIntent().getIntExtra(DETALHES_USER, 0);

        //obter idMarcação ao clicar na marcacão na página da lista de marcações
        idMarcacao =getIntent().getIntExtra(DETALHES_MARCACAO, 0);
        marcacao = LoginSingleton.getInstance(getApplicationContext()).getMarcacao(idMarcacao);

        //preencher dropdown
        ArrayList<Carro> carros = LoginSingleton.getInstance(getApplicationContext()).getCarroPessoal(idUser);
       ArrayAdapter<Carro> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item, carros);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner_carro.setAdapter(adapter);

        boolean net = UserJsonParser.isConnectionInternet(getApplicationContext());


        if(marcacao != null){

            setTitle("Detalhes da Marcação:");

            if(marcacao.getEstadoMarcacao().toString().equals("Concluida")){

                et_data.setText(marcacao.getDataMarcacao());
                et_descricao.setText(marcacao.getDescricaoMarcacao());
                et_carro.setText(LoginSingleton.getInstance(getApplicationContext()).getNomeCarroPorID(marcacao.getFk_idCarro()));
                et_estado.setText(marcacao.getEstadoMarcacao());
                et_tipo.setText(marcacao.getTipoMarcacao());
                et_preco.setText(""+marcacao.getValorFinal());
                et_descricaoFinal.setText(marcacao.getDescricaoFinal());
                et_horasTrabalho.setText(""+marcacao.getHorasTrabalho());

                et_data.setFocusable(false);
                et_descricao.setFocusable(false);
                et_carro.setFocusable(false);
                et_estado.setFocusable(false);
                et_tipo.setFocusable(false);
                et_preco.setFocusable(false);
                et_descricaoFinal.setFocusable(false);
                et_horasTrabalho.setFocusable(false);
                spinner_carro.setVisibility(View.INVISIBLE);

            }else {
                et_data.setText(marcacao.getDataMarcacao());
                et_descricao.setText(marcacao.getDescricaoMarcacao());
                et_carro.setText(LoginSingleton.getInstance(getApplicationContext()).getNomeCarroPorID(marcacao.getFk_idCarro()));
                et_estado.setText(marcacao.getEstadoMarcacao());
                et_tipo.setText(marcacao.getTipoMarcacao());

                et_data.setFocusable(false);
                et_descricao.setFocusable(false);
                et_carro.setFocusable(false);
                et_estado.setFocusable(false);
                et_tipo.setFocusable(false);

                et_preco.setVisibility(View.INVISIBLE);
                et_descricaoFinal.setVisibility(View.INVISIBLE);
                et_horasTrabalho.setVisibility(View.INVISIBLE);

            }


        }else{
            setTitle("Criar Marcação: ");
            et_estado.setVisibility(View.INVISIBLE);
            et_tipo.setVisibility(View.INVISIBLE);
            et_preco.setVisibility(View.INVISIBLE);
            et_descricaoFinal.setVisibility(View.INVISIBLE);
            et_horasTrabalho.setVisibility(View.INVISIBLE);
            botao.setText("Gravar");
        }

        if (!net){
            botao.setVisibility(View.INVISIBLE);
        }
    }

    public void btnGuardar_onClick(View view) {


        String data = et_data.getText().toString();
        String descricao = et_descricao.getText().toString();


    }



}