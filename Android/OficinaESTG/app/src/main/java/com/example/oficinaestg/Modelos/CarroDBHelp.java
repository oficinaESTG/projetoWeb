package com.example.oficinaestg.Modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class CarroDBHelp extends SQLiteOpenHelper {

    private static final int DB_VERSION = 1;
    private static final String BD_NAME = "OficinaBD";
    private static final String TABLE_NAME_CARROVENDA = "CarroVenda";

    private static final String idCarro_CARRO= "idCarro";
    private static final String ano_CARRO= "ano";
    private static final String quilometros_CARRO= "quilometros";
    private static final String fk_idPessoa_CARRO= "fk_idPessoa";
    private static final String precoCarro_CARRO= "precoCarro";
    private static final String modeloCarro_CARRO= "modeloCarro";
    private static final String marcaCarro_CARRO= "marcaCarro";
    private static final String matricula_CARRO= "matricula";
    private static final String tipoCarro_CARRO= "tipoCarro";
    private static final String combustivel_CARRO= "combustivel";
    private static final String vendido_CARRO= "vendido";

    private final SQLiteDatabase sqLiteDatabase;

    public CarroDBHelp( Context context) {
        super(context, BD_NAME, null, DB_VERSION);
        this.sqLiteDatabase = this.getReadableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createLivroTable =
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
        db.execSQL(createLivroTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        sqLiteDatabase.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME_CARROVENDA);
        this.onCreate(sqLiteDatabase);
    }

    public void adicionarCarroVendaBD(Carro carro){
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

    public void removerAllCarroVendaBD(){
        this.sqLiteDatabase.delete(TABLE_NAME_CARROVENDA, null, null);
    }

    public ArrayList<Carro> getAllCarrosVendaBD(){
        ArrayList<Carro> carros = new ArrayList<>();
        Cursor cursor = this.sqLiteDatabase.query(TABLE_NAME_CARROVENDA, new String[]{
                idCarro_CARRO, ano_CARRO, quilometros_CARRO, fk_idPessoa_CARRO, precoCarro_CARRO, modeloCarro_CARRO,marcaCarro_CARRO,matricula_CARRO,tipoCarro_CARRO,combustivel_CARRO,vendido_CARRO}, null, null, null, null, null);
        if (cursor.moveToFirst()){
            do {
                Carro auxCarro = new Carro(cursor.getInt(0), cursor.getInt(1), cursor.getInt(2), cursor.getInt(3), cursor.getInt(4), cursor.getString(5),
                        cursor.getString(6),cursor.getString(7),cursor.getString(8),cursor.getString(9),cursor.getInt(10));
                carros.add(auxCarro);
            }while (cursor.moveToNext());
        }
        return carros;
    }
}
