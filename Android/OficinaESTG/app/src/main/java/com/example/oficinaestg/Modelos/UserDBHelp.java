package com.example.oficinaestg.Modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class UserDBHelp extends SQLiteOpenHelper {

    private static final int DB_VERSION = 1;
    private static final String BD_NAME = "UserBD";
    private static final String TABLE_NAME = "User";

    private final SQLiteDatabase sqLiteDatabase;

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

    private User user;

    public UserDBHelp( Context context) {
        super(context, BD_NAME, null, DB_VERSION);
        this.sqLiteDatabase = this.getReadableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createLivroTable =
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
        db.execSQL(createLivroTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        sqLiteDatabase.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        this.onCreate(sqLiteDatabase);
    }

    public void adicionarUserBD(User user){
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

    public void removerAllUserBD(){
        this.sqLiteDatabase.delete(TABLE_NAME, null, null);
    }

    public User getUserBDbyNome(String email, String password){
        Cursor cursor = this.sqLiteDatabase.query(TABLE_NAME, new String[]{
                id_USER, status_USER, created_at_USER, updated_at_at_USER, username_USER, auth_key_USER,email_USER,password_hash_USER,password_reset_token_USER,verification_token_USER,password_USER},
                username_USER + "=?",new String[] { email }, null, null, null, null);
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
        }catch (Exception e){
            //ver com professor
            return null;
        }


    }
}
