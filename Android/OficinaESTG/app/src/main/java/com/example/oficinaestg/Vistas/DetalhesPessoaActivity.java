package com.example.oficinaestg.Vistas;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.oficinaestg.Modelos.Pessoa;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;
import com.example.oficinaestg.Utils.UserJsonParser;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

public class DetalhesPessoaActivity extends AppCompatActivity{

    private TextView et_Nome, et_Email, et_dataNasc, et_Morada, et_Nif;
    private Button btn_Gravar;
    final Calendar myCalendar = Calendar.getInstance();
    private Pessoa pessoa;
    private User user;
    String nome, email, dataNasc, morada;
    int nif;

    boolean net;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_pessoa);

        et_Nome = findViewById(R.id.et_Pnome_tx);
        et_Email = findViewById(R.id.et_Pemail_tx);
        et_dataNasc = findViewById(R.id.et_PdataNascimento_tx);
        et_Morada = findViewById(R.id.et_Pmorada_tx);
        et_Nif = findViewById(R.id.et_Pnif_tx);
        btn_Gravar = findViewById(R.id.btnGravarPessoa);

        DatePickerDialog.OnDateSetListener date = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int monthOfYear, int dayOfMonth) {
                myCalendar.set(Calendar.YEAR, year);
                myCalendar.set(Calendar.MONTH, monthOfYear);
                myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                updateLabel();
            }
        };

        et_dataNasc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new DatePickerDialog(DetalhesPessoaActivity.this, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show();
            }
        });

        net = UserJsonParser.isConnectionInternet(getApplicationContext());

        LoginSingleton.getInstance(getApplicationContext()).getPessoaAPI(getApplicationContext(), net);
        user = LoginSingleton.getInstance(getApplicationContext()).getUserBD();
        pessoa = LoginSingleton.getInstance(getApplicationContext()).getPessoaBD(user.getId());

        if(pessoa != null) {
            setTitle("Detalhes: " + pessoa.getNome());

            et_Nome.setText(pessoa.getNome());
            et_Email.setText(user.getEmail());
            et_dataNasc.setText(pessoa.getDataNascimento());
            et_Morada.setText(pessoa.getMorada());
            et_Nif.setText(""+pessoa.getNif());
            btn_Gravar.setText("Atualizar");

            et_dataNasc.setFocusable(false);
            et_Email.setClickable(false);
            et_Email.setEnabled(false);


        }

    }

    public void onClickButton(View view) {

        nome = et_Nome.getText().toString();
        email = et_Email.getText().toString();
        dataNasc = et_dataNasc.getText().toString();
        morada = et_Morada.getText().toString();
        nif =Integer.parseInt(et_Nif.getText().toString());


        Pessoa pessoas = new Pessoa(0, nif, 0, nome, morada, null, dataNasc);
        LoginSingleton.getInstance(getApplicationContext()).atualizarPessoaPerfilAPI(pessoas, getApplicationContext());
        finish();

    }

    private void updateLabel() {
        String myFormat = "yyyy-MM-dd"; //In which you need put here
        SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.UK);

        et_dataNasc.setText(sdf.format(myCalendar.getTime()));
    }

}

