package com.example.oficinaestg.Vistas;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.oficinaestg.Listeners.RegistoListener;
import com.example.oficinaestg.Modelos.Pessoa;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class RegistoActivity extends AppCompatActivity {

    private EditText et_rUsername;
    private EditText et_rPassword;
    private EditText et_rEmail;
    private EditText et_rNome;
    private EditText et_rDataNascimento;
    private EditText et_rMorada;
    private EditText et_rNIF;
    final Calendar myCalendar = Calendar.getInstance();


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
        et_rDataNascimento.setFocusable(false);

        DatePickerDialog.OnDateSetListener date = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int monthOfYear, int dayOfMonth) {
                myCalendar.set(Calendar.YEAR, year);
                myCalendar.set(Calendar.MONTH, monthOfYear);
                myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                updateLabel();
            }
        };

        et_rDataNascimento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new DatePickerDialog(RegistoActivity.this, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show();
            }
        });

    }

    public void onClickRegistar(View view) {

        if(et_rUsername.length() == 0){
            et_rUsername.setError("Introduza uma Data");
        }else if(et_rPassword.length() == 0){
            et_rPassword.setError("Introduza uma Password");
        }else if(et_rEmail.length() == 0 || !isEmailValid(et_rEmail.getText().toString())) {
            et_rEmail.setError("Introduza um Email Válido");
        }else if (et_rNome.length() == 0){
            et_rNome.setError("Introduza um Nome");
        }else if (et_rMorada.length() == 0){
            et_rMorada.setError("Introduza uma Morada");
        } else if (et_rNIF.length() <= 8 || et_rNIF.length() > 9){
            et_rNIF.setError("Introduza um NIF válido (9 carateres)");
        }else{

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
                    main(view);
                }
            });
        }




    }

    public void main (View view){
        Intent intent = new Intent(this, LoginActivity.class);
        startActivity(intent);
    }

    public static boolean isEmailValid(String email) {
        String expression = "^[\\w\\.-]+@([\\w\\-]+\\.)+[A-Z]{2,4}$";
        Pattern pattern = Pattern.compile(expression, Pattern.CASE_INSENSITIVE);
        Matcher matcher = pattern.matcher(email);
        return matcher.matches();
    }

    private void updateLabel() {
        String myFormat = "yyyy-MM-dd"; //In which you need put here
        SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.UK);

        et_rDataNascimento.setText(sdf.format(myCalendar.getTime()));
    }
}