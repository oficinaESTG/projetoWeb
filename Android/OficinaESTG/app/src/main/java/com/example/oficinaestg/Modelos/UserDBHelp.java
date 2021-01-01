package com.example.oficinaestg.Modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class UserDBHelp extends SQLiteOpenHelper {

    private static final int DB_VERSION = 1;
    private static final String BD_NAME = "OficinaBD";


    private final SQLiteDatabase sqLiteDatabase;

    private static final String TABLE_NAME = "User";

    private static final String id_USER = "id";
    private static final String status_USER = "status";
    private static final String created_at_USER = "created_at";
    private static final String updated_at_at_USER = "updated_at";
    private static final String username_USER = "username";
    private static final String auth_key_USER = "auth_key";
    private static final String email_USER = "email";
    private static final String password_hash_USER = "password_hash";
    private static final String password_reset_token_USER = "password_reset_token";
    private static final String verification_token_USER = "verification_token";
    private static final String password_USER = "password";


    private static final String TABLE_NAME_CARROVENDA = "CarroVenda";

    private static final String idCarro_CARRO = "idCarro";
    private static final String ano_CARRO = "ano";
    private static final String quilometros_CARRO = "quilometros";
    private static final String fk_idPessoa_CARRO = "fk_idPessoa";
    private static final String precoCarro_CARRO = "precoCarro";
    private static final String modeloCarro_CARRO = "modeloCarro";
    private static final String marcaCarro_CARRO = "marcaCarro";
    private static final String matricula_CARRO = "matricula";
    private static final String tipoCarro_CARRO = "tipoCarro";
    private static final String combustivel_CARRO = "combustivel";
    private static final String vendido_CARRO = "vendido";

    private static final String TABLE_NAME_MARCACAO = "Marcacao";

    private static final String idMarcacoes_MARCACAO = "idMarcacoes";
    private static final String fk_idPessoa_MARCACAO = "fk_idPessoa";
    private static final String fk_idCarro_MARCACAO = "fk_idCarro";
    private static final String fk_idResponsavel_MARCACAO = "fk_idResponsavel";
    private static final String valorFinal_MARCACAO = "valorFinal";
    private static final String horasTrabalho_MARCACAO = "horasTrabalho";
    private static final String tipoMarcacao_MARCACAO = "tipoMarcacao";
    private static final String dataMarcacao_MARCACAO = "dataMarcacao";
    private static final String descricaoMarcacao_MARCACAO = "descricaoMarcacao";
    private static final String estadoMarcacao_MARCACAO = "estadoMarcacao";
    private static final String descricaoFinal_MARCACAO = "descricaoFinal";


    private User user;

    public UserDBHelp(Context context) {
        super(context, BD_NAME, null, DB_VERSION);
        this.sqLiteDatabase = this.getReadableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createUserTable =
                "CREATE TABLE " + TABLE_NAME +
                        "( " + id_USER + " INTEGER NOT NULL, " +
                        status_USER + " INTEGER NOT NULL, " +
                        created_at_USER + " INTEGER NOT NULL, " +
                        updated_at_at_USER + " INTEGER NOT NULL, " +
                        username_USER + " TEXT NOT NULL, " +
                        auth_key_USER + " TEXT NOT NULL, " +
                        email_USER + " TEXT NOT NULL, " +
                        password_hash_USER + " TEXT NOT NULL, " +
                        password_reset_token_USER + " TEXT, " +
                        verification_token_USER + " TEXT NOT NULL, " +
                        password_USER + " TEXT NOT NULL" +
                        ");";
        db.execSQL(createUserTable);

        String createCarroTable =
                "CREATE TABLE " + TABLE_NAME_CARROVENDA +
                        "( " + idCarro_CARRO + " INTEGER NOT NULL, " +
                        ano_CARRO + " INTEGER NOT NULL, " +
                        quilometros_CARRO + " INTEGER NOT NULL, " +
                        fk_idPessoa_CARRO + " INTEGER NOT NULL, " +
                        precoCarro_CARRO + " INTEGER NOT NULL, " +
                        modeloCarro_CARRO + " TEXT NOT NULL, " +
                        marcaCarro_CARRO + " TEXT NOT NULL, " +
                        matricula_CARRO + " TEXT NOT NULL, " +
                        tipoCarro_CARRO + " TEXT, " +
                        combustivel_CARRO + " TEXT NOT NULL, " +
                        vendido_CARRO + " INTEGER NOT NULL" +
                        ");";
        db.execSQL(createCarroTable);

        String createMarcacaoTable =
                "CREATE TABLE " + TABLE_NAME_MARCACAO +
                        "( " + idMarcacoes_MARCACAO + " INTEGER NOT NULL, " +
                        fk_idPessoa_MARCACAO + " INTEGER NOT NULL, " +
                        fk_idCarro_MARCACAO + " INTEGER NOT NULL, " +
                        fk_idResponsavel_MARCACAO + " INTEGER, " +
                        valorFinal_MARCACAO + " INTEGER, " +
                        horasTrabalho_MARCACAO + " INTEGER, " +
                        tipoMarcacao_MARCACAO + " TEXT NOT NULL, " +
                        dataMarcacao_MARCACAO + " TEXT NOT NULL, " +
                        descricaoMarcacao_MARCACAO + " TEXT, " +
                        estadoMarcacao_MARCACAO + " TEXT NOT NULL, " +
                        descricaoFinal_MARCACAO + " TEXT" +
                        ");";
        db.execSQL(createMarcacaoTable);

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        sqLiteDatabase.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        this.onCreate(sqLiteDatabase);
    }

    //MARCACAO

    public void adicionarMarcacaoBD(Marcacao marcacao) {
        ContentValues values = new ContentValues();

        values.put(idMarcacoes_MARCACAO, marcacao.getIdMarcacoes());
        values.put(fk_idPessoa_MARCACAO, marcacao.getFk_idPessoa());
        values.put(fk_idCarro_MARCACAO, marcacao.getFk_idCarro());
        values.put(fk_idResponsavel_MARCACAO, marcacao.getFk_idResponsavel());
        values.put(valorFinal_MARCACAO, marcacao.getValorFinal());
        values.put(horasTrabalho_MARCACAO, marcacao.getHorasTrabalho());
        values.put(tipoMarcacao_MARCACAO, marcacao.getTipoMarcacao());
        values.put(dataMarcacao_MARCACAO, marcacao.getDataMarcacao());
        values.put(descricaoMarcacao_MARCACAO, marcacao.getDescricaoMarcacao());
        values.put(estadoMarcacao_MARCACAO, marcacao.getEstadoMarcacao());
        values.put(descricaoFinal_MARCACAO, marcacao.getDescricaoFinal());

        this.sqLiteDatabase.insert(TABLE_NAME_MARCACAO, null, values);
    }

    public void removerAllMarcacoesBD() {
        this.sqLiteDatabase.delete(TABLE_NAME_MARCACAO, null, null);
    }

    public ArrayList<Marcacao> getAllMarcacoes(int id) {
        //falta fazer a condição de filtração de marcações do user
        String queryStringMarcacao = "(" + fk_idPessoa_MARCACAO + " = '" + id + "')";

        ArrayList<Marcacao> marcacoes = new ArrayList<>();
        Cursor cursor = this.sqLiteDatabase.query(TABLE_NAME_MARCACAO, new String[]{
                idMarcacoes_MARCACAO, fk_idPessoa_MARCACAO, fk_idCarro_MARCACAO, fk_idResponsavel_MARCACAO, valorFinal_MARCACAO,
                horasTrabalho_MARCACAO, tipoMarcacao_MARCACAO, dataMarcacao_MARCACAO, descricaoMarcacao_MARCACAO, estadoMarcacao_MARCACAO, descricaoFinal_MARCACAO}, queryStringMarcacao, null, null, null, null, null);
        if (cursor.moveToFirst()) {
            do {
                Marcacao auxMarcacao = new Marcacao(cursor.getInt(0), cursor.getInt(1), cursor.getInt(2), cursor.getInt(3), cursor.getInt(4), cursor.getInt(5),
                        cursor.getString(6), cursor.getString(7), cursor.getString(8), cursor.getString(9), cursor.getString(10));
                marcacoes.add(auxMarcacao);
            } while (cursor.moveToNext());
        }
        return marcacoes;
    }


    //USER
    public void adicionarUserBD(User user) {
        ContentValues values = new ContentValues();

        values.put(id_USER, user.getId());
        values.put(status_USER, user.getStatus());
        values.put(created_at_USER, user.getCreated_at());
        values.put(updated_at_at_USER, user.getUpdated_at());
        values.put(username_USER, user.getUsername());
        values.put(auth_key_USER, user.getAuth_key());
        values.put(email_USER, user.getEmail());
        values.put(password_hash_USER, user.getPassword_hash());
        values.put(password_reset_token_USER, user.getPassword_reset_token());
        values.put(verification_token_USER, user.getVerification_token());
        values.put(password_USER, user.getPassword());

        this.sqLiteDatabase.insert(TABLE_NAME, null, values);
    }

    public void removerAllUserBD() {
        this.sqLiteDatabase.delete(TABLE_NAME, null, null);
    }

    public User getUserBDbyNome(String email, String password) {

        String queryString = "(" + username_USER + " = '" + email + "') AND (" + password_USER + " = '" + password + "')";

        Cursor cursor = this.sqLiteDatabase.query(TABLE_NAME, new String[]{
                        id_USER, status_USER, created_at_USER, updated_at_at_USER, username_USER, auth_key_USER, email_USER, password_hash_USER, password_reset_token_USER, verification_token_USER, password_USER},
                queryString, null, null, null, null);
        if (cursor != null)
            cursor.moveToFirst();

        try {
            User auxUser = new User(cursor.getInt(0),
                    cursor.getInt(1),
                    cursor.getString(4),
                    cursor.getString(5),
                    cursor.getString(6),
                    cursor.getInt(2),
                    cursor.getInt(3),
                    cursor.getString(7),
                    cursor.getString(8),
                    cursor.getString(9),
                    cursor.getString(10));
            return auxUser;
        } catch (Exception e) {
            //ver com professor
            return null;
        }
    }



    //CARRO
    public void adicionarCarroVendaBD(Carro carro) {
        ContentValues values = new ContentValues();

        values.put(idCarro_CARRO, carro.getIdCarro());
        values.put(ano_CARRO, carro.getAno());
        values.put(quilometros_CARRO, carro.getQuilometros());
        values.put(fk_idPessoa_CARRO, carro.getFk_idPessoa());
        values.put(precoCarro_CARRO, carro.getPrecoCarro());
        values.put(modeloCarro_CARRO, carro.getModeloCarro());
        values.put(marcaCarro_CARRO, carro.getMarcaCarro());
        values.put(matricula_CARRO, carro.getMatricula());
        values.put(tipoCarro_CARRO, carro.getTipoCarro());
        values.put(combustivel_CARRO, carro.getCombustivel());
        values.put(vendido_CARRO, carro.getVendido());

        this.sqLiteDatabase.insert(TABLE_NAME_CARROVENDA, null, values);
    }

    public void removerAllCarroVendaBD() {
        String queryString = "(" + tipoCarro_CARRO + " = 'Venda')";
        this.sqLiteDatabase.delete(TABLE_NAME_CARROVENDA, queryString, null);
    }

    public void removerAllCarroPessoalBD() {
        String queryString = "(" + tipoCarro_CARRO + " = 'Reparacao')";
        this.sqLiteDatabase.delete(TABLE_NAME_CARROVENDA, queryString, null);
    }

    public ArrayList<Carro> getAllCarrosVendaBD() {
        String queryString = "(" + tipoCarro_CARRO + " = 'Venda')";

        ArrayList<Carro> carros = new ArrayList<>();
        Cursor cursor = this.sqLiteDatabase.query(TABLE_NAME_CARROVENDA, new String[]{
                        idCarro_CARRO, ano_CARRO, quilometros_CARRO, fk_idPessoa_CARRO, precoCarro_CARRO, modeloCarro_CARRO, marcaCarro_CARRO, matricula_CARRO, tipoCarro_CARRO, combustivel_CARRO, vendido_CARRO},
                queryString, null, null, null, null);
        if (cursor.moveToFirst()) {
            do {
                Carro auxCarro = new Carro(cursor.getInt(0), cursor.getInt(1), cursor.getInt(2), cursor.getInt(3), cursor.getInt(4), cursor.getString(5),
                        cursor.getString(6), cursor.getString(7), cursor.getString(8), cursor.getString(9), cursor.getInt(10));
                carros.add(auxCarro);
            } while (cursor.moveToNext());
        }
        return carros;
    }

    public ArrayList<Carro> getAllCarrosPessoaBD(int idUser) {
        String queryString = "(" + fk_idPessoa_CARRO + " = '" + idUser + "')";

        ArrayList<Carro> carros = new ArrayList<>();
        Cursor cursor = this.sqLiteDatabase.query(TABLE_NAME_CARROVENDA, new String[]{
                        idCarro_CARRO, ano_CARRO, quilometros_CARRO, fk_idPessoa_CARRO, precoCarro_CARRO, modeloCarro_CARRO, marcaCarro_CARRO, matricula_CARRO, tipoCarro_CARRO, combustivel_CARRO, vendido_CARRO},
                queryString, null, null, null, null);
        if (cursor.moveToFirst()) {
            do {
                Carro auxCarro = new Carro(cursor.getInt(0), cursor.getInt(1), cursor.getInt(2), cursor.getInt(3), cursor.getInt(4), cursor.getString(5),
                        cursor.getString(6), cursor.getString(7), cursor.getString(8), cursor.getString(9), cursor.getInt(10));
                carros.add(auxCarro);
            } while (cursor.moveToNext());
        }
        return carros;
    }

    public String getNomeCarro(int idCarro) {
        //String queryString = "(" + idCarro_CARRO + " = '" + idCarro + "')";

        Cursor cursor = sqLiteDatabase.rawQuery("SELECT " + modeloCarro_CARRO + " FROM " + TABLE_NAME_CARROVENDA + " WHERE idCarro = '" + idCarro + "'", null);
        cursor.moveToFirst();
        int pos = cursor.getPosition();

        return cursor.getString(pos);
    }

    public int getIdCarro(String nomeCarro){
        //String queryString = "(" + modeloCarro_CARRO + " = '" + nomeCarro + "')";

        Cursor cursor = sqLiteDatabase.rawQuery("SELECT " + idCarro_CARRO + " FROM " + TABLE_NAME_CARROVENDA + " WHERE modeloCarro LIKE '" + nomeCarro + "'", null);
        cursor.moveToFirst();


        return Integer.parseInt(cursor.getString(0));
    }
}
