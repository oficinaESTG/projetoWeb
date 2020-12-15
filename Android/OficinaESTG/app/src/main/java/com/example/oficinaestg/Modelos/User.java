package com.example.oficinaestg.Modelos;

public class User {
    private int id, status, created_at, updated_at;
    private String username, auth_key, email, password_hash, password_reset_token,verification_token ;

    public User(int id, String username, String auth_key, String email, int created_at, int updated_at, String password_hash, String password_reset_token, String verification_token){
            this.id=id;
            this.username=username;
            this.auth_key=auth_key;
            this.email=email;
            this.created_at=created_at;
            this.updated_at=updated_at;
            this.password_hash=password_hash;
            this.password_reset_token=password_reset_token;
            this.verification_token=verification_token;
    }

    public int getId() {
        return id;
    }

    public String getEmail() {
        return email;
    }
}
