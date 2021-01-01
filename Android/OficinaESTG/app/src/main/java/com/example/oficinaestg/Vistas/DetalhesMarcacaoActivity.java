package com.example.oficinaestg.Vistas;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
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

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Locale;

public class DetalhesMarcacaoActivity extends AppCompatActivity {

    public static final String DETALHES_MARCACAO = "marcacao";
    public static final String DETALHES_USER = "user";
    private int idUser, idMarcacao, idCarro;
    final Calendar myCalendar = Calendar.getInstance();

    private Spinner spinner_carro;
    private Button botao;
    private TextView et_data, et_descricao, et_preco, et_descricaoFinal, et_horasTrabalho, et_carro, et_estado, et_tipo, v_data, v_descricao, v_preco, v_descricaoFinal, v_horasTrabalho, v_carroSpinner, v_carro, v_estado, v_tipo;
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

        v_data = findViewById(R.id.tv_data_view);
        v_descricao = findViewById(R.id.tv_descricao_view);
        v_carroSpinner = findViewById(R.id.tv_carro_view);
        v_carro = findViewById(R.id.tv_carro_view2);
        v_estado = findViewById(R.id.tv_estado_view);
        v_preco = findViewById(R.id.tv_preco_view);
        v_tipo = findViewById(R.id.tv_tipo_view);
        v_descricaoFinal = findViewById(R.id.tv_descricaoTrabalho_view);
        v_horasTrabalho = findViewById(R.id.tv_horasTrabalhadas_view);


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

        spinner_carro.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                Carro carro = (Carro) parent.getSelectedItem();
                idCarro = LoginSingleton.getInstance(getApplicationContext()).getIdCarroPorNome(carro.getModeloCarro());
                System.out.println("-->"+idCarro);
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });

        DatePickerDialog.OnDateSetListener date = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int monthOfYear, int dayOfMonth) {
                myCalendar.set(Calendar.YEAR, year);
                myCalendar.set(Calendar.MONTH, monthOfYear);
                myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                updateLabel();
            }
        };

        et_data.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new DatePickerDialog(DetalhesMarcacaoActivity.this, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show();
            }
        });


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

                et_data.setClickable(false);
                et_data.setEnabled(false);
                et_descricao.setClickable(false);
                et_descricao.setEnabled(false);
                et_carro.setClickable(false);
                et_carro.setEnabled(false);
                et_estado.setClickable(false);
                et_estado.setEnabled(false);
                et_tipo.setClickable(false);
                et_tipo.setEnabled(false);

                et_preco.setClickable(false);
                et_preco.setEnabled(false);
                et_descricaoFinal.setClickable(false);
                et_descricaoFinal.setEnabled(false);
                et_horasTrabalho.setClickable(false);
                et_horasTrabalho.setEnabled(false);

                spinner_carro.setVisibility(View.GONE);
                v_carroSpinner.setVisibility(View.GONE);
                botao.setVisibility(View.GONE);

            }else {

                et_data.setText(marcacao.getDataMarcacao());
                et_descricao.setText(marcacao.getDescricaoMarcacao());
                et_carro.setText(LoginSingleton.getInstance(getApplicationContext()).getNomeCarroPorID(marcacao.getFk_idCarro()));
                et_estado.setText(marcacao.getEstadoMarcacao());
                et_tipo.setText(marcacao.getTipoMarcacao());

                et_data.setClickable(false);
                et_data.setEnabled(false);
                et_descricao.setClickable(false);
                et_descricao.setEnabled(false);
                et_carro.setClickable(false);
                et_carro.setEnabled(false);
                et_estado.setClickable(false);
                et_estado.setEnabled(false);
                et_tipo.setClickable(false);
                et_tipo.setEnabled(false);

                et_preco.setVisibility(View.GONE);
                et_descricaoFinal.setVisibility(View.GONE);
                et_horasTrabalho.setVisibility(View.GONE);
                spinner_carro.setVisibility(View.GONE);
                v_preco.setVisibility(View.GONE);
                v_descricaoFinal.setVisibility(View.GONE);
                v_horasTrabalho.setVisibility(View.GONE);
                v_carroSpinner.setVisibility(View.GONE);
                botao.setVisibility(View.GONE);
            }


        }else{
            setTitle("Criar Marcação: ");

            et_data.setFocusable(false);
           et_carro.setVisibility(View.GONE);
           et_estado.setVisibility(View.GONE);
            et_tipo.setVisibility(View.GONE);
            et_preco.setVisibility(View.GONE);
            et_descricaoFinal.setVisibility(View.GONE);
            et_horasTrabalho.setVisibility(View.GONE);

            v_carro.setVisibility(View.GONE);
            v_estado.setVisibility(View.GONE);
            v_tipo.setVisibility(View.GONE);
            v_preco.setVisibility(View.GONE);
            v_descricaoFinal.setVisibility(View.GONE);
            v_horasTrabalho.setVisibility(View.GONE);

            botao.setText("Gravar");
        }

        if (!net){
            botao.setVisibility(View.INVISIBLE);
        }
    }

    public void btnGuardar_onClick(View view) {

        int carro = idCarro;

        if(et_data.length() == 0){
            et_data.setError("Introduza uma Data");
        }else if(et_descricao.length() == 0){
            et_descricao.setError("Introduza uma Descrição");
        }else{
            String data = et_data.getText().toString();
            String descricao = et_descricao.getText().toString();


            Marcacao marcacao = new Marcacao(0, 0, carro, 0, 0, 0,null, data, descricao, null, null );
            LoginSingleton.getInstance(getApplicationContext()).adicionarMarcacaoAPI(marcacao, getApplicationContext());
            finish();
        }




    }

    private void updateLabel() {
        String myFormat = "yyyy-MM-dd"; //In which you need put here
        SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.UK);

        et_data.setText(sdf.format(myCalendar.getTime()));
    }



}